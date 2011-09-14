�_"�keV�5�)��Pn�NmX��R��J��p���ӣx��L��k&g��x_�#ٝ�~�)�j�@�BA�#�ZG���ۃ������tc�=Qgh�9��
to�N0�mx��.&���-^<��%�31X2G��6*��d��ܩ�e"���Q���D�k`	�4*���P,��/�( 9��I��q�c}{y<8q%�մ{��A�c��<����:�(���eIEByPRN�T��6�Z\���&S���w������HCC9��wv"9/<ʀ�(�F��b�&~ ��ݐ)z��y�q{\n&���L�r�f!�G��k�0��,���!7d���GP����8UL��Nv~I����=���9�A�ݴ|�q�;ZmEi7�2	�f�i'�A���0���(�-aTCo�_�34��0��l������wl�S�6����q�4C�A�-W�ǵ/��ޜ�����f�ٚj����b�PL
��`Q�*,�O@�?_subpackage UserAgent
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * @category   Zend
 * @package    Zend_Http
 * @subpackage UserAgent
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Zend_Http_UserAgent_Storage
{
    /**
     * Returns true if and only if storage is empty
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If it is impossible to determine whether storage is empty
     * @return boolean
     */
    public function isEmpty();

    /**
     * Returns the contents of storage associated to the key parameter
     *
     * Behavior is undefined when storage is empty.
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If reading contents from storage is impossible
     * @return mixed
     */
    public function read();

    /**
     * Writes $contents associated to the key parameter to storage
     *
     * @param  mixed $contents
     * @throws Zend_Http_UserAgent_Storage_Exception If writing $contents to storage is impossible
     * @return void
     */
    public function write($contents);

    /**
     * Clears contents from storage
     *
     * @throws Zend_Http_UserAgent_Storage_Exception If clearing contents from storage is impossible
     * @return void
     */
    public function clear();
}
