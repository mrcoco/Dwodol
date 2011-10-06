<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Product_label_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	function create($data){
		$this->db->where('name', $data);
		$q = $this->db->get('store_product_label_tag');
		if($q->num_rows() != 0) return false;
		
		$this->db->insert('store_product_label_tag', $data);
		return $this->getbyid($this->db->insert_id());
		
	}
	function update($id, $data){
		if(!$this->getbyid($id)) return false;
		
		$this->db->where('name', element('name', $data));
		if($this->db->get('store_product_label_tag')->num_rows() > 0) return false;
		
		if(!$this->db->update('store_product_label_tag', $data)) return false;
		return $this->getbyid($this->db->insert_id());
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('store_product_label_tag');
		if($q->num_rows() != 1) return false;
		return $q->row();
	}
	function delete($id){
		if($del = $this->getbyid($id)) return false;
		$this->db->where('id', $id);
		if(!$this->db->delete('store_product_label_tag')) return false;
		return $del;
	}