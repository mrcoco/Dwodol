<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_user extends MX_Controller {
	
	
	function __construct() {
		parent::__construct();
		$this->dodol_auth->userRoleCheck('owner');
		
	}
	function index() {
	
	}
	function browse(){
		$q = $this->db->get('user');
		if($q->num_rows() < 1) return $this->dodol_theme->not_found();
		$data['users'] = $q->result();
		$data['pT'] = 'User';
		$this->dodol_theme->render()->build('page/user/browse', $data);
		
	}
	function view(){
		
	}
	function edit(){
		
	}
	function delete(){
		
	}
	function account(){
		
	}


}