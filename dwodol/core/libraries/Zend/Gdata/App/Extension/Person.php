D@`UZ���Ō7`�K����w�L�yV[~��i�IWʞNӒ14�sYJ�q+����>������M\�g���m�j1HUg�ɲ���}��l#[��m��\�@�y1h�<��7J��K>5a�6����]�o�͞D�T��ow�m�gXKp�ܠx!h�߫
a�ةY%
����6��W�i�#�7[����U�YNַ�!P�%�|4�8�����b�7��9y�MB��Fx��D�9�~b�K���GM$;�"
��j�����K\[��)�߆[��m�p���.	U�쥖�z.N�ߙ���D;d�8��+�'k�Ra��/~Ho�h�l���e����3�z��5pX_���;�~� J�4̉,9vM�͟oՋ&V���F�u������	;���lsn�M���Ҹ<��>��FS����YA�s�q's��d��D��+���G��@9`�3S���f�H$�&̆�(�q���:ƣ&�)��K��b�� @subpackage App
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Person.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_App_Extension
 */
require_once 'Zend/Gdata/App/Extension.php';

/**
 * @see Zend_Gdata_App_Extension_Name
 */
require_once 'Zend/Gdata/App/Extension/Name.php';

/**
 * @see Zend_Gdata_App_Extension_Email
 */
require_once 'Zend/Gdata/App/Extension/Email.php';

/**
 * @see Zend_Gdata_App_Extension_Uri
 */
require_once 'Zend/Gdata/App/Extension/Uri.php';

/**
 * Base class for people (currently used by atom:author, atom:contributor)
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage App
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Zend_Gdata_App_Extension_Person extends Zend_Gdata_App_Extension
{

    protected $_rootElement = null;
    protected $_name = null;
    protected $_email = null;
    protected $_uri = null;

    public function __construct($name = null, $email = null, $uri = null)
    {
        parent::__construct();
        $this->_name = $name;
        $this->_email = $email;
        $this->_uri = $uri;
    }

    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_name != null) {
            $element->appendChild($this->_name->getDOM($element->ownerDocument));
        }
        if ($this->_email != null) {
            $element->appendChild($this->_email->getDOM($element->ownerDocument));
        }
        if ($this->_uri != null) {
            $element->appendChild($this->_uri->getDOM($element->ownerDocument));
        }
        return $element;
    }

    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName) {
        case $this->lookupNamespace('atom') . ':' . 'name':
            $name = new Zend_Gdata_App_Extension_Name();
            $name->transferFromDOM($child);
            $this->_name = $name;
            break;
        case $this->lookupNamespace('atom') . ':' . 'email':
            $email = new Zend_Gdata_App_Extension_Email();
            $email->transferFromDOM($child);
            $this->_email = $email;
            break;
        case $this->lookupNamespace('atom') . ':' . 'uri':
            $uri = new Zend_Gdata_App_Extension_Uri();
            $uri->transferFromDOM($child);
            $this->_uri = $uri;
            break;
        default:
            parent::takeChildFromDOM($child);
            break;
        }
    }

    /**
     * @return Zend_Gdata_App_Extension_Name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param Zend_Gdata_App_Extension_Name $value
     * @return Zend_Gdata_App_Entry Provides a fluent interface
     */
    public function setName($value)
    {
        $this->_name = $value;
        return $this;
    }

    /**
     * @return Zend_Gdata_App_Extension_Email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param Zend_Gdata_App_Extension_Email $value
     * @return Zend_Gdata_App_Extension_Person Provides a fluent interface
     */
    public function setEmail($value)
    {
        $this->_email = $value;
        return $this;
    }

    /**
     * @return Zend_Gdata_App_Extension_Uri
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * @param Zend_Gdata_App_Extension_Uri $value
     * @return Zend_Gdata_App_Extension_Person Provides a fluent interface
     */
    public function setUri($value)
    {
        $this->_uri = $value;
        return $this;
    }

}
