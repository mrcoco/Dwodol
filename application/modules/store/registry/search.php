<?php 
class Store_search extends Site_search {
	function __construct(){
		parent::__construct();
	}
	function do_search($param){
		$this->db->select('name, id, l_desc');
		$this->db->like('name', element('q', $param));
		$this->db->where('publish', 'y');
		$q = $this->db->get('store_product', element('limit', $param), element('start', $param));
		$storage = array();
		if( $q->num_rows() > 0 ) :
			foreach($q->result() as $item) :
				$data = new stdClass;
				$data->title 	= $item->name;
				$data->content 	= $item->l_desc;
				$data->link 	= site_url('store/prod/'.$item->id);
				$data->image 	= null;
				$data->module 	= $this->router->fetch_module();
				array_push($storage, $data);
			endforeach;
		endif;
		
		if(count($storage) > 0) :
			return $storage;
		else:
			return false;
		endif;
	}
}?>