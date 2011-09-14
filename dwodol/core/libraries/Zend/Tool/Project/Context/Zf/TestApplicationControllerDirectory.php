����!n�P-nЀ���� L����0��>n�\
VD�H!�����A�hTTr�W�es��dZ��o�������3�-)J�V��镭���L����#�YoP�TI�د��4z������E�������:��2���8��h�a�CQǵɱryvfI4R�#n:~� h���,Qg�E�h0�Q��jh�%Lku��}kKΒaJ��6(�ْ\�nR1���7b����B�U�i7��
��8P����N����lz�e�_�A����E�a#�ٙM!N)�Q���-��`�R�]�B�$���W'X�l�=�Uv��'�Z�������ԺYkIQ`�\�>����=�)J/
S1�$�o
�d'��f���@����>�֥�l�{Mk���"T�͍:xکu/����2��e7�Z���NO�I�t��v���ߧ�˺ �m��f�9�0�<v=(��o���kP3��/����·$�E�����Z �q�$hsubpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: TestApplicationControllerDirectory.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Tool_Project_Context_Filesystem_Directory
 */
require_once 'Zend/Tool/Project/Context/Filesystem/Directory.php';

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
class Zend_Tool_Project_Context_Zf_TestApplicationControllerDirectory extends Zend_Tool_Project_Context_Filesystem_Directory
{

    /**
     * @var string
     */
    protected $_filesystemName = 'controllers';

    /**
     * getName()
     *
     * @return string
     */
    public function getName()
    {
        return 'TestApplicationControllerDirectory';
    }

}