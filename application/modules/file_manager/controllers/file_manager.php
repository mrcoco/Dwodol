<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class File_manager extends MX_Controller {

	var $root_folder = './assets/media/';
	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->helper('text');
	}
	
	
	function index() {
		$data = array();
		$data['items'] =modules::run('file_manager/api_getall');
		$data['path'] = $this->root_folder;
	 	$this->dodol_theme->render()->build('index', $data);
	}
	
	function ajx_request_all(){
		$path = $this->input->post('path');

		
		if(strpos($path , $this->root_folder) === false) :
			$this->messages->add('You Already on the root folder', 'warning');
			$data = array('msg'=> 0);
		else:
			if($list = modules::run('file_manager/api_getall', $path)):
				$data = array('msg' => 1, 'items' => $list);
			else:
				$data = array('msg'=> 0);
			endif;
		endif;
		echo json_encode($data);
	}
	function ajx_crt_folder(){
		$path = $this->input->post('path');
		if(!is_dir($path)) :
			if(mkdir($path)) :
				echo json_encode(array('msg'=> 1));
			else:
				echo json_encode(array('msg'=> 0));
			endif;
		else:
		$this->messages->add('folder is exist', 'warning');
		echo json_encode(array('msg'=> 0));
		endif;
	}
	
	//API
	function api_getall($parent='') {
			$parent = str_replace($this->root_folder, '', $parent);
			
			$path = $this->root_folder.$parent;
		
			$storage = array();
			foreach (scandir($path) as $item) :
				if($item != '.' && $item != '..' && $item != '.DS_Store' ):
				$data['name'] = $item;
				$data['path'] = $path.$item;
				$data['url'] = base_url().str_replace('./assets/', 'assets/',$path.$item);
				$data['hv_child'] = false;
				if(is_file($path.$item)):
					$data['type'] = end(explode('.', $item));
				elseif(is_dir($path.$item)):
					$data['path'] = $path.$item.'/';
					$data['type'] = 'dir';
				endif;
				if(is_dir($path.$item) && ($files = scandir($path.$item)) && count($files) > 2) :
				    $data['hv_child'] = true;  
				endif;	
				array_push($storage, $data);
				endif;
			endforeach;
			if(count($storage) == 0) :
				$storage = false;				
			endif;
			$data['path'] = $path;
			$data['items'] = $storage;
			$this->dodol_theme->view('folder_container', $data);
	}
	function ck_upload_img(){
		enable_get();
		$CKEditor = $_GET['CKEditor'] ;
		$funcNum = $_GET['CKEditorFuncNum'] ;
		$langCode = $_GET['langCode'] ;
		$url = '' ;
		$message = '';
		$config['upload_path'] = './assets/media/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';

		$this->load->library('upload', $config);
		if(isset($_FILES['upload'])) :
			if ( ! $this->upload->do_upload('upload'))
			{
				 $message = $this->upload->display_errors();
			}
			else
			{
				$data = $this->upload->data();
				$url = base_url().'/assets/media/images/'.$data['file_name'];
			}
		else:
			 $message = 'No file has been sent';
		endif;
	
		// ------------------------
		// Write output
		// ------------------------
		// We are in an iframe, so we must talk to the object in window.parent
		echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";

	
	}
	function api_delete($dir) {
	  if (is_dir($dir)) {
	    $files = scandir($dir);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
	    rmdir($dir);
	  }
	  else if (file_exists($dir)) unlink($dir);
	}
	function api_copy($src, $dst) {
	  if (file_exists($dst)) $this->rrmdir($dst);
	  if (is_dir($src)) {
	    mkdir($dst);
	    $files = scandir($src);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file");
	  }
	  else if (file_exists($src)) copy($src, $dst);
	}
	function api_upload($option=array()){
		
	}
	function api_renamefile($option=array()){
		
	}
	function api_movefile($option=array()){
		
	}
	function api_deletefile($option=array()){
		
	}
	function api_getfolder($parent=''){
		$parent =  (strpos($parent, $this->root_folder) === false) ? $parent : str_replace($this->root_folder, '', $parent) ;
		$root = $this->root_folder.$parent;
		$root = ($root[strlen($root)-1] == '/') ? $root : $root.'/';
		$storage = array();
		if(is_dir($root)):
			foreach(scandir($root) as $folder):
				if($folder != '.' && $folder != '..' && is_dir($root.$folder)):
				
					$item = array();
					$item['name'] = $folder;
					$item['path'] = $root.$folder.'/';
				
						if(($files = scandir($item['path'])) && count($files) > 2) :
						    $item['hv_child'] = TRUE;  
						else:
						    $item['hv_child'] = FALSE;
						endif;  
				
					array_push($storage, $item);
				
				endif;
			endforeach;
			if(count($storage) > 0) :
				return $storage;
			else:
				return false;
			endif;
		else:
			return false;
		endif;
	}
	function api_createfolder($parent, $name){
		if(is_dir($parent.$name)):
			return false;
		else:
			mkdir($parent.$name);
			return $parent.$name;
		endif;
	}
	function api_deletefolder($name){
		
	}

}