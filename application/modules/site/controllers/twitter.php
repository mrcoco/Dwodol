<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Twitter extends MX_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->helper('site/twitter');
	}
	function index(){
		echo $this->router->fetch_module();
	}
	function sendUpdateStock($conf){
		$TWUSER 	= element('twuser', $conf);
		$PRODNAME 	= element('product_name', $conf);
		$LINK 		= element('link', $conf);
	
		$str = $this->load->model('newsletter/newsletter_m')->tpl_browse(
				array('grp_name' => 'tw restock mention'),
				true)->template;
		$result = preg_replace('/\{([A-Z]+)\}/e', "$$1", $str);
		tw_update($result);
		return true;
	}
	
	
}