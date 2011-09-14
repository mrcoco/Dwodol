���!AQ�M�#W�ك��*6�8e( �KH;�\k��t����A�T�L��;�ϦQǒ1�j(b���	�C�G:m����b��/[WKnC i�/����`f'��*sl�Lft*�Oc���P@y�53q(	.��gL�NZ'd�뒶Y���)�M���;������[,�^��0$~ |>�Iz��9��Ѭ@b�� �ʁ����m��ƺ��핗-G�8��",pNHZC����3n��v� �/��%�L���Y���ƈ}m�8��.��	���h��P���UӳE>��(��Y�H(�%�EJ\p����b�/au��Ġ� O*�5�P���G�e	���^ �o��,+���O���@}�ZEh 9j(�h��{��[����쿍a�� �21�: W�r�����gZP��}ag](�:�Q0�x��cq�,E��fA$}N5��Yt�T���!m�q�;��9��ѣy�5�b��Sfl/�7�!��!��[k/�;[�s�r
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: AdapterAbstract.php 23775 2011-03-01 17:25:24Z ralph $
 */

/** @see Zend_Serializer_Adapter_AdapterInterface */
require_once 'Zend/Serializer/Adapter/AdapterInterface.php';

/**
 * @category   Zend
 * @package    Zend_Serializer
 * @subpackage Adapter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend_Serializer_Adapter_AdapterAbstract implements Zend_Serializer_Adapter_AdapterInterface
{
    /**
     * Serializer options
     *
     * @var array
     */
    protected $_options = array();

    /**
     * Constructor
     *
     * @param array|Zend_Config $opts Serializer options
     */
    public function __construct($opts = array())
    {
        $this->setOptions($opts);
    }

    /**
     * Set serializer options
     *
     * @param  array|Zend_Config $opts Serializer options
     * @return Zend_Serializer_Adapter_AdapterAbstract
     */
    public function setOptions($opts)
    {
        if ($opts instanceof Zend_Config) {
            $opts = $opts->toArray();
        } else {
            $opts = (array) $opts;
        }

        foreach ($opts as $k => $v) {
            $this->setOption($k, $v);
        }
        return $this;
    }

    /**
     * Set a serializer option
     *
     * @param  string $name Option name
     * @param  mixed $value Option value
     * @return Zend_Serializer_Adapter_AdapterAbstract
     */
    public function setOption($name, $value)
    {
        $this->_options[(string) $name] = $value;
        return $this;
    }

    /**
     * Get serializer options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Get a serializer option
     *
     * @param  string $name
     * @return mixed
     * @throws Zend_Serializer_Exception
     */
    public function getOption($name)
    {
        $name = (string) $name;
        if (!array_key_exists($name, $this->_options)) {
            require_once 'Zend/Serializer/Exception.php';
            throw new Zend_Serializer_Exception('Unknown option name "'.$name.'"');
        }

        return $this->_options[$name];
    }
}
