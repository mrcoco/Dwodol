<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Widget_cont extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function go() {
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$exe = $this->input->get('w');
		$param = false;
		if($idw = $this->input->get('idw') ) :
		$wid 	= modules::run('modularizer/api_getbyid', $idw);
		$param 	= jsonToArray($wid->parameter);
		endif;
 		echo widget_helper::placed($exe, $param, $wid);
	}
}?>