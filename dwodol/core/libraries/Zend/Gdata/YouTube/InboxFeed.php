>J`�'�Z�T��K���ƾ
IJ�m�,e3�V��h���ED��� �@� 1p�]|���43G��x�����{q2��	��RjG�D�G���B��X�@��0	n�x����1 ���Ov*�ߺ�??���K~|��Fi��/�ٗ��G!�IF� H�QUX}�^3��EH��N�cp�K ȝ࠰�ui<�4��*�[8eLG�؞����UD���X�@�  @ �ҺQ�x�Yn�����W����H�mi�PR �c/t��H4�`ۈZ��/0�� � {   �L�x�����\.���w}�qS�����}�}�|��T� !������	F
@J���@�����C��#( BcɆ�z�g�Ŧ�v�|���cݲ��m�|B��ʽ�kڃ�R��) ��꾑ʪ��x I�p �a*eyV:�j�$� G���|�.A����Ϩ]�b�� @subpackage YouTube
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: InboxFeed.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_Media_Feed
 */
require_once 'Zend/Gdata/Media/Feed.php';

/**
 * @see Zend_Gdata_YouTube_InboxEntry
 */
require_once 'Zend/Gdata/YouTube/InboxEntry.php';

/**
 * The YouTube inbox feed list flavor of an Atom Feed with media support
 * Represents a list of individual inbox entries, where each contained entry is
 * a message.
 *
 * @category   Zend
 * @package    Zend_Gdata
 * @subpackage YouTube
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_YouTube_InboxFeed extends Zend_Gdata_Media_Feed
{

    /**
     * The classname for individual feed elements.
     *
     * @var string
     */
    protected $_entryClassName = 'Zend_Gdata_YouTube_InboxEntry';

    /**
     * Creates an Inbox feed, representing a list of messages,
     * associated with an individual user.
     *
     * @param DOMElement $element (optional) DOMElement from which this
     *          object should be constructed.
     */
    public function __construct($element = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_YouTube::$namespaces);
        parent::__construct($element);
    }

}
