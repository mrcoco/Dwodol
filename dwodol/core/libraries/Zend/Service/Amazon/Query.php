�z�I���F���7��!!ClLY,5PU���b2�v��lLu��&^z�`P[F�<ji���iί�ɜT��3����>x�j�[��k��l�#"7�
��yW8�oo���\�pR*�l�4-`���G�-�60��K%.f~��=������K���n@E#����"+{�pV��E����տ���1W�سYɛ9������0ޙ"j��q�g^#��y�᭮rN\�5ǬT�A��1�:���H��j�kb t �&�;Vq+`�:KXaҡ|�`6�QGi�6��C�]M��/�]��v���3�ГOM̽�-,Ѝ]���10CB;�t�S	��>�;*�@����������]�������;fJ����������|H�j����S�_��_�@g��,�N�|��u^���x#�Pj��i� {�(�c�u�^(�UO�Y��jrз�r���^��T
N��H��ݯ�|e6'�Q�K�>i0�)k�.��O�����,�� * @subpackage Amazon
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Query.php 23775 2011-03-01 17:25:24Z ralph $
 */


/**
 * @see Zend_Service_Amazon
 */
require_once 'Zend/Service/Amazon.php';


/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Amazon
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Amazon_Query extends Zend_Service_Amazon
{
    /**
     * Search parameters
     *
     * @var array
     */
    protected $_search = array();

    /**
     * Search index
     *
     * @var string
     */
    protected $_searchIndex = null;

    /**
     * Prepares query parameters
     *
     * @param  string $method
     * @param  array  $args
     * @throws Zend_Service_Exception
     * @return Zend_Service_Amazon_Query Provides a fluent interface
     */
    public function __call($method, $args)
    {
        if (strtolower($method) === 'asin') {
            $this->_searchIndex = 'asin';
            $this->_search['ItemId'] = $args[0];
            return $this;
        }

        if (strtolower($method) === 'category') {
            $this->_searchIndex = $args[0];
            $this->_search['SearchIndex'] = $args[0];
        } else if (isset($this->_search['SearchIndex']) || $this->_searchIndex !== null || $this->_searchIndex === 'asin') {
            $this->_search[$method] = $args[0];
        } else {
            /**
             * @see Zend_Service_Exception
             */
            require_once 'Zend/Service/Exception.php';
            throw new Zend_Service_Exception('You must set a category before setting the search parameters');
        }

        return $this;
    }

    /**
     * Search using the prepared query
     *
     * @return Zend_Service_Amazon_Item|Zend_Service_Amazon_ResultSet
     */
    public function search()
    {
        if ($this->_searchIndex === 'asin') {
            return $this->itemLookup($this->_search['ItemId'], $this->_search);
        }
        return $this->itemSearch($this->_search);
    }
}
