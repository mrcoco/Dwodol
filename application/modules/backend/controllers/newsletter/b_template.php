<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class B_template extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->main_mdl = $this->load->model('newsletter/newsletter_m');
	}
	function index(){

	}
	function create_tpl(){
		$menuSource = array(
			array(
				'anchor' => 'All theme', 'link' => backend_url('newsletter/b_template/browse_tpl')),
		);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['pT'] = 'Create Newsletter Template';
		$render['groups'] = $this->tpl_group_drop_dwon();
		$this->dodol_theme->render()->build('page/newsletter/create_tpl', $render);
		// EXECUTION
		if($this->input->post('submit')):
			if($q = $this->main_mdl->tpl_create(post_filter('main_'))){
				$this->messages->add('Success Create Template with name '.$q->name, 'success');
				redirect('backend/newsletter/b_template/browse_tpl');
			}else{
				$this->messages->add('Something Wrong, PLease check again your form', 'warning');
				redirect(current_url());
			}
		endif;
			
		
		
	}
	function edit_tpl(){
		$id = $this->uri->segment(5);
		if(!$q = $this->main_mdl->tpl_getbyid($id)) return $this->dodol_theme->not_found();
		$menuSource = array(
			array(
				'anchor' => 'All theme', 'link' => backend_url('newsletter/b_template/browse_tpl')),
		);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['tpl'] = $q;
		$render['pT'] = 'Edit Newsletter Template';
		$render['groups'] = $this->tpl_group_drop_dwon();
		$this->dodol_theme->render()->build('page/newsletter/edit_tpl', $render);
		if($this->input->post('submit')):
			if($q = $this->main_mdl->tpl_update($id, post_filter('main_'))){
				$this->messages->add('Success Update Template with name '.$q->name, 'success');
				redirect('backend/newsletter/b_template/browse_tpl');
			}else{
				$this->messages->add('Something Wrong, PLease check again your form', 'warning');
				redirect(current_url());
			}
		endif;
	}
	function del_tpl(){
		if(!$id = $this->uri->segment(5)) return $this->dodol_theme->not_found();;
		if($q = $this->main_mdl->tpl_delete($id)){
			$this->messages->add('Success delete Template with name '.$q->name, 'success');
			redirect('backend/newsletter/b_template/browse_tpl');
		}else{
			$this->messages->add('Something Wrong', 'warning');
			redirect('backend/newsletter/b_template/browse_tpl');
		}
	}
	function browse_tpl(){
		$menuSource = array(
			array(
				'anchor' => 'Create Template', 'link' => backend_url('newsletter/b_template/create_tpl')
				),
			array(
				'anchor' => 'Template Group', 'link' => backend_url('newsletter/b_template/browse_group_tpl')
				),
		);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['pT'] = 'Browse Template';
		$render['tpls'] = $this->main_mdl->tpl_browse();
		$this->dodol_theme->render()->build('page/newsletter/browse_tpl', $render);
	}
	function create_group_tpl(){
			$menuSource = array(
				
				array(
					'anchor' => 'Template Group', 'link' => backend_url('newsletter/b_template/browse_group_tpl')
					),
			);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['pT'] = 'Create Template Group';
		$this->dodol_theme->render()->build('page/newsletter/create_group_tpl', $render);
		if($this->input->post('submit')){
			if($q = $this->main_mdl->tpl_group_create(post_filter('main_'))){
				$this->messages->add('Success Create Template Group with name '.$q->name, 'success');
				redirect('backend/newsletter/b_template/browse_group_tpl');
			}else{
				$this->messages->add('Something wrong, check again your form','warning');
				redirect(current_url());
			}
		}
	}
	function edit_group_tpl(){
		$id = $this->uri->segment(5);
		if(!$id || !is_numeric($id) || !$q = $this->main_mdl->tpl_group_getbyid($id)) return $this->dodol_theme->not_found();
		$menuSource = array(
			
			array(
				'anchor' => 'Template Group', 'link' => backend_url('newsletter/b_template/browse_group_tpl')
				),
		);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['grp'] = $q;
		$render['pT'] = 'Edit Template Group';
		$this->dodol_theme->render()->build('page/newsletter/edit_group_tpl', $render);
		if($this->input->post('submit')){
			if($q = $this->main_mdl->tpl_group_update($id, post_filter('main_'))){
				$this->messages->add('Success update Template Group with name '.$q->name, 'success');
				redirect('backend/newsletter/b_template/browse_group_tpl');
			}else{
				$this->messages->add('Something wrong, check again your form','warning');
				redirect(current_url());
			}
		}
	}
	function del_group_tpl(){
		if(!$id = $this->uri->segment(5) || !is_numeric($id)) return $this->dodol_theme->not_found();;
		if($q = $this->main_mdl->tpl_group_delete($id)){
			$this->messages->add('Success delete Template Group with name '.$q->name, 'success');
			redirect('backend/newsletter/b_template/browse_group_tpl');
		}else{
			$this->messages->add('Something Wrong, ', 'warning');
			redirect('backend/newsletter/b_template/browse_group_tpl');
		}
	}
	function browse_group_tpl(){
		$menuSource = array(
			array(
				'anchor' => 'Create Template Grup', 'link' => backend_url('newsletter/b_template/create_group_tpl')
				),
			array(
				'anchor' => 'All Theme', 'link' => backend_url('newsletter/b_template/browse_tpl')
				),
		);
		$render['pageMenu'] = menu_rend($menuSource);
		$render['grps'] = $this->main_mdl->tpl_group_browse();
		$render['pT'] = 'Browse Template Group';
		$this->dodol_theme->render()->build('page/newsletter/browse_group_tpl', $render);
	}
	function tpl_group_drop_dwon(){
		$list_group = array();
		$list_group[0] = 'none';
		if( $groups = $this->main_mdl->tpl_group_browse()){
			foreach($groups as $group){
				$list_group[$group->id] = $group->name;
			}
		}
		return $list_group;
	}

}