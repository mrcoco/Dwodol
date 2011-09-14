<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function generate_ext_data($data){
	$storage = array();
		if(element('0', $data)):
		// is Multiple
			foreach($data as  $value):
				$new['key'] = element('0', array_keys($value));
				$new['value'] = element('0', array_values($value));
				array_push($storage, $new);
			endforeach;
		else:
		// is single
		$storage['key'] = element('0', array_keys($data));
		$storage['value'] = element('0', array_values($data));
		endif;
	
	return $storage;
}