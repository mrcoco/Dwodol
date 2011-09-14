a|�x?�H<��ޑ���������%�{"��ޠAu�Y�U/��8%c����ό����� F_�L��P�V'v- g4a�E�P�n��[�ꆌ��Z�L�~�[BЍe����m:x�L ���b���� s���Fo:�*V�O/B�S�I��*,�MG�����وX�uZ#��ƒ+�t����\�M$=�B���̕MwV_CH��4z%S0���9IX������O[�	����8�D ���ٔЌ��׸�'���Z�O0������X]0�ϫEgi�I���rm񚩒�KI�u�!�:B�!�6{)�QnH�b���z��epɢC�k*�޽��
�r]�C_� �̠��r����5�s�ٙ�����i�n����a�c�]���4�Іﳫ����l�r�qN'
q���xl��lpg�ê�}��^Z/�-__;>�Dߝ���'��Z�ͨit���t�(\�|W�V�<h%^���d�@Է!���8�՗���K�A`1��-�Wsubpackage Schema
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Schema.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Ldap_Node_Abstract
 */
require_once 'Zend/Ldap/Node/Abstract.php';

/**
 * Zend_Ldap_Node_Schema provides a simple data-container for the Schema node.
 *
 * @category   Zend
 * @package    Zend_Ldap
 * @subpackage Schema
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Ldap_Node_Schema extends Zend_Ldap_Node_Abstract
{
    const OBJECTCLASS_TYPE_UNKNOWN    = 0;
    const OBJECTCLASS_TYPE_STRUCTURAL = 1;
    const OBJECTCLASS_TYPE_ABSTRACT   = 3;
    const OBJECTCLASS_TYPE_AUXILIARY  = 4;

    /**
     * Factory method to create the Schema node.
     *
     * @param  Zend_Ldap $ldap
     * @return Zend_Ldap_Node_Schema
     * @throws Zend_Ldap_Exception
     */
    public static function create(Zend_Ldap $ldap)
    {
        $dn = $ldap->getRootDse()->getSchemaDn();
        $data = $ldap->getEntry($dn, array('*', '+'), true);
        switch ($ldap->getRootDse()->getServerType()) {
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_ACTIVEDIRECTORY:
                /**
                 * @see Zend_Ldap_Node_Schema_ActiveDirectory
                 */
                require_once 'Zend/Ldap/Node/Schema/ActiveDirectory.php';
                return new Zend_Ldap_Node_Schema_ActiveDirectory($dn, $data, $ldap);
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_OPENLDAP:
                /**
                 * @see Zend_Ldap_Node_RootDse_ActiveDirectory
                 */
                require_once 'Zend/Ldap/Node/Schema/OpenLdap.php';
                return new Zend_Ldap_Node_Schema_OpenLdap($dn, $data, $ldap);
            case Zend_Ldap_Node_RootDse::SERVER_TYPE_EDIRECTORY:
            default:
                return new self($dn, $data, $ldap);
        }
    }

    /**
     * Constructor.
     *
     * Constructor is protected to enforce the use of factory methods.
     *
     * @param  Zend_Ldap_Dn $dn
     * @param  array        $data
     * @param  Zend_Ldap    $ldap
     */
    protected function __construct(Zend_Ldap_Dn $dn, array $data, Zend_Ldap $ldap)
    {
        parent::__construct($dn, $data, true);
        $this->_parseSchema($dn, $ldap);
    }

    /**
     * Parses the schema
     *
     * @param  Zend_Ldap_Dn $dn
     * @param  Zend_Ldap    $ldap
     * @return Zend_Ldap_Node_Schema Provides a fluid interface
     */
    protected function _parseSchema(Zend_Ldap_Dn $dn, Zend_Ldap $ldap)
    {
        return $this;
    }

    /**
     * Gets the attribute Types
     *
     * @return array
     */
    public function getAttributeTypes()
    {
        return array();
    }

    /**
     * Gets the object classes
     *
     * @return array
     */
    public function getObjectClasses()
    {
        return array();
    }
}