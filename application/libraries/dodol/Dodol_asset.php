<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
Theme Library for CI, Personaly Use for barock [zidmubarock@gmail.com]
file name : asset.php
**/
class Dodol_asset
{
	var	$_ci ;
	var	$theme_css 	= array();
	var	$theme_js  	= array();
	var	$global_css = array(
						array('global_js/jquery_ui/theme/Aristo/jquery-ui-1.8.7.custom.css'),
						array('global_js/jgrowl/jquery.jgrowl.css'),
						);
	var	$global_js 	= array(
						array('global_js/jquery.min.js'),
						array('global_js/dodolan_js_lib.js'),
						array('global_js/jquery_ui/jquery-ui.min.js'),
						array('global_js/jquery_ui/jquery-ui-timepicker-addon.js'),
						array('global_js/jgrowl/jquery.jgrowl.js')
						);
	var	$module_css = array();
	var	$module_js 	= array();
	
	var $theme_path ;
	
	function __construct(){
	
		$this->_ci =& get_instance();
		$this->theme_path = $this->_ci->dodol_theme->theme_path();
		
		$module_css  = $this->scan($this->theme_path.'modules_assets/'.$this->_ci->router->fetch_module().'/', '.css');
		$module_js	 = $this->scan($this->theme_path.'modules_assets/'.$this->_ci->router->fetch_module().'/', '.js');

		$this->global_css 	= array_merge(	$this->global_css, $this->scan('./assets/global_css/', '.css'));

	
		$this->theme_css 	= $this->scan($this->theme_path.'css/', '.css');
		$this->theme_js 	= $this->scan($this->theme_path.'js/', '.js');

		if(count($module_css) > 0) :
		$this->module_css = $module_css;
		else:
		$this->module_css = $this->scan('.assets/modules/'.$this->_ci->router->fetch_module().'/css/', '.css');
		endif;

		if(count($module_js) > 0) :
		$this->module_js = $module_js;
		else:
		$this->module_js = $this->scan('.assets/modules/'.$this->_ci->router->fetch_module().'/js/', '.js');
		endif;
		
	}
	function showup(){
		
		if(count($this->theme_css	) > 0) $this->_ci->carabiner->group('theme'	, array( 'css'	=> $this->theme_css ) );
		if(count($this->theme_js	) > 0) $this->_ci->carabiner->group('theme'	, array( 'js'	=> $this->theme_js ) );
		if(count($this->global_css	) > 0) $this->_ci->carabiner->group('global', array( 'css'	=> $this->global_css ) );
		if(count($this->global_js	) > 0) $this->_ci->carabiner->group('global', array( 'js'	=> $this->global_js ) );
		if(count($this->module_css	) > 0) $this->_ci->carabiner->group('module', array( 'css'	=> $this->module_css ) );
		if(count($this->module_js	) > 0) $this->_ci->carabiner->group('module', array( 'js'	=> $this->module_js ) );
	}
	function append_global($type, $assets){
		$storage = array();
		if(is_array($assets)):
			foreach($assets as $asset):
				if(is_file('./assets/'.$asset)) array_push($storage, array($asset));
			endforeach;
		else:
			if(is_file('./assets/'.$assets)) array_push($storage, array($assets));
		endif;
		if($type == 'js'):
		$this->global_js = array_merge($this->global_js, $storage);
		elseif($type == 'css'):
		$this->global_css = array_merge($this->global_css, $storage);
		endif;
		
	}
	function append_module($type, $assets){
		$mod = $this->_ci->router->fetch_module();
		$base_path_dir = array(
			$this->theme_path.'/modules_assets/'.$mod.'/',
			'./assets/modules/'.$mod.'/'
			);
		$storage = array();

		foreach($base_path_dir as $bs_path){
			
			if(is_file($bs_path.$type.'/'.$assets)){
				$path = str_replace('./assets/', '', $bs_path.$type.'/'.$assets );
				if($this->_asset_exist('module_'.$type, $path) == false){
					array_push($storage, array($path));
				}
				break;
			}
		}
		if($type == 'js'){
			$this->module_js = array_merge($this->module_js, $storage);
		}elseif($type == 'css'){
			$this->module_css = array_merge($this->module_css, $storage);
		}
	
		
	}
	function _asset_exist($group, $asset_loc){
		foreach($this->$group as $item){
			if(element('0', $item) == $asset_loc):
				return true;
			else:
				return false;
			endif;
		}
	}
	function scan($path, $type){
		$storage = array();
		if(is_dir($path)):
			$css = scandir($path);
			if(count($css) > 0):
				foreach($css as $c):
					if(is_file($path.$c) && strpos($c, $type) ):
						$file_path = str_replace('./assets/', '', $path);
						array_push($storage, array($file_path.$c));
					endif;
				endforeach;
			endif;
		endif;
		return $storage;
	}


}
