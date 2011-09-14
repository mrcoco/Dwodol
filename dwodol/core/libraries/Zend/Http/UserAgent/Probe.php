R��������`6c��cJ啗A���B�c��O	�%��}R�Tz�G���[J�6aeH�����ܤC��fB��m����2Zʍ�/��֪P(}���҇�p��
���0�ό��b�`�f+��q|����*�Vi�����^g 02�vqfK�X��]k)M9�jMҌ��	��B%N?C  ���1���yf����9%�Q>0pq .�w����>�B���}��ݚRdgs�0�����5�]\m��n�{�<4wv;�$elF��������b�����v��J]�Ӎ#��>4��V�.a�<�w^ �Ma"�~�U���B��2�%��t���"G'�
"jC��łY�N��  ���"����I��^o-���I�)�i�2*�u�xA^�4B���pj���	jr�>9��[�I;1�3�#�}Qtvi��Ґ&���E�?�F��2��l�AD�#�4䵇��g0�˄ O��l�p^������ю}�&z-O�r�x���Tsubpackage UserAgent
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

require_once 'Zend/Http/UserAgent/AbstractDevice.php';

/**
 * Probe browser type matcher
 *
 * @category   Zend
 * @package    Zend_Http
 * @subpackage UserAgent
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Http_UserAgent_Probe extends Zend_Http_UserAgent_AbstractDevice
{
    /**
     * User Agent Signatures
     *
     * @var array
     */
    protected static $_uaSignatures = array(
        'witbe',
        'netvigie',
    );

    /**
     * Comparison of the UserAgent chain and User Agent signatures
     *
     * @param string $userAgent User Agent chain
     * @param  array $server $_SERVER like param
     * @return bool
     */
    public static function match($userAgent, $server)
    {
        return self::_matchAgentAgainstSignatures($userAgent, self::$_uaSignatures);
    }


    /**
     * Gives the current browser type
     *
     * @return string
     */
    public function getType()
    {
        return 'probe';
    }

    /**
     * Look for features
     *
     * @return string
     */
    protected function _defineFeatures()
    {
        $this->setFeature('images', false, 'product_capability');
        $this->setFeature('iframes', false, 'product_capability');
        $this->setFeature('frames', false, 'product_capability');
        $this->setFeature('javascript', false, 'product_capability');
        return parent::_defineFeatures();
    }
}
