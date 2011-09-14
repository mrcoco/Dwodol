Û¿”ôù~Ñ :»MıIÙhq,éĞI(t»–z/sÆƒ‰a””«Ö¬Ôÿß÷×’@^âêWyÙÅC>™Ÿ$P†g3<ÆX6+]ä½L‡œÏµ<cÑóù®5üÆĞ°Õöb¹›Q²‡ÜˆŠ+Ì´BŞX¬h/CÕ?É
ñÌâÓNÍ(L:Jô˜ÔıòˆÈ€û°Ğhß‘¸Ä}´³€P=:XLÀ¥<_¸2£IĞª¸à—ƒ9Üºeì)¶RŒÜš2HòA0êÄ¸jj}üƒØ®.Š“’ØÍä*ëÌ1j²òˆ·Î1„ŸÙô£%l¡˜$ã9C¿üŞL¸§­v!}>ç&6Kbùã€*â»‘åç-¦ÿÓpY¥—ø¯è˜áS_€:.³m“eÃÿp,Ô•î94’÷EÍò]?/zØÛÈœ‰”3È¦–Í2†·Ğ	[`·é°^1Ç¥hÌñµp#h•cºœ6ÖšæáÖô	CKO[R/¶Ÿ¢›ô×ŠKØ‘SØ[8ƒy£çsŒƒçÅÿ¹¸°¥”‰È‡ì¸j¢?Ö¢E!ĞrÍáNŞ#Ádïã6†ííMkdì ´n`:—€k»~úÇ$bp×¾ô¤³™¢®ÿ"`0È¨O—T§p\²É×ñ#êñãif²€­™)Ç–subpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Interface.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Basic Interface for factilities that load Zend_Tool providers or manifests.
 *
 * @category   Zend
 * @package    Zend_Tool
 * @subpackage Framework
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
interface Zend_Tool_Framework_Loader_Interface
{
    /**
     * Load Providers and Manifests
     *
     * Returns an array of all loaded class names.
     *
     * @return array
     */
    public function load();
}
