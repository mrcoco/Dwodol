�=�'����0Z�}Ml���6Z�x��qӠ�.�-4�	����D�Z�q2���|`�o�(�o��K���.B�.W'��_�;�V	ܗ�VE R0[�Y���� ]��ޱ��eD5ݷ�qAGn��HX�����r�*|���b%�~v����`�y).8L#��m���}��E/�#�6�0譵���=���y$X������L�v�Q^��j���fV�	#�`�tB���:[|�"�DJ�i}F��E�|R���!K��3�[ b����Ot�����,�u�u�.K�L���yl�u��f�z)��V͓!�аt����K�_���K�g�?��kF!hR��� r�PŬ��Z�_,Rۇm����w�~�&�Ufs����l��Q�,�w��J���;��?�fF��b�/�4t���:P�^)���!��>�x�v�>�}�޲���+�-S�f"���6�:��� ��Y�d�Tb4�O|�ˉ�_��}��RN_�k(aD!~o4/����'subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @version    $Id: BaseUrl.php 23953 2011-05-03 05:47:39Z ralph $
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** @see Zend_View_Helper_Abstract */
require_once 'Zend/View/Helper/Abstract.php';

/**
 * Helper for retrieving the BaseUrl
 *
 * @package    Zend_View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_View_Helper_BaseUrl extends Zend_View_Helper_Abstract
{
    /**
     * BaseUrl
     *
     * @var string
     */
    protected $_baseUrl;

    /**
     * Returns site's base url, or file with base url prepended
     *
     * $file is appended to the base url for simplicity
     *
     * @param  string|null $file
     * @return string
     */
    public function baseUrl($file = null)
    {
        // Get baseUrl
        $baseUrl = $this->getBaseUrl();

        // Remove trailing slashes
        if (null !== $file) {
            $file = '/' . ltrim($file, '/\\');
        }

        return $baseUrl . $file;
    }

    /**
     * Set BaseUrl
     *
     * @param  string $base
     * @return Zend_View_Helper_BaseUrl
     */
    public function setBaseUrl($base)
    {
        $this->_baseUrl = rtrim($base, '/\\');
        return $this;
    }

    /**
     * Get BaseUrl
     *
     * @return string
     */
    public function getBaseUrl()
    {
        if ($this->_baseUrl === null) {
            /** @see Zend_Controller_Front */
            require_once 'Zend/Controller/Front.php';
            $baseUrl = Zend_Controller_Front::getInstance()->getBaseUrl();

            // Remove scriptname, eg. index.php from baseUrl
            $baseUrl = $this->_removeScriptName($baseUrl);

            $this->setBaseUrl($baseUrl);
        }

        return $this->_baseUrl;
    }

    /**
     * Remove Script filename from baseurl
     *
     * @param  string $url
     * @return string
     */
    protected function _removeScriptName($url)
    {
        if (!isset($_SERVER['SCRIPT_NAME'])) {
            // We can't do much now can we? (Well, we could parse out by ".")
            return $url;
        }

        if (($pos = strripos($url, basename($_SERVER['SCRIPT_NAME']))) !== false) {
            $url = substr($url, 0, $pos);
        }

        return $url;
    }
}
