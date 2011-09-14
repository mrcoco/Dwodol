����U�f��^���  w ?�}���R�le��>T�W�zB
�E�8` 0�^���   �A�V&�-�)���e�.�6�5��9��_}��X�C2T�	q<+ct藒�Co��h�0:@��L����u�P(��Ԏ�L�X-F�g���� /�s_�V?+��L�w�nr+u����j-�p�he�:`�;�
�HU�B����'�:%�/���uX��=�͡�����"�_,�G��,EXi�v(�!2Xˢ���(�>��f/��-V�I~�)�M�	OM}m�F��E��Po�	~/$+|oN���ISì��(�f�?�yD
'�Y�'���,�R���w��q3Qg>�r%8����L�&J!����d�6�O�IU��A!s����Y���ڏ���c�_�0�C����A�Q7_�
Mb#����7��i��uހ���}��P��*o�v%���Ɵm�<#{B/i͘Z�"f�Dr����0�sCP�* @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: UpdateParticipantRequest.php 23775 2011-03-01 17:25:24Z ralph $
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
class Zend_Service_DeveloperGarden_Request_ConferenceCall_UpdateParticipantRequest
    extends Zend_Service_DeveloperGarden_Request_RequestAbstract
{
    /**
     * the conference id
     *
     * @var string
     */
    public $conferenceId = null;

    /**
     * the participant id
     *
     * @var string
     */
    public $participantId = null;

    /**
     * conference participant
     *
     * @var Zend_Service_DeveloperGarden_ConferenceCall_ParticipantDetail
     */
    public $participant = null;

    /**
     * possible action
     *
     * @var integer
     */
    public $action = null;

    /**
     * constructor
     *
     * @param integer $environment
     * @param string $conferenceId
     * @param string $participantId
     * @param integer $action
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ParticipantDetail $participant
     */
    public function __construct($environment, $conferenceId, $participantId,
        $action = null,
        Zend_Service_DeveloperGarden_ConferenceCall_ParticipantDetail $participant = null
    ) {
        parent::__construct($environment);
        $this->setConferenceId($conferenceId)
             ->setParticipantId($participantId)
             ->setAction($action)
             ->setParticipant($participant);
    }

    /**
     * set the conference id
     *
     * @param string $conferenceId
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_UpdateParticipantRequest
     */
    public function setConferenceId($conferenceId)
    {
        $this->conferenceId = $conferenceId;
        return $this;
    }

    /**
     * set the participant id
     *
     * @param string $participantId
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_UpdateParticipantRequest
     */
    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
        return $this;
    }

    /**
     * sets new action
     *
     * @param integer $action
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_UpdateParticipantRequest
     */
    public function setAction($action = null)
    {
        if ($action !== null) {
            Zend_Service_DeveloperGarden_ConferenceCall::checkParticipantAction($action);
        }
        $this->action = $action;
        return $this;
    }

    /**
     * sets new participant
     *
     * @param Zend_Service_DeveloperGarden_ConferenceCall_ParticipantDetail $participant
     * @return Zend_Service_DeveloperGarden_Request_ConferenceCall_UpdateParticipantRequest
     */
    public function setParticipant(
        Zend_Service_DeveloperGarden_ConferenceCall_ParticipantDetail $participant = null
    ) {
        $this->participant = $participant;
        return $this;
    }
}
