<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Customer_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Customer_m() {
		parent::__construct();
	}
	
	function create($data){
		$this->db->where('email', element('email', $data));
		$q = $this->db->get('store_customer');
		if($q->num_rows() > 0) return false;
		
		if($this->db->insert('store_customer', $data)){
			return $this->getbyid($this->db->insert_id());
		}else{
			return false;
		}
		
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() > 0) {
			return $q->row();
		}else{
			return false;
		}
	}
	function update($id, $data){
		$this->db->where('email', element('email', $data));
		$this->db->where('id !=', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() > 0)return false;
		
		$this->db->where('id', $id);
		if($this->db->update('store_customer', $data)){
			return $this->getbyid($id);
		}else{
			return false;
		}
		
	}
	function browse($conf){
		
		$q = $this->db->get('store_customer', element('limit', $conf), element('start', $conf));
		if($q->num-rows() > 0){
			return $q->result();
		}else{
			return false;
		}

	}

	function updateById($id, $passdata){
		$current_data = $this->getById($id);
		
		// check, that there is other customer with email inputed
		$this->db->where('email', $passdata['email']);
		$this->db->where('id !=', $id);
		$pre = $this->db->get('store_customer');
		// check, that there is no user register with email inputed
		$this->db->where('email', $passdata['email']);
		$this->db->where('id !=', $current_data['user_id']);
		$pre2 = $this->db->get('user');
		
		// if all pre qualify, update the data;
		if($pre->num_rows() == 0 && $pre2->num_rows() == 0):
			$this->db->where('id', $id);
			$q = $this->db->update('store_customer', $passdata);
			if($q){
				return true;
			}else{
				return false;
			}
		else:
			return false;
		endif;
	}
	function getByEmail($email){
		$this->db->where('email', $email);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	
	
	function _getbyid($id, $select = false){
		if($select == true):
			$this->db->select($select);
		endif;
		$this->db->where('id', $id);
		$q = $this->db->get('store_customer');
		if($q->num_rows() == 1):
			return $q->row();
		else:
			return false;
		endif;
	}
}