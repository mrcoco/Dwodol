_J^p����~_+��3��m���2Y�k�-���SĔ�5�9�,�+�I)�$eo�`��`s�U�jǏ���A��O��㜗,��ϤK�FX�v��s�网�I��B��x�a �"�j����ӱ��ق��H?�j��sX����eV��s�5' X=�EbXH�T��0e�c�'/)�����lMT�����8L���%��i�3J�.~ʔ�aC�$TN�V[%`����nH$���Az��\��@�8��l@��C��U�v�k�-s�O���9�G\���ߓKG;��NrW�f��;l�TS��S��!?��m���Q��v��lR�o]Ao2�\��kw��\�pz�)ق�lr��g۳%� ?�2��/��E.�
�a��H��*Z��H]�Y݅�GVP憤�#]G�đ����g�
�*e��<���9q�1�ᓷ���f�8�V]�}�d���w�-ꝹjI�i[�iӖ*��'����n͆����m0l]
�[�`rr�#:w˸�d��
xsubpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Abstract.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Tool_Project_Context_Interface
 */
require_once 'Zend/Tool/Project/Context/Interface.php';

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
abstract class Zend_Tool_Project_Context_Filesystem_Abstract implements Zend_Tool_Project_Context_Interface
{

    /**
     * @var Zend_Tool_Project_Profile_Resource
     */
    protected $_resource = null;

    /**
     * @var string
     */
    protected $_baseDirectory = null;

    /**
     * @var string
     */
    protected $_filesystemName = null;

    /**
     * init()
     *
     * @return Zend_Tool_Project_Context_Filesystem_Abstract
     */
    public function init()
    {
        $parentBaseDirectory = $this->_resource->getParentResource()->getContext()->getPath();
        $this->_baseDirectory = $parentBaseDirectory;
        return $this;
    }

    /**
     * setResource()
     *
     * @param Zend_Tool_Project_Profile_Resource $resource
     * @return Zend_Tool_Project_Context_Filesystem_Abstract
     */
    public function setResource(Zend_Tool_Project_Profile_Resource $resource)
    {
        $this->_resource = $resource;
        return $this;
    }

    /**
     * setBaseDirectory()
     *
     * @param string $baseDirectory
     * @return Zend_Tool_Project_Context_Filesystem_Abstract
     */
    public function setBaseDirectory($baseDirectory)
    {
        $this->_baseDirectory = rtrim(str_replace('\\', '/', $baseDirectory), '/');
        return $this;
    }

    /**
     * getBaseDirectory()
     *
     * @return string
     */
    public function getBaseDirectory()
    {
        return $this->_baseDirectory;
    }

    /**
     * setFilesystemName()
     *
     * @param string $filesystemName
     * @return Zend_Tool_Project_Context_Filesystem_Abstract
     */
    public function setFilesystemName($filesystemName)
    {
        $this->_filesystemName = $filesystemName;
        return $this;
    }

    /**
     * getFilesystemName()
     *
     * @return string
     */
    public function getFilesystemName()
    {
        return $this->_filesystemName;
    }

    /**
     * getPath()
     *
     * @return string
     */
    public function getPath()
    {
        $path = $this->_baseDirectory;
        if ($this->_filesystemName) {
            $path .= '/' . $this->_filesystemName;
        }
        return $path;
    }

    /**
     * exists()
     *
     * @return bool
     */
    public function exists()
    {
        return file_exists($this->getPath());
    }

    /**
     * create()
     *
     * Create this resource/context
     *
     */
    abstract public function create();

    /**
     * delete()
     *
     * Delete this resouce/context
     *
     */
    abstract public function delete();

}