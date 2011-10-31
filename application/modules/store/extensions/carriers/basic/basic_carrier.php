<? if (!defined('BASEPATH')) exit('No direct script access allowed');
class Basic_carrier extends Store_carrier_helper {
	
	var $detail = array(
		'name' 			=> 'Basic Carrier',
		'description' 	=> 'Provide carrier fee post the order placed, when the system can determine the shipping cost',
		'author'		=> 'Zidni Mubarock',
		'author_mail'	=> 'zidmubarock@gmail.com',
		'author_site'	=> 'http://barockprojects.com',
		'file_name'		=> 'basic_carrier'
	//	'logo_path'		=>  
	);
	
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