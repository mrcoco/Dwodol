ۿ���~Ѡ:�M�I�hq,��I(t��z/sƃ�a���֬����ג@^��Wy��C>��$P�g3<�X6+]�L�����<c����5��а���b��Q�����+̴B�X�h�/C�?�
����N�(L:J������Ȁ���hߑ��}���P=:XL��<_�2�IЪ����9ܺe�)�R�ܚ2H�A0���jj}��خ.������*��1j���1������%l��$�9�C����L���v!}�>�&6�Kb��*⻑��-���pY�������S_�:.�m�e��p,ԕ�94��E��]?/z��Ȏ���3Ȧ��2���	[`��^1ǥh��p#h�c��6֚����	CKO�[R/������׊K؞�S�[8�y��s�����������ȇ�j�?֢E!�r��N�#�d��6���Mkd젴n`:��k��~��$bp׾�������"`0Ȩ�O�T�p\����#���if����)ǖsubpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Interface.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Basic Interface for factilities that load Zend_Tool providers or manifests.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Zend_Tool_Framework_Loader_Interface
{
    /**
     * Load Providers and Manifests
     *
     * Returns an array of all loaded class names.
     *
     * @return array
     */
    public function load();
}
