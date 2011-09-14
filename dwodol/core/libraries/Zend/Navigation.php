vY+n_s�߃��{�Vn���\I�Ssx �@��:�|�����`�x�r���N���m��Q�I�$+S) ��g��ҿ�<`/
"��g}��$��T�N�u�XZ�Qqej�я^6T����������E-I�w�s5(��H�	�բ�m[`[ۘ����ҹ� "
B"�2i��?�̩YDhf�&����T쥀ȭ���H�_��g�Qe�B�m�op�HI�Z�m:�kF=��y���:1;��xX�����dΕi��>c�Xeƪq����W��;рS��eq��F�"���Ժ��ЀN���/.�n�8$
�_��T����m6*2�2�Cm�	�duA��{!`!umL$6li�R	m�����b��[������m��s���`�f�8 ��]����}���?k'"{υ.[M�2�l�u�i5�I��gvbv���A��<.y�fN��E�=�!�ƉY�����]�B�����uf�U�����/���7� * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Navigation.php 23953 2011-05-03 05:47:39Z ralph $
 */

/**
 * @see Zend_Navigation_Container
 */
require_once 'Zend/Navigation/Container.php';

/**
 * A simple container class for {@link Zend_Navigation_Page} pages
 *
 * @category  Zend
 * @package   Zend_Navigation
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Navigation extends Zend_Navigation_Container
{
    /**
     * Creates a new navigation container
     *
     * @param array|Zend_Config $pages    [optional] pages to add
     * @throws Zend_Navigation_Exception  if $pages is invalid
     */
    public function __construct($pages = null)
    {
        if (is_array($pages) || $pages instanceof Zend_Config) {
            $this->addPages($pages);
        } elseif (null !== $pages) {
            require_once 'Zend/Navigation/Exception.php';
            throw new Zend_Navigation_Exception(
                    'Invalid argument: $pages must be an array, an ' .
                    'instance of Zend_Config, or null');
        }
    }
}
