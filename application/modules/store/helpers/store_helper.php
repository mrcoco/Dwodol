<?  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function currency(){
	$ci =& get_instance();
	$ci->load->library('session');
	$ci->load->library('dodol');
	if($ci->session->userdata('currency')){		
		$currency = $ci->session->userdata('currency');		
	}else{		
		$currency = $ci->dodol->conf('store', 'currency');		
	}		
	return $currency;
	}
	
	function currency_conv($currencyfrom,$currencyto){
	$rate = 1;
   	$from   = $currencyfrom;
	$to     = $currencyto;
    $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s='. $from . $to .'=X';
    $handle = @fopen($url, 'r');
    
	if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
    }else{
		return $rate;
	}
    $allData = explode(',', $result); /* Get all the contents to an array */
    $rate = $allData[1];
    return $rate;
	}
	function show_price($number, $curr =false){
	if($curr == false):		
	$formated = currency().' '.number_format($number, 2, ',', '.');		
	else:
	// TODO : Change when currency session change	
	$formated = $curr.' '.number_format($number, 2, ',', '.');		
	endif;	
	return $formated;
}