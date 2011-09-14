<?

class Dodol {
	function __construct()
	{
		$this->_ci =& get_instance();
	}

	// DB HACK
	function db_found_rows(){

		return $this->_ci->db->query('SELECT FOUND_ROWS() as total;')->row()->total;
	}
	function db_calc_found_rows(){
		$select = array();
		$selects =  $this->_ci->db->ar_select;
		$this->_ci->db->ar_select = array();
		// if already have select put the index 0 together with calc_found_row
		if(count($selects) == 1){
			$CALC = 'SQL_CALC_FOUND_ROWS '.$selects[0];
			$this->_ci->db->select($CALC,false);
		}elseif(count($selects) > 1){
			$CALC = 'SQL_CALC_FOUND_ROWS '.$selects[0].',';
			$this->_ci->db->select($CALC,false);
			unset($selects[0]);
			foreach($selects as $s){
				$this->_ci->db->select($s);
			}
			
		}elseif(count($selects) < 1){
			$CALC = 'SQL_CALC_FOUND_ROWS *';
			$this->_ci->db->select($CALC,false);
		}
	}
	function enable_get(){
			parse_str($_SERVER['QUERY_STRING'], $_GET); 
			$this->_ci->input->_clean_input_data($_GET);
	}
	
	// CONFIGURATION
	function conf($conf, $item=false){
		if(is_int($conf)):
		$this->_ci->db->where('id', $conf);
		else:
		$this->_ci->db->where('name', $conf);
		endif;
		$this->_ci->db->select('config_object');
		$q = $this->_ci->db->get('site_conf');
		if($q->num_rows() > 0):
			if($item!=false):
				$list = json_decode($q->row()->config_object, true);
				if(array_key_exists($item, $list)):
					return $list[$item];
				else:
					return false;
				endif;
			else:
				return json_decode($q->row()->config_object);
			endif;
		else:
			return false;
		endif;
	}
	
	function current_user($select=false){
		if($select!=false):
			$this->_ci->db->select($select);
		endif;
		$this->_ci->db->where('id', element('user_id', $this->_ci->session->userdata('login_data')));
		$q = $this->_ci->db->get('user');
		if($q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
	
	}
	function post_filter($suffix){
				$new_post = array();
				foreach($_POST as $post => $value){
					if(strpos($post, $suffix) !== false):
					$new_index = str_replace($suffix, '', $post);
					$new_post[$new_index] = $this->_ci->security->xss_clean($value);
					endif;
				}
				if(count($new_post)>0){
					return $new_post;
				}else{
					return false;
				}
	}

	function show_price($value, $currency){
		if($curr == false):		
		$formated = $this->currency().' '.number_format($number, 2, ',', '.');		
		else:
		// TODO : Change when currency session change	
		$formated = $curr.' '.number_format($number, 2, ',', '.');		
		endif;	
		return $formated;
	}
}