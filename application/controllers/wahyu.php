<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Wahyu extends MX_Controller {

	//php 5 constructor
	var $user_mail ;
	var $user_pass ;
	function __construct() {
		parent::__construct();
		$this->user_mail = 'zidmubarock@gmail.com';
		$this->user_pass = 'alzid4ever';
	}
	
	function index() {
		$this->load->view('wahyu/login_p');
	}
	function exec(){
		
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		if($email == $this->user_mail && $pass == $this->user_pass){
			$data = array('name' => 'Zidni mUbarock', 'is_login' => true);
			$this->session->set_userdata(array('wahyu_login' => $data));
			redirect('wahyu/private_page');
		}else{
			redirect('wahyu/index');
		}
		
	}
	function private_page(){
		$login_data = $this->session->userdata('wahyu_login');
		if(!$login_data){
			redirect('wahyu/index');
		}else{
			$this->load->view('wahyu/private_p');
		}
		
	}
	function logout(){
		$this->session->unset_userdata('wahyu_login');
		redirect('wahyu/index');
	}

}