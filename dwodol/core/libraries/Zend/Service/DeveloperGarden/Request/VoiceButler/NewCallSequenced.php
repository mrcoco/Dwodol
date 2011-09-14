	�3�ë�/����+\�z��yj�9����>���8�������4�`RS��i����9�<&6U1g���D����D��A��E9�B��|�@�t��Í/ٜR`���p�k5��K^6��Q��*�Q�TY���	ޠS�y�hE��;�㊍�H����%�(J=N-s?j&�*�
6�4 ��/��VI�2�Q'���=�,y��s@����ջ,]������ �Bܛf�>��(��������S�nD�I?G�?������ե��8:$Ø�$B���.������B4�W=��V���#$��n��*(ф�W�.{|"EEX���i<{a��-'
��مVX6YO������>�^�Ccx��_"���Ͽ`�������lk'���e$5~0����<�U�"57n�ha*l����}΢�� nW����NK|v8GF��\�yS�\������R��c�k	B]�\x��k-�ˮ���yn�'��k�);�'����Zg�ѣ?�M�* @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: NewCallSequenced.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Service_DeveloperGarden_VoiceButler_NewCall
 */
require_once 'Zend/Service/DeveloperGarden/Request/VoiceButler/NewCall.php';

/**
 * @category   Zend
 * @package    Zend_Service
 * @subpackage DeveloperGarden
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @author     Marco Kaiser
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_DeveloperGarden_Request_VoiceButler_NewCallSequenced
    extends Zend_Service_DeveloperGarden_Request_VoiceButler_NewCall
{
    /**
     * array of second numbers to be called sequenced
     *
     * @var array
     */
    public $bNumber = null;

    /**
     * max wait value to wait for new number to be called
     *
     * @var integer
     */
    public $maxWait = null;

    /**
     * @return array
     */
    public function getBNumber()
    {
        return $this->bNumber;
    }

    /**
     * @param array $bNumber
     * @return Zend_Service_DeveloperGarden_Request_VoiceButler_NewCall
     */
    /*public function setBNumber(array $bNumber)
    {
        $this->bNumber = $bNumber;
        return $this;
    }*/

    /**
     * returns the max wait value
     *
     * @return integer
     */
    public function getMaxWait()
    {
        return $this->maxWait;
    }

    /**
     * sets new max wait value for next number call
     *
     * @param integer $maxWait
     * @return Zend_Service_DeveloperGarden_Request_VoiceButler_NewCallSequenced
     */
    public function setMaxWait($maxWait)
    {
        $this->maxWait = $maxWait;
        return $this;
    }
}
