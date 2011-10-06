<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Product extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->mdl = $this->load->model('store/product_m');
		//$this->load->helper('store/product');

		
	}
	
	//php 4 constructor
	function Product() {
		parent::__construct();
	}
	
	//Page
	function index() {
		
	}
	function prodImg($id){
		$q = $this->product_m->getProdSnap($id);
		$data = $q['media'];
		return $data;
	}
	function prodSnap($id){
		$q = modules::run('store/product/api_getbyid', $id, array('media'));
		$data['prod'] =  $q['product'];
		$data['media'] = $q['media'];
		$this->dodol_theme->view('store/misc/product/productSnap_v', $data);
	}
	function detProd($param=array()){
		$q = $this->product_m->getProdById($param);
		return $q;
	}
	function get_relation($id){
		return $this->product_m->getRel($id);
	}
	function view(){
	//	$this->load->helper('store/product');
	//	$this->dodol_theme->set_layout('extend/store/store');
		$this->dodol_asset->append_module('css', 'detail_prod.css');
		$param['id'] 	= $this->uri->segment(3);
		$param['attr'] 	= true;
		$param['media'] = true;
		//$this->dodol_asset->append_global('css', 'style.css');
		$data['prod'] 		= $this->api_getbyid($param['id'], array('media', 'medias', 'relations', 'attributes'));
		if($data['prod'] == false)return $this->dodol_theme->not_found();
		$data['loadSide'] 	= false;
		$data['pT']        	= $data['prod']['product']->name;

		$this->dodol_theme->render()->build('page/product/detailProd', $data);
		// execution buy product
		modules::run('store/store_cart/buyProd');
	}
	function _prod_price($id, $id_attr=false){
		$prod = $this->api_getbyid($id, false, $select = 'prod.price,prod.disc, prod.currency', false);
		$currency = currency();
		$disc_type = 'n';
		$disc_percent = '';
		// MY_TODO : buat untuk dapet price role dari attribute, jika attribute di set;
		
		// IF HAVE DISCOUNT
		
		if($prod->disc):
			$disc = explode(':', $prod->disc);
			// IF DISCOUNT TYPE "n"
			if(element(0, $disc) == 'n'):
				$disc_value = element(1, $disc);
			// IF DISCOUNT TYPE "%"
			elseif(element(0, $disc) == '%'):
				$disc_type = 'percent';
				$disc_percent = element(1,$disc);
				$disc_value = $prod->price*($disc_percent/100);
			// IF DISCOUNT NOT VALID
			else:
				$disc_value = 0;
			endif;
		else:
			// IF THERE IS NO DISCOUNT
			$disc_value = 0;
		endif;
		// TODO : CHANGE CURRENCY WHEN SEttup
		// IF PRODUCT CURRENCY != CURRENT CURRENCY
		/*
		if($prod->currency != $currency):
			$rate = currency_conv($prod->currency, $currency);
		else:
		// IF PRODUCT CURRENCY SAME WITH CURRENT CURRENCY
			$rate = 1;
		endif;
		*/
		$rate = 1;
		// GRAB ALL TOGETHER 
		$data = new stdClass;
		$data->final_value 	= ($prod->price*$rate) - ($disc_value*$rate);
		$data->origin	   	= $prod->price*$rate;
		$data->formated 	= $currency.' '.number_format($data->final_value, 0, ',', '.');
		$data->disc_type 	= $disc_type;
		$data->disc_value  	= $disc_value;
		$data->disc_percent = $disc_percent;
		$data->currency 	= $currency;
		return $data;

	}
	function prod_price($id, $id_attrb=false){
		$param = array('select'=> 'price, disc, currency', 'id'=> $id);
		$currency = currency();
		$qp = $this->detProd($param);
		$p = $qp['prod'];
		$rate = rate();
		if($p->disc){
			$disc = explode(':', $p->disc);	
			if($disc[0] == 'n'){		
				$disc_nominal = $disc[1];
			}else{
				$disc_nominal  = $p->price*($disc[1]/100);
			}
		}else{
			$disc_nominal = 0;
		}
	
			$price_addon = 0;
	
		/*next task
		if($p->currency != $this->config->item('currency') && !$this->session->userdata('currency') ){
		$new_rate = $this->yh_conv->conv($p->currency, $this->config->item('currency') );
		$final_value = ($p->price*$new_rate ) - ($disc_nominal*$new_rate ) - (-1*($price_addon*$new_rate ));
		$origin_value = $p->price*$new_rate ;
		}elseif($this->session->userdata('currency') && $p->currency == $this->session->userdata('currency') && $p->currency != $this->config->item('currency')){
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		elseif($this->session->userdata('currency') && $p->currency != $this->session->userdata('currency')){
		$final_value = ($p->price*$rate) - ($disc_nominal*$rate) - (-1*($price_addon*$rate));
		$origin_value = $p->price*$rate;
		}
		else{
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		*/
		///* backup
		if($p->currency != $currency ){
		$final_value = ($p->price*$rate) - ($disc_nominal*$rate) - (-1*($price_addon*$rate));
		$origin_value = $p->price*$rate;
		}
		else{
		$final_value = $p->price - ($disc_nominal) - (-1*($price_addon));
		$origin_value = $p->price;
		}
		//*/
		$data['final'] = $final_value;
		$data['origin'] = $origin_value;
		$data['formated'] = $currency.' '.number_format($final_value, 0, ',', '.');
		if(!$p->disc){
		$data['formated_detail'] = '<div class="priceProduct_formated"><span class="finalPrice"> '.$currency.' '.number_format($final_value, 2, ',', '.').'</span></div>';
		}else{
			
		$data['formated_detail'] = '<div class="priceProduct_formated"><span class="finalPrice"><span class="finalPrice"> '.$currency.' '.number_format($origin_value, 2, ',', '.').'</span><br/>
		<span class="originPrice">'.$currency.' '.number_format($origin_value, 0, ',', '.').'</span><br/>
		'.$rate.'
		
		</div>
		';	
		}
		return $data;
		
	}
	
	function thumb() {
		$url = $this->uri->uri_string();
		$parameter = $this->uri->segment(4);
		$param = explode('-', $parameter);
		$w = $param[0];
		$h = $param[1];
		$c = $param[2];
		$source = strstr($url, '/dir/');
	
		
		
		$s = str_replace('/dir/', '',$source);
		$s = (file_exists($s)) ? $s : 'assets/global_img/default_img.jpg'; 
		$thumb = $this->load->library('PhpThumbFactory');
		$pre_source = explode('/', $s);
		$file_name = $pre_source[count($pre_source)-1];
		$dir_img_origin = './'.str_replace($file_name, '', $s );
		$dir_img_cache = $dir_img_origin.'thumb/'.$parameter.'/';
		$path_img_origin = './'.$s;
		$path_img_cache  = $dir_img_origin.'thumb/'.$parameter.'/'.$file_name;
		if (is_file($path_img_cache) && (filemtime($path_img_origin) > filemtime($path_img_cache))) {
        // if src file is newer than the cache file, delete cache
            unlink($path_img_cache);
            clearstatcache();
	        $image = $thumb->create($path_img_origin);
			if($c == 'crop'){
				$image->adaptiveResize($w, $h);
			}elseif($c == 'no'){
				$image->resize($w, $h);
			}
			if(is_dir($dir_img_cache)){
				$image->save($path_img_cache);
			}else{
				mkdir($dir_img_cache);
				$image->save($path_img_cache);
			}  
        	$image->show();
			
		}elseif(!is_file($path_img_cache)){
			$image = $thumb->create($path_img_origin);
			if($c == 'crop'){
				$image->adaptiveResize($w, $h);
			}elseif($c == 'no'){
				$image->resize($w, $h);
			}
			if(is_dir($dir_img_cache)){
				$image->save($path_img_cache);
			}else{
				mkdir($dir_img_cache);
				$image->save($path_img_cache);
			}  
			$image->show();
		}else{
        	$image = $thumb->create($path_img_cache);
        	$image->show();
        }


		
	}
	function browse(){
		$this->load->library('dodol/dodol_paging');
		
		$param = $this->uri->uri_to_assoc(4);
		if(!isset($param['limit'])){
			$param['limit'] = 12;
		}
		if(!isset($param['cat'])){
			$param['cat'] = false;
		}
		if(!isset($param['page'])){
			$param['page'] = 0;
		}
		if(!isset($param['pub'])){
			$param['pub'] = 'y';
		}
		if(!isset($param['q'])){
			$param['q'] = false;
		}
		
		if($param['page']){
			$start = ($param['page'] - 1)* $param['limit'];
		}else{
			$start = 0;
		}
		$limit = $param['limit'];
		// configuration before query to database
		$conf = array(
			'cat_id'   => $param['cat'],
			'publish'  => $param['pub'],
			'limit'    => $param['limit'],
			'start'    => $start,
			'search'   =>  $param['q']
			);
		$prods = $this->product_m->getListProd($conf);
		// get the base url for pagination,
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		// configuration for pagination
		$confpage = array(
			'target_page' => $target_url,
			'num_records' => $prods['num_rec'],
			'num_link'	  => 5,
			'per_page'   => $limit,
			'cur_page'   => $param['page']
			);
		// execute the pagination conf
		$this->dodol_paging->initialize($confpage);
		$data = array(
			'mainLayer' => 'page/product/browse_view_v',
			'prods'     => $prods['prods'],
			'param'     => $param
			);
		if($param['cat']){
			$cat = modules::run('store/category/getCatDet', $param['cat']);
			$data['pT'] = $cat->name; 
		}else{
		$data['pT'] = 'Store Product';
		}
		$this->dodol_theme->render()
			 			  ->build('page/product/browse_view_v', $data);
	}
	
	/// API ///
	function exe_delete($id){
		$del = $this->product_m->deleteProduct($id);
		return $del;
	}
	
	
	//--------------------------------//
	// 				API V.02 
	//--------------------------------//
	
	// PRODUCT
	function api_update($id, $data){
		
		$q = $this->mdl->update($id, $data);
		if($q){
			$this->load->controller('store/store_misc')->update_product_action_listener($q);
		}
		return $q;
		
	}
	function api_create($data){
		return $this->mdl->create($data);
	}
	function api_delete($id){
		return $this->mdl->delete($id);
	}
	function api_getbyid($id, $include = false, $select = '*', $alldata = TRUE){
		return $this->mdl->getbyid($id, $include, $select, $alldata);
	}
	function api_browse($param){
		return $this->mdl->browse($param);
	}
	
	// IMAGES
	function api_getmedia($id){
		return $this->mdl->getmedia($id);
	}
	function api_getmedias($id){
		return $this->mdl->getmedias($id);
	}
	// IMAGES TRANASACTION
	function api_media_create($data){
		return $this->mdl->media_create($data);
	}
	function api_media_update($id, $data){
		return $this->mdl->media_update($id,$data);
	}
	function api_media_delete($id){
		return $this->mdl->media_delete($id); 
	}
	function api_media_getbyid($id){
		return $this->mdl->media_getbyid($id);
	}
	
	
	// ATTRIBUTES
	function api_getattributes($id){
		return $this->mdl->getattributes($id);
	}
	// ATTRIBUTES TRANSACTIONS
	function api_attribute_create($data){
		return $this->mdl->attribute_create($data);
	}
	function api_attribute_update($id, $data){
		if($q = $this->mdl->attribute_update($id, $data) ) {
		
		}
		return $q;
	}
	function api_attribute_delete($id){
		return $this->mdl->attribute_delete($id); 
	}
	function api_attribute_getbyid($id){
		return $this->mdl->attribute_getbyid($id);
	}
	
	
	// RELATIONS
	function api_getrelations($id){
		return $this->mdl->getrelations($id);
	}
	// RELATION TRANSACTIONS
	function api_relation_create($data){
		
		return $this->mdl->relation_create($data);
	}
	function api_relation_update($id, $data){
		return $this->mdl->relation_update($id, $data);
	}
	function api_relation_delete($id){
		return $this->mdl->relation_delete($id); 
	}
	function api_relation_getbyid($id){
		return $this->mdl->relation_getbyid($id);
	}

	

}?>