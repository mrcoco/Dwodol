<? if (!defined('BASEPATH')) exit('No direct script access allowed');
class Basic_carrier extends Store_carrier_helper {
	function __construct(){
		
	}
	function get_rate(){

	//	if($this->session->userdata('store_carrier') == '') :
			$this->render('view', array('data' => false));
	//	else:
	//		return false;
	//	endif;
	}
	function choose_rate(){	
		$data = array(
			'nope' => true,
			'fee' => 0
			);
		$this->session->set_userdata('shipping_data', $data);
		
	}
}