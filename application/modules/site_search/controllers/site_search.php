<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Site_search extends MX_Controller {
	
	
	var $result  = array();
	function __construct() {
		parent::__construct();
	
	}
	private function get_all_search_registry(){
		$storage = array();
		if ($modules = opendir(APPPATH.'modules/')) :
		    while (false !== ($module = readdir($modules))) :
				if(file_exists($path = APPPATH.'modules/'.$module.'/registry/search'.EXT) == true && $module != 'search'):
					$data = array();
					$data['path'] 		 = $path;
					$data['module_name'] = $module; 
					array_push($storage, $data);
				endif;
		    endwhile;
		    closedir($modules);
		endif;
		if(count($storage) > 0) : 
			return $storage;
		else:
			return false;
		endif;
	}
	function result(){
		enable_get();
		$return['results'] = $this->do_search($this->input->get());
		$return['pT'] = 'Search Result';
		$this->dodol_theme->render()->build('result', $return);
	}
	function do_search($param = array(), $module = false, $type= false){
		$files = $this->get_all_search_registry();
		if($files != false) :
			foreach($files as $file) :
				if($module != false) :
					if(element('module', $file) == $module) :
							include element('path', $file);
							$class_name = ucfirst(element('module', $file).'_search');
							$child = new $class_name();
							$child_result = $child->do_search($param);
							if($child_result) :
								$this->assign_result($child_result);
							endif;
							unset($child);
					endif;
				else :
					include element('path', $file);
					$class_name = ucfirst(element('module_name', $file).'_search');
					$child = new $class_name();
					$child_result = $child->do_search($param);
					if($child_result) :
						$this->assign_result($child_result);
					endif;
					unset($child);
				endif;
				
			endforeach;
		endif;
	
		$result = $this->result;
		if($type == 'json') :
			$result = json_encode($result);
		endif;
		return $result;
	}
	function assign_result($array){
		foreach($array as $item ){
			array_push($this->result, $item);
		}
	}

	
	

}