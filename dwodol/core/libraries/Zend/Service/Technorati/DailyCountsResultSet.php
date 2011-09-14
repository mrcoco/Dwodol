��jS�chʵ?�j���3��ٌ:N�Q�8_Y}6�f����_���9i�׋�9.O�N�8���� SZ�FrMp�(f�hŋ�7���A2Bo��T�c_���t�r��o������N��c�?Edj�'fV%���H�&!�HS�������.)6�ip)gQ�;Q�G:q���V��4�j89�Q�n�s1�c��J��X#b��ހ*������)��JC�S��/�����B2/�J)���'1,}�:&���t��;e���=��	.Ȥ(5�S;��MDT-�>�uS1�|��7r�#�j0D P.N�
�F�Dē6f��Q&��nP�u��

_� �:J���u�x[������L���:s����{y�0.�+#��)ǲ�+q)�O��&O�����Y�Xz�qc��Htz�kq`���z5Z�G
럶T��.yZ�:��ٙ��"�O���gz��U'ć+��tj���;�Ս�܎e9:kKe��
�* @subpackage Technorati
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: DailyCountsResultSet.php 23775 2011-03-01 17:25:24Z ralph $
 */


/**
 * @see Zend_Date
 */
require_once 'Zend/Date.php';

/**
 * @see Zend_Service_Technorati_ResultSet
 */
require_once 'Zend/Service/Technorati/ResultSet.php';

/**
 * @see Zend_Service_Technorati_Utils
 */
require_once 'Zend/Service/Technorati/Utils.php';


/**
 * Represents a Technorati Tag query result set.
 *
 * @category   Zend
 * @package    Zend_Service
 * @subpackage Technorati
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Service_Technorati_DailyCountsResultSet extends Zend_Service_Technorati_ResultSet
{
    /**
     * Technorati search URL for given query.
     *
     * @var     Zend_Uri_Http
     * @access  protected
     */
    protected $_searchUrl;

    /**
     * Number of days for which counts provided.
     *
     * @var     Zend_Service_Technorati_Weblog
     * @access  protected
     */
    protected $_days;

    /**
     * Parses the search response and retrieve the results for iteration.
     *
     * @param   DomDocument $dom    the ReST fragment for this object
     * @param   array $options      query options as associative array
     */
    public function __construct(DomDocument $dom, $options = array())
    {
        parent::__construct($dom, $options);

        // default locale prevent Zend_Date to fail
        // when script is executed via shell
        // Zend_Locale::setDefault('en');

        $result = $this->_xpath->query('/tapi/document/result/days/text()');
        if ($result->length == 1) $this->_days = (int) $result->item(0)->data;

        $result = $this->_xpath->query('/tapi/document/result/searchurl/text()');
        if ($result->length == 1) {
            $this->_searchUrl = Zend_Service_Technorati_Utils::normalizeUriHttp($result->item(0)->data);
        }

        $this->_totalResultsReturned  = (int) $this->_xpath->evaluate("count(/tapi/document/items/item)");
        $this->_totalResultsAvailable = (int) $this->getDays();
    }


    /**
     * Returns the search URL for given query.
     *
     * @return  Zend_Uri_Http
     */
    public function getSearchUrl() {
        return $this->_searchUrl;
    }

    /**
     * Returns the number of days for which counts provided.
     *
     * @return  int
     */
    public function getDays() {
        return $this->_days;
    }

    /**
     * Implements Zend_Service_Technorati_ResultSet::current().
     *
     * @return Zend_Service_Technorati_DailyCountsResult current result
     */
    public function current()
    {
        /**
         * @see Zend_Service_Technorati_DailyCountsResult
         */
        require_once 'Zend/Service/Technorati/DailyCountsResult.php';
        return new Zend_Service_Technorati_DailyCountsResult($this->_results->item($this->_currentIndex));
    }
}
