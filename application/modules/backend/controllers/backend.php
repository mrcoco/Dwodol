<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Backend extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		//$this->dodol_auth->userRoleCheck('owner');
		$this->dodol_auth->userRoleCheck('owner');
	}
	
	function index() {
		$url = $this->uri->segment(4);
		$u = modules::run('user/api_getbyid', $this->dodol_auth->userdata('object')->user_id);
		$data['pT'] = 'Backend';
		$data['mainLayer'] = 'backend/sample_view_admin';
		$data['u_name'] = $u->first_name.' '.$u->last_name;
	//	$this->load->library('dwodol')->theme();
		
		$this->dodol_theme->render()
						->build('sample_view_admin', $data);
	}
	function store_back(){
		$data = array(
		'directLayer' => 'this is index of Store banck end',
		'pt' => 'Store'
			);
		$this->dodol_theme->render($data, 'back');
	}
	
	

}?>