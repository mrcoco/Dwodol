<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Site extends MX_Controller {
	
	function __construct(){
		parent::__construct();
	}
	function index(){
		echo $this->router->fetch_module();
	}
	
	
}