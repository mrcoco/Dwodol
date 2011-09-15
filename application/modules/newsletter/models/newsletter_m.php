<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Newsletter_m extends CI_Model {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Newsletter_m() {
		parent::__construct();
	}
	
	function add_member($email, $name) {
		$this->db->where('email', $email);
		$q = $this->db->get('newsletter_member');
		if($q->num_rows() == 0){
			$data =array(
				'email' => $email,
				'name' => $name
				);
			$q = $this->db->insert('newsletter_member', $data);
			if($q){
				return true;
			}else{
				return false;
			}
		}else{
			$data['have_account'] = true;
			return $data;
		}
		
	}
	function subcriber_getbyid($id){
		$this->db->where('id', $id);
	 	$q = $this->db->get('newsletter_subcriber') ;
		if($q->num_rows() ==1){
			return $q->row();
		}else{
			return false;
		}

	}
	function subcriber_update($id, $data){
		if(!$q = $this->subcriber_getbyid($id)) return false;
		if($q->name == element('name', $data) && $q->email == element('email', $data)) return false;
		$this->db->where('id', $id);
		if($this->db->update('newsletter_subscriber', $data))  : 
			return $this->subcriber_getbyid($id) ;
		else: 
			return false ;
		endif;
	}
	function subcriber_create($data){
		$this->db->where('name', element('name', $data));
		$this->db->where('email', element('email', $data));
		$q = $this->db->get('newsletter_subscriber');
		if($q->num_row() == 1) return false;

		if($this->db->insert('newsletter_subcriber', $data)) : 
			return $this->subcriber_getbyid($this->db->insert_id()); 
		else: 
			return false ;
		endif;
	}
	function subcriber_delete($id){
		if(!$q = $this->subcriber_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->delete('newsletter_subscriber')) : 
			return $q;
		else:
			return false; 
		endif;
	}
	
	function campaign_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('newsletter_campaign');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
		
	}
	function campaign_create($data){
		$data['c_date'] = date('Y-m-d H:i:s');
		$this->db->insert('newsletter_campaign', $data);
		return $this->campaign_getbyid($this->db->insert_id());
	}
	function campaign_update($id, $data){
		if(!$this->campaign_getbyid($id))return false;
		$data['m_date'] = date('Y-m-d H:i:s');
		$this->db->where('id', $id);
		if($this->db->update('newsletter_campaign', $data)):
			return $this->campaign_getbyid($id);
		else:
			return false;
		endif;
	}
	function campaign_delete($id){
		if(!$q = $this->campaign_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->delete('newsletter_campaign')) : 
			return $q;
		else:
			return false; 
		endif;
	}
	
	function tpl_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('newsletter_tpl');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function tpl_create($data){
		if($this->db->inert('newsletter_tpl', $data)):
			return $this->tpl_getbyid($this->db->insert_id());
		else:
			return false;
		endif;
	}
	function tpl_update($id, $data){
		if(!$this->tpl_getbyid($id))return false;
		$this->db->where('id', $id);
		if($this->db->update('newsletter_tpl', $data)){
			return $this->tpl_getbyid($id);
		}else{
			return false;
		}
		
	}
	function tpl_delete($id){
		if(!$q = $this->tpl_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->delete('newsletter_tpl')){
			return $q
		}else{
			return false;
		}
	}
	
	function tpl_group_getbyid($id){
		$this->db->where('id', $id);
		$q = $this->db->get('newsletter_tpl_group');
		if($q->num_rows() == 1){
			return $q->row();
		}else{
			return false;
		}
	}
	function tpl_group_create($data){
		if($this->db->inert('newsletter_tpl_group', $data)):
			return $this->tpl_group_getbyid($this->db->insert_id());
		else:
			return false;
		endif;		
	}
	function tpl_group_update($id, $data){
		if(!$this->tpl_group_getbyid($id))return false;
		$this->db->where('id', $id);
		if($this->db->update('newsletter_tpl_group', $data)){
			return $this->tpl_group_getbyid($id);
		}else{
			return false;
		}		
	}
	function tpl_group_delete($id){
		if(!$q = $this->tpl_group_getbyid($id)) return false;
		$this->db->where('id', $id);
		if($this->db->delete('newsletter_tpl')){
			return $q
		}else{
			return false;
		}	
	}

}?>