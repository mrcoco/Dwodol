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
	

	// API //

	function getbyid($id, $ext = false){
		$this->db->where('id',$id);
		$q = $this->db->get('user');
		if($q->num_rows() == 1){
			$data = $q->row();
			if($ext == true):
				if($ext_data = $this->ext_getbyuserid($id)):
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
	function update($id, $data, $ext_data= false){
		// check first
		$this->db->where('email', element('email', $data));
		$this->db->where('id !=', $id);
		$chk = $this->db->get('user');
		if($chk->num_rows() > 0) return false;
		
		if($this->getbyid($id)):
		$data['m_date'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
			if($q = $this->db->update('user', $data)){
				if(is_array($ext_data)){
					$this->ext_create($id, $ext_data);
				}
				return $this->getbyid($id, true);
			}else{
				return false;
			}
		else:
			return false;
		endif;	
	}
	function create($data, $ext_data =false){
		$data['c_date'] = date('Y-m-d H:i:s');
		switch (true) {
			case (element('role', $data) != 'customer'):
				if(element('role', $data) != 'customer') $data['password'] = md5(element('password', $data));
				$this->db->where('email', element('email', $data));
				$pre = $this->db->get('user');
				if($pre->num_rows() > 0 ) return false;
				
				if(	$q = $this->db->insert('user', $data)) :
					$user_id = $this->db->insert_id();
					if(is_array($ext_data)){
					$this->ext_create( $user_id, $ext_data);
					}
					return $this->getbyid($user_id, true);
				else:
					return false;
				endif;
				
				break;
				
			case (element('role', $data) == 'customer') :
				$this->db->where('email', element('email', $data));
				$pre = $this->db->get('user');
				if($pre->num_rows() == 1 && $pre->row()->role == 'customer') {
					
					$this->db->where('id', $pre->row()->id);
					if(	$q = $this->db->update('user', $data)) :
						$user_id = $pre->row()->id;
						if(is_array($ext_data)){
						$this->ext_create( $user_id, $ext_data);
						}
						return $this->getbyid($user_id, true);
					else:
						return false;
					endif;
				}elseif($pre->num_rows() == 1 && $pre->row()->role != 'customer'){
					return false;
				}else{
					
					if(	$q = $this->db->insert('user', $data)) :
						$user_id = $this->db->insert_id();
						if(is_array($ext_data)){
						$this->ext_create( $user_id, $ext_data);
						}
						return $this->getbyid($user_id, true);
					else:
						return false;
					endif;
				}
						
				break;
		
		}
		
	
		
		
	}
	function delete($id){
		
		if($user = $this->getbyid($id)):
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

	function ext_getbyuserid($user_id){
		$this->db->where('user_id', $user_id);
		$q = $this->db->get('user_ext_data');
		if($q->num_rows() > 0){
			$storage = new stdClass; 
			foreach($q->result() as $item):
				$key = $item->key;
				$storage->$key = $item->value;
			endforeach;
			return $storage;
		}else{
			return false;
		}
	}
	function ext_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('user_ext_data');
		if( $q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
		
	}
	function ext_getbykey($user_id, $key){
		$this->db->where('user_id', $user_id);
		$this->db->where('key', $key);
		$q = $this->db->get('user_ext_data');
		if($q->num_rows() == 1):
			return $q->row()->value;
		else:
			return false;
		endif;
	}
	function ext_getbygroup($user_id, $group){
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
	function ext_delete($user_id , $key = false , $group = false, $id = false ){
		
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
	function ext_create($user_id, $data = array(), $group = false){
		$storage = array();
		foreach($data as $key => $val){
			$data = array(
				'key' => $key,
				'value' => $val);
			if($new_item = $this->_ext_create($user_id, $data, $group)) array_push($storage , $new_item);
		}
		return $storage;
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
	function _ext_create($user_id, $data , $group = false){
		$item = null;
		
	//	$data = generate_ext_data($data);
		$data['user_id'] = $user_id;
		if($group != false) $data['group'] = $group;
	
		$this->db->where('user_id', element('user_id', $data));
		$this->db->where('key', element('key', $data));
		if($group != false) $this->db->where('group', $group);
		$pre = $this->db->get('user_ext_data');

		if($pre->num_rows() == 1):
		//do update
			$this->db->where('id', $pre->row()->id);
			if($q = $this->db->update('user_ext_data', $data)):
				$item = $this->ext_getbyid($pre->row()->id);
			endif;
			
		else:
		// do insert
			if($this->db->insert('user_ext_data', $data)):
				$item = $this->ext_getbyid($this->db->insert_id());
			endif;

		endif;
		
		$storage = new stdClass; 
		$key = $item->key;
		$storage->$key 		= $item->value;
		$storage->group		 = $item->group;
		return $storage;
	}

}