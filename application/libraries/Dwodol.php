<?

class Dwodol{
	var $dw_class = array();
	var $lipath	;
	function __construct(){
		$this->_ci =& get_instance();
		$this->libpath = DWCOREPATH.'libraries/';
	}
	function theme(){
		require $this->libpath.'Dw_theme'.EXT;
	}
	function load($class){
		
	}
	
}?>