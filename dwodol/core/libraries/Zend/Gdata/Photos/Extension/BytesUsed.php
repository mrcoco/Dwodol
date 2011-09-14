��ǧɂM��0�Hf-1��J�
o_��)����)ի0��x�;Iy�������!�����h���<��B36��O@.zChh�y��8��C� �,f�1!EwV}���ã����4ކlv6p�Ʈ�0MfX����%M�����_�)��e7�Z�G��Ω��Z�x��[@��e?T.iz�r^�|ZÃ!�����e�@w"��}��12g�XL�
�6��j|<E�}�ܯ��XN	ҿ�ҳFXL���x9F���'Q��Ĺp3�ʮEwڰ��1�6U��/�Ն]�����,����fS=�qjF(��݈��:���<&}0�Z&e���^gz�r,�s����M�������+J���f~�4V�I����M� �@ �1�<#�=�7��:t��٤_p.�湟����C�9}����D������D��:f��\��5�!i=�%�7����;J�R6i� `l��T䷟e�}BXP�˵��93���É�ZΈ�N�:�����	M3D_ @subpackage Photos
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: BytesUsed.php 23775 2011-03-01 17:25:24Z ralph $
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
 * Represents the gphoto:bytesUsed element used by the API.
 * This indicates the number of bytes of storage used by an album.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage Photos
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Photos_Extension_BytesUsed extends Zend_Gdata_Extension
{

    protected $_rootNamespace = 'gphoto';
    protected $_rootElement = 'bytesUsed';

    /**
     * Constructs a new Zend_Gdata_Photos_Extension_BytesUsed object.
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
