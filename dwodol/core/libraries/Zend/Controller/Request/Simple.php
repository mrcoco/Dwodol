��z�i���f���8"Hh���z�D���V[�:O�oT�R_@������ECFf,�A�{7��u�dX�/��xc��\KG�
L�UU'�c�Gӊ@�a��Y��]�ECs+c�& ͣ{}c)�o�p��s��j��ˠ�*9���5=N���`x��S@hYO9unh�"e��b�}��/ʋ*7�M.�2�!__<�-�?�ֽO�`7�Zݩ���ᑇ��Ǚj���O��9q����@�/?IHX�	�T�B�
���S�<��5hn��q�59���ڙ$i�n��*���y�N��(��i&������O���Y�3�*������8�<�iγΞӊ#��;�NF=��ą�B�7/�O���Y�i�z�)���p�4d�a��:��Xu��n���������FP�E��WJ~��}b���\3�ǗA@������{���� �	y����{�2rm��.X9�k�=�ur+1Vl��b�����D̋k&Z��`D��mL�:��5��r
 * @subpackage Request
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Simple.php 23775 2011-03-01 17:25:24Z ralph $
 */

/** Zend_Controller_Request_Abstract */
require_once 'Zend/Controller/Request/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Controller
 * @subpackage Request
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Controller_Request_Simple extends Zend_Controller_Request_Abstract
{

    public function __construct($action = null, $controller = null, $module = null, array $params = array())
    {
        if ($action) {
            $this->setActionName($action);
        }

        if ($controller) {
            $this->setControllerName($controller);
        }

        if ($module) {
            $this->setModuleName($module);
        }

        if ($params) {
            $this->setParams($params);
        }
    }

}
