<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class Cron extends MX_Controller {

	//php 5 constructor
	function __construct() {
		parent::__construct();
		$this->load->model('cron/cron_m');
	}
	function index(){
	
	}
	function run(){
		if(	$all_task = $this->cron_m->call_all_task()):
			foreach($all_task as $task){
				
				$run = $this->exec($task->action, json_decode($task->parameter, true));
				if($run){
					$this->cron_m->set_done($task->id);
					echo 'success';
				}else{
					echo 'failed';
				}
			}
		endif;
	}
	private function exec($module, $args){
			return modules::run($module, $args);
	}
	function add($action, $parameter=false,$time = '+1 minutes'){
		$data['action'] = $action;
		$data['do_time'] = date("Y-m-d H:i:s", strtotime($time));
		if($parameter){
			$data['parameter'] = arrayToJson($parameter);
		}
		return $this->cron_m->add($data);
	}
	function test(){
		$var = 'its work';
		return $var;
	}
	
}