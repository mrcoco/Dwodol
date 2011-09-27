<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_extension extends MX_Controller {
	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->dodol_auth->userRoleCheck('owner');
	}
	function index(){
		$this->dodol_theme->render()->build('page/store/extension/index');
	}
	// PAYMENT
	function create_payment(){
		
		if($this->input->post('submit')):
			$data = array(
				'name' => $this->input->post('name'),
				'nm_rek' => $this->input->post('an_rek'),
				'no_rek' => $this->input->post('no_rek'),
				'description' => $this->input->post('desc'),
				);
			if($q = $this->db->insert('store_payment', $data)):
			$this->messages->add('Success Create Payment wit name'.$this->input->post('name'), 'success');
			redirect('backend/store/b_extension/list_payment');
			else:
			$this->messages->add('There is Something Wrong, try again latter', 'warning');
			redirect('backend/store/b_extension/list_payment');
			endif;
			
		endif;
		$data = array(
			'mainLayer' => 'backend/page/store/product/addprod_v',
			'pt'        => 'Create Payment',
			'ht'		=> 'Create Payment',
			);
		$this->dodol_theme->render()->build('page/store/extension/payment/create_v', $data);
	}
	function edit_payment(){
		$id = $this->uri->segment(5);
		if(!$payment = $this->db->where('id', $id)->get('store_payment')->row()) return $this->dodol_theme->not_found();
			$data = array(
				'pT'        => 'Edit Payment',
				'hT'		=> 'Edit Payment',
				);
		$data['payment'] = $payment;
		$this->dodol_theme->render()->build('page/store/extension/payment/edit_v', $data);
		if($this->input->post('submit')){
			$data = array(
				'name' => $this->input->post('name'),
				'nm_rek' => $this->input->post('an_rek'),
				'no_rek' => $this->input->post('no_rek'),
				'description' => $this->input->post('desc'),
				);
			$this->db->where('id', $id);
			if($q = $this->db->update('store_payment', $data)):
			$this->messages->add('Success update Payment wit name'.$payment->name, 'success');
			redirect('backend/store/b_extension/list_payment');
			else:
			$this->messages->add('There is Something Wrong, try again latter', 'warning');
			redirect('backend/store/b_extension/list_payment');
			endif;
		}
	}
	function delete_payment(){
		
	}
	function list_payment(){
		$menuSource = array(
			array(
				'anchor' => 'Create Payment', 'link' => site_url('backend/store/b_extension/create_payment')),
		);
		$menu = menu_rend($menuSource);
		$q = $this->db->get('store_payment'); 
		$payments = ($q->num_rows() == 0) ? false : $q->result();
		$data = array(
				'pt'        => 'List Payment',
				'ht'		=> 'List Payment',
				'payments'	=> $payments,
				'pageMenu' => $menu,
				);
		$this->dodol_theme->render()->build('page/store/extension/payment/list_v', $data);
	}
	
}	