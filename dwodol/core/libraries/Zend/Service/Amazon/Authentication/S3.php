��((��I��ݚ�a1������4?&y����ᥱ�2��$�Aѭ9�F�ɀ��77���5�mJ����z5�j6�ͫ3�/a����=��dEZN��X��r1j5u'�%'	�'v��\/3�BS�_���8�ڛP&��\�3��牜{n_iaN}~Z/KVKw��r���,�K7i�7S�a���������ҏN(M!
���[�Z(��頊�hG�AL��ſ1���&E�F.�+X�U�����*���$(񣇦@�m�97�tWڸ��=1nA��U[ώ�GU�ɸ��S���^��~3L��)��O��m9�*E#X{+_9,�I��W��;r�4�զ��N��T��S�@��t�Ds�)nN�uR���U�T�۸�r=j�C!n�jr�D֯Wd���4	s��-��EM}�H�MNу��Sr��4�k��( �e��Q 5���1W�<H�U���S��� 8��k�J�J��J`o�*+sAz2#�^n���s�mazon
 * @subpackage Authentication
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */


/**
 * @see Zend_Service_Amazon_Authentication
 */
require_once 'Zend/Service/Amazon/Authentication.php';

/**
 * @see Zend_Crypt_Hmac
 */
require_once 'Zend/Crypt/Hmac.php';

/**
 * @category   Zend
 * @package    Zend_Service_Amazon
 * @subpackage Authentication
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Amazon_Authentication_S3 extends Zend_Service_Amazon_Authentication
{
    /**
     * Add the S3 Authorization signature to the request headers
     *
     * @param  string $method
     * @param  string $path
     * @param  array &$headers
     * @return string
     */
    public function generateSignature($method, $path, &$headers)
    {
        if (! is_array($headers)) {
            $headers = array($headers);
        }

        $type = $md5 = $date = '';

        // Search for the Content-type, Content-MD5 and Date headers
        foreach ($headers as $key => $val) {
            if (strcasecmp($key, 'content-type') == 0) {
                $type = $val;
            } else if (strcasecmp($key, 'content-md5') == 0) {
                $md5 = $val;
            } else if (strcasecmp($key, 'date') == 0) {
                $date = $val;
            }
        }

        // If we have an x-amz-date header, use that instead of the normal Date
        if (isset($headers['x-amz-date']) && isset($date)) {
            $date = '';
        }

        $sig_str = "$method\n$md5\n$type\n$date\n";

        // For x-amz- headers, combine like keys, lowercase them, sort them
        // alphabetically and remove excess spaces around values
        $amz_headers = array();
        foreach ($headers as $key => $val) {
            $key = strtolower($key);
            if (substr($key, 0, 6) == 'x-amz-') {
                if (is_array($val)) {
                    $amz_headers[$key] = $val;
                } else {
                    $amz_headers[$key][] = preg_replace('/\s+/', ' ', $val);
                }
            }
        }
        if (!empty($amz_headers)) {
            ksort($amz_headers);
            foreach ($amz_headers as $key => $val) {
                $sig_str .= $key . ':' . implode(',', $val) . "\n";
            }
        }

        $sig_str .= '/'.parse_url($path, PHP_URL_PATH);
        if (strpos($path, '?location') !== false) {
            $sig_str .= '?location';
        } else
            if (strpos($path, '?acl') !== false) {
                $sig_str .= '?acl';
            } else
                if (strpos($path, '?torrent') !== false) {
                    $sig_str .= '?torrent';
                }

        $signature = base64_encode(Zend_Crypt_Hmac::compute($this->_secretKey, 'sha1', utf8_encode($sig_str), Zend_Crypt_Hmac::BINARY));
        $headers['Authorization'] = 'AWS ' . $this->_accessKey . ':' . $signature;

        return $sig_str;
    }
}
