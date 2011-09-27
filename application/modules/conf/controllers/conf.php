<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Conf extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('conf/conf_m');
	}
	function index() {
		
//echo $this->dodol_conf->load('tester')->tester->name;
		echo $this->dodol_conf->tester->name;
	}
	function gettest(){
		echo $this->dodol_conf->test();
	}
	/// API 
	function exe_create($data){
		return $this->mdl->create($data);
	}
	function exe_update($id, $data){
		return $this->mdl->update($id, $data);
	}
	function exe_delete($id){
		return $this->mdl->delete($id);
	}
	function getbyid($id){
		return $this->mdl->getbyid($id);
	}
	function getall(){
		return $this->mdl->getall();
	}
	function getbyname($name){
		return $this->mdl->getbyname($name);
	}
	function append_conf($id, $key, $value){
		if(is_numeric($id)){
			$data = $this->getbyid($id);
		}else{
			$data = $this->getbyname($id);
		}
		if(!$data)return false;
		$new_data = json_decode($data->config_object, true);
		$new_data[$key] = $value;
		$upd_data = array('config_object' => json_encode($new_data));
		if($update = $this->exe_update($data->id, $upd_data)){
			return true;
		}else{
			return false;
		}
		
	}
	
}?>