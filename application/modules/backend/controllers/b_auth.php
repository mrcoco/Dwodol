<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_auth extends MX_Controller {
	function __construct(){
		parent::__construct();

	}
	function index(){
		echo 'auth backend';
	}
	function logout(){
		if($this->dodol_auth->do_logout()):
			redirect('backend');
		else:
			redirect('backend');
		endif;
	}
	function login(){
		if( $this->dodol_auth->userdata()) redirect('backend');
		$render = array(
			'pT' => 'Login',
		);
		$this->dodol_asset->append_module('css', array('login_page.css'));
		$this->dodol_theme->set_layout('login');
		$this->dodol_theme->render()->build('page/login_page', $render);
	}
	function ajx_do_login(){
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$url = $this->input->post('url');
		if($this->dodol_auth->do_login($email, $pass, 'backend')):

			$location = str_replace('/red/', '', strstr($url, '/red/' ));
			if($location == 'backend') $location = 'backend?first=true';
			$data = array( 'msg' => 1, 'location' => $location);
		else:
			$this->messages->add('Wrong Combination', 'warning');
			$data = array( 'msg' => 0);
		endif;
		echo json_encode($data);
		
	}
}