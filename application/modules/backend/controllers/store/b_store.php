<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_store extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function index(){
		$this->dodol_theme->render()->build('page/store/index');
	}
	function config(){
		$this->load->helper('store/store_carrier');
		$this->load->helper('store/store_payment');
		$carriers = array();
		$payments = array();
		foreach(store_carrier_helper::caller() as $carr){
			array_push($carriers, store_carrier_helper::load($carr.'/get_detail'));
		}
		foreach(store_payment_helper::caller() as $pay){
			array_push($payments , store_payment_helper::load($pay.'/get_detail'));
		}
		
		
		$data = array(
			'pT' 		=> 'Store Configuration',
			'carriers' 	=> $carriers,
			'payments'	=> $payments
			);
		$this->dodol_theme->render()->build('page/store/config', $data);
		
	}
	private function get_payment(){
		
	}
	private function get_shipping(){
		
	}
}