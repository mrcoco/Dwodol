<?
class Dodol_mailer
{
	var	$_ci ;
	var $mail_body ; 
	var $mail_title ;
	var $mail_sender_mail ;
	var $mail_sender_name ;
	var $mail_recievers = array();
	var $debugger;
	function __construct(){
		$this->_ci =& get_instance();
		$this->dw_theme = $this->_ci->load->library('dodol/dodol_theme');
		$this->cssinline = $this->_ci->load->library('inlinestyle');
		$this->email = $this->_ci->load->library('email');
		$this->load->library('dodol');
	}
	function set_body($var, $data = array(), $use_theme = true){
		if($use_theme != false){
			$var = $var
		}else{
			$var = $this->dw_theme->view($var, $data, true);
		}
		$this->mail_body = $var;
	}
	function set_title($title){
		$this->mail_title = $title;
	}
	function set_recievers($reciever){
		array_merge($this->mail_recievers, $reciever);
	}
	function set_sender($email, $name){
		$this->mail_sender_name = $name;
		$this->mail_sender_mail = $mail;
	}
	
	private function final_body(){
		$data['body'] = $this->mail_body;
		$config['source'] = $this->_ci->load->view('email_theme/general_email', $data, true);
		$this->cssinline->initialize($config);
		$this->cssinline->convert();
		$this->cssinline->applyStylesheet($this->cssinline->extractStylesheets());
		return 	$this->cssinline->getHTML();
	}
	function send(){
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from($this->mail_sender_mail, $this->mail_sender_name);
		$this->email->to(implode(',', $this->mail_recievers));
		$this->email->subject($this->dodol->conf('site', 'name').' - '.$this->mail_subject);
		$this->email->message($this->final_body()); 
		$this->email->send();
		$this->debugger = $this->email->print_debugger();
	}
	function debug(){
		return $this->debugger;
	}
