�^6U���\���h�_���T�NtxȌ��|Un�}���\v�	s �2tC9,�·�*��K|��a�A�a�:���~�!̼.`gQQVc٦g���7���nܚZ�B�*t쯶
�,k�1.����C!.����n/�/M�H����8cޓ�ڤ�|�A�2�~˔��$��Sl�ED3�ĐTjZ�FN]�1v�c��_ �ˬ����	��7)�y!�!����5N�!!��	�A���DY��[��i=E��S��uC0
g�>�6`L�B=4�r��N8f�u0 ��fE�R���W���#�F�[;�f�U�R��J�Xk��6�5@Nbj2,D�_f>��뺙�a�S�\��m��{��*e�?n6N-Bn�̲	��3��_��k����p��Ѭ���MlZ�-:��>�HCJ�N��f�K�:����5����͇���f��8;��ҵB,0���2d���A��$ _ܧ���Bo���]�6��7�9��G�8<kzX�N�<�m�v<إ���9� * @subpackage Zend_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: XmlEnc.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Zend_InfoCard_Xml_EncryptedData/Abstract.php
 */
require_once 'Zend/InfoCard/Xml/EncryptedData/Abstract.php';

/**
 * An XmlEnc formatted EncryptedData XML block
 *
 * @category   Zend
 * @package    Zend_InfoCard
 * @subpackage Zend_InfoCard_Xml
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_InfoCard_Xml_EncryptedData_XmlEnc extends Zend_InfoCard_Xml_EncryptedData_Abstract
{

    /**
     * Returns the Encrypted CipherValue block from the EncryptedData XML document
     *
     * @throws Zend_InfoCard_Xml_Exception
     * @return string The value of the CipherValue block base64 encoded
     */
    public function getCipherValue()
    {
        $this->registerXPathNamespace('enc', 'http://www.w3.org/2001/04/xmlenc#');

        list(,$cipherdata) = $this->xpath("//enc:CipherData");

        if(!($cipherdata instanceof Zend_InfoCard_Xml_Element)) {
            throw new Zend_InfoCard_Xml_Exception("Unable to find the enc:CipherData block");
        }

        list(,$ciphervalue) = $cipherdata->xpath("//enc:CipherValue");

        if(!($ciphervalue instanceof Zend_InfoCard_Xml_Element)) {
            throw new Zend_InfoCard_Xml_Exception("Unable to fidn the enc:CipherValue block");
        }

        return (string)$ciphervalue;
    }
}
