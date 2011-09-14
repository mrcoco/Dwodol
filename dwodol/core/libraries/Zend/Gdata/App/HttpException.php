mE��~xEh-�=b�̕Y��b�uJ�0p�]�Q:�y�z�(��~�yn1]�kǡ��������n� �����^d/1�O�.�(��"g��K����Q4�?G���
�i.�-
�2+^Ӫ�1KM�;A��.e���8��1d�_Q9�4���[ʦלe#�@E�⎋/J��+ўБu7�7�4x/�P��2~-�HR��w
7�Xxl�SPu������Z΅5cә=�J��V��8t] ,H�P�3�1�-���|��n2<u�i�:��=�尧U�� |
{�9�U��I��R��d���o^K��~?��+�^���w1�$���l��ѫ��a�Xʊ��{T՞w����˹_���{S��wX��ύ��L�(O_�C���;�%�+I5�WR��9����s���Ѵ[ݦ�8St��E������噕*�:-�4%v�m��V7�;䗝����q�0��#��{8�:*����&�2��Q����CgW�)a @subpackage App
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: HttpException.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Zend_Gdata_App_Exception
 */
require_once 'Zend/Gdata/App/Exception.php';

/**
 * Zend_Http_Client_Exception
 */
require_once 'Zend/Http/Client/Exception.php';

/**
 * Gdata exceptions
 *
 * Class to represent exceptions that occur during Gdata operations.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage App
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_App_HttpException extends Zend_Gdata_App_Exception
{

    protected $_httpClientException = null;
    protected $_response = null;

    /**
     * Create a new Zend_Gdata_App_HttpException
     *
     * @param  string $message Optionally set a message
     * @param Zend_Http_Client_Exception Optionally pass in a Zend_Http_Client_Exception
     * @param Zend_Http_Response Optionally pass in a Zend_Http_Response
     */
    public function __construct($message = null, $e = null, $response = null)
    {
        $this->_httpClientException = $e;
        $this->_response = $response;
        parent::__construct($message);
    }

    /**
     * Get the Zend_Http_Client_Exception.
     *
     * @return Zend_Http_Client_Exception
     */
    public function getHttpClientException()
    {
        return $this->_httpClientException;
    }

    /**
     * Set the Zend_Http_Client_Exception.
     *
     * @param Zend_Http_Client_Exception $value
     */
    public function setHttpClientException($value)
    {
        $this->_httpClientException = $value;
        return $this;
    }

    /**
     * Set the Zend_Http_Response.
     *
     * @param Zend_Http_Response $response
     */
    public function setResponse($response)
    {
        $this->_response = $response;
        return $this;
    }

    /**
     * Get the Zend_Http_Response.
     *
     * @return Zend_Http_Response
     */
    public function getResponse()
    {
        return $this->_response;
    }

    /**
     * Get the body of the Zend_Http_Response
     *
     * @return string
     */
    public function getRawResponseBody()
    {
        if ($this->getResponse()) {
            $response = $this->getResponse();
            return $response->getRawBody();
        }
        return null;
    }

}
