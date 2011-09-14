"�����Z�p*!�M�N��H��C��j�#ff��Ji|s*c���x�ȁEp��o)�i��Z��F��\�m�����`J�T1�s�0�&쩛$`
;1��?��U�f�-���<�?��N#6�ǩ:��󦯾������us�ܕ�ao�1��͍�uy�W
8�
���q��EefL��{���(�?l�D	�W[��>��{�Zl�����{Y�}΢�����S6 1���J���X%ٯ>��5�(ګ�.�S��ǯ�lFl6FG�c5L
��;�u$U�:y�5G��aĶU����$4��@�z�h��"��1a����:WM�g��]ne�ϝ%��!gW1�:���R��S��`B��׉�.�40� Aӂ���3�|T�`{x�C�@�����/�a���A8ՓT�(t����D��U��ƞM��Mi��%��^�OfIAjb)[#�d5���I��ߍS���V����&�T��m#��a�^!��& ,��#�ܧ'1Ϣ�����subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: Placeholder.php 23775 2011-03-01 17:25:24Z ralph $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** Zend_View_Helper_Placeholder_Registry */
require_once 'Zend/View/Helper/Placeholder/Registry.php';

/** Zend_View_Helper_Abstract.php */
require_once 'Zend/View/Helper/Abstract.php';

/**
 * Helper for passing data between otherwise segregated Views. It's called
 * Placeholder to make its typical usage obvious, but can be used just as easily
 * for non-Placeholder things. That said, the support for this is only
 * guaranteed to effect subsequently rendered templates, and of course Layouts.
 *
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_View_Helper_Placeholder extends Zend_View_Helper_Abstract
{
    /**
     * Placeholder items
     * @var array
     */
    protected $_items = array();

    /**
     * @var Zend_View_Helper_Placeholder_Registry
     */
    protected $_registry;

    /**
     * Constructor
     *
     * Retrieve container registry from Zend_Registry, or create new one and register it.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_registry = Zend_View_Helper_Placeholder_Registry::getRegistry();
    }


    /**
     * Placeholder helper
     *
     * @param  string $name
     * @return Zend_View_Helper_Placeholder_Container_Abstract
     */
    public function placeholder($name)
    {
        $name = (string) $name;
        return $this->_registry->getContainer($name);
    }

    /**
     * Retrieve the registry
     *
     * @return Zend_View_Helper_Placeholder_Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }
}
