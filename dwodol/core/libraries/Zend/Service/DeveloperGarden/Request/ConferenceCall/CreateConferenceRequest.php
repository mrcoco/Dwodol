�+�~A#k���9w���[˃���ڟL�Q�ߠ ��0J�q���������zP��!Y`qT�C�.s�3�M��g�c���b�e8����*bPU[����ո^�������� �S_��k�����e{c��&rp�C��e�I���
� 4 k����A�|��DS����5�����H��JGyo���1���Ȓ~���$H'�4�? !�dn$z+��=��	2��dxd�'
 xX���#��铊7�M�Y4����H]<�+���qb4Yg��xn�
��O��k  �A��3���-�����]�]9���/�@@��Z�_�$w��9����6�Kc	��ݱ�8�n���m��f;dj�C\�vmDL1b6�N��o����ΖK��Ox��ъ�.Ӽ��hW���nfk���|<p��sQ�sڶB?��n��L��b�N���V�����lh�{�&6�iP��k�g�1S#�~4�#Έ6%�cCV0�����!��* @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: CreateConferenceRequest.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Service_DeveloperGarden_Request_RequestAbstract
 */
require_once 'Zend/Service/DeveloperGarden/Request/RequestAbstract.php';

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceRequest
    extends Zend_Service_DeveloperGarden_Request_RequestAbstract
{
    /**
     * account to be used for this conference
     *
     * @var integer
     */
    public $account = null;

    /**
     * unique owner id
     *
     * @var string
     */
    public $ownerId = null;

    /**
     * object with details for this conference
     *
     * @var Zend_Service_DeveloperGarden_ConferenceCall_ConferenceDetail
     */
    public $detail = null;

    /**
     * object with schedule for this conference
     *
     * @var Zend_Service_DeveloperGarden_ConferenceCall_ConferenceSchedule
     */
    public $schedule = null;

    /**
     * constructor
     *
     * @param integer $environment
     * @param string $ownerId
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $conferenceDetails
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ConferenceSchedule $conferenceSchedule
     * @param integer $account
     */
    public function __construct($environment, $ownerId,
        Zend_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $conferenceDetails,
        Zend_Service_DeveloperGarden_ConferenceCall_ConferenceSchedule $conferenceSchedule = null,
        $account = null
    ) {
        parent::__construct($environment);
        $this->setOwnerId($ownerId)
             ->setDetail($conferenceDetails)
             ->setSchedule($conferenceSchedule)
             ->setAccount($account);
    }

    /**
     * sets $schedule
     *
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ConferenceSchedule $schedule
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceRequest
     */
    public function setSchedule(
        Zend_Service_DeveloperGarden_ConferenceCall_ConferenceSchedule $schedule = null
    ) {
        $this->schedule = $schedule;
        return $this;
    }

    /**
     * sets $detail
     *
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $detail
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceRequest
     */
    public function setDetail(Zend_Service_DeveloperGarden_ConferenceCall_ConferenceDetail $detail)
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * sets $ownerId
     *
     * @param string $ownerId
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceRequest
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    /**
     * sets $account
     *
     * @param int $account
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_CreateConferenceRequest
     */
    public function setAccount($account = null)
    {
        $this->account = $account;
        return $this;
    }
}
