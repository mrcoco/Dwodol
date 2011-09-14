^��ꔛ�P�套%V�l���28W��ME��'����F� '��6]���a����Y�.YŠtX�^�Y�e��ڔ.�y�T%�_�ୡ
����h��*���U� �	Y�=��<?�e�ׂh�I/s8J~2o&L8�� ��Ń�j\�He��ѝ��H"��\[�C�x��B}P���,��O�F�7�P�oP�ů�`�wQD�w0�ܢf{0ԧ�z>���@(�R8n��� ���e�m(ꧮ�;!7H�U���$_w��/f/FG�w��Q|֛ߚH �G�&}���Dk�*�x��,��+��c��T����,K��L���Q[x��C��}4h,�s�OD01C��'�E�
��(����K��A�h���x)&$�uuW(
8��8/vN��D?v��;_%�A����`|f��x��+���p�9?X�Cp�ŉ�4˼��RC� s8RZp�~�8h�+C;r��^K޹�G�xzC_u���	���	�� @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: LocalizedToNormalized.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Filter_Interface
 */
require_once 'Zend/Filter/Interface.php';

/**
 * @see Zend_Loader
 */
require_once 'Zend/Locale/Format.php';

/**
 * Normalizes given localized input
 *
 * @category   Zend
 * @package    Zend_Filter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Filter_LocalizedToNormalized implements Zend_Filter_Interface
{
    /**
     * Set options
     * @var array
     */
    protected $_options = array(
        'locale'      => null,
        'date_format' => null,
        'precision'   => null
    );

    /**
     * Class constructor
     *
     * @param string|Zend_Locale $locale (Optional) Locale to set
     */
    public function __construct($options = null)
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        if (null !== $options) {
            $this->setOptions($options);
        }
    }

    /**
     * Returns the set options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Sets options to use
     *
     * @param  array $options (Optional) Options to use
     * @return Zend_Filter_LocalizedToNormalized
     */
    public function setOptions(array $options = null)
    {
        $this->_options = $options + $this->_options;
        return $this;
    }

    /**
     * Defined by Zend_Filter_Interface
     *
     * Normalizes the given input
     *
     * @param  string $value Value to normalized
     * @return string|array The normalized value
     */
    public function filter($value)
    {
        if (Zend_Locale_Format::isNumber($value, $this->_options)) {
            return Zend_Locale_Format::getNumber($value, $this->_options);
        } else if (($this->_options['date_format'] === null) && (strpos($value, ':') !== false)) {
            // Special case, no date format specified, detect time input
            return Zend_Locale_Format::getTime($value, $this->_options);
        } else if (Zend_Locale_Format::checkDateFormat($value, $this->_options)) {
            // Detect date or time input
            return Zend_Locale_Format::getDate($value, $this->_options);
        }

        return $value;
    }
}
