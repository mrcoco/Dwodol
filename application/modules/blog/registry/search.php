<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Blog_search extends Site_search {
	
	function __construct(){
		parent::__construct();
	}
	function do_search($param){
		$this->db->select('title, id, content, slug');
		$this->db->like('title', element('q', $param));
		$this->db->where('status', 'publish');
		$q = $this->db->get('blog_post', element('limit', $param), element('start', $param));
		$storage = array();
		if( $q->num_rows() > 0 ) :
			foreach($q->result() as $item) :
				$data = new stdClass;
				$data->title 	= $item->title;
				$data->content 	= $item->content;
				$data->link 	= site_url('blog/read/'.$item->slug);
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

};?>