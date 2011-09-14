�cL)���E�`�h�=q��e�p�a��vʨ�Q0a��:���K�sc"�*���hj>/�yXІV�vl|�q��la��Bò��w+aΤF�=g�<n-r�
ɾ	u�TcQ�B�����!0�o��Nd|S��XE��F`�Qg��  _�������6�@��E3��@������'[>4
�[�LU
�O��֨/�+�P�#����b�h�+�yt��f��_�4�\g��y����8����[����ٞ<� 9O:�i$ �
��n�x���'�����\A �9��j��������8b`ʒ'I��]�Ϛ�XK���^̸����7��-���%#�Gޤ�E�RYeN_B�ꄷ� ;�͠��������ׅV�Q01���2?Wj��=g;�d?ID�4v�>�@��M�7Ǜ@>7�oZD�Ʉ�p�P_Zjpm�K
��S�>9R�ױ�ո���/0�o�.���ԃ7	��6jKY�9�(��#��]�6�.��5�ەsubpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: BootstrapFile.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * This class is the front most class for utilizing Zend_Tool_Project
 *
 * A profile is a hierarchical set of resources that keep track of
 * items within a specific project.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Tool_Project_Context_Zf_BootstrapFile extends Zend_Tool_Project_Context_Filesystem_File
{

    /**
     * @var string
     */
    protected $_filesystemName = 'Bootstrap.php';

    /**
     * @var Zend_Tool_Project_Profile_Resource
     */
    protected $_applicationConfigFile = null;

    /**
     * @var Zend_Tool_Project_Profile_Resource
     */
    protected $_applicationDirectory = null;

    /**
     * @var Zend_Application
     */
    protected $_applicationInstance = null;


    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'BootstrapFile';
    }

    public function init()
    {
        parent::init();

        $this->_applicationConfigFile = $this->_resource->getProfile()->search('ApplicationConfigFile');
        $this->_applicationDirectory = $this->_resource->getProfile()->search('ApplicationDirectory');

        if (($this->_applicationConfigFile === false) || ($this->_applicationDirectory === false)) {
            throw new Exception('To use the BootstrapFile context, your project requires the use of both the "ApplicationConfigFile" and "ApplicationDirectory" contexts.');
        }


    }

    /**
     * getContents()
     *
     * @return array
     */
    public function getContents()
    {

        $codeGenFile = new Zend_CodeGenerator_Php_File(array(
            'classes' => array(
                new Zend_CodeGenerator_Php_Class(array(
                    'name' => 'Bootstrap',
                    'extendedClass' => 'Zend_Application_Bootstrap_Bootstrap',
                    )),
                )
            ));

        return $codeGenFile->generate();
    }

    public function getApplicationInstance()
    {
        if ($this->_applicationInstance == null) {
            if ($this->_applicationConfigFile->getContext()->exists()) {
                define('APPLICATION_PATH', $this->_applicationDirectory->getPath());
                $applicationOptions = array();
                $applicationOptions['config'] = $this->_applicationConfigFile->getPath();

                $this->_applicationInstance = new Zend_Application(
                    'development',
                    $applicationOptions
                    );
            }
        }

        return $this->_applicationInstance;
    }
}
