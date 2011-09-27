<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Store_misc extends MX_Controller {
 	
	function __construct(){
		parent::__construct();
	}
	function update_product_action_listener($prod_data){
		
		if($prod_data->publish == 'y' && prod_stock($prod_data->id) > 0){
			
			$this->db->where('id_prod', $prod_data->id);
			$q = $this->db->get('store_waiting_restock');
			if($q->num_rows() > 0){	
				foreach($q->result() as $item){
					if(is_numeric($item->id_attrb) || $item->attrb_key != null) continue;
					$this->load->controller('cron/cron')->add(
						'site/twitter/sendUpdateStock',
						array(
						'twuser' => '@'.$item->twitter,
						'product_name' => $prod_data->name,
						'link'   => site_url('store/prod/'.$prod_data->id)
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
	function test(){
		$this->load->controller('cron/cron')->add(
			'site/twitter/sendUpdateStock',
			array(
			'twuser' => '@rock',
			'product_name' => 'usdaain',
			'link'   => site_url(),
			)
		);
	}
	
}