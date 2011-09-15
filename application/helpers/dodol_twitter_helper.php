<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
function tw_update($status, $media = false){
	$ci =& get_instance();
	$tw = $ci->load->library('twitter/epitwitter');	
	$tw_conf = $ci->dodol->conf('twitter');
	$tw->setToken($tw_conf->oauth_token ,$tw_conf->oauth_token_secret);
	if($media != false){
			$tw->post('/statuses/update_with_media.json', 
								array(
									'status' => $status,
									'@media[]' => "@{$image}",
									)
								);
	}else{
		$tw->post('/statuses/update.json', array('status' => $status));
	}
}