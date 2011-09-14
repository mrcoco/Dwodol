<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dodol_auth
{
	var $login_data = array('login' => '', 'role' => '', 'user_id' => '');
	var $auth_m ;
	function __construct(){
		$this->_ci =& get_instance();
		$this->_ci->load->library('session');
		if($this->_ci->router->fetch_module() == 'backend'):
			$this->login_data = $this->_ci->session->userdata('back_login_data');
		else:
			$this->login_data = $this->_ci->session->userdata('login_data');
		endif;
		$this->auth_m = $this->_ci->load->model('user/auth_m');
		
	}
	function userRoleCheck($role=''){
		$source_page = str_replace(site_url(), '', current_url());
		if($role):
			if($role == element('role', $this->login_data) && element('login', $this->login_data) == true && element('user_id', $this->login_data) != null ):
				return true;
			else:
				redirect('backend/login/red/'.$source_page);
			endif;
		else:
			if(element('login', $this->login_data) == true && element('user_id', $this->login_data) != null ):
				return true;
			else:
				redirect('backend/login/red/'.$source_page);
			endif;
		endif;
	
	}
	function userdata($type = false){
		if($type == true):
		return  arrayObject($this->login_data);
		else:
		return $this->login_data;
		endif;
	}
	function do_logout(){
		if($this->_ci->router->fetch_module() == 'backend'):
			$this->_ci->session->unset_userdata('back_login_data');
			$this->_ci->messages->add('your succesfully logout', 'success');
			return true;
		else:
			$this->_ci->session->unset_userdata('login_data');
			$this->_ci->messages->add('your succesfully logout', 'success');
			return true;
		endif;	
	}
	function do_login($email, $pass, $stage = 'front'){
		if($data_user = $this->auth_m->validate_combination($email, $pass)):
			if($stage == 'backend'):
				$new_data_sess = array('back_login_data' =>
									array(
										'login' 	=> true, 
										'role' 		=> $data_user->role, 
										'user_id' 	=> $data_user->id
									)
								);
			else:
				$new_data_sess = array('login_data' =>
									array(
										'login' 	=> true, 
										'role' 		=> $data_user->role, 
										'user_id' 	=> $data_user->id
									)
								);
			endif;
			$this->_ci->session->set_userdata($new_data_sess);
			return true;
		else:
			return false;
		endif;
	}
}