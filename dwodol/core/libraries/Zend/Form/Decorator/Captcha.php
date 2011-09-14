l�D{~`�@N�N�2�ZٺT�@�D�@���9,BiMH��rf��
���k�/GÙ���
l�c}$�H����ƶ֌I|��Ɩ�a	���J#n����?�
�v�+;��p��enS3A�Nρ:diI�;ll��%J���h��q�+ڳ���k��Hv���V� �=�=KZ�*
^8�7�w"�� tdO�D�Vt�Wr��Ԃ�H�3�������g~�H3/�F��4�����GL�;|:w�d��c�����p"2����Ď'P�<�9W85�%F�C7�����:�ְ�$�^�Q��|�ʆY_����|T�����T��O^��X��G�]��g0ؑ.>iM��̭B5��c����\I�Oͫ�����,��'S���F=�q��Y���!D4�1�S\����Q���o ���6��@EiR���xNUһ��j��d	�V�R5(<6��s���?��Ad�Az�M���עy�$jr�1���ȇ�Y!��nz����@S5X�subpackage Decorator
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** @see Zend_Form_Decorator_Abstract */
require_once 'Zend/Form/Decorator/Abstract.php';

/**
 * Captcha generic decorator
 *
 * Adds captcha adapter output
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Decorator
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Captcha.php 23775 2011-03-01 17:25:24Z ralph $
 */
class Zend_Form_Decorator_Captcha extends Zend_Form_Decorator_Abstract
{
    /**
     * Render captcha
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        if (!method_exists($element, 'getCaptcha')) {
            return $content;
        }

        $view    = $element->getView();
        if (null === $view) {
            return $content;
        }

        $placement = $this->getPlacement();
        $separator = $this->getSeparator();

        $captcha = $element->getCaptcha();
        $markup  = $captcha->render($view, $element);
        switch ($placement) {
            case 'PREPEND':
                $content = $markup . $separator .  $content;
                break;
            case 'APPEND':
            default:
                $content = $content . $separator . $markup;
        }
        return $content;
    }
}
