<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_misc extends MX_Controller {
 	
	function __construct(){
		parent::__construct();
	}
	function update_product_action_listener($prod_data){
		if($prod_data->publish == 'y'){
			$this->db->where('id_prod', $prod->id);
			$q = $this->db->get('store_waiting_restock');
			if($q->num_rows() > 0){
				foreach($q->result() as $item){
					if(is_numeric($q->id_attrb) && ($q->attrb_key != null || $q->attrb_key != '' ) continue;
					
					$this->load->contrller('cron')->add(
						'site/twitter/mentions', array(
							
						)
					);
				}
			}
		}else{
			return false;
		}
	}
	function update_product_attr_action_lister($attr_data){
		
	}
	
}