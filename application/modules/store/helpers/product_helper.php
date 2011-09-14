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
				echo '<span class="nav"><a class="next" href="'.site_url('store/prod/'.$q->row()->id.'/'.nice_strlink($q->row()->prod_name)).'" title="'.$q->row()->prod_name.'" >Next</a></span>';
		}
	}
	function prod_price($id, $id_attrb = false){
		$data = modules::run('store/product/_prod_price', $id);
		return $data->formated;
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
			echo '<span class="nav"><a class="prev" href="'.site_url('store/prod/'.$q->row()->id.'/'.nice_strlink($q->row()->prod_name)).'" title="'.$q->row()->prod_name.'" >Prev</a></span>';
		}
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
	               $pairs[$k] = $v;		
	       }		
	       return $pairs;		
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
	
;?>