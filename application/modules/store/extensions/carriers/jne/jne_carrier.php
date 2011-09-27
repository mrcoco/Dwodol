<? if (!defined('BASEPATH')) exit('No direct script access allowed');
class Jne_carrier extends Store_carrier_helper {

	var $url_getcity = 'http://www.jne.co.id/tariff.php?';
	var $url_getrate = 'http://www.jne.co.id/index.php?mib=tariff&amp;lang=IN';
	var $base_from_code = 'Q0dLMTAwMDBK';// jakarta base
	
	
	function __construct(){
		parent::__construct();
	
		$jne_meta =  element('meta', element('jne', $this->session->userdata('store_carrier')));
		if( 
			element('country_id', $this->source_data ) != 100  || 
			($jne_meta &&
			( 
			  element('country_id', $this->source_data ) != element('country_id', $jne_meta) &&  
			  element('city_code', $this->source_data )  != element('city_code', $jne_meta)
			))
			){
				$this->unset_carrier('jne');
			}

	}
	
	// OVERIDING FUNCTION
	function get_rate(){
		
		if(element('country_id', $this->source_data ) != 100){
				return false;				
		}
		if($jne_table = element('jne',$this->session->userdata('store_carrier'))){	
				return 	$this->render('view', $jne_table);
		}else{
		
		$source_data = $this->source_data;
		$destination_code = element('city_code', $source_data);
		$weight = $this->cart->weight();
		$param = array(
			'origin_code' => urlencode($this->base_from_code),
			'destination_code' => urlencode($destination_code),
			'weight' => $weight,
			);
		
	
		$this->load->library('curl');
		$this->curl->create($this->url_getrate);
		$this->curl->option(CURLOPT_BUFFERSIZE, 10);
		$this->curl->option(CURLOPT_TIMEOUT_MS, 200);
		$this->curl->post($param);
		$result = $this->curl->execute();
		if (!$result) {
			return false;
		} else {
		
				// ambil variabel data tarif
				// checking if the curl result macth form the pattern, if no, return false
				if(strpos($result, "<tr class='trfC'>") == true){
						$result = explode("<tr class='trfC'>", $result);
						$last = count($result)-1;
						unset($result[0]);
						$result[$last] = explode("</table>", $result[$last]);
						$result[$last] = $result[$last][0]; 

						$tag = array('<td>', '</td>', '</tr>');
						foreach ($result as &$str) {
							$str = str_replace($tag, '', $str);
							$str = explode(' ', $str);
							//unset($str[1]);
							$str[2] = trim(str_replace(array(',', '.00'), '', $str[2]));
						ksort($str);
						}

						$rate = $this->addon_store->rate();
						$site_currency = $this->addon_store->currency();
						$index = 0;
						$this->load->helper('string');
						foreach($result as $r){
							$cost = $r[2]*$rate;
							$data[$index]['jne_rate_id']   = 'jne_'.random_string('alnum', 32);
							$data[$index]['service'] = $this->service($r[0]);
							$data[$index]['rate'] =$cost;
							$index++;
						}
					$return['meta'] = array(
						'country_id' 	=> element('country_id', $this->source_data),
						'zip'			=> element('zip', $this->source_data),
						'city'			=>element('city', $this->source_data),
						'province'		=> element('province', $this->source_data),
						'city_code'		=> element('city_code', $this->source_data),
						);
					$return['data'] = $data;
					$this->session->userdata['store_carrier']['jne'] = $return;
					$this->session->sess_write();
					$this->render('view', $return);
				}else{
					return false;
				}
			
		}
		}
	}

	function choose_rate(){	
		// GRAB THE LISTENER
		$id_rate = $this->input->post('rate_id');
		// check that JNE choosen
		if(strpos($id_rate,'jne_') !== false): 
				foreach($this->session->userdata['store_carrier']['jne']['data'] as $item):
					if($item['jne_rate_id'] == $id_rate) :
							$rate_detail = array(
								'fee' 			=> element('rate', $item),
								'service' 		=> element('service', $item),
								'carrier' 		=> 'JNE',
								'country_id' 	=> element('country_id', $this->source_data),
								'zip' 			=> element('zip', $this->source_data),
								'city' 			=> element('city', $this->source_data)
							);
														
					endif;
				endforeach;
				$this->session->set_userdata('shipping_data', $rate_detail );
		endif;



	}
	// ADDITION FUNCTION
	function ajax_getcity(){
		if($this->input->post('city')){
			$json = $this->getDestination($this->input->post('city'), 4);
			echo $json;
		}
	}
	function getDestination($q, $limit) {
		$query = 'q='.$q.'&limit=5';
		$url = $this->url_getcity.''.$query;

	    $getSource = @fopen($url, 'r');

		if($getSource){
		while(!feof($getSource)){
       		$lines[] = fgets($getSource, 4096);
		}
        fclose($getSource);
	    $list = $lines;
	    $index = 0;
	 	foreach($list as $item){
	 		$itemdata = explode('|', $item);
			if(isset($itemdata[0])&&isset($itemdata[1])){
	 		$codecity = preg_replace('/\r\n|\r/', "", $itemdata[1]);
	 		$data[$index]['value'] =   ucwords(strtolower($itemdata[0]));
	 		$data[$index]['city_code'] = $codecity;
			}
	 		$index++;
	 	}
	 		if(count($data) >= 1 && $data[0]['city_code'] == ' null '){
	 			$data_nope = array('value' => 'nope', 'city_code' => 'null');
			
	 			return json_encode($data_nope);
	 		}else{
 				
 				return json_encode($data);	
 			}
 		
	 	}else{
	 		$data_nope = array('value' => 'nope', 'city_code' => 'null');
	 		return json_encode($data_nope);
	 	}
	 	
		
	}
	function service($code){
		if($code == 'SS'){
			$type = 'SS (Special Service)';
		}elseif($code == 'YES'){
			$type = 'YES (Yakin Esok Sampai)';
		}elseif($code == 'REG'){
			$type = 'REG (Regular)';
		}elseif($code == 'OKE'){
			$type = 'OKE (Ongkos Kirim Ekomonis)';
		}else{
			$type = $code;
		}	
		return $type;	
	}
	
}