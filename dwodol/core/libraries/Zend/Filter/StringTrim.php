��E��g��ێ���c� ��)[*�v�����ƑC�17)m�q�`���D)�
T�Hv�íi�MH� +��ld`������"��3����n�~1k�g��:S�AEO�a��1��SG�I+�!@��˗�;�9���Q�@X��-B}� ��L̪�3�kݾ��K9��	]��"�������H�}7��<�����A���3J��}�l�8�)o����ء��"	�5)::T 1ȐR[��A��zЯP� i�1�`�P�w;�|��m���KU�`'�$���/�B��u/P�(e���y�c��yƴ�s�I���i�A�%Dç���+�
XS��;,�I6*�`��ƨ�:�* v�H����4���[:���{������D�|����s�.���/I�"�U5a���VV�P'��?FQ�����lv��=�`k?���j��Y�q��]�tM����9y����150�WY\3	I�����3�-q��F @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: StringTrim.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Filter_Interface
 */
require_once 'Zend/Filter/Interface.php';

/**
 * @category   Zend
 * @package    Zend_Filter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Filter_StringTrim implements Zend_Filter_Interface
{
    /**
     * List of characters provided to the trim() function
     *
     * If this is null, then trim() is called with no specific character list,
     * and its default behavior will be invoked, trimming whitespace.
     *
     * @var string|null
     */
    protected $_charList;

    /**
     * Sets filter options
     *
     * @param  string|array|Zend_Config $options
     * @return void
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        } else if (!is_array($options)) {
            $options          = func_get_args();
            $temp['charlist'] = array_shift($options);
            $options          = $temp;
        }

        if (array_key_exists('charlist', $options)) {
            $this->setCharList($options['charlist']);
        }
    }

    /**
     * Returns the charList option
     *
     * @return string|null
     */
    public function getCharList()
    {
        return $this->_charList;
    }

    /**
     * Sets the charList option
     *
     * @param  string|null $charList
     * @return Zend_Filter_StringTrim Provides a fluent interface
     */
    public function setCharList($charList)
    {
        $this->_charList = $charList;
        return $this;
    }

    /**
     * Defined by Zend_Filter_Interface
     *
     * Returns the string $value with characters stripped from the beginning and end
     *
     * @param  string $value
     * @return string
     */
    public function filter($value)
    {
        if (null === $this->_charList) {
            return $this->_unicodeTrim((string) $value);
        } else {
            return $this->_unicodeTrim((string) $value, $this->_charList);
        }
    }

    /**
     * Unicode aware trim method
     * Fixes a PHP problem
     *
     * @param string $value
     * @param string $charlist
     * @return string
     */
    protected function _unicodeTrim($value, $charlist = '\\\\s')
    {
        $chars = preg_replace(
            array( '/[\^\-\]\\\]/S', '/\\\{4}/S', '/\//'),
            array( '\\\\\\0', '\\', '\/' ),
            $charlist
        );

        $pattern = '^[' . $chars . ']*|[' . $chars . ']*$';
        return preg_replace("/$pattern/sSD", '', $value);
    }
}
