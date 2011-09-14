��`�X��E��w�L�Rؘ������W���.$GY�ػ���}VСH
 [��\(H�/5�\wY]����P��W����A�}{\5qj)嫋4>��)"#o$.��,�ѐ:�
��bi�@�/巗sO7Ժf0��E�~��̷ffԱ�a��Pͅ�9�
��Sk�#�� ��hU3`�� �e��I��_�TȪ�O׋�6j{�c!H)��_��m���R�����a݊"Lqf��r�u���ws<�:W#�W�=�K�����ɸ,�T�y�%��F��/�G+T���Z�v���PIz�u��3V��))xv;��������8�P��M�߁���?�sx2�����8��}��2M�"����a�}Y� �|ƍK�?�f��Y��H2>��2f3���y	8�Km.���r#�JP	�!�ū)�����5�����VB�7S�1���L��G`���ǈ�f���ǚj#V�h���3n�T��\x��&��]�j��~��c��&#Md7a
 * @subpackage   Spreadsheets
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: CellEntry.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * @see Zend_Gdata_Entry
 */
require_once 'Zend/Gdata/Entry.php';

/**
 * @see Zend_Gdata_Spreadsheets_Extension_Cell
 */
require_once 'Zend/Gdata/Spreadsheets/Extension/Cell.php';

/**
 * Concrete class for working with Cell entries.
 *
 * @category     Zend
 * @package      Zend_Gdata
 * @subpackage   Spreadsheets
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Gdata_Spreadsheets_CellEntry extends Zend_Gdata_Entry
{

    protected $_entryClassName = 'Zend_Gdata_Spreadsheets_CellEntry';
    protected $_cell;

    /**
     * Constructs a new Zend_Gdata_Spreadsheets_CellEntry object.
     * @param string $uri (optional)
     * @param DOMElement $element (optional) The DOMElement on which to base this object.
     */
    public function __construct($element = null)
    {
        $this->registerAllNamespaces(Zend_Gdata_Spreadsheets::$namespaces);
        parent::__construct($element);
    }

    public function getDOM($doc = null, $majorVersion = 1, $minorVersion = null)
    {
        $element = parent::getDOM($doc, $majorVersion, $minorVersion);
        if ($this->_cell != null) {
            $element->appendChild($this->_cell->getDOM($element->ownerDocument));
        }
        return $element;
    }

    protected function takeChildFromDOM($child)
    {
        $absoluteNodeName = $child->namespaceURI . ':' . $child->localName;
        switch ($absoluteNodeName) {
        case $this->lookupNamespace('gs') . ':' . 'cell';
            $cell = new Zend_Gdata_Spreadsheets_Extension_Cell();
            $cell->transferFromDOM($child);
            $this->_cell = $cell;
            break;
        default:
            parent::takeChildFromDOM($child);
            break;
        }
    }

    /**
     * Gets the Cell element of this Cell Entry.
     * @return Zend_Gdata_Spreadsheets_Extension_Cell
     */
    public function getCell()
    {
        return $this->_cell;
    }

    /**
     * Sets the Cell element of this Cell Entry.
     * @param Zend_Gdata_Spreadsheets_Extension_Cell $cell
		 * @return Zend_Gdata_Spreadsheets_CellEntry
     */
    public function setCell($cell)
    {
        $this->_cell = $cell;
        return $this;
    }

}
