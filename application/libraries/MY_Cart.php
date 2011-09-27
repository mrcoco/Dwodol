<?php if (!defined('BASEPATH')) exit('No direct script access allowed');		
/**
 * This is Extended Class for Native Ci_Cart Class Library
 * file name : application/library/MY_cart.php
 * @package default
 * @author Zidni Mubarock
 **/
class MY_Cart extends CI_Cart {		
		
	var $_ci 			= '';
	var $customer_info 	= '';
	var $shipto_info    = '';
	var $shipping_info 	= '';	
	var $paymnet_info 	= '';
	var $extra_data_name= 'meta_cart';
	var $meta  			= '';
	var $check_step 	= '';	
	
	function MY_Cart(){	
		parent::__construct();
		
		$this->_ci =& get_instance();		
		$this->_ci->load->library('session');
		$this->billing_data 	= $this->get_sess('billing_data');
		$this->shipto_data 		= $this->get_sess('shipto_data');
		$this->payment_data 	= $this->get_sess('payment_data');
		$this->shipping_data   	= $this->get_sess('shipping_data');

	}		
	
	/**
	 * get_sess
	 *
	 * @return $session_name or False
	 * @author Zidni Mubarock
	 **/
	function get_sess($name)
	{
		if($this->_ci->session->userdata($name)){
			return $this->_ci->session->userdata[$name];
		}else{
			return false;
		}
	}
	/**
	 * write addtional data on session, needed during transaction
	 *
	 * @param string $name 
	 * @return void
	 * @author Zidni Mubarock
	 */
	function write_data($name, $value){
		if($name){
			$this->_ci->session->set_userdata($name, $value);
		}else{
			$this->_ci->session->sess_write();
		}
	}
	
	/**
	 * destroy_data
	 * for destroying all data on session, which needing during transaction				
	 * @return void
	 * @author Zidni Mubarock
	 **/
	function destroy_data($specify=false)
	{
		if($specify == false){
			$this->destroy();
			$this->_ci->session->unset_userdata('billing_data');
			$this->_ci->session->unset_userdata('shipto_data');
			$this->_ci->session->unset_userdata('shipping_data');
			$this->_ci->session->unset_userdata('payment_data');
			$this->_ci->session->unset_userdata('cart_user_data');
		}else{
			$this->_ci->session->unset_userdata($specify);
		}
		return true;
		
	}
	/**
	 * HackAttrib, to extract the product attribute from database, to array each key and value;
	 *
	 * @param string $value 
	 * @return $pairs
	 * @author Zidni Mubarock
	 */	

	/**
	 * GroupAttrib, to grouping and array into one index, if have same value
	 *
	 * @param array $attribs 
	 * @return new sorted array $attribs
	 * @author Zidni Mubarock
	 */	
	function groupArray($attribs){		
		$gr_attrib = array();		
				foreach ($attribs as $key => $value) {		
				if (array_key_exists($value, $gr_attrib)) {		
					 $gr_attrib[$value] .= ",$key";		
					} else {		
					 $gr_attrib[$value] = $key;		
					} // endif		
				} // end foreach		
		$attribs = array_flip($gr_attrib);		
		return $attribs;		
		
	}
	/**
	 * loadAttrib, extract the product attribute from database into and array, and group it
	 *
	 * @param array $attributes 
	 * @param string $index name of search index
	 * @return extracted and sorted group array $attrib
	 * @author Zidni Mubarock
	 */	
	function loadAttrib($attributes, $index){		
		foreach($attributes as $singelAttrb){		
			$source = $singelAttrb->attribute;		
			$attrb = $this->hackAttrib($source);		
				$preFinalArray[] = $attrb[$index];		
			} 		
				
			$attrb = $this->groupArray($preFinalArray);		
			return $attrb;		
			
	}
	function load_attr($a){
		$storage = array();
		
		foreach($a as $att){
				$prepare_sort = explode(';',$att->attribute) ;
					foreach ($prepare_sort as $pre){
						list($key, $value) = explode(':', $pre);
						$attribute[$key] = $value;
					}
				array_push($storage, $attribute);
		}
	
		return call_user_func_array('merge',$storage);
		
		
	}
	function reverse_attr($array){
		$output = '';
		ksort($array);
		foreach($array as $key=>$value){
			$output .= $key.':'.$value.';';
		}
		return substr($output, 0 , -1);
	}
	function extractAttrib($data){
		$i = 0;
		foreach($data as $dt){
			$attrib = explode(';',$dt->attribute);
			foreach($attrib as $a){
			$i_attrb[$i] = strstr($a, ':', true);
			$i++;
			}
		}
		$return['index'] = $this->groupArray($i_attrb);
		
		foreach($return['index'] as $index){
			$return['attribute'][$index] = $this->loadAttrib($data, $index);
		}
		
		return $return;
	}
	/**
	 * Show_price, showing formated money format which selected currency or site default currency
	 *
	 * @param int $number ; number to be formated
	 * @param string $curr ; currency want to embed
	 * @return $formated
	 * @author Zidni Mubarock
	 */			
	function show_price($number, $curr=false){		
		if($curr == false){		
		$formated = $this->currency().' '.number_format($number, 2, ',', '.');		
		}else{	
			// TODO : Change when currency session change	
		$formated = $curr.' '.number_format($number, 2, ',', '.');		
		}		
		return $formated;		
	}	
	/**
	 * currency; get current currency set, from session or site config, default currency
	 *
	 * @return $currency
	 * @author Zidni Mubarock
	 */
	function currency(){		
		if($this->_ci->session->userdata('currency')){		
			$currency = $this->_ci->session->userdata('currency');		
		}else{		
			$currency = $this->_ci->config->item('currency');		
		}		
		return $currency;		
	}		
	/**
	 * rate ; get the current rate based on the current currency seted.
	 *
	 * @return void
	 * @author Zidni Mubarock
	 */	
	function rate(){		
		$rate = $this->_ci->session->userdata('rate');		
		if($rate){		
			$rate = $rate;		
		}else{		
			$rate = 1;		
		}		
		return $rate;		
	}
	function conv($currencyfrom,$currencyto){
       	$from   = $currencyfrom;
		$to     = $currencyto;
	    $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
	    $handle = @fopen($url, 'r');
	    if ($handle) {
	            $result = fgets($handle, 4096);
	            fclose($handle);
	    }
	     $allData = explode(',', $result); /* Get all the contents to an array */
	     $rate = $allData[1];
	     return $rate;
	}		
	function weight(){
			$index = 0;
			if ($this->total_items() != 0) :
			foreach($this->contents() as $item){
				$param = array('id' => $item['id'], 'select' => 'weight');
				$prod = modules::run('store/product/detProd', $param);
				$totalWeight[$index] = $prod['prod']->weight*$item['qty'];
				$index++;
			}
			$finalWeight = array_sum($totalWeight);
			return $finalWeight;
			else :
			return 0;
			endif;
	}
	function shipping_option(){
		$this->_ci->load->helper('store/store_carrier');
		return store_carrier_helper::registry('get_rate');
	}
	function shipping_choose($rate_id){
		$this->_ci->load->helper('store/store_carrier');
		store_carrier_helper::registry('choose_rate', $rate_id);
	}
	function payment_action(){
		$this->_ci->load->helper('store/store_payment');
		store_payment_helper::registry('payment_action');
	}
	function payment_option(){
		$this->_ci->load->helper('store/store_payment');
		store_payment_helper::registry('get_option');
	}
	function validate_product($conf = array()){
		$id 			= element('product_id', $conf);
		$id_attribute 	= false;
		$attr_key		= ($key_a = element('attribute_key', $conf)) ? $key_a : false;
		$stock 			= 0;
		$qty 			= element('qty', $conf);
		$cart_qty 		= 0;
		$in_cart		= true;
		$no_attribute	= false;
		$rowid 			= false;
		
		// if attribute key was set, so search the id of that attribute n get the stock;
		if($attr_key != false){
			$this->_ci->db->where('prod_id', $id);
			$this->_ci->db->where('attribute', $attr_key);
			$q = $this->_ci->db->get('store_product_attrb');
			if($q->num_rows() == 1){
				$id_attribute = $q->row()->id;
				$stock = $q->row()->stock;
			}elseif($q->num_rows() == 0){
				$id_attribute = false;
				$stock = 0;
				$no_attribute = true;
			}
		}else{
			$this->_ci->db->where('id', $id);
			$q = $this->_ci->db->get('store_product');
			if($q->num_rows() == 1){
				$stock = $q->row()->stock;
			}
		}

		if($rowid = $this->is_in_cart($id, $id_attribute)){
			$cart_qty  = element('qty', $this->cart_item($rowid));
		}
	
		$request_stock = $qty + $cart_qty;
	
		switch (true) {
			case ($no_attribute == true):
				$return['status'] = 'off';
				break;
			case($stock == 0):
				$return['status'] = 'off';
				break;
			case ($no_attribute == false && $request_stock > $stock):
				$return['status'] = 'min';
				break;
			case ($no_attribute == false && $request_stock <= $stock):
				$return['status'] = 'on';
				break;
		}
		
	$return['in_cart'] 			= $in_cart;
	$return['rowid'] 			= $rowid;
	$return['qty']				= $request_stock;
	$return['attribute_id'] 	= $id_attribute;
	$return['product_id']	 	= $id;
	$return['attribute_key'] 	= $attr_key;
	return $return;	
	
	}
	function put_to_cart($conf = array()){
		$this->_ci->load->helper('store/product');
		$check = $this->validate_product($conf);
		$product = modules::run('store/product/api_getbyid', element('product_id',$conf) , false , 'prod.weight', false);
		if(element('status', $check) == 'on'){
			if($rowid = element('rowid', $check)){
			
				$this->update(array(
							'rowid' => $rowid,
				       		'qty'   => element('qty', $check)
				       			));
				
			}else{
				$data = array(
					'id'		=> $product->id,
					'weight'	=> $product->weight,
					'name'		=> $product->name,
					'qty'		=> element('qty', $conf)
					);
				
				if(is_numeric(element('attribute_id', $check))){
					$data['id_attrb'] 	= element('attribute_id', $check);
					$data['options']  	= prod_attr_to_array(element('attribute_key', $conf));
					$data['price'] 		= prod_price(element('product_id', $conf), element('attribute_id', $check), true)->final_value;
				}else{
					$data['price'] 		= prod_price(element('product_id', $conf), false, true)->final_value;
				}
			
				$this->insert($data);
				
			}
		}
		return $check;
	}
	function is_in_cart($id_prod, $id_attrb=false){
		$row_id = false;
		// checking the product is on cart or nope
		foreach($this->contents() as $key => $value){
			if($id_attrb != false){
					if(element('id_attrb', $value) == $id_attrb && element('id', $value) == $id_prod){
						$row_id = $key;
						break;
					}
					
			}else{
					if( element('id', $value) == $id_prod){
						$row_id = $key;
						break;
					}
			}
		}
		return $row_id;
	}
	function cart_item($rowid){
		foreach($this->contents() as $key => $value){
			if($rowid == $key) {
				return $value;
			}
		}
	}
}		
