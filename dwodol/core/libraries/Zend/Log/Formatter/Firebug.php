x��y7L��Ӭ��9q]�p+jk��ߍ*�KRm��(Cl{*U|����2�.o�Cq��$�g�(�+^���&c��W|�)m�q�Q�~BA�U+��̴��
�����Z��6X��]ך�.}����ϫ�%�ë�^#��[����n��,��Y�����5�X@6��N)��T�6Ɲ���u����Ħ�u�S�$�����h�v��������C���� �l�)���^�F��h)�<��}$��1�� W]3�[���i�N)
��ō��p�oZ���ş�J&�^9e�$�>Ց����p��Y	C	�ػ�+����O�)Ӌ:���E��G�˗Jd_�D��c�(�Z�2[?�"%�d5S��r�{�|��� o��imEqB~	)�ƻ��1pP{��dG)�Y-���?OK��3�~f界3�����|��5���N���m�ӝt�X���Lm�����m�`09��S�rhNDvy��'a1A�G.��i��խQ��ubpackage Formatter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Firebug.php 23775 2011-03-01 17:25:24Z ralph $
 */

/** Zend_Log_Formatter_Abstract */
require_once 'Zend/Log/Formatter/Abstract.php';

/**
 * @category   Zend
 * @package    Zend_Log
 * @subpackage Formatter
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Zend_Log_Formatter_Firebug extends Zend_Log_Formatter_Abstract
{
    /**
	 * Factory for Zend_Log_Formatter_Firebug classe
	 *
     * @param array|Zend_Config $options useless
	 * @return Zend_Log_Formatter_Firebug
     */
    public static function factory($options)
    {
        return new self;
    }

    /**
     * This method formats the event for the firebug writer.
     *
     * The default is to just send the message parameter, but through
     * extension of this class and calling the
     * {@see Zend_Log_Writer_Firebug::setFormatter()} method you can
     * pass as much of the event data as you are interested in.
     *
     * @param  array    $event    event data
     * @return mixed              event message
     */
    public function format($event)
    {
        return $event['message'];
    }
}