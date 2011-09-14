�8a�d�k��'���n\��V��D�~W�G�H0�zF���V��|�����훀�9�y�ou��nF6��1f)\�������ٝ��%�<t�|�Π%��?����YI�0����ZU�D���xٛ�V��,~�����ay���-G)����	�Oo���.�B�3I���fO����d�l�5fh�*.!6�4�i��J2�'�6�MO����^~�5�f�#�I�Xa�@�K�
���G�U���pq�*`�fAUaCx�N��ɧ���v�Xt�'�fe��f�_����%�5F~�
�uoD���[�ꝑ,����,���0��Lq�ďȖ��©pj��l9Y֌n���!rFN��eY&��'����Wƺ��%�yM���}D|X�0�'���D6�u
���������7���4�{�U��Db�$ߏ-��yp,�^�o�~�i���l!ñ2S��.���u��m�ʙ�.��� v���������Z�ʎ���$�,'* @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: IpLocation.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Service_DeveloperGarden_Client_ClientAbstract
 */
require_once 'Zend/Service/DeveloperGarden/Client/ClientAbstract.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_LocateIPResponseType
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/LocateIPResponseType.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/LocateIPResponse.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_IPAddressLocationType
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/IPAddressLocationType.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_RegionType
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/RegionType.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_GeoCoordinatesType
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/GeoCoordinatesType.php';

/**
 * @see Zend_Service_DeveloperGarden_Response_IpLocation_CityType
 */
require_once 'Zend/Service/DeveloperGarden/Response/IpLocation/CityType.php';

/**
 * @see Zend_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest
 */
require_once 'Zend/Service/DeveloperGarden/Request/IpLocation/LocateIPRequest.php';

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_DeveloperGarden_IpLocation
    extends Zend_Service_DeveloperGarden_Client_ClientAbstract
{
    /**
     * wsdl file
     *
     * @var string
     */
    protected $_wsdlFile = 'https://gateway.developer.telekom.com/p3gw-mod-odg-iplocation/services/IPLocation?wsdl';

    /**
     * wsdl file local
     *
     * @var string
     */
    protected $_wsdlFileLocal = 'Wsdl/IPLocation.wsdl';

    /**
     * Response, Request Classmapping
     *
     * @var array
     *
     */
    protected $_classMap = array(
        'LocateIPResponseType'  => 'Zend_Service_DeveloperGarden_Response_IpLocation_LocateIPResponseType',
        'IPAddressLocationType' => 'Zend_Service_DeveloperGarden_Response_IpLocation_IPAddressLocationType',
        'RegionType'            => 'Zend_Service_DeveloperGarden_Response_IpLocation_RegionType',
        'GeoCoordinatesType'    => 'Zend_Service_DeveloperGarden_Response_IpLocation_GeoCoordinatesType',
        'CityType'              => 'Zend_Service_DeveloperGarden_Response_IpLocation_CityType',
    );

    /**
     * locate the given Ip address or array of addresses
     *
     * @param Zend_Service_DeveloperGarden_IpLocation_IpAddress|string $ip
     * @return Zend_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse
     */
    public function locateIP($ip)
    {
        $request = new Zend_Service_DeveloperGarden_Request_IpLocation_LocateIPRequest(
            $this->getEnvironment(),
            $ip
        );

        $result = $this->getSoapClient()->locateIP($request);

        $response = new Zend_Service_DeveloperGarden_Response_IpLocation_LocateIPResponse($result);
        return $response->parse();
    }
}
