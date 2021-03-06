�����e�˞��Mh;�����m��1}���B�3Τ�����J�y��2���p!0)�6i
�V��#pm�� p!�ʳ6��Ж0��[ڹNq'�L>m����W��D ���!E�pK�� ������(k��x� ���%/��m	�wc�`�E����)SA��Q�b��� 0�"m�?�f,b<��=�,A	�Q@:�Ɂ��
�`�-h������~���� �@
 '`פ:	� ̴ �!��32��� �PE�M�2�������1�u��-����Ý�� #�!��TVg.Hɜ�t �рQ �A-V[���h��~��  ' N`�,& 0 	���fqTBP �Y�J
��5�>��Ϻ��4�� ��Tސ9��G�
�h�/�q�O֩  
�@ � ��
L�7�oRV�7��Qk��p!��76�[jho�1�����P�^z�X��_o��Ax������1I��t7��� �P * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Gtin14.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Validate_Barcode_AdapterAbstract
 */
require_once 'Zend/Validate/Barcode/AdapterAbstract.php';

/**
 * @category   Zend
 * @package    Zend_Validate
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Validate_Barcode_Gtin14 extends Zend_Validate_Barcode_AdapterAbstract
{
    /**
     * Allowed barcode lengths
     * @var integer
     */
    protected $_length = 14;

    /**
     * Allowed barcode characters
     * @var string
     */
    protected $_characters = '0123456789';

    /**
     * Checksum function
     * @var string
     */
    protected $_checksum = '_gtin';
}
