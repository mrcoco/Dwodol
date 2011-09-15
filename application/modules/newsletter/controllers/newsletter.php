<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Newsletter extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('newsletter/newsletter_m');
	}
	
	//php 4 constructor
	function Newsletter() {
		parent::__construct();
	}
	
	
}?>