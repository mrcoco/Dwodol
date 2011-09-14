<?
class Statistic extends Widget_helper {
	var $detail = array(
		'name' => 'Site Statistic',
		'file_name' => 'statistic',
		'Author' => 'Zidni Mubarock',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'state'=> 'admin',
	);
	var $ga_metrics = 	array('visitors', 'newVisits');
	
	function __construct(){
		$ga_conf = $this->dodol->conf('google analytics');
		$this->ga_account 	= $ga_conf->ga_account;
		$this->ga_password 	= $ga_conf->ga_password;
		$this->ga_profile 	= $ga_conf->ga_profile;
	}
	function run(){
		$this->render('index');
	}
	function update(){
		$this->render('update');
	}
	function create(){
		$this->render('create');
	}
	function formater($data){
		
	}
	function request_report(){

		$param = $this->parameter;
		$member_metric = array();
		$ga_metric = $this->ga_data();
		if(element('statistic_member', $param)):
		foreach(element('statistic_member', $param) as $member){
				$array = array(
					'data' 	=> modules::run(element('function', $member)),
					'name'	=> ucfirst(str_replace('_', ' ', element('metric', $member))),
					);
				array_push($member_metric, $array);
		}	
		endif;
		$return  = array(
					'series' 	=> array_merge($member_metric, $ga_metric),
					'status'	=> 'success'
					);
		echo json_encode($return);
					
		
	}
	function ga_data($s_date =null, $e_date =null){
		$ga = $this->load->library('gapi');
		$req = $ga->requestReportData(
			array('date'),
			$this->ga_metrics, 
			array('-date'),  
			$filter			= null, 				
			$start_date		= $s_date, 
			$end_date		= $e_date, 
			$start_index 	= 1, 
			$max_results	= 50, 
			'ori');
		if($req){
			$data = $this->ga_formater($ga->getDataArray(), array('visitors', 'newVisits'));
		}else{
			//$data = array();
			$data = array('status' => 'error');
		}
		return $data;
	}
	function ga_formater($data, $metrics = false){
			// initialize as metric
			$storage = array();
			foreach ($metrics as $metric):
				$$metric = array();
			endforeach;
			
			// visitors
			foreach($data as $dt => $datval){
				list($year, $month, $day) = sscanf($dt, '%04d%02d%02d');
				$date = new DateTime($year.'-'.$month.'-'.$day);

				$str_date = $date->format('l, F j,  Y');
				//$date = date_create_from_format('Ymd', $dt);
				//$str_date = $dt;
				foreach($metrics as $metric):
				array_push($$metric, array('date' => $str_date, 'value' => $datval['ga:'.$metric]) );
				endforeach;	
			}
			
			foreach($metrics as $metric):
				$array = array(
					'data' => $$metric,
					'name'	=> $metric,
					'type'	=> 'spline'
				);
				array_push($storage, $array);
			endforeach;
			return $storage;
		
	}
	
}?>