<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
function tw_update($status, $media = false){
	$ci =& get_instance();
	$tw = $ci->load->library('site/twitter/epitwitter');	
	$tw_conf = $ci->dodol->conf('twitter');
	$tw->setToken($tw_conf->oauth_token ,$tw_conf->oauth_token_secret);
	$status = prepare_status($status);
	if($media != false){
		if(strpos($media, base_url()) !== false)
			if(strpos($media, base_url()) !== false){
				$image = str_replace(base_url(), './', $media);
				if( is_file($image) ){
					$image = $image;
				}else{
					$image = get_image($media);
				}
			}else {
			 $image = get_image($media);
			}
			
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
function get_image($url, $return = false){
	
	$img_file=$url;

	$img_file = file_get_contents($img_file);
	$name = random_string('alnum', 32);
	$file_loc = './assets/cache/img/'.$name.'.jpg';

	$file_handler=fopen($file_loc,'w');

	if(fwrite($file_handler,$img_file)==false){
	    return '';
	}
	fclose($file_handler);
		if($return != false){
			return base_url().str_replace('./assets/', 'assets/', $file_loc);
		}else{
			return $file_loc;
		}
}
function prepare_status($str){
	$ci =& get_instance();
	$new_text = '';
	$str = explode(' ',$str);
	for($i = 0; $i<count($str) ; $i++){
		if(strpos($str[$i], 'http://') !== FALSE){
			$new  = $ci->load->library('dependency/google_url_api')->shorten($str[$i]);
			$new_text .= ' '.$new->id;
		}else{
			$new_text .= ' '.$str[$i];
		}
	}
	if(strlen($new_text) > 160)
		return longTweet($new_text);
	else 
		return $new_text;
}
function longTweet($text, $limit = 20){
	$ci =& get_instance();
	require_once('tw_include/OAuth.php'); // https://github.com/abraham/twitteroauth has OAuth.php library
	$tw_cfg = $ci->dodol->conf('twitter');
	$consumer_key = $tw_cfg->consumer_key;
	$consumer_secret = $tw_cfg->consumer_secret;
	$kanvaso_api_key = 'a83c11a91b4ba5b71730fe8c480aecf84c5a2eab';
	$user_access_token = $tw_cfg->oauth_token;
	$user_access_token_secret = $tw_cfg->oauth_token_secret;

	$header = array(
	    'X-Auth-Service-Provider: https://api.twitter.com/1/account/verify_credentials.json',
	    'X-Verify-Credentials-Authorization: OAuth realm="http://api.twitter.com/"'
	);
	$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
	$sha1_method = new OAuthSignatureMethod_HMAC_SHA1();
	$token = new OAuthConsumer($user_access_token, $user_access_token_secret);
	$signingURL = 'https://api.twitter.com/1/account/verify_credentials.json';
	$request = OAuthRequest::from_consumer_and_token($consumer, $token, 'GET', $signingURL, array());
	$request->sign_request($sha1_method, $consumer, $token);

	$header[1] .= ", oauth_consumer_key=\"" . $request->get_parameter('oauth_consumer_key') . "\"";
	$header[1] .= ", oauth_signature_method=\"" . $request->get_parameter('oauth_signature_method') ."\"";
	$header[1] .= ", oauth_token=\"" . $request->get_parameter('oauth_token') ."\"";
	$header[1] .= ", oauth_timestamp=\"" . $request->get_parameter('oauth_timestamp') ."\"";
	$header[1] .= ", oauth_nonce=\"" . $request->get_parameter('oauth_nonce') ."\"";
	$header[1] .= ", oauth_version=\"" . $request->get_parameter('oauth_version') ."\"";
	$header[1] .= ", oauth_signature=\"" . urlencode($request->get_parameter('oauth_signature')) ."\"";

	$url = 'http://api.kanvaso.com/1/update.php';

	$ch = curl_init();

	$contents = array(
			  'text'	=>	urlencode($text),
	          'api_key'	=>	$kanvaso_api_key,
	          'format'	=>	'json'
	);
   $fields = '';
	foreach($contents as $key=>$value) {
	  $fields .= $key . '=' . $value . '&';
	}

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

	$respond = curl_exec($ch);

	$response_info = curl_getinfo($ch);

	curl_close($ch);

	$result = json_decode($respond);

	// send $result->text to Twitter using oAuth post method
	
	$clean = '';
	$words = explode(' ', $result->text);

	$decrease = 0;
	for($i = count($words)-1 ; $i>0 ; $i--){
		if(strpos($words[$i], 'http') !== false){
			$final_text[$i] = $words[$i];
		}else{
			$decrease  = $decrease + strlen($words[$i]);
			if($limit >= $decrease) {
				continue;
			}else{
			$final_text[$i] = $words[$i];
			};
		}
	}
	ksort($final_text);
	
	return implode(' ', $final_text);

}
