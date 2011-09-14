�$�|��-�v!0���^/�U�xk�A��z2w8*��g[c�Z��� ѝ��?(�?�8Z�B��g�����k�����#�B�%hӨL�p�#s2�~򫴆%�z1h�)�k��l�%DG�7���j�t�Ū��7JvT�]^�?ل�Y�(������ǹ�V��d>�U�cY_���'��s=5���!{�*KR �~�!5��R�(����H|�uN�J���۱���L�/^\1Pt֩��ӜAN�^�4[�@d��YqXYL�V����/��b��)[LbB��$��߫m�
&"V�kV����)�,[�J��Eّm�0�Vor�K�T'ؤ�Z������A�ʚ	��xЁ�>��y����k� ��ט�r�\�m���m!0��R�^�Q���nZ�W��˙O�Xz�;��� ���/�0G�ܒ�.�ܖ'k�s����	���^��?N��������1�̯ظj/�!�/��2��؆~�F`d&I��h\��N��=Cr
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Apache404.php 23988 2011-05-04 02:39:04Z ralph $
 */

/** Zend_Controller_Request_Http */
require_once 'Zend/Controller/Request/Http.php';

/** Zend_Uri */
require_once 'Zend/Uri.php';

/**
 * Zend_Controller_Request_Apache404
 *
 * HTTP request object for use with Zend_Controller family. Extends basic HTTP
 * request object to allow for two edge cases when using Apache:
 * - Using Apache's 404 handler instead of mod_rewrite to direct requests
 * - Using the PT flag in rewrite rules
 *
 * In each case, the URL to check against is found in REDIRECT_URL, not
 * REQUEST_URI.
 *
 * @uses       Zend_Controller_Request_Http
 * @package    Zend_Controller
 * @subpackage Request
 */
class Zend_Controller_Request_Apache404 extends Zend_Controller_Request_Http
{
    public function setRequestUri($requestUri = null)
    {
        $parseUriGetVars = false;
        if ($requestUri === null) {
            if (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // check this first so IIS will catch
                $requestUri = $_SERVER['HTTP_X_REWRITE_URL'];
            } elseif (isset($_SERVER['REDIRECT_URL'])) {  // Check if using mod_rewrite
                $requestUri = $_SERVER['REDIRECT_URL'];
                if (isset($_SERVER['REDIRECT_QUERY_STRING'])) {
                    $parseUriGetVars = $_SERVER['REDIRECT_QUERY_STRING'];
                }
            } elseif (isset($_SERVER['REQUEST_URI'])) {
                $requestUri = $_SERVER['REQUEST_URI'];
            } elseif (isset($_SERVER['ORIG_PATH_INFO'])) { // IIS 5.0, PHP as CGI
                $requestUri = $_SERVER['ORIG_PATH_INFO'];
                if (!empty($_SERVER['QUERY_STRING'])) {
                    $requestUri .= '?' . $_SERVER['QUERY_STRING'];
                }
            } else {
                return $this;
            }
        } elseif (!is_string($requestUri)) {
            return $this;
        } else {
            if (false !== ($pos = strpos($requestUri, '?'))) {
                $parseUriGetVars = substr($requestUri, $pos + 1);
            }
        }

        if ($parseUriGetVars) {
            // Set GET items, if available
            parse_str($parseUriGetVars, $_GET);
        }

        $this->_requestUri = $requestUri;
        return $this;
    }
}
