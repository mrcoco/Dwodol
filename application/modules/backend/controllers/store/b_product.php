<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_product extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('store/product_m');
		$this->dodol_auth->userRoleCheck('owner');
		$this->load->helper('store/product');
	}
	
	//php 4 constructor
	function B_product() {
		parent::__construct();
	}
	
	//Page
	function index() {
			redirect('backend/store/b_product/listprod');
	}
	function tab_ui(){
//		echo modules::run('store/product/api_relation_delete', 9);
		print_r(modules::run('store/product/api_relation_delete', 9));
		$this->dodol_theme->render()->build('page/store/product/tab_ui');
	}
	function addprod(){
		$data = array(
			'mainLayer' => 'backend/page/store/product/addprod_v',
			'pT'        => 'Add Product',
			);
		$this->dodol_theme->render()->build('page/store/product/addprod_v', $data);
		if($this->input->post('submit')){
		$this->exe_addprod();
		}
	}

	function ajx_media(){
		enable_get();
		$func = $this->input->get('func');
		$return = array();
		switch($func)
		{
			case 'upload':
				$config['upload_path'] = './assets/modules/store/product_img/';
				$config['allowed_types'] = 'jpg|jpeg';
				$config['max_size']	= '10000';
				$uploaded = array();
				$error = array();
				$this->load->library('dw_upload');
				if( $this->dw_upload->is_multiple('image') ):
					for($i = 0 ; $i<count($_FILES['image']['tmp_name']) ; $i++){
						$this->dw_upload->initialize($config);
						if ($this->dw_upload->do_upload('image', $i)):
							array_push($uploaded, $this->dw_upload->data());
						endif;
					}
				else:
					$this->dw_upload->initialize($config);
					if ($this->dw_upload->do_upload('image')):
						array_push($uploaded, $this->dw_upload->data());
					endif;
				endif;

				$success = array();
				if(count($uploaded) > 0){
					$i = 1;
					foreach($uploaded as $item){
						$data = array(
							'name' => element('raw_name', $item),
							'publish' => 'y',
							'default' => 0,
							'sort' => $i,
							'path' => element('file_name', $item),
						);
						if($this->input->post('media_prodid')) $data['prod_id'] =$this->input->post('media_prodid');
						$ins = $this->load->controller('store/product')->api_media_create($data);
						array_push(
							$success, 
							array(
								'id' 		 => $ins->id,
								'img_url' 	 => site_url('store/product/thumb/200-200-crop/dir/assets/modules/store/product_img/'.$ins->path), 
								'name'		 => $ins->name
								)
							);
						$i++;
					}
				}
				$return = array(
					'uploaded' => $success, 
					'status' => 'success', 
					'errors' => $this->dw_upload->error_files()
					);
				break;
			case 'rename':
				if($this->input->post('name')){
					$data = array('name' => $this->input->post('name')	);
					$id = $this->input->post('id');
					if($q = modules::run('store/product/api_media_update', $id, $data)):
						$return = array('name' => $q->name, 'status' => 'success');
					else:
						$return = array('status' => 'success');
					endif;
				}

				break;
			case 'delete': 
				if($id = $this->input->post('id')){
					if($q = modules::run('store/product/api_media_delete', $id) ):
						$return = array('status' => 'success');
					else:
						$return = array('status' => 'success');
					endif;
				}
				break;
			default : 
				$return = 'no valid request setup';
				break;
		}
		
		echo json_encode($return);
	}
	function ajx_relation(){
		enable_get();
		$func = $this->input->get('func');
		$return = array();
		switch($func)
		{
			case 'search' :
				$q = $this->input->post('q');
				//$not = explode(',',$this->input->post('not'));
				$not = array(301);
				$query = modules::run('store/product/api_browse', 
						array(
							'src' 		=> $q, 
							'select' 	=> 'prod.name as name', 
							'id_not' 	=> $not)
							);
				if($prods = element('prods', $query)){
					$list = array();
					foreach($prods as $p){
						$item = array(
						'id' => $p->id,
						'name' => $p->name,
						'img' => 'assets/modules/store/product_img/'. modules::run('store/product/api_getmedia', $p->id)->path,	
						);
						array_push($list, $item);
					}
					$return = array(
						'status' 	=> 'success',
						'prods'		=> $list,
						);
				}else{
					$return = array(
						'status' 	=> 'fail');
				}
			
			break;
			case 'add'	:
				$id = $this->input->post('id');
				$query = modules::run('store/product/api_relation_create', array('p_rel' => $id) );
				if($query){
					$qp = modules::run('store/product/api_getbyid', $id, array('media') );
					$prod = $qp['product'];
					$prod->img = 'assets/modules/store/product_img/'.element('media', $qp)->path;
					$prod->id = $query->id;
					$return = array(
						'status' => 'success',
						'rel'	 => $prod ,
					);
				}else{
					$return = array(
						'status' => 'fail',
					);
				}
				
			break;
			case 'del' :
				$id = $this->input->post('id');
				$query = modules::run('store/product/api_relation_delete', $id );
				if($query){
					$return = array(
						'status' => 'success');
				}else{
					$return = array(
						'status' => 'fail',
					);
				}
			break;
			default :
				$return = 'no valid request setup';
			break;
		}
		echo json_encode($return);
		
	}
    function _exec_addprod(){
		$main_info 	= post_filter('main_');
		$attrs    	= post_filter('attr_');
		$relations  = $this->input->post('relations');
		$medias     = $this->input->post('medias');
		
	}
	function editprod(){
		$idprod = $this->uri->segment(5);
		$param = array(
			'id' => $idprod,
			'attr' => true,
			'media' => true,
			);
		$prod = modules::run('store/product/detProd',$param);
		if(!$prod)return $this->dodol_theme->not_found();
		$data['prod'] = $prod['prod'];
		$data['attrb'] = $prod['attrb'];
		$data['media'] = $prod['media'];
		$data['relations'] = modules::run('store/product/get_relation', $idprod);
		$data['mainLayer'] = 'backend/page/store/product/editprod_v';
		$data['pt'] = 'edit product';
		$data['ht'] = 'edit product - '.$prod['prod']->name;
		$this->carabiner->js('global_js/drag_sort/j_drag_sort.js', '', TRUE, FALSE, 'add_on'); 
		$this->dodol_theme->render()->build('page/store/product/editprod_v', $data);
		
		if($this->input->post('submit')){
			$this->exe_editprod($idprod);
		}
	}
	function deleteprod(){
		$id = $this->uri->segment(5);
		$del = modules::run('store/product/exe_delete', $id);
		if($del){
			$this->messages->add('Success Delete Product with id '.$id, 'success');
			redirect('backend/store/b_product/listprod');
		}else{
			$this->messages->add('Failed Delete Product with id '.$id, 'warning');
			redirect('backend/store/b_product/listprod');
		}
	}
	
	function prod_filter(){
		
		$this->load->view('backend/page/store/misc/prod_filter_v');
	}
	function listprod(){
		$this->load->library('dodol/dodol_paging');
		$limit = 20;
		$param = $this->uri->uri_to_assoc();
		if(!isset($param['cat'])){
			$param['cat'] = false;
		}
		if(!isset($param['page'])){
			$param['page'] = 0;
		}
		if(!isset($param['pub'])){
			$param['pub'] = false;
		}
		if(!isset($param['q'])){
			$param['q'] = false;
		}
		
		if($param['page']){
			$start = ($param['page'] - 1)* $limit;
		}else{
			$start = 0;
		}
		
		$conf = array(
			'cat_id'   => $param['cat'],
			'publish'  => $param['pub'],
			'limit'    => $limit,
			'start'    => $start,
			'search'   =>  $param['q']
			);
		$prods = $this->product_m->getListProd($conf);
		$target_url = str_replace('/page/'.$param['page'] , '', current_url());
		$confpage = array(
			'target_page' => $target_url,
			'num_records' => $prods['num_rec'],
			'num_link'	  => 5,
			'per_page'   => $limit,
			'cur_page'   => $param['page']
			);
		$this->dodol_paging->initialize($confpage);
		$menuSource = array(
			array(
				'anchor' => 'Add Product', 'link' => site_url('backend/store/b_product/addProd')),
		);
		$menu = menu_rend($menuSource);
		$data = array(
			'mainLayer' => 'backend/page/store/product/listprod_v',
			'pT'        => 'List Product',
			'pH'        => 'List Product',
			'pageTool'  => modules::run('backend/store/b_product/prod_filter'),
			'pageMenu'  => 'test',
			'pageMenu'  => $menu,
			'prods'     => $prods['prods'],
			'num_rec'	=> $prods['num_rec']
			);
		// filterize 
		if($this->input->post('submitfilter')){
			if($this->input->post('keyword') && $this->input->post('keyword') != 'keyword'){
				$filter['q'] = $this->input->post('keyword');
			}
			if($this->input->post('cat_id')){
				$filter['cat'] = $this->input->post('cat_id');
			}
			if($this->input->post('publish')){
				$filter['pub'] = $this->input->post('publish');
			}
			if(isset($filter)){
			$outputFilter = $this->uri->assoc_to_uri($filter);
			redirect('backend/store/b_product/listprod/'.$outputFilter);
			}
		}
		
		
		$this->dodol_theme->render()->build('page/store/product/listprod_v',$data);
	}
	// Edit Media View
	function editmedia(){
		$idmedia = $this->uri->segment(5);
		$media = $this->product_m->getMediaById($idmedia);
		if(!$media) return $this->dodol_theme->not_found();
		$pram = array('id'=> $media->prod_id, 'select' => 'name, sku');
		$prod =  $this->product_m->getProdById($pram);
		$data = array(
			'mainLayer' => 'backend/page/store/product/editmedia_v',
			'pt'        => 'Update Media',
			'ht'        => 'Update Media - '.$media->name. '<small> product : '.$prod['prod']->name.' | sku :'.$prod['prod']->sku.'</small>',
			'media'		=> $media,
				);
		$this->dodol_theme->render()->build('page/store/product/editmedia_v', $data);
		if($this->input->post('submit')){
			if($this->input->post('default') == '1'){$def = 1;}else{$def = 0;}
			if($this->input->post('publish') == 'y'){ $pub = 'y';}else{ $pub = 'n';}
			$ins_data = array(
				'publish' => $pub,
				'default' => $def,
				'name'    => $this->input->post('name'));
			$q = $this->exe_editmedia($ins_data, 'media_file', $this->input->post('id-media'));
			redirect('backend/store/b_product/editmedia/'.$this->input->post('id-media'),'refresh');
		}
	}
	
	
	function exe_editmedia($data ,$input_name, $idmedia){
	
		if($_FILES[$input_name]['name']){
			$media = $this->product_m->getMediaById($idmedia);
			//$current_media = './assets/modules/store/product_img/'.$media->path;
			$name_media = 'p_'.$media->prod_id.'_m_'.$media->id.'_'.$media->name;
			$up = $this->product_m->uploadMedia($input_name,$name_media);
			if (!isset($up['error'])){
		//	$del = unlink($current_media);
			$data['path'] = $up['file_name'];
			$this->product_m->editMedia($data, $idmedia);
			$this->messages->add('media with name <strong>'.$data['name'].'</strong> success be updated', 'success');
			}else{
			
				$this->messages->add('media with name <strong>'.$data['name'].'</strong> failed be updated <br/> error detail : '.$up['error']['error'], 'warning');
			}
		}else{
			$this->product_m->editMedia($data, $idmedia);
			$this->messages->add('media with name <strong>'.$data['name'].'</strong> success be updated', 'success');
		}
	}
	function delete_media(){
		if($id = $this->uri->segment(5)){
			if( $del = modules::run('store/product/api_media_delete', $id)):
				$this->messages->add('Success DElete media with name'.$del->name, 'success');
				redirect('backend/store/b_product/editprod/'.$del->prod_id);
			else:
				$this->messages->add('failed DElete media with name'.$del->name, 'warning');
				redirect('backend/store/b_product/editprod/'.$del->prod_id);
			endif;
		}
		
	}
	function reorder_media(){
		if($state = $this->input->post('sort_state')):
		$state = explode(',', $state);
			foreach($state as $item => $value):
				$data = array('sort' => $item+1);
				$update = modules::run('store/product/api_media_update', $value, $data );
			endforeach;
		endif;
	}

	// EXE Function
	function exe_editprod($id){
		if ($this->input->post('p_publish') == 'y'){
			$publish = 'y';
		}else{
			$publish = 'n';
		}
		$mainInfo = array(
			'name'      => $this->input->post('p_name'),
			'sku'       => $this->input->post('p_sku'),
			'l_desc'    => $this->input->post('p_desc'),
			'price'     => $this->input->post('p_price'),
			'weight'    => $this->input->post('p_weight'),
			'stock'		=> $this->input->post('global_stock'),
			'm_date'    => date('Y-m-d H:i:s'),
			'cat_id'    => $this->input->post('p_cat_id'),
			'publish'   => $publish,
			'meta_desc' => $this->input->post('p_meta_desc'),
			'meta_key'  => $this->input->post('p_meta_key')
			);
		$ins = $this->product_m->editProduct($mainInfo, $id);
		if($ins){
				// insert relation
				if($this->input->post('product_rel') != null){
					$rel_array = explode(',', $this->input->post('product_rel'));
				
					$this->product_m->addRel($id, $rel_array);

				}
			//update attribute
			$num_attrb = count($this->input->post('attribute'));
				for($i=0;$i<$num_attrb;$i++){
					if($_POST['attribute'][$i]!= null && $_POST['attr_id'][$i] == null){
						$dataAttrb = array(
							'prod_id'   => $id,
							'attribute' => $_POST['attribute'][$i],
							'price_opt' => $_POST['price_opt'][$i],
							'stock'     => $_POST['stock'][$i]
						);
						$this->product_m->addAttrib($dataAttrb);
					}elseif($_POST['attribute'][$i]!= null && $_POST['attr_id'][$i] != null){
						$dataAttrb = array(
							'prod_id'   => $id,
							'attribute' => $_POST['attribute'][$i],
							'price_opt' => $_POST['price_opt'][$i],
							'stock'     => $_POST['stock'][$i]
						);
						$this->product_m->editAttrib($dataAttrb, $_POST['attr_id'][$i]);
					}
				}
			
			// upload n insert media
			$num_file = count($this->input->post('p_media_name'));		
			$publish = $this->input->post('p_media_publish');
			$default = $this->input->post('p_media_default');
			// looping for mutiple upload
			for($i=0;$i<$num_file;$i++){
				
				$i_fl = $i+1;
				if(!isset($publish[$i])){
					$pub = 'y';
				}else{
					$pub = 'n';
				}
				if(!isset($default[$i])){
					$def = '0';
				}else{
					$def = '1';
				}
				
				//check if file chosen to upload
				if($_FILES['p_media_file_'.$i_fl]['name'] && $_POST['p_media_name'][$i] ){
					$nameMedia =  'p_'.$ins['id'].'_'.$_POST['p_media_name'][$i];
					$upload = $this->product_m->uploadMedia('p_media_file_'.$i_fl,$nameMedia );
						if(isset($upload['error'])){
							$this->messages->add('product with name '.$_POST['p_media_name'][$i].' failed to be uploaded ' , 'warning');
						}else{
						$insMediaData = array(
									'prod_id' => $id,
									'name'    => $_POST['p_media_name'][$i],
									'publish'  => $pub,
									'default'  => $def,
									'path'    => $upload['file_name'],
							);
							$insert = $this->product_m->addMedia($insMediaData);
							if($insert){
								$this->messages->add('product with name '.$_POST['p_media_name'][$i].' successfully uploaded',  'information');
							}else{
								$this->messages->add('product with name '.$_POST['p_media_name'][$i].' failed to be uploaded ' , 'warning');
							}
						}
				}
			//end off looping multiple upload	
			}
			$this->messages->add('success update product with id '.$id, 'success');
			redirect('backend/store/b_product/listprod');
		}else{
			$this->messages->add('failed to update product with id '.$id, 'warning');
			redirect('backend/store/b_product/editprod/'.$id);
		}
	}
	function exe_addprod(){
		if ($this->input->post('p_publish') == 'y'){
			$publish = 'y';
		}else{
			$publish = 'n';
		}
		$mainInfo = array(
			'name'      => $this->input->post('p_name'),
			'sku'       => $this->input->post('p_sku'),
			'l_desc'    => $this->input->post('p_desc'),
			'price'     => $this->input->post('p_price'),
			'weight'    => $this->input->post('p_weight'),
			'stock'		=> $this->input->post('global_stock'),
			'c_date'    => date('Y-m-d H:i:s'),
			'cat_id'    => $this->input->post('p_cat_id'),
			'publish'   => $publish,
			'meta_desc' => $this->input->post('p_meta_desc'),
			'meta_key'  => $this->input->post('p_meta_key')
			);
		$ins = $this->product_m->create($mainInfo);
		if($ins){
			// insert relation
			if($this->input->post('product_rel') != null){
				$rel_array = explode(',', $this->input->post('product_rel'));
				$this->product_m->addRel(element('product', $ins)->id, $rel_array);
				
			}
			
			// insert attrib
			$num_attrb = count($this->input->post('attribute'));
				for($i=0;$i<$num_attrb;$i++){
					if($_POST['attribute'][$i]!= null){
						$dataAttrb = array(
							'prod_id'   => element('product', $ins)->id,
							'attribute' => $_POST['attribute'][$i],
							'price_opt' => $_POST['price_opt'][$i],
							'stock'     => $_POST['stock'][$i]
						);
						$this->product_m->addAttrib($dataAttrb);
					}
				}
			// upload n insert media
			
			$num_file = count($this->input->post('p_media_name'));		
			$publish = $this->input->post('p_media_publish');
			$default = $this->input->post('p_media_default');
			// looping for mutiple upload
			for($i=0;$i<$num_file;$i++){
				
				$i_fl = $i+1;
				if(!isset($publish[$i])){
					$pub = 'y';
				}else{
					$pub = 'n';
				}
				if(!isset($default[$i])){
					$def = '0';
				}else{
					$def = '1';
				}
			
				//check if file chosen to upload
				if($_FILES['p_media_file_'.$i_fl]['name'] && $_POST['p_media_name'][$i]){
					$nameMedia =  'p_'.element('product', $ins)->id.'_'.$_POST['p_media_name'][$i];
					$upload = $this->product_m->uploadMedia('p_media_file_'.$i_fl,$nameMedia );
						if(isset($upload['error'])){
							$this->messages->add('product with name '.$_POST['p_media_name'][$i].' failed to be uploaded ' , 'warning');
						}else{
						$insMediaData = array(
									'prod_id' 	=>element('product', $ins)->id,
									'name'    	=> $_POST['p_media_name'][$i],
									'publish'  	=> $pub,
									'default'  	=> $def,
									'path'    	=> $upload['file_name'],
							);
							$insert = $this->product_m->addMedia($insMediaData);
							if($insert){
								$this->messages->add('product with name '.$_POST['p_media_name'][$i].' successfully uploaded',  'information');
							}else{
								$this->messages->add('product with name '.$_POST['p_media_name'][$i].' failed to be uploaded ' , 'warning');
							}
						}
				}
			//end off looping multiple upload	
			}
			// product successfully added
			redirect('backend/store/b_product/listprod');

			}
			// there something wrong when add product
			else{
			$this->messages->add('something done not correctly, we so sorry, you can try again now',  'warning');
			redirect('backend/store/b_product/addprod');
			}
	}
	
	function ajax_prod_search_rel(){
		$q = $this->input->post('rel_search');
		
		$combine_q = array('name' => $q, 'sku' => $q);
		if($this->input->post('except') != null){
			$exc = explode(',', $this->input->post('except'));
			$this->db->where_not_in('id', $exc);
		}
		
		$this->db->or_like($combine_q);
		$prods = $this->db->get('store_product');
		if($prods->num_rows() > 0){
			$data['status'] = true;
			$data['prods'] = '';
		
			foreach($prods->result() as $prod){
				$img = modules::run('store/product/prodImg', $prod->id);
				$data['prods'] .= '
					<div class="rel_item mb10"  id="'.$prod->id.'">
						<div class="img_prod left mr5"><img
						 src="'.site_url('store/product/thumb/70-30-crop/dir/assets/modules/store/product_img/'.$img->path).'"/></div>
						<div class="detail_prod left">
						'.$prod->name.'
						</div>
						<div class="clear"></div>
						<div class="horline"></div>
						<div class="clear"></div>
					</div>
				';
				
			}
		}else{
			$data['status'] = false;
		}
		echo json_encode($data);
		
	}
	function ajax_get_prodrel(){
		$id = $this->input->post('id_prod');
		$this->db->where('id', $id);
		$q= $this->db->get('store_product');
		$prod = $q->row();
		$img = modules::run('store/product/prodImg', $id);
		$data['prod'] = '
			<div id="'.$prod->id.'" class="item mb10">
				<div class="img_prod left mr5"><img src="'.site_url('store/product/thumb/70-30-crop/dir/assets/modules/store/product_img/'.$img->path).'"/></div>
				<div class="detail_prod left">
				'.$prod->name.'
				</div>
				<div class="right tool">
					<a href="'.site_url('backend/store/b_product/editprod/'.$prod->id).'"><span class="edit act"></span></a>
					<a href="'.site_url('store/prod/'.$prod->id).'"><span class="view act"></span></a>
					<a href="#"><span class="delete_ajx act pre_del"></span></a>
				</div>
				<div class="clear"></div>
				<div class="horline"></div>
				<div class="clear"></div>
			</div>
		';
		$data['status'] = true;
		echo json_encode($data);
	}
	function ajax_del_prodrel(){
		$id = $this->input->post('id_rel');
		$q = $this->product_m->delRel($id);
		if($q){
			$data['status'] = true;
		}else{
			$data['status'] = false;
		}
		echo json_encode($data);
	}

}