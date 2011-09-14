�%�Eb	*A:B �-Z��@	�~8a���R�FY׃��[ah-����:(�G(��p�6�0jHb��U�Ue�O��H���`0���@"�����f�MP��Z��l I�e��D��0$���L�]��m��&q���Y�jb�@�Ȁ��=��t��}�i�/��A�%�߱?"�������}����     8!�"���N�JB %)m`\E�}\�T�W��ҙ'@��?���:�L�oB]قo�P�Y:�6ާ� !
�� .�����3����4���Խ�$e�� �Ր��)=�k��n����J��֟�z6�|aMp �0����
�ݍ�W$�����:^3����|�J��� ��� D[@B��HAQٻyR�p� `�!�2�� �DL!@�Uq�;���jȋ:�$.��X�Z�N�ZR\3<���O����n��^�dF����t�:n�(�DA���VP�vc���{�(�Ο���i[�悳Z @subpackage Photos
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Size.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_Extension
 */
require_once 'Zend/Gdata/Extension.php';

/**
 * @see Zend_Gdata_Photos
 */
require_once 'Zend/Gdata/Photos.php';

/**
 * Represents the gphoto:size element used by the API.
 * The size of a photo in bytes.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Photos_Extension_Size extends Zend_Gdata_Extension
{

    protected $_rootNamespace = 'gphoto';
    protected $_rootElement = 'size';

    /**
     * Constructs a new Zend_Gdata_Photos_Extension_Size object.
     *
     * @param string $text (optional) The value to represent.
     */
    public function __construct($text = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Photos::$namespaces);
        parent::__construct();
        $this->setText($text);
    }

}
