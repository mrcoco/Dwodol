f��թ����O��3��^��cH��{�!E�3� D'��Q�����ʅ���q!lS/����k��{x	/�z�z�Aē�}`�]ި��evVE̱wR���)���.%`bH�r5_��0Y��&kI��ż��c��GpA[����&�IQ��� ZL@&; �8a�����]Y�_(���rs�v�񧥀��=b�?�߰�P�=GE*'��t*�����*�y��bt�w����l��2�lE��Mr�M6q�eV���cB� �-�<���iMDL�7�g^K�}E)xv��E��v���\wm�[8�2��&���R�:�k�\��)�>!۽�l���Xӫ+6C%A�m�g�ơ�	��a�J�	��ֽ��]�v�T��P����������-B��pw0�c� $=�-.�" ̾��\�;1����$kJ���a�b�Z&��탯�Cҭ�o�\�R�y|r!����f�&ij���i{�2�6�o�A'�p�a6�
�8����>���� @subpackage Exif
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Iso.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_Extension
 */
require_once 'Zend/Gdata/Extension.php';

/**
 * @see Zend_Gdata_Exif
 */
require_once 'Zend/Gdata/Exif.php';

/**
 * Represents the exif:iso element used by the Gdata Exif extensions.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Exif
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Exif_Extension_Iso extends Zend_Gdata_Extension
{

    protected $_rootNamespace = 'exif';
    protected $_rootElement = 'iso';

    /**
     * Constructs a new Zend_Gdata_Exif_Extension_Iso object.
     *
     * @param string $text (optional) The value to use for this element.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Exif::$namespaces);
        parent::__construct();
        $this->setText($text);
    }

}
