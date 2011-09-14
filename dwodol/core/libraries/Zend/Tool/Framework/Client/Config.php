w����Rd7{q4�P�S�`�i�}���z� �ؓk�M���2.���*0dFg¸���5�%�K���H�/�~�wus~����@�9ef�>@$ܺJ�=%H��"�Z��$k�b��R�6�K5�+i/6��Ȍ�rj+�I�a������6w��r���n\c5��a9�*�i�rpuy���>���g�ͺ�zW���:��^����%)s��V�\\�M��h��q��p��Ƒ����:�t �sy�؁T�����d
$���#�6'��JN/�xFD���x�~˫�$N�R�_�_���H�<N&��G��gi��rތ��r.~_�ʤ�\&��I�'�}ĄE(P_����ᐝ�Ce��N��  ������t��[S](����9�I�v��k_��\V6��7���j'�(D/e~g���|�d����}^m�̃&��f���@4�z�S|�z|�0�q!u0� ��2����ԧ$Hk�
�p�kt������j���濖uH����^5��subpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Config.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Tool_Framework_Client_Config
{

    protected $_configFilepath = null;

    /**
     * @var Zend_Config
     */
    protected $_config = null;

    /**
     * @param array $options
     */
    public function __config($options = array())
    {
        if ($options) {
            $this->setOptions($options);
        }
    }

    /**
     * @param array $options
     */
    public function setOptions(Array $options)
    {
        foreach ($options as $optionName => $optionValue) {
            $setMethodName = 'set' . $optionName;
            if (method_exists($this, $setMethodName)) {
                $this->{$setMethodName}($optionValue);
            }
        }
    }

    /**
     * @param  string $configFilepath
     * @return Zend_Tool_Framework_Client_Config
     */
    public function setConfigFilepath($configFilepath)
    {
        if (!file_exists($configFilepath)) {
            require_once 'Zend/Tool/Framework/Client/Exception.php';
            throw new Zend_Tool_Framework_Client_Exception('Provided path to config ' . $configFilepath . ' does not exist');
        }

        $this->_configFilepath = $configFilepath;
        $this->loadConfig($configFilepath);

        return $this;
    }

    /**
     * Load the configuration from the given path.
     *
     * @param string $configFilepath
     */
    protected function loadConfig($configFilepath)
    {
        $suffix = substr($configFilepath, -4);

        switch ($suffix) {
            case '.ini':
                require_once 'Zend/Config/Ini.php';
                $this->_config = new Zend_Config_Ini($configFilepath, null, array('allowModifications' => true));
                break;
            case '.xml':
                require_once 'Zend/Config/Xml.php';
                $this->_config = new Zend_Config_Xml($configFilepath, null, array('allowModifications' => true));
                break;
            case '.php':
                require_once 'Zend/Config.php';
                $this->_config = new Zend_Config(include $configFilepath, true);
                break;
            default:
                require_once 'Zend/Tool/Framework/Client/Exception.php';
                throw new Zend_Tool_Framework_Client_Exception('Unknown config file type '
                    . $suffix . ' at location ' . $configFilepath
                    );
        }
    }

    /**
     * Return the filepath of the configuration.
     *
     * @return string
     */
    public function getConfigFilepath()
    {
        return $this->_configFilepath;
    }

    /**
     * Get a configuration value.
     *
     * @param string $name
     * @param string $defaultValue
     * @return mixed
     */
    public function get($name, $defaultValue=null)
    {
        return $this->getConfigInstance()->get($name, $defaultValue);
    }

    /**
     * Get a configuration value
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->getConfigInstance()->{$name};
    }

    /**
     * Check if a configuration value isset.
     *
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if($this->exists() == false) {
            return false;
        }
        return isset($this->getConfigInstance()->{$name});
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        unset($this->getConfigInstance()->$name);
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        return $this->getConfigInstance()->$name = $value;
    }

    /**
     * Check if the User profile has a configuration.
     *
     * @return bool
     */
    public function exists()
    {
        return ($this->_config!==null);
    }

    /**
     * @throws Zend_Tool_Framework_Client_Exception
     * @return Zend_Config
     */
    public function getConfigInstance()
    {
        if(!$this->exists()) {
            require_once "Zend/Tool/Framework/Client/Exception.php";
            throw new Zend_Tool_Framework_Client_Exception("Client has no persistent configuration.");
        }

        return $this->_config;
    }

    /**
     * Save changes to the configuration into persistence.
     *
     * @return bool
     */
    public function save()
    {
        if($this->exists()) {
            $writer = $this->getConfigWriter();
            $writer->write($this->getConfigFilepath(), $this->getConfigInstance(), true);
            $this->loadConfig($this->getConfigFilepath());

            return true;
        }
        return false;
    }

    /**
     * Get the config writer that corresponds to the current config file type.
     *
     * @return Zend_Config_Writer_FileAbstract
     */
    protected function getConfigWriter()
    {
        $suffix = substr($this->getConfigFilepath(), -4);
        switch($suffix) {
            case '.ini':
                require_once "Zend/Config/Writer/Ini.php";
                $writer = new Zend_Config_Writer_Ini();
                $writer->setRenderWithoutSections();
                break;
            case '.xml':
                require_once "Zend/Config/Writer/Xml.php";
                $writer = new Zend_Config_Writer_Xml();
                break;
            case '.php':
                require_once "Zend/Config/Writer/Array.php";
                $writer = new Zend_Config_Writer_Array();
                break;
            default:
                require_once 'Zend/Tool/Framework/Client/Exception.php';
                throw new Zend_Tool_Framework_Client_Exception('Unknown config file type '
                    . $suffix . ' at location ' . $this->getConfigFilepath()
                    );
        }
        return $writer;
    }
}