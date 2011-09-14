���>\Sx���.��m�������k<>&�?��5SR�o`�EF�ş�ً�Cx�}v\��Gj��O��!�xŐ�ft���W�/P�>�3�����S���hc��U�A@�9ܾ��z��' C�yV�x����K;����w0��Rz��[���\fO迀�9Y%R��	����(f�������2��ҳ.��4E�������}��cuc*ytD�&k���{�f'\NgA��Q�@��2M�BF��
�Ʃ�D��R�ů�My?�'�U֛w<���_Lb a
�7�ؔ�îhP�A	Ӗd��};��R�;s�Dsڸe�8�?� �d�#���ZwN����-�V+\[�:|��ϩ4�ES���^�Di�*�Z��(�	��P��Qַ�M �끠���� � I had rehearsals for
the Easter play today.����X�$   �A������e0 !�9���_"s�q��J��0:���v9�2��� @subpackage Exif
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: FocalLength.php 23775 2011-03-01 17:25:24Z ralph $
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
 * Represents the exif:focalLength element used by the Gdata Exif extensions.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Exif
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Exif_Extension_FocalLength extends Zend_Gdata_Extension
{

    protected $_rootNamespace = 'exif';
    protected $_rootElement = 'focallength';

    /**
     * Constructs a new Zend_Gdata_Exif_Extension_FocalLength object.
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
