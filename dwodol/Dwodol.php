<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require(DWPATH.'Dw_common'.EXT);
$DW_THEME =& dw_load_class('theme');

class Dwodol {
	public function __construct()
	{
		self::$instance =& $this;
	}
	public static function &get_instance()
	{
		return self::$instance;
	}
	
}
