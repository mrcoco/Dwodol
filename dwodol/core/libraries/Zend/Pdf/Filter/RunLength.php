�o�_,t�:����Ȕ�L�X�,�RԜo|�vn���-{K
�C��oc�2�F��df��^ʆ��(�Y���|4�rv��5��9Tq�8��ӧ�ql2�A�s{�.�g���FC<RUSQy_+�^WFD*�E�e�%�ۣ��V��CxQ�E����=�����e��UT��X�"���I<��dV����?g�_��G�$A��� ���=>lR�d�s���{;m�<�ƆзH^���RNڕ��"�䟠�K��6�d����8�� `UM��1�@���v��2%�tJYр�����#�Ԁ{�������W��8����7M�l����Z��<;lh��>�mS3�9�$ ҕ����@�41��$����U�� 3���}�S"�\�IVu{�8�]uyjXH�+ӄ��\(�t�\ h��z�E�'��%��:U��bYgʸ���
zv!�+?.$����*��L�b<&�H�;���L�:(����ۅDƷ����_�D�8�>�}G6�a��������opyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: RunLength.php 23775 2011-03-01 17:25:24Z ralph $
 */


/** Zend_Pdf_Filter_Interface */
require_once 'Zend/Pdf/Filter/Interface.php';

/**
 * RunLength stream filter
 *
 * @package    Zend_Pdf
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Pdf_Filter_RunLength implements Zend_Pdf_Filter_Interface
{
    /**
     * Encode data
     *
     * @param string $data
     * @param array $params
     * @return string
     * @throws Zend_Pdf_Exception
     */
    public static function encode($data, $params = null)
    {
        $output = '';

        $chainStartOffset = 0;
        $offset = 0;

        while ($offset < strlen($data)) {
            // Do not encode 2 char chains since they produce 2 char run sequence,
            // but it takes more time to decode such output (because of processing additional run)
            if (($repeatedCharChainLength = strspn($data, $data[$offset], $offset + 1, 127) + 1)  >  2) {
                if ($chainStartOffset != $offset) {
                    // Drop down previouse (non-repeatable chars) run
                    $output .= chr($offset - $chainStartOffset - 1)
                             . substr($data, $chainStartOffset, $offset - $chainStartOffset);
                }

                $output .= chr(257 - $repeatedCharChainLength) . $data[$offset];

                $offset += $repeatedCharChainLength;
                $chainStartOffset = $offset;
            } else {
                $offset++;

                if ($offset - $chainStartOffset == 128) {
                    // Maximum run length is reached
                    // Drop down non-repeatable chars run
                    $output .= "\x7F" . substr($data, $chainStartOffset, 128);

                    $chainStartOffset = $offset;
                }
            }
        }

        if ($chainStartOffset != $offset) {
            // Drop down non-repeatable chars run
            $output .= chr($offset - $chainStartOffset - 1) . substr($data, $chainStartOffset, $offset - $chainStartOffset);
        }

        $output .= "\x80";

        return $output;
    }

    /**
     * Decode data
     *
     * @param string $data
     * @param array $params
     * @return string
     * @throws Zend_Pdf_Exception
     */
    public static function decode($data, $params = null)
    {
        $dataLength = strlen($data);
        $output = '';
        $offset = 0;

        while($offset < $dataLength) {
            $length = ord($data[$offset]);

            $offset++;

            if ($length == 128) {
                // EOD byte
                break;
            } else if ($length < 128) {
                $length++;

                $output .= substr($data, $offset, $length);

                $offset += $length;
            } else if ($length > 128) {
                $output .= str_repeat($data[$offset], 257 - $length);

                $offset++;
            }
        }

        return $output;
    }
}

