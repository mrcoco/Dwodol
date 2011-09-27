<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_order extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/order_m');
		$this->dodol_auth->userRoleCheck('owner');
	}
	
	//php 4 constructor
	function B_order() {
		parent::__construct();
	}
	
	function index() {
		redirect('backedn/store/b_order/browse');
	}
	
	function browse(){
		$this->load->library('dodol/dodol_paging');
		$limit = 20;
		
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['page'])){
			$param['page'] = 0;
		}
		if(!isset($param['status'])){
			$param['status'] = false;
		}
		if(!isset($param['q'])){
			$param['q'] = false;
		}
		
		if($param['page']){
			$start = ($param['page'] - 1)* $limit;
		}else{
			$start = 0;
		}
		
		$conf = array(
			'start' 	=> $start,
			'end'   	=> $limit,
			'status' 	=> $param['status'],
			'query' 	=> $param['q'],
			);
		
		//$prods = $this->product_m->getListProd($conf);
		$query = $this->load->controller('store/order')->api_browse($conf);
		if($query){
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' 	=> $target_url,
			'num_records' 	=> element('num_records', $query),
			'num_link'	  	=> 5,
			'per_page'   	=> $limit,
			'cur_page'   	=> element('page', $param)
			);
			
		$this->dodol_paging->initialize($confpage);
		}
		$menuSource = array(
			array('anchor' => 'Open Order', 'link' => '#'),
			array('anchor' => 'Shipping Label', 'link' => site_url('backend/store/b_order/shipping_label')),
		);
		$data['pageMenu']  = menu_rend($menuSource);
		$data['orders']    	= element('result', $query);
		$data['pT']			= 'Browse Order';
		$data['mainLayer'] 	='backend/page/store/order/browse_order_v';
		$this->dodol_theme->render()->build('page/store/order/browse_order_v', $data);
		
	}
	function view(){
		$id = $this->uri->segment(5);
		$data = $this->load->controller('store/order')->api_getbyid($id, array(
			'billing' => true, 'shipto' => true, 'product_item' => true, 'customer' => true, 'history'=> true));

		if(!$data) return $this->dodol_theme->not_found();

		
		$render['order'] = $data;
		$render['pH'] = 'Order No. '.$data->id;
		$render['mainLayer'] 	='backend/page/store/order/view_v';
		$this->dodol_theme->render()->build('page/store/order/view_v', $render);
	}
	function shipping_label(){
		enable_get();
		
		$this->dodol_asset->append_global('js', 'global_js/jq_printPage/jquery.printPage.js');
		$render['pT'] = 'Shipping Label Wizard';
		$statuses = array();

		foreach(array_merge(array('all'), $this->load->model('store/order_m')->status_type) as $stt){
			$statuses[$stt] = $stt;
		
		}
		$menuSource = array(
			array('anchor' => 'Browse Order', 'link' => site_url('backend/store/b_order/browse')),
		);
		$render['pageMenu']  = menu_rend($menuSource);
		$render['statuses'] = $statuses;
		$this->dodol_theme->render()->build('page/store/order/shipping_label', $render);
	}
	function print_ship_lab(){
		enable_get();
		$this->dodol_theme->set_layout('print');
		$this->dodol_asset->append_module('css', 'order_shipping_label_print.css');
		$prev = ($this->input->get('preview')) ? true : false;
		
		$start = $this->input->get('s_date');
		$end = $this->input->get('e_date');
		$oid = $this->input->get('oid');
		$status = $this->input->get('status');
	
		if(!$end && $start){
			$end = $start;
		}
		if($end && !$start){
			$start = $end;
		}
		if($oid) 	$this->db->where('a.order_id', $oid);
		if($start) 	$this->db->where('DATE(b.c_date) >=', $start);
		if($end)	$this->db->where('DATE(b.c_date) <=', $end);
		if($status && $status != 'all')	$this->db->where('b.status', $status);
	
		$this->db->join('store_order b', 'b.id=a.order_id');
		$q = $this->db->get('store_order_shipto_data a');

		if($q->num_rows() < 1) return false; 
		$data = array('labels' => $q->result(), 'prev' => $prev);
		
		$this->dodol_theme->render()->build('page/store/order/print_ship_lab', $data);
	}
	function updater_form($id_order, $current){
		$render['id'] = $id_order;
		$render['current'] = $current;
		$this->load->view('backend/page/store/order/updater_form_v', $render);
		if ($this->input->post('update_status')){
			$update = modules::run('store/order/update_status', $id_order, $this->input->post('new_status'));
			$this->messages->add('Success Update Order #'.$id_order.' Status to '.$this->input->post('new_status'), 'success');
			redirect(current_url());
		}
	}
	function delete(){
		$id = $this->uri->segment(5);
		if($this->order_m->delete($id)):
		$this->messages->add('Success Delete Order with number '.$id, 'success');
		redirect('backend/store/b_order/browse');
		else:
		$this->messages->add('failed Delete Order with number '.$id, 'error');
		redirect('backend/store/b_order/browse');
		endif;
		
	}
	function getorder_byid($id){
		$order = $this->load->controller('store/order')->api_getbyid($id, true);
		if($order){
			return $order;
		}else{
			return false;
		}
		
	}
	

}