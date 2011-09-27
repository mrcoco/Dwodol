<?php 

if (! defined('BASEPATH')) exit('No direct script access');



class Order_m extends CI_Model {
	var $history_type = array('payment_confirm', 'update_status');
	var $status_type = array('pending', 'confirm', 'process', 'cancel','shipped', 'refund');
	//php 5 constructor
	function __construct() {
		parent::__construct();
	
	}
	
	//php 4 constructor
	function Order_m() {
		parent::__construct();
	}
	

	
	// ORDER
	function create($data){
		$data['c_date'] = date('Y-m-d H:i:s');
		$data['uniq_id'] = md5(uniqid(mt_rand(), true));
		if(element('user_id', $data) == false) return false;
		if($this->db->insert('store_order', $data)):
			return $this->getbyid($this->db->insert_id());
		else:
			return false;
		endif;
	}
	function update($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('store_order', $data)){
			return $this->getbyid($id);
		}else{
			return false;
		}
	}
	function delete($id){
		if($pre = $this->getbyid($id)):
			$this->db->where('id', $id);
			if($this->db->delete('store_order')):
				return $pre;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	function getbyid($id, $include = array()){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order');
		$return = array();
		if($q->num_rows() == 1):
			$return = $q->row();
				if(element('billing', $include)) $return->billing_data  = $this->db->where('order_id', $id)->get('store_order_billing_data')->row();
				if(element('shipto', $include))	$return->shipto_data = $this->db->where('order_id', $id)->get('store_order_shipto_data')->row();
				if(element('product_item', $include)) $return->product_item  = $this->db->where('order_id', $id)->get('store_order_product_item')->result();
				if(element('customer', $include)) $return->user = $this->db->where('id', $return->user_id)->get('user')->row();
				if(element('history', $include)) $return->history = $this->db->where('order_id', $id)->get('store_order_history')->result();
			return $return;
		else:
			return false;
		endif;
	}
	function browse($param){
	$start = ($start = element('start', $param)) ? $start : 0;
	$limit = ($limit = element('limit', $param)) ? $start : 20;
	if($slc = element('select', $param)):
		$this->db->select($slc);
	else:
		$this->db->select('*');
	endif;
	
	$this->db->select('order_data.id as id_order');
	
	if(element('search', $param)) :
		$search = array(
			'order_data.id' => element('search', $param),
			'user.first_name' => element('search', $param),
			'shipping_info.first_name' => element('search', $param),
			'billing_data.first_name' => element('search', $param),
			'user.last_name' => element('search', $param),
			'shipping_info.last_name' => element('search', $param),
			'billing_data.last_name' => element('search', $param),
		); 
		$this->db->or_like($search);
	endif;
	
	if(element('status', $param)):
		$this->db->where('status', element('status', $param));
	endif;
	
		$this->dodol->db_calc_found_rows();
	
		$this->db->join('user user', 'user.id=order_data.user_id');
		$this->db->join('store_order_shipto_data shipto_data', 'shipto_data.order_id=order_data.id');
		$this->db->join('store_order_billing_data billing_data', 'billing_data.order_id=order_data.id');
		$q = $this->db->get('store_order order_data', $limit, $start);
		if($q->num_rows() > 0):
			return array('result'=> $q->result(), 'num_records' => $this->dodol->db_found_rows());
		else:
			return false;
		endif;
		
	}
	// PRODUCT item
	
	function prd_item_getbyorderid($order_id){
		$this->db->where('order_id', $order_id);
		$q = $this->db->get('store_order_product_item');
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	function prd_item_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_product_item');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function prd_item_create($data){
		
		if($this->db->insert('store_order_product_item', $data)){
			if($id_attr = element('id_attr', $data)) :
				$current_stock = $this->db->where('id', $id_attr)->get('store_product_attrb')->row()->stock;
				$attr_data = array('stock' => $current_stock - element('qty', $data));
				$this->db->where('id', $id_attr)->update('store_product_attrb', $attr_data);
			else:
				$id_prod = element('id_prod', $data);
				$current_stock = $this->db->where('id', $id_prod)->get('store_product')->row()->stock;
				$new = array('stock' => $current_stock - element('qty', $data));
				$this->db->where('id', $id_prod)->update('store_product', $new);
			endif;
		
			
		
			return $this->prd_item_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function prd_item_update($id, $data){
		if(!$this->prd_item_getbyid($id)) return false;
		
		$this->db->where('id', $id);
		if($this->db->update('store_order_product', $data)){
			return $this->prd_item_getbyid($id);
		}else{
			return false;
		}
	}
	function prd_item_delete($id){
		if(!$q = $this->prd_item_getbyid($id)) return false;
		
		$this->db->where('id', $id);
		if($this->db->delete('store_order_product_item')){
			return $q;
		}else{
			return false;
		}
	}
	function prd_item_browse($conf = array()){
		$q = $this->db->get('store_order_product_item', element('limit', $start), element('start', $conf));
		if($q->num_rows() > 0){
			return $q->result();
		}else{
			return false;
		}
	}
	
	// Billing data
	function bill_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_billing_data');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function bill_create($data){
		if($this->db->insert('store_order_billing_data', $data)){
			return $this->bill_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function bill_update($id, $data){
		$this->db->where('id', $id);
		if($this->db->update('store_order_billing_data', $data)){
			return $this->bill_getbyid($id);
		}else{
			return false;
		}
	}
	function bill_delete($id){
		if(!$q = $this->bill_getbyid($id))return false;
		$this->db->where('id', $id);
		if($this->db->delete('store_order_billing_data')){
			return $q;
		}else{
			return false;
		}
	}
	
	// SHIPto Data
	function shipto_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_order_shipto_data');
		if($q->num_rows() == 1 ){
			return $q->row();
		}else{
			return false;
		}
	}
	function shipto_create($data){
		if($this->db->insert('store_order_shipto_data', $data)){
			return $this->shipto_getbyid($this->db->insert_id());
		}else{
			return false;
		}
	}
	function shipto_update($id, $data){
		if(!$q = $this->shipto_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->update('store_order_shipto_data', $data)){
			return $this->shipto_getbyid($id);
		}else{
			return false;
		}
	}
	function shipto_delete($id){
		if(!$q = $this->shipto_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->delete('store_order_shipto_data')){
			return $q;
		}else{
			return false;
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}