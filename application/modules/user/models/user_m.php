<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class User_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->helper('user/user');
		
	}
	
	//php 4 constructor
	function User_m() {
		parent::__construct();
	}
	
	function register($data=array()) {
		$this->db->where('email', $data['email']);
		$q = $this->db->get('user');
		$this->db->where('email', $data['email']);
		$q2 = $this->db->get('store_customer');
		if($q->num_rows() == 0 && $q2->num_rows() == 0){
			$ins = $this->db->insert('user', $data);
			if($ins){
				$id = $this->db->insert_id();
				return $id;
			}
		}else{
			return false;
		}
	}
	function do_update($data, $id_user){
		$this->db->where('email', $data['email']);
		$this->db->where('id !=', $id_user);
		$q = $this->db->get('user');
		if($q->num_rows() == 0){
			$this->db->where('id', $id_user);
			$upd = $this->db->update('user', $data);
			if($upd){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}	
	}
	
	// this function fecthing from jne.co.id, its important for next to determine the shipping cost
	function getCity($q, $limit){
		$this->load->library('jne');
		$json = $this->jne->getDestination($q, $limit);
		if($json){
			return $json;
		}else{
			return false;
		}
		
		
	}
	function get_userdata($id, $select=false){
		if($select){
		$this->db->select($select);
		}
		$this->db->where('id', $id);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data['user'] = $q->row_array();
			return $data;
		}else{
			return false;
		}
	}
	function get_userdata_by_email($email, $select=false){
		if($select){
		$this->db->select($select);
		}
		$this->db->where('email', $email);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data['user'] = $q->row_array();
			return $data;
		}else{
			return false;
		}
	}
	
	
	// API //
	function browse($param){
		$q = $this->db->get('user');
		if($q->num_rows() > 0):

			$return = array(
				'users' => $q->result(),
				'num_rows' => $q->num_rows(),
			);
			return $return;
		else:
			return false;
		endif;
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('user');
		if($q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
	}
	function update($id, $data){
		$data['m_date'] = date('Y-m-d H:i:s');
		$this->db->where('email', element('email', $data));
		$pre = $this->db->get('user');
		if($pre->num_rows() > 0 ) return false;
		
		if($this->getbyid($id)):
			$data['m_date'] = date('Y-m-d H:i:s');
			$this->db->where('id', $id);
			if($this->db->update('user', $data)):
				return $this->getbyid($id);
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	function delete($id){
		if($user = $this->getbyid($id)):
			$this->db->where('id', $id);
			$this->db->delete('user');
			return $user;
		else:
			return false;
		endif;
	}
	
	function api_getbyid($id, $ext = false){
		$this->db->where('id',$id);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data = $q->row();
			if($ext == true):
				if($ext_data = $this->api_ext_getbyuserid($id)):
					$data->ext_data = $ext_data; 
				else:
					$data->ext_data = null;
				endif; 
			endif;
			return  $data;
		}else{
			return false;
		}
	}
	function api_update($id, $data, $ext_data= false){
		if($this->api_getbyid($id)):
		$this->db->where('id', $id);
			if($q = $this->db->update('user', $data)){
				return $this->api_getbyid($id);
			}else{
				return false;
			}
		else:
			return false;
		endif;	
	}
	function api_create($data, $ext_data){
		$data['c_date'] = date('Y-m-d H:i:s');
		$this->db->where('email', element('email', $data));
		$pre = $this->db->get('user');
		if($pre->num_rows() > 0 ) return false;
		if(	$q = $this->db->insert('user', $data)) :
			$user_id = $this->db->insert_id();
			$this->api_ext_create($ext_data, $user_id);
			return $this->api_getbyid($user_id, true);
		else:
			return false;
		endif;
	}
	function api_delete($id){
		
		if($user = $this->api_getbyid($id)):
			$this->db->where('id', $id);
			if($this->db->delete('user')):
				return $user;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	

	function api_ext_getbyuserid($user_id){
		$this->db->where('user_id', $user_id);
		$q = $this->db->get('user_ext_data');
		if($q->num_rows() > 0){
			$storage = new stdClass; 
			foreach($q->result() as $item):
				$storage->$tem->key = $item->value;
			endforeach;
			return $storage;
		}else{
			return false;
		}
	}
	function api_ext_getbyid($id){
		$this->db->where('id');
		$q = $this->db->get('user_ext_data');
		if( $q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
		
	}
	function api_ext_getbykey($user_id, $key){
		$this->db->where('user_id', $user_id);
		$this->db->where('key', $key);
		$q = $this->db->get('user_ext_data');
		if($q->num_rows() == 1):
			return $q->row()->value;
		else:
			return false;
		endif;
	}
	function api_ext_getbygroup($user_id, $group){
		$this->db->where('user_id', $user_id);
		$this->db->where('group', $grup);
		$q = $this->db->get('user_ext_data');
		if($q->num_rows() > 0):
			$storage = new stdClass; 
			foreach($q->num_rows() as $item):
				$storage->$item->key = $item->value;
				$storage->group = $item->gorup; 
			endforeach;
			return $storage;
		else:
			return false;
		endif;
	}
	function api_ext_delete($user_id , $key = false , $group = false, $id = false ){
		
		if($key 	!= false) $this->db->where('key', $key);
		if($group 	!= false) $this->db->where('group', $group);
		if($id 		!= false) $this->db->where('id', $id);
		$this->db->where('user_id', $user_id);
		$pre = $this->db->get('user_ext_data');
		if($pre->num_rows() > 0 ):
			
			if($key 	!= false) $this->db->where('key', $key);
			if($group 	!= false) $this->db->where('group', $group);
			if($id 		!= false) $this->db->where('id', $id);
			$this->db->where('user_id', $user_id);
			$del = $this->db->delete('user_ext_data');
			
			return $pre->result();
		else:
			return false;
		endif;
		
	}
	/**
	 * Its just for single input insert, not multiple
	 *
	 * @param string $user_id 
	 * @param string $data 
	 * @param string $group 
	 * @return void
	 * @author Zidni Mubarock
	 */
	function _api_ext_create($user_id, $data , $group = false){
		$item = null;
		
		$data = generate_ext_data($data);
		$data['user_id'] = $user_id;
		if($group != false) $data['group'] = $group;
	
		$this->db->where('user_id', element('user_id', $data));
		$this->db->where('key', element('key', $data));
		if($group != false) $this->db->where('group', $group);
		$pre = $this->db->get('user_ext_data');

		if($pre->num_rows() == 1):
		//do update
		
			$this->db->where('id', $pre->row()->id);
			if($this->db->update('user_ext_data', $data)):
			$item =  $this->api_ext_getbyid($pre->row()->id);
			endif;
			
		else:
		// do insert
			if($this->db->insert('user_ext_data', $data)):
				$item = $this->api_ext_getbyid($this->db->insert_id());
			endif;
		endif;
		

		$this->db->where('id', 2);
		$this->db->update('user_ext_data', $data);
		$this->db->where('id', 2);
		$item = $this->db->get('user_ext_data')->row();
		if($item == null) return false;
		
		$storage = new stdClass; 
		$key = $item->key;
		$storage->$key 		= $item->value;
		$storage->group		 = $item->group;
		return $storage;
	}

}