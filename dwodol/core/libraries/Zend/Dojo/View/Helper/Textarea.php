�M$+�@(G�2���W,4dkI���/E�A���Us�L��w5�6^�ܤ�7[��2W��!K�����I��O�W�w�st{�TE��R��2��A4a��^���a�}@�UjPh��g��B�$=��:��B
�5^��:�$��M�fk�z�#N�A�tۃ��PTu�h�� ���{��\������sO�[8��I!ĞSe��R���벝�h����5\�t�WL�l���{t�;b	Q�cDR�J�u ���"�mD���K��g� t�~�cB��ay ���=W��c�-�����=fU�(n.��j���r&{7�nS@����5�~������5�u:A��Ŀ�G!!5�Q�e�������U�'JP����{�iw��7�0��-}��|j���b�s����qa��-��7`g@YƐ�����>�s=����΃���x�3I�9���ViO/��2�ҁ�_�-��Ć���$�?�C�8�
��7�a�subpackage View
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Textarea.php 23777 2011-03-01 18:26:05Z matthew $
 */

/** Zend_Dojo_View_Helper_Dijit */
require_once 'Zend/Dojo/View/Helper/Dijit.php';

/**
 * Dojo Textarea dijit
 *
 * @uses       Zend_Dojo_View_Helper_Dijit
 * @package    Zend_Dojo
 * @subpackage View
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
  */
class Zend_Dojo_View_Helper_Textarea extends Zend_Dojo_View_Helper_Dijit
{
    /**
     * Dijit being used
     * @var string
     */
    protected $_dijit  = 'dijit.form.Textarea';

    /**
     * HTML element type
     * @var string
     */
    protected $_elementType = 'text';

    /**
     * Dojo module to use
     * @var string
     */
    protected $_module = 'dijit.form.Textarea';

    /**
     * dijit.form.Textarea
     *
     * @param  int $id
     * @param  mixed $value
     * @param  array $params  Parameters to use for dijit creation
     * @param  array $attribs HTML attributes
     * @return string
     */
    public function textarea($id, $value = null, array $params = array(), array $attribs = array())
    {
        if (!array_key_exists('id', $attribs)) {
            $attribs['id']    = $id;
        }
        $attribs['name']  = $id;

        $attribs = $this->_prepareDijit($attribs, $params, 'textarea');

        $html = '<textarea' . $this->_htmlAttribs($attribs) . '>'
              . $value
              . "</textarea>\n";

        return $html;
    }
}
