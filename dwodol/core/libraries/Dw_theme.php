<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : Theme.php
**/
class Dw_theme extends Dwodol
{
		var $_ci 			=  '';
	
		var $front_class ;
		var $front_layout 	= 'default';
		var $admin_layout 	= 'default';
		var $layout ;
		
		function __construct(){
			parent::__construct();
			$this->_ci->load->library('carabiner');
			$this->_ci->load->library('template');
			$this->front_theme = $this->_ci->dodol->conf('site', 'front_theme');
			$this->admin_theme = 'default';
			$this->front_theme_location = './assets/theme/theme_front/';
			$this->admin_theme_location = './assets/theme/theme_admin/';
			
			if($this->_ci->router->fetch_module() == 'backend'):
				$this->theme_location = './assets/theme/theme_admin/';
				$this->theme = $this->admin_theme;
				$this->layout = $this->admin_layout;
				$this->theme_path = $this->theme_location.$this->theme.'/';
			else:
				$this->theme_location = './assets/theme/theme_front/';
				$this->theme = $this->front_theme;
				$this->layout = $this->front_layout;
				$this->theme_path = $this->theme_location.$this->theme.'/';
			endif;
	
		}

		function set_layout($file){
			if(!is_file($this->theme_location.$this->theme.'/views/layouts/'.$file.EXT)) : return false ; endif;
			if($this->_ci->router->fetch_module() != 'backend'):
				$this->front_layout = $file;
			else:
				$this->admin_layout = $file;
			endif;
		}
		function get_layout(){
			if($this->_ci->router->fetch_module() != 'backend'):
				return $this->front_layout ;
			else:
				return $this->admin_layout ;
			endif;
		}
		
		function render(){
			parse_str($_SERVER['QUERY_STRING'], $_GET); 
			$this->_ci->input->_clean_input_data($_GET);
			$layout = $this->get_layout();
			$this->_ci->load->library('dodol_asset')->showup();	
			$this->_ci->template->add_theme_location($this->theme_location);
			$this->_ci->template->set_theme($this->theme);
			return $this->_ci->template->set_layout($layout);
		}
		function view($view, $vars = array(), $return = FALSE){
			// THEME FILE PATH OVERIDE
			$path = $this->theme_location.$this->theme.'/views/modules/';
			// IF VIEW FILE EXIST ON THEME, LETS PUT ALL on here
			if(file_exists($path.$view.EXT)):
				return $this->_ci->load->my_view($path, $view, $vars, $return);
		
			else:
			// IF THEME DOSN't HAve THE file, Let put it back to th module 
				return $this->_ci->load->view($view, $vars, $return);
			endif;

		}
		function not_found(){
			$this->_ci->input->_clean_input_data($_GET);
			$layout = $this->layout;
			$this->_ci->load->library('dodol_asset')->showup();	
			$this->_ci->template->add_theme_location($this->theme_location);
			$this->_ci->template->set_theme($this->theme);
			$data['pT'] = 'Not Found';
			return $this->_ci->template->set_layout($layout)->build('not_found', $data);
		}
		
		function partial($view){
			$vars = array();
			$return = FALSE;
			$path = $this->theme_location.$this->theme.'/views/partials/';
			if(file_exists($path.$view.EXT)):
				return $this->_ci->load->my_view($path, $view, $vars, $return);
			endif;
			
			$path = $this->theme_location.'/partials/';
			if(file_exists($path.$view.EXT)):
				return $this->_ci->load->my_view($path, $view, $vars, $return);
			endif;
		}
		function path($dir =NULL){
		$path = $this->theme_location.$this->theme.'/'.$dir;
		return base_url().$path;
		}
		function theme_path(){
			return $this->theme_path;
		}

}
	
	
	
	
	
	
