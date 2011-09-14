<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Blog extends MX_Controller {
	
	var $current_post;
	function __construct() {
		parent::__construct();
		global $post_ID;
		$this->mdl = $this->load->model('blog/blog_m');
		$this->dodol_theme->set_layout('extend/blog/blog');
		$this->load->helper('blog/blog');
	}
	//PAGE
	function index(){
		
	}
	function category(){
	
		$slug = $this->uri->segment(3);
		$cat  = $this->api_cat_getbyslug($slug);
		$this->load->library('dodol/dodol_paging');
		$uri = $this->uri->uri_to_assoc();
		$param['start'] = (!element('page', $uri)) ? 0 : element('page', $uri);
		$param['limit'] = 10;
		$param['status'] = 'publish';
		$param['cat_id'] = $cat->id;
		$q = modules::run('blog/api_post_browse', $param);
		if(!$q){
			return $this->dodol_theme->not_found();
		}
		$target_url = str_replace('/page/'.element('page', $uri) , '', current_url());
				// configuration for pagination
		$confpage = array(
					'target_page' => $target_url,
					'num_records' => element('num_rows', $q),
					'num_link'	  => 5,
					'per_page'   => $param['limit'],
					'cur_page'   => element('page', $uri),
					);
				// execute the pagination conf
		$this->dodol_paging->initialize($confpage);
		$data['pT'] = 'Blog - '.$cat->name;
		$data['posts'] = element('posts', $q);
		$this->dodol_theme->render()->build('posts', $data);
	}
	function posts(){
		$this->load->library('dodol/dodol_paging');
		$uri = $this->uri->uri_to_assoc();
		$page = (!element('page', $uri)) ? 1 : element('page', $uri);
		$param['limit'] = 3;
		$param['start'] = ($page == 1) ? 0 : ($page-1)*$param['limit'];
		$param['status'] = 'publish';
		$page = (!element('page', $uri)) ? 1 : element('page', $uri);
		$q = modules::run('blog/api_post_browse', $param);
		$target_url = str_replace('/page/'.element('page', $uri) , '', current_url());
			// configuration for pagination
		$confpage = array(
				'target_page' => $target_url,
				'num_records' => element('num_rows', $q),
				'num_link'	  => 5,
				'per_page'   => $param['limit'],
				'cur_page'   => $page,
				);
			// execute the pagination conf
		$this->dodol_paging->initialize($confpage);
		
		$data['pT'] = 'Blog - Post';
		$data['posts'] = element('posts', $q);
		$this->dodol_theme->render()->build('posts', $data);
	}
	function search(){
	}
	function single(){
		$id = $this->uri->segment(3);
		$q = modules::run('blog/api_post_getbyslug', $id);
		if(!$q){
			return $this->dodol_theme->not_found();
		}
		$data['post'] = $q;
		$data['pT'] = $q->title;
		
		$post_ID = $q->id;
		$this->dodol_theme->render()->build('single', $data);
		
	}
	
	//PARTIAL
	function comment_form(){
		$this->dodol_theme->view('blog/comment_form');
	}
	//MISC
	function thumb(){
			$thumb = $this->load->library('PhpThumbFactory');
			$param = $this->uri->segment(3);
			$param = explode('_', $param);
			if(is_numeric(element(0, $param))):
				if(count($param) == 1) :
					$width 	= element(0, $param);
					$height = $witdh;
					$crop 	= true;
				elseif(count($param) == 2 && is_numeric(element(1, $param))) :
					$width 	= element(0, $param);
					$height = element(1, $param);
					$crop 	= false;
				elseif(count($param) == 2 && !is_numeric(element(1, $param)) && element(1, $param) == 'crop'):
					$width 	= element(0, $param);
					$height = $witdh;
					$crop 	= true;
				elseif(count($param) == 3 && element(2, $param) == 'crop'):
					$width 	= element(0, $param);
					$height = element(1, $param);
					$crop 	= true;
				else:
					$width 	= 100;
					$height = 100;
					$crop 	= false;
				endif;
			else:
				$width 	= 100;
				$height = 100;
				$crop 	= false;
			endif;
			
			$img_source = str_replace('/source/', '', strstr(current_url(), '/source/'));
			$site_domain = str_replace('http://', '', site_url());

			$remote_cache_dir 	= './assets/modules/blog/media/remote_cache/'.$width.'_'.$height.'/';
			$local_cache_dir 	= './assets/modules/blog/media/cache/'.$width.'_'.$height.'/';

			if(strpos($img_source, $site_domain) !== false):
			//remote false
				$is_remote = false;
				$cache_dir = $local_cache_dir;
				$img_source = str_replace($site_domain,'', $img_source);
				$s = explode('/', $img_source);
				$file_name = $s[count($s)-1];
				$s = explode('.', $file_name);
				$file_type = $s[count($s)-1];
				// file exst on cache, and to old
				if(is_file($cache_dir.$file_name) &&  (filemtime($img_source) > filemtime($cache_dir.$file_name))):
					//delete the cache
					unlink($cache_dir.$file_name);
		            clearstatcache();
					
					$image = $thumb->create($img_source);
					if($crop == true){
						$image->adaptiveResize($width, $height);
					}else{
						$image->resize($width, $height);
					}
					if(!is_dir($cache_dir)) : mkdir($cache_dir); endif;
					$image->save($cache_dir.$file_name, $file_type);
				elseif(!is_file($cache_dir.$file_name)) :
					$image = $thumb->create($img_source);
					if($crop == true){
						$image->adaptiveResize($width, $height);
					}else{
						$image->resize($width, $height);
					}
					if(!is_dir($cache_dir)) : mkdir($cache_dir); endif;
					$image->save($cache_dir.$file_name, $file_type);
				elseif(is_file($cache_dir.$file_name)) :
					$image = $thumb->create($cache_dir.$file_name);
				endif;
				
			else:
			// REMOTE true
				$is_remote = true;
				$cache_dir = $remote_cache_dir;	
				$file_name = str_replace('/', '_', $img_source);
				$s = explode('.', $file_name);
				$file_type = $s[count($s)-1];
				$img_source = 'http://'.$img_source;
				if(is_file($cache_dir.$file_name)):
					$image = $thumb->create($cache_dir.$file_name);
				else:
					$image = $thumb->create($img_source);
					if($crop == true){
						$image->adaptiveResize($width, $height);
					}else{
						$image->resize($width, $height);
					}
					if(!is_dir($cache_dir)) : mkdir($cache_dir); endif;
					$image->save($cache_dir.$file_name, $file_type);
				endif;
			endif;
			$image->show();
			
			
			
			
		
	}
	
	//HELPER
	function set_post($post){
		$this->current_post = $post;
	}
	function unset_post(){
		$this->current_post = '';
	}
	function get_post(){
		return $this->current_post;
	}
	
	// AJAX FUNC FRONT
	function ajx_add_comment(){
		$data = $this->dodol->post_filter('com_');
		if(	$q = modules::run('blog/api_comment_create',$data)) :
			
			$return = array(
					'msg' 		=> 1, 
					'comment' 	=> $q, 
					'gravatar' 	=> gravatar_img($q->author_email), 
					'time' 		=>custom_time($q->c_date), 
					'count' 	=> post_comment_count($q->post_id)
					);
		else:
			$return = array('msg' => 0);		
		endif;
		echo json_encode($return);
	}
		
	// API //
	function api_post_create($data){
		if(	(element('cat_id', $data) == null || element('cat_id', $data) == '') &&
			(element('cat_src', $data) == null || element('cat_src', $data) == '')):
			$data['cat_id'] = 1;
		endif;
		
		if( (element('cat_id', $data) == null || element('cat_id', $data) == '') &&
			(element('cat_src', $data) != null || element('cat_src', $data) != '')):
			$data['cat_id'] = modules::run('blog/api_cat_create', array('name'=> element('cat_src', $data)))->id;
			
		endif;
		
		if(element('p_date', $data) && element('p_date', $data) > date("Y-m-d H:i:s")):
			$data['status'] = 'draft';
		elseif(element('p_date', $data) && element('p_date', $data) <= date("Y-m-d H:i:s")):
			$data['status'] = 'publish';
		endif;
		unset($data['cat_src']);
		$data['author'] = element('user_id', $this->session->userdata('login_data'));
		return $this->mdl->post_create($data);
	}
	function api_post_update($id, $data){
		if(	(element('cat_id', $data) == null || element('cat_id', $data) == '') &&
			(element('cat_src', $data) == null || element('cat_src', $data) == '')):
			$data['cat_id'] = 1;
		endif;
		
		if( (element('cat_id', $data) == null || element('cat_id', $data) == '') &&
			(element('cat_src', $data) != null || element('cat_src', $data) != '')):
			$data['cat_id'] = modules::run('blog/api_cat_create', array('name'=> element('cat_src', $data)))->id;
			
		endif;
		
		if(element('p_date', $data) && element('p_date', $data) > date("Y-m-d H:i:s")):
			$data['status'] = 'draft';
		elseif(element('p_date', $data) && element('p_date', $data) <= date("Y-m-d H:i:s")):
			$data['status'] = 'publish';
		endif;
		unset($data['cat_src']);
		return $this->mdl->post_update($id, $data);
	}
	function api_post_delete($id){
		return $this->mdl->post_delete($id);
	}
	function api_post_getbyid($id){
		return $this->mdl->post_getbyid($id);
	}
	function api_post_getbyslug($slug){
		return $this->mdl->post_getbyslug($slug);
	}
	function api_post_browse($param){
		return $this->mdl->post_browse($param);
	}
	function api_comment_create($data){
		
		return $this->mdl->comment_create($data);
	}
	function api_comment_update($id, $data){
		return $this->mdl->comment_update($id, $data);
	}
	function api_comment_delete($id){
		return $this->mdl->comment_delete($id);
	}
	function api_comment_getbyid($id){
		return $this->mdl->comment_getbyid($id);
	}
	function api_comment_browse($param){
		if(!element('result', $param)):
		$param['result'] = true;
		endif;
		return $this->mdl->comment_browse($param);
	}

	function api_cat_create($data){
		return $this->mdl->cat_create($data);
	}
	function api_cat_update($id, $data){
		return $this->mdl->cat_update($id, $data);
	}
	function api_cat_delete($id){
		return $this->mdl->cat_delete($id);
	}
	function api_cat_getbyid($id){
		return $this->mdl->cat_getbyid($id);
	}
	function api_cat_getbyslug($slug){
		return $this->mdl->cat_getbyslug($slug);
	}
	function api_cat_browse($param=false){
		return $this->mdl->cat_browse($param);
	}
	function api_cat_menu(){
		$menu_raw = array();
		foreach(element('cats', $this->api_cat_browse()) as $item):
			$item_data = array('anchor' => $item->name, 'link' => site_url('blog/category/'.$item->slug));
			array_push($menu_raw, $item_data);
		endforeach;
		return $menu_raw;
	}
	

}