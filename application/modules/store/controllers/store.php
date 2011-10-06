<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/store_m');
	}
	
	//php 4 constructor
	function Store() {
		parent::__construct();
	}
	
	function index() {
	 	redirect('/');
	}
	function testing_route(){
		echo 'its work';
	}

	function request_restock($id_prod, $id_attrb = false, $attrb_key = false){
		$data = array('id_prod' => $id_prod, 'id_attrb' => $id_attrb, 'attrb_key' => $attrb_key);
		$this->dodol_theme->view('store/misc/store/request_restockform_v', $data);
	}
	function exe_requestRestock(){
		$data = array(
			'email'=>$this->input->post('email'),
			'name'=> $this->input->post('name'),
			'id_prod' => $this->input->post('id_prod'),
				);
		if($this->input->post('id_attrb')){
		$data['id_attrb'] = $this->input->post('id_attrb');
		}
		$q = $this->store_m->add_request_restock($data);
		if($q){
			$this->messages->add('your request successfully added', 'success');
		}else{
			$this->messages->add('you seem already request restock from this product');
		}
	}
	function ajax_requestRestock(){
		if($this->input->post('email_twitter') && $this->input->post('prod_id')){
			// checking the input email or twiter
			$source = $this->input->post('email_twitter');
			if(strpos('@', $source) === false):
				if(element('0', explode('@', $source)) != '' && element('0', explode('@', $source)) != $source) :
				$ins_data['email'] = $source;
				else:
				$ins_data['twitter'] = str_replace('@', '', $source);
				endif;
			else:
				$ins_data['twitter'] =  $source;
			endif;
		
			$ins_data['id_prod'] = $this->input->post('prod_id');
			$ins_data['c_date'] = date('Y-m-d H:i:s');
			if($id_attrb = $this->input->post('atrb_id')) $ins_data['id_attrb'] = $id_attrb;
			if($attrb_key = $this->input->post('atrb_id')) $ins_data['attrb_key'] = $attrb_key;
			
			$q = $this->store_m->add_request_restock($ins_data);
			if($q){
				$this->messages->add('your request successfully placed', 'success');
				$data['status'] = 'on';
				echo json_encode($data);
			}else{
				$this->messages->add('something wrong', 'warning');
				$data['status'] = 'off';
				echo json_encode($data);
			}
		}
	}
	function test(){
		$source = 'gmail@zidmubarock';
		if(strpos('@', $source) === false):
			if(element('0', explode('@', $source)) != '' && element('0', explode('@', $source)) != $source) :
				echo 'email =' .$source;
			else:
				echo 'twitter =' .str_replace('@', '', $source);
			endif;
		else:
			echo 'twitter ='. str_replace('@', '', $source);
		endif;
	}
	function getCountry($id){
	return	$this->store_m->get_country($id);
	}
	function payprocessing(){
		$id = $this->session->userdata('order_id');
		$data['form'] = modules::run('paypal/generate_form', $id);
		$data['loadSide'] = false;
		$data['mainLayer'] = 'store/page/checkout/payProcessing_v';
		$this->dodol_theme->render($data);
	}
	function carrier_cont(){
		parse_str($_SERVER['QUERY_STRING'], $_GET); 
		$this->input->_clean_input_data($_GET);
		$state = $this->input->get('cr');
		$this->load->helper('store/store_carrier');
		return store_carrier_helper::load($state);
	}
	function new_arrival(){
	//	$this->dodol_theme->set_layout('extend/store/store');
		$this->load->library('dodol/dodol_paging');
		$uri = $this->uri->uri_to_assoc();
		$param['start'] = 0;
		$param['limit'] = 9;
		$param['order_role'] = 'ASC';
		$param['order_by'] = 'prod.c_date';
		$q = modules::run('store/product/api_browse', $param);
		if(!$q):
			return $this->dodol_theme->not_found();
		endif;
		$render['prods'] = element('prods', $q);
		$render['pT'] 	 = 'New Arrival';
		$this->dodol_theme->render()->build('store/page/store/new_arrival', $render);
		
		
	}
	function new_arrival_mod($limit = 3){
		$param['start'] = 0;
		$param['limit'] = $limit;
	//	$param['order_role'] = 'DESC';
	//	$param['order_by'] = 'prod.c_date';
		$q = modules::run('store/product/api_browse', $param);
		if(!$q):
			return $this->dodol_theme->not_found();
		endif;
		$render['prods'] = element('prods', $q);
		$this->dodol_theme->view('store/page/store/new_arrival', $render);
		
		
	}
	function get_dropdown_country(){
		$list = array();
		$list['0'] = 'none';
		$q = $this->db->get('store_country');
		if($q->num_rows() > 0 ){
			foreach($q->result() as $item){
				$list[$item->country_id] = $item->country_name;
			}
		}
		return $list;
	}
}?>