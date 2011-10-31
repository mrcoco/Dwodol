<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Store_carrier_helper
{


	var $_ci_obj ;
	function __construct(){
	$this->_ci_obj =& get_instance();
	$this->source_data 	= ($ship = $this->_ci_obj->session->userdata('shipto_data')) ? $ship : $this->_ci_obj->session->userdata('billing_data');
	}
	function get_detail(){
		return $this->detail;
	}
	function load($file){
		
		if(strpos($file, '/') !== false){
			$post = explode('/', $file);
			$file = $post[0].'_carrier';
			$func = $post[1];
		}else{
			$file = $file.'_carrier';
			$func = 'load';
		}
		$this->path =  APPPATH.'modules/store/extensions/carriers/'.str_replace('_carrier', '', $file).'/';
		
		$path = $this->path;
		$args = func_get_args();
		// check that file exist;
  		if(self::find($path, $file)):
		    Modules::load_file($file, $path);
		    $file = ucfirst($file);
		    $carrier = new $file();
		    $carrier->carrier_path = $path;
		    return call_user_func_array(array($carrier, $func), array_slice($args, 1));
		else:
			return false;
		endif;
	
	}
	
	function find($path, $file){
		$file_path = $path.'/'.$file.EXT ;
		// check that file exist
		if(!file_exists($file_path)){
			return false;
		}else{
			return true;
		}
	}
	function render($view, $data = array()){
        extract($data);
        include $this->carrier_path.'views/'.$view.EXT;
    }
	function caller(){
		$_ci_obj =& get_instance();
		$all_carriers = scandir(APPPATH.'modules/store/extensions/carriers/');
		$loaded = array();
		if(count($all_carriers) > 0){
			foreach($all_carriers as $item){
				if(
					$item == '.'  		|| 
					$item == '..' 		|| 
					$item == '.DS_Store'
					) continue;
				array_push($loaded , $item);
			}
			
		}
		return $loaded;
	}
	function registry($func = null){
		$_ci_obj =& get_instance();
		$func = ($func != null) ? $func : 'get_rate';
		$all_shipper    = scandir(APPPATH.'modules/store/extensions/carriers/');
		$loaded = array();
		if(count($all_shipper) > 0):
			
			foreach($all_shipper as $item){
				if($item != '.' && $item != '..'  && $item != '.DS_Store' && $item != 'basic' ){
					array_push($loaded, $item);
					store_carrier_helper::load($item.'/'.$func);	
				}
			}
			if(!$_ci_obj->session->userdata('store_carrier')):
			store_carrier_helper::load('basic/'.$func);
			endif;
			
			//store_carrier_helper::load('basic/'.$func);
		else:
			return false;
		endif;
		
	}
	function unset_carrier($name){
			$all_carrier = $this->_ci_obj->session->userdata('store_carrier');
			unset($all_carrier[$name]);
			$this->_ci_obj->session->set_userdata('store_carrier', $all_carrier);
	}
	
	// LOAD CI GET_INSTANCE
	function __get($var) {
        global $CI;
        return $CI->$var;
    }
}
?>
