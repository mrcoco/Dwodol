<?php 


if (! defined('BASEPATH')) exit('No direct script access');
/**
 * Checkout Class Controller, 
 *
 * @package store
 * @author Zidni Mubarock
 */
class Checkout extends MX_Controller {

	//php 5 constructor

	function __construct() {
		parent::__construct();
		$this->load->library('cart');
		$this->load->library('jne');
		$this->step = $this->session->userdata('checkout_step');
	
		$this->dodol_theme->set_layout('extend/store/checkout');
		$this->dodol_asset->append_module('css', 'checkout.css');
	}
	
	//php 4 constructor
	
	function Checkout() {
		parent::__construct();
	}
	function logout(){
		$this->dodol_auth->do_logout();
	}
	function index() {
		if($this->cart->total_items() == 0) redirect('store/cart/viewcart/');
		if($this->dodol_auth->userdata()) redirect('store/checkout/buyerinfo?user=is_log');
		$this->dodol_theme->render()->build('page/checkout/pre_check_v');
	}
	function do_login(){
		$email = $this->input->post('email');
		$pass = $this->input->post('password');
		if($this->dodol_auth->do_login($email, $pass)){
			$this->session->unset_userdata('shipto_data');
			$this->session->unset_userdata('billing_data');
			$return = array(
				'status' => 'success');
		}else{
			$return = array('status' => 'fail');
		}
		echo json_encode($return);
	}
	function ajax(){
		enable_get();
		$act = ($this->input->get('act')) ? $this->input->get('act') : 'nope';
		$return = array();
		switch ($act) {
			case 'buyer_info':
					$exe = $this->exe_buyer_info()	;
					if(element('status', $exe) == 'fail'){
						$this->messages->add(element('msg', $exe),'warning');
						$return = array('status'=> 'fail');
					}else{
						$return = array('status'=> 'success');
					}

				break;
			case 'load_ship':
					ob_start();
					$this->cart->shipping_option();
					$buffer = ob_get_clean();
					$return = array('status' => 'success', 'all_shippers' => $buffer);
				break;
			default:
				# code...
				break;
		}
		echo json_encode($return);
	}
	function summary_cart(){
		$this->load->library('cart');
		$data = array(
				'items' => $this->cart->contents(),
				'shipping_info' => $this->session->userdata('shipping_info')
			);
		
		if(!$this->session->userdata('ship_to_info')){
			$data['buyer_info'] = $this->session->userdata('customer_info');
		}else{
			$data['buyer_info'] = $this->session->userdata('ship_to_info');
		}
		$this->dodol_theme->view('store/misc/checkout/summary_cart_v', $data);
		
	}
	/**
	 * Buyer info Page
	 *
	 * @return Void : Page
	 * @author Zidni Mubarock
	 */		
	function buyerinfo(){
		enable_get();
		if(!$this->dodol_auth->userdata()){
		if(!$this->input->get('do_reg')) redirect('store/checkout');
		}
		
		// if total item in cart == 0, so trow out to cart view;
		if($this->cart->total_items() == 0) redirect('store/cart/viewcart/');
		
	   	if(!$this->dodol_auth->userdata() && !$this->cart->billing_data):
		$bill = array();
		elseif($this->dodol_auth->userdata() && !$this->cart->billing_data ):
		$bill = objectToArray($this->load->controller('user')->api_getbyid($this->dodol_auth->userdata(true)->user_id));
		elseif(($this->dodol_auth->userdata() && $this->cart->billing_data ) || (!$this->dodol_auth->userdata() && $this->cart->billing_data)) :
		$bill = $this->cart->billing_data;
		endif;
			$data = array(
				'pT' => 'chekout - Customer Information' ,
				'cart' => modules::run('store/checkout/summary_cart'),
				'bill_data' => $bill,
				'ship_data'  => $this->cart->shipto_data,
				//'loadSide' => false
				);
			$this->dodol_theme->render()->build('page/checkout/buyerinfo_v', $data);
		
	
		
		
	}
	/**
	 * Exe_buyerinfo; an execution function for buyerinfo page
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_buyer_info(){
		$billing_data 		= post_filter('main_');
		$shipping_data 		= post_filter('ship_');
		$reg_data 			= post_filter('reg_');
		$log_data 			= $this->dodol_auth->userdata(true);
		$cart_user_data 	= $this->session->userdata('cart_user_data');
		$return['status'] 	= 'success';
		
		
		if(!$this->input->post('different_ship')):
			$this->session->unset_userdata('shipto_data');
		 	$shipping_data = false;
		endif;
		
		// apapun yang terjadi masukan billing_data ke billing_data
		$this->cart->write_data('billing_data' , $billing_data);

		if(!$cart_user_data && $log_data){
			$this->session->set_userdata('cart_user_data', array('id' => $log_data->user_id) );
			$cart_user_data =  $this->session->userdata('cart_user_data');
		}
		
		if(!$log_data && $cart_user_data) {
			$this->load->controller('user')->api_update($cart_user_data['id'], $billing_data);
		}
		if($shipping_data != false) {
			$this->cart->write_data('shipto_data' , $shipping_data);
		}
	
		// jika regdata valid;
		if($reg_data  && !$cart_user_data){
			$new_member = array_merge($billing_data, $reg_data);
			$new_member['role'] = 'user';
			$new = $this->load->controller('user')->api_create($new_member);	
			if($new == false){
				$return['status'] 	= 'fail';
				$return['msg']  	= 'email have registered';
			}else{
				$this->session->set_userdata('cart_user_data', array('id' => $new->id) );
			}
					
		}elseif(!$reg_data && !$cart_user_data){
			$new_customer = $billing_data;
			$new_customer['role'] = 'customer';
			$new = $this->load->controller('user')->api_create($new_customer);
			if($new == false){
				$return['status'] 	= 'fail';
				$return['msg']  	= 'email have registered';
			}else{
				$this->session->set_userdata('cart_user_data', array('id' => $new->id) );
			}
		
		}
		
		return $return;
		
	}
	/**
	 * shipping_method ;
	 *
	 * @return void : page shipping_method	
	 * @author Zidni Mubarock
	 */
	function shipping_method(){	
//		if(!$this->cart->customer_info) redirect('store/checkout/buyerinfo/');
		$buyer_info = ($this->cart->shipto_data) ? $this->cart->shipto_data : $this->cart->billing_data;
		if(!$buyer_info) {
			redirect('store/checkout/buyerinfo?tpl=checkout');
		}
		if($this->input->post('next')){
			modules::run('store/checkout/exe_shipping_method');
		}else{
			$data['pT'] = 'Checkout - Shipping Method';
			$data['buyer_info'] = $buyer_info;
			$data['cart'] = modules::run('store/checkout/summary_cart');
			$data['mainLayer'] = 'store/page/checkout/shipping_method_v';
			$this->dodol_theme->render()->build('page/checkout/shipping_method_v', $data);
		
		}
	}
	/**
	 * exe_shipping_method
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_shipping_method(){
		$this->session->unset_userdata('shipping_data');
		$this->load->helper('store/store_carrier');
		store_carrier_helper::registry('choose_rate');
		redirect('store/checkout/payment?tpl=checkout');
	}
	function clean(){
		$this->session->unset_userdata('login_data');
		$this->session->unset_userdata('billing_data');
				$this->session->unset_userdata('cart_user_data');
				$this->cart->destroy();
	}
	/**
	 * payment page
	 *
	 * @return void : page
	 * @author Zidni Mubarock
	 */	
	function payment(){
	//$this->session->unset_userdata('shipping_info');
		if($this->cart->shipping_data){
		
				$data= array(
					'mainLayer' => 'store/page/checkout/payment_v',
					'pT'        => 'Checkout - Payment Method',
					'cart'      => modules::run('store/checkout/summary_cart'),
				);
		
				$this->dodol_theme->render()->build('page/checkout/payment_v', $data);
		
				if($this->input->post('next')){
					$this->exe_payment();
				}		
		}else{
			redirect('store/checkout/shipping_method?tpl=checkout');
		}
	}
	/**
	 * execution for payment page
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function exe_payment(){
		$this->load->helper('store/store_payment');
		store_payment_helper::registry('choose_option');
		redirect('store/checkout/summary?tpl=checkout');
	}
	
	/**
	 * summary page;
	 * only can accessed when all steep of checkout passed
	 * @return void
	 * @author Zidni Mubarock
	 */
	function summary(){
		if(!$this->cart->payment_data) :
			redirect('store/checkout/payment?tpl=checkout');
		endif;
		
		$this->load->library('recaptcha');
		if($this->cart->payment_data){
			if(element('nope', $this->cart->shipping_data) == true){
				$ship_carrier = 'Will Confirm Latter after order placed';
			}else{
				$ship_carrier = element('carrier', $this->cart->shipping_data).' - '.element('service', $this->cart->shipping_data);
			}
			$rendered = array(	
				'mainLayer' => 'store/page/checkout/summary_v',
				'pT'        => 'Checkout - Order Summary',
				'cart'      => modules::run('store/checkout/summary_cart'),
				'ship_data' => ($this->cart->shipto_data) ? $this->cart->shipto_data : $this->cart->billing_data,
				'bill_data' => $this->cart->billing_data,
				'payment' 	=> $this->cart->payment_data,
				'shipping' => $ship_carrier,
				);
			$this->dodol_theme->render($rendered)->build('page/checkout/summary_v', $rendered);
			if($this->input->post('process') /* && $this->recaptcha->validate() */){
			  $this->process();
			}
		}else{
			redirect('store/checkout/payment?tpl=checkout');
		}
		
	}
	
	/**
	 * process
	 * processor order into database and payment process
	 * @return void
	 * @author Zidni Mubarock
	 */
	function process(){
		if(!$this->cart->payment_data) redirect('store/checkout/summary');
		$order_data = array(
			'user_id' 				=> element('id', $this->session->userdata('cart_user_data')),
			'payment_method' 		=> element('method', $this->cart->payment_data),
			'total_amount' 			=> $this->cart->total()+element('fee', $this->cart->shipping_data),
			'sub_amount'			=> $this->cart->total(),
			'currency'				=> currency(),
			'ship_carrier' 			=> element('carrier', $this->cart->shipping_data),
			'ship_carrier_service' 	=> element('service', $this->cart->shipping_data),
			'ship_fee'				=> element('fee', $this->cart->shipping_data),
			'customer_note'			=> $this->input->post('customer_note'),
			'status'				=> 'pending',
		);
		$billing_data = $this->cart->billing_data;
		$shipto_data  = ($ship = $this->cart->shipto_data ) ? $ship : $this->cart->billing_data ;
		$product_item = array();
		foreach($this->cart->contents() as $item){
			$new = array(
				'id_prod' 		=> element('id', $item),
				'id_attr' 	=> element('id_attrb', $item),
				'price'			=> element('price', $item),
				'price_total'	=> element('subtotal', $item) ,
				'qty'			=> element('qty', $item),
			);
			array_push($product_item, $new);
		}
		$new_order = $this->load->controller('store/order')->api_create(array(
			'order_data'	=> $order_data,
			'billing_data' 	=> $billing_data,
			'shipto_data'  	=> $shipto_data,
			'product_item' 	=> $product_item,
		));
		

		$this->session->set_userdata('order_data', $new_order);
		$this->cart->destroy_data('billing_data');
		$this->cart->destroy_data('shipto_data');
		$this->cart->destroy_data('shipping_data');
		$this->cart->destroy();
		redirect('store/checkout/payment_process');
	}
	function payment_process(){

		if(!$this->session->userdata('order_data')) redirect('store/checkout/summary');
		$data['bar'] = 'Payment Process';
		$data['pT'] = 'Payment Process';
		$data['order_data'] = $this->session->userdata('order_data');
		$this->dodol_theme->render()->build('page/checkout/payment_process', $data);
	}
	/**
	 * success page
	 * will delet all extra data and cart, because order already successfully placed,
	 * @return void
	 * @author Zidni Mubarock
	 */
	function success(){
		$this->dodol_theme->render()->build('page/checkout/success_v');
	}
	/**
	 * checkout menu, show on checkout page only
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */
	function checkoutbar(){
		$data['active'] = 'class="active"';
		$data['method'] = $this->router->method;
		$this->dodol_theme->view('store/widget/checkout/checkout_bar', $data);
		
	}/**
	 * This Function, to check that email which user input, allready on site database or not
	 *
	 * @return json
	 * @author Zidni Mubarock
	 */
	function ajax_checkmail(){
	    if($this->input->post('email')){
	        $email = $this->input->post('email');
     	    $this->db->where('email', $email);
    	    $q = $this->db->get('user');
    	    if($q->num_rows() > 0){
    	        $data['hv_user'] = true;
    	        echo json_encode($data);
    	    }else{
    	        $data['hv_user'] = false;
        	    echo json_encode($data);
    	    }
        }
	}
	
	
}	
	

