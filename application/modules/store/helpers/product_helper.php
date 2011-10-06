<? if (!defined('BASEPATH')) exit('No direct script access allowed');
	function prod_next_link($id){

		$ci =& get_instance();
		$ci->db->select('a.name as prod_name, a.id as id, b.id as catid, b.name as cat_name');
		$ci->db->where('a.id >', $id);
		$ci->db->where('a.publish', 'y');
		$ci->db->order_by('a.id', 'ASC');
		$ci->db->join('store_category b', 'b.id=a.cat_id');
		$q = $ci->db->get('store_product a', 1);
		if($q->num_rows() == 1){
				echo '<span class="nav"><a class="next" href="'.site_url('store/prod/'.$q->row()->id.'/'.nice_strlink($q->row()->prod_name)).'" title="'.$q->row()->prod_name.'" >Next &rarr;</a></span>';
		}
	
	}
	function prod_price($id, $id_attrb = false, $raw = false){
		$data = modules::run('store/product/_prod_price', $id, $id_attrb);
	
		if($raw == false){
		return $data->formated;
		}else{
		return $data;
		}
	}
	function prod_prev_link($id){

		$ci =& get_instance();
		$ci->db->select('a.name as prod_name, a.id as id, b.id as catid, b.name as cat_name');
		$ci->db->where('a.id <', $id);
		$ci->db->where('a.publish', 'y');
		$ci->db->order_by('a.id', 'DESC');
		$ci->db->join('store_category b', 'b.id=a.cat_id');
		$q = $ci->db->get('store_product a', 1);
		if($q->num_rows() == 1){
			echo '<span class="nav"><a class="prev" href="'.site_url('store/prod/'.$q->row()->id.'/'.nice_strlink($q->row()->prod_name)).'" title="'.$q->row()->prod_name.'" > &larr; Prev</a></span>';
		}
	
	}
	function prod_link($id){
		return site_url('store/prod'.$id);
	}
	function prod_stock($id, $id_attr = false){
		
		$ci =& get_instance();
		if($id_attr == false){
			$ci->db->where('id', $id);
			$q = $ci->db->get('store_product');
			if($q->num_rows() == 1){
			
				$stock = $q->row()->stock;
				if($ci->db->where('prod_id', $id)->get('store_product_attrb')->num_rows() > 0){
					$ci->db->where('prod_id', $id);
					$ci->db->select_sum('stock');
					$q2 = $ci->db->get('store_product_attrb');
					if($q2->num_rows() > 0){
					$stock = $q2->row()->stock;
					}
				}
			}
		}else{
			$ci->db->where('id', $id_attr);
			$q2 = $ci->db->get('store_product_attrb');
			if($q2->num_rows() > 0){
				$stock = $q2->row()->stock;
			}
		}
		
		return ($stock == '') ? 0 : $stock;
	}
	function prod_load_attr($a){
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
	function prod_attr_to_array($key_attr){	
		
	 $attribute = explode (';',$key_attr);		
	       foreach ($attribute as $pair) {		
	               list ($k,$v) = explode (':',$pair);		
	               $pairs[trim($k)] = trim($v);		
	       }
		ksort($pairs);		
	    return $pairs ;		
	}
	function prod_attr_to_key($array){
		$output = '';
		ksort($array);
		foreach($array as $key=>$value){
			$output .= $key.':'.$value.';';
		}
		return substr($output, 0 , -1);
	}
	function prod_attr_to_word($attrb = array()){
		if(!is_array($attrb)) return false;
		$word = '';
		$num =count($attrb);
		
		if($num == 1){
			foreach($attrb as $key => $value):
				$word .= $key.' '.$value;
			endforeach;
		}
		elseif($num == 2){
			$i = 1;
			foreach($attrb as $key => $value):
				if($i == $num):
					$limiter = '';
				else:
					$limiter = ', and ';			
				endif;
				$word .= $key.' '.$value.$limiter;
				$i++;
			endforeach;
		}elseif($num > 2){
			$i = 1;
			$last = $num;
			$before_last = $num-1;
			foreach($attrb as $key => $value):
				if($i = $last) :
				$limiter = '';
				elseif($i = $before_last) :
				$limiter = ', and ';
				else:
				$limiter = ', ';
				endif;
				
				$word .= $key.' '.$value.$limiter;
				$i++;
			endforeach;
		}
		return $word;
	}
	function prod_attr_formater($attr_key){
		return prod_attr_to_key(prod_attr_to_array($attr_key));
	}
	function prod_media($id, $size_term = '300-300-crop'){
		$base = ($size_term != false) ? 'store/product/thumb/'.$size_term.'/dir/' : '' ;
		if($q = modules::run('store/product/api_getmedia',$id)){
			return base_url().$base.'assets/modules/store/product_img/'.$q->path;
		}else{
			return base_url().$base.'assets/modules/store/product_img/no_image.jpg';
		}
	}
	function prod_detail($id, $attr_id = false){
		$ci =& get_instance();
		$ci->db->where('id', $id);
		$prd = $ci->db->get('store_product');
		$obj = new stdClass;
		$obj = false;
		if($prod->num_row() == 1) {
			$obj = $prod->row();
			$obj->attr = false;
			if($attr_id != false){
				$ci->db->where('id', $attr_id);
				$attr = $ci->db->get('store_product_attribute');
				if($attr->num_rows() == 1){
					$obj->attr = $attr->row();
				}
			}
		
		
		}
		return $obj;
	}
	function prod_snap($id){
		return modules::run('store/product/prodSnap', $id);
	}
	function prod_snap_data($id, $img_size ='300-300-crop'){
		$ci =& get_instance();
		$ci->db->select('name, price, sku, currency, id');
		$ci->where('id', $id);
		$q = $ci->db->get('store_product');
		if($q->num_rows() != 1 ) return false;
		$data = $q->row();
		$data->media = prod_media($id, $img_size);
	}
	function prod_label($id, $height='80'){
		$ci =& get_instance();
		$path = base_url().'/assets/modules/store/label_img/';
		// detect sold out
		if(prod_stock($id) == 0)  return  '<img height="'.$height.'" src="'.$path.'sold_out.png"  alt="Sold out">';
		
		// check have discount
		$ci->db->select('disc');
		$ci->db->where('id', $id);
		$disc = $ci->db->get('store_product');
		if($disc->row()->disc != '') return  '<img height="'.$height.'" src="'.$path.'sale.png"  alt="sale">';
		
		// detect new arrival
		$ci->db->select('DATE(c_date) as date');
		$ci->db->where('id', $id);
		$q = $ci->db->get('store_product');
		if($q->row()->date >= date("Y-m-d", strtotime("-1 weeks")) ) return '<img height="'.$height.'"  src="'.$path.'new_arrival.png"  alt="New Arrival">';
		
	}
;?>