<? if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dodol_search {
	var $_ci ;
	function __construct(){
		$this->_ci =& get_instance();
		$this->stage = 'front';
		if($this->-ci->router->fetch_module() == 'backend') $this->stage = 'back';
	}
	function call_all(){
			$storage = array();
			if($this->stage == 'front') :
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
			elseif($this->stage == 'backend'):
				if ($modules = opendir(APPPATH.'modules/backend/controllers/')) :
				    while (false !== ($module = readdir($modules))) :
						if(file_exists($path = APPPATH.'modules/backend/controllers/'.$module.'/registry/search'.EXT) == true && $module != 'search'):
							$data = array();
							$data['path'] 		 = $path;
							$data['module_name'] = $module; 
							array_push($storage, $data);
						endif;
				    endwhile;
				    closedir($modules);
				endif;
			endif;
			
			if(count($storage) > 0) : 
				return $storage;
			else:
				return false;
			endif;
	}
}