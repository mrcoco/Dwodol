<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Tester extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
	}
	
	//php 4 constructor
	function Tester() {
		parent::__construct();
	}
	function index(){
	echo 'tester';
	}
	function jancok(){
		$data = array('suh' => 'jncok');
		$this->load->view('tester', $data);
	}
	
	function test_md5(){
		echo md5('password321');
	}
	function testUpload() {
		$this->load->helper('form');
		echo form_open_multipart(current_url());
		echo form_upload('file');
		echo form_submit('upload', 'upload');
		echo form_close();
		if($this->input->post('upload')){
		$this->load->library('upload');
		$config['upload_path'] = './assets/modules/store/product_img/';
		$config['allowed_types'] = 'rar|gif|jpg|png|zip';
		$config['max_size']	= '100000';
		$config['overwrite'] = false;
		$this->upload->initialize($config);
		$this->upload->do_upload('file');
		}
	}
	function test(){
		$this->load->library('mailer');
		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('cs@bajubatik.com', 'Bajubatik.com');
		$this->email->to('zidmubarock@gmail.com');
		$this->email->subject('Order');
		$this->email->message($this->mailer->test()); 
		$this->email->send();
		echo $this->email->print_debugger();
	}
	function test2(){
		$data = array('template' => 'msg', 'mailmsg' => 'from $mailMsg');
		$this->load->library('mailer');
		$this->mailer->to = 'zidmubarock@gmail.com';
		$this->mailer->subject = 'Oredr Was Recieve';
		$this->mailer->from = 'alent.alzid@gmail.com';
		$this->mailer->name_from = 'your darling';
		//$this->mailer->send();
		//$this->mailer->test();
		$this->mailer->body = $data;
		$this->mailer->send();
	}
	function test3(){
		$send = modules::run('store/order/send_order_data', $this->session->userdata('order_id'));
		
	}
	function test4(){
		$this->cart->destroy_data();
		$this->session->unset_userdata('order_id');
		
		redirect('store/checkout');
	}
	function test5(){
		$this->session->unset_userdata('order_id');
	}
	function test6(){
		$data = array('shipping_info' => array('carrier' => 'jne'));
		$this->cart->write_data($data);
	}
	function test7(){
		$q = 'b';
		$query = 'q='.$q.'&limit=5';
		$url = 'http://www.jne.co.id/tariff.php?'.$query;
		/*
		$handle = @fopen('yourfile...', "r");
		if ($handle) {
		   while (!feof($handle)) {
		       $lines[] = fgets($handle, 4096);
		   }
		   fclose($handle);
		}
		*/
	    $getSource = @fopen($url, 'r');
	    		
		//$handle = file($url);
		if($getSource){
			while(!feof($getSource)){
       			$line[] = fgets($getSource, 4096);
			}
        fclose($getSource);
		}
		foreach($line as $key=>$val){
				echo '<h3>'.$key.'</h3>';
				$single_data = explode('|', $val);
				echo $single_data[0].' = ';
				echo $single_data[1].'<hr/>';
		}
	}
	function test10(){
		$css = array('theme/back/css/admin-style.css', 'theme/back/css/admin-style.css');
		$this->dodol_theme->register_css($css);
		$this->dodol_theme->load_css();
	}
	function test11(){
			$this->dodol_theme->load_css();
	}
	function test12(){
		echo ('
		<form method="post">
			<input type="file" name="file" value="">
			<input type="submit" name="submit" value="submit" id="submit">
		</form>
		');
		if($this->input->post('file')){
			echo $this->input->post('file');
		}else{
			echo 'asuh';
		}
		
	}
	function test13(){
		$id = $this->uri->segment(3);
		echo $id;
	}
	function test14(){
		$parameter = array(101, 'payment_confirm', 'testing cron');
		$do_time = datetime('+5 minutes');
		$cron = modules::run('cron/add', 'store/order/create_history_order', $parameter, $do_time );
	}
	function flip(){
		$render['mainLayer'] = 'flip_v';
		$this->dodol_theme->render($render);
	}
	function test15(){
		$this->db->where('nav_id', 1);
		$this->db->select_max('order', 'last_order');
		$q = $this->db->get('site_nav_item');
		if($q->row()->last_order != null){
			echo $q->row()->last_order;
		}else{
			echo 'asuh';
		}
	}
	function test16(){
		$input = array("a", "b", "c", "d", "e");
		echo implode('/',$input).'<br/>';
		echo implode('/',array_slice($input, 0, -2));      // returns "c", "d", and "e"
	
	}
	function testup(){
		$this->load->helper('form');
		echo form_open_multipart('tester/testup');
		echo ('<input type="file" name="image" value=""><br/>');
		echo ('<input type="text" name="name_image" value=""><br/>');
		echo ('<br/><input type="submit" name="upload" value="Upload">');
		echo form_close();
		
		if($this->input->post('upload')){
				$this->load->library('upload');
				$config['upload_path'] = './myfile/';
				$config['allowed_types'] = 'gif|jpg|png|dmg|txt';
				$config['file_name'] = $this->input->post('name_image');
				$config['max_size']	= '1000000000';
				$config['overwrite'] = false;
				$this->upload->initialize($config);
				$up = $this->upload->do_upload('image');
				$this->load->library('image_lib');
				$result = $this->upload->data();

		}
	}
	function asuh(){
		echo 'Kampret';
	}
	function ups(){
	
		$param = array(
			's_country' 	=> 'ID',
			's_zip'  		=> '15132',
			't_country' 	=> 'US',
			't_zip'			=> '10011',
			'weight'		=> '1',
			'pickup'		=> '01',
			'residential' 	=> '0',
			'submit'		=> 'Calculate Shipping Cost'
		);
		
		$this->load->library('curl');
		$this->load->helper('dodol_dom');
		$this->curl->create('http://www.neox.net/ups/upsrate.php');
		$this->curl->option(CURLOPT_BUFFERSIZE, 10);
		$this->curl->post($param);
		$result = $this->curl->execute();
		
		$html = str_get_html($result);
		//echo $result;
		$td = $html->find('table', 0);
		$output = array();
		$index = array();
		//GETTING INDEX of EACH Value Information
		foreach($td->find('tr th') as $row){
			
					array_push($index, strtolower(str_replace(' ', '_', $row->innertext)));
			
		}
		// CHECK That everything works good :)
		if(element(0, $index) != 'service'){
			return false;
		}
		// EXTRACT EACH RATE VALUE
		foreach($td->find('tr') as $row){
				$value = array();
				if($row->find('td') != null):
					foreach($row->find('td') as $item){
						$string = ($item->innertext == null) ? '0' : $item->innertext ;
						array_push($value, str_replace('$', '', $item->innertext));
					}
					array_push($output, array_combine($index, $value));
				endif;
		}
		echo print_arrayRecrusive($output);
		// ADAPT WITH SITE CURRENCY
	
		if($this->cart->currency() != 'USD'):
			$rate = $this->cart->conv('USD', 'IDR');
			$new_output = array();
			foreach ($output as $index => $val){
				
				foreach($val as $key => $value){
						$money = array('basic_charge', 'option_charge', 'total_charge');
						$pre = array();
						if(in_array($key, $money)){
							$new[$key] = $this->cart->show_price($value*$rate);
						}else{
							$new[$key] = $value;
						}
				
				}
				array_push($new_output, $new);
			}
			echo print_arrayRecrusive($new_output);
		endif;
		

	}
	function tweet(){
		$tw = $this->load->library('twitter/epitwitter');
		$link = $tw->getAuthenticateUrl(null,array('oauth_callback' => 'http://127.0.0.1/dwodol/tester/tweet_callback/'));
		echo '<a href="'.$link.'">Connect</a>';
		
	}
	function tweet_callback(){
		enable_get();		

		if(!$this->session->userdata('twitter_session')):
			if(!$this->input->get('oauth_token')) redirect('tester/tweet');
			$tw = $this->load->library('twitter/epitwitter');
			$tw->setToken($this->input->get('oauth_token'));
			$token = $tw->getAccessToken();
			$render['token'] = $token;
			
			$data = array(
					'twitter_session' => array(
											'oauth_token' => $token->oauth_token, 
											'oauth_token_secret' => $token->oauth_token_secret,
											)
					);
			$this->session->set_userdata($data);
		else:
		
			if($this->input->post('send_tweet')):
			$tw_sess = $this->session->userdata('twitter_session');
			$tw = $this->load->library('twitter/epitwitter');	
			$tw->setToken(element('oauth_token', $tw_sess),element('oauth_token_secret', $tw_sess));
			$image = get_image('http://localhost/dwodol/store/product/thumb/500-500-crop/dir/assets/modules/store/product_img/p_299_m_121_Detail.jpg');
			$status = $tw->post('/statuses/update_with_media.json', 
								array(
									'status' => $this->input->post('status'),
									'@media[]' => "@{$image}",
									)
								);
			endif;
		endif;
		$render['tw_data'] = $this->session->userdata('twitter_session');
	 	$this->dodol_theme->render()->build('tweet', $render);
	}
	function test34(){
		$message = 'http://127.0.0.1/culture-update.com/store/product/thumb/240-320-crop/dir/assets/modules/store/product_img/p_299_m_121_Detail.jpg voila..!! finally.. http://127.0.0.1/culture-update.com/store/ nice result in the early morning :)';
		echo prepare($message); 
	}
	function user_create(){
		$this->load->model('user/user_m');
		$render = array();
		if($this->input->post('submit')):
			$data = post_filter('main_');
			$ext_data = post_filter('ext_');
			$render['data'] = array_merge($data, $ext_data);
			$this->user_m->api_create($data, $ext_data);
		endif;
	
		$this->dodol_theme->render()->build('user_create', $render);
	}
	function user_test(){
		$this->load->model('user/user_m');
		$data = array('facebook' => 'valentia.amiz');
	//	echo print_arrayRecrusive(generate_ext_data($data));
		if( $exec = $this->user_m->_api_ext_create(1, $data, 'twitter') ) :
		echo print_arrayRecrusive($exec) ;
		else:
		echo 'gagal';
		endif;
	}
	function test_string_template(){
		$date =  date('now');
		$place = 'Home';
		echo sprintf('adalah contoh %s atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun %s', $place, $date);
		
	}
	function barcode(){
		$this->load->library('dependency/zend');
		$this->zend->load('Zend/Barcode');
	  	Zend_Barcode::render('code39', 'image', array('text' => 'CU0987-081188'), array());
	}
	function twig(){
		$data = array(
			'array' => array(
				'suh' => array(
					'kampret' => 78, 
					'kaki' => 5,
					), 
				'pret'	 => array(
					'kampret' => 8, 
					'kaki' => 9,),
				 'jing' => array(
					'kampret' => 1, 
					'kaki' => 3,)
				)
			);
		$this->load->library('dependency/Twig'); 
		foreach( element('user', get_defined_functions()) as $func_name ){
	
		$this->twig->add_function($func_name);
		}
		
		$this->twig->display('test_twig.html', $data);
		
	
	}
	function kampret(){
		echo 89;
	}
	function get_image(){
		echo get_image('http://localhost/dwodol/store/product/thumb/500-500-crop/dir/assets/modules/store/product_img/p_299_m_121_Detail.jpg');
	}
	function twitt(){
		print_r($this->session->userdata('twitter_session'));
	}
	function send_tw(){
		$this->load->helper('dodol_twitter');
		tw_update('http://localhost/dwodol/store/product/thumb/500-500-crop/dir/assets/modules/store/product_img/p_299_m_121_Detail.jpg Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya http://127.0.0.1/culture-update.com/store/ Maksud penggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf yang normal', 'http://127.0.0.1/dwodol/store/product/thumb/240-320-crop/dir/assets/modules/store/product_img/karlapink1l.jpg');
	}
	function shorturl(){
	print_r($this->load->library('dependency/google_url_api')->shorten('http://localhost/dwodol/store/product/thumb/500-500-crop/dir/assets/modules/store/product_img/p_299_m_121_Detail.jpg')->id);
	}
	function test67(){
		$this->load->helper('dodol_twitter');
		$text = 'Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya. Maksud penggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf yang normal, ketimbang menggunakan kalimat seperti "Bagian isi disini, bagian isi disini';
		echo longTweet($text);
	}
	


}