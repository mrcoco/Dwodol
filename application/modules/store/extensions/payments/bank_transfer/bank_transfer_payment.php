<? if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bank_transfer_payment extends Store_payment_helper {
	function __construct(){
		
	}
	function get_option(){
		$q = $this->db->get('store_payment'); 
		if($q->num_rows() == 0){
			return false;
		}
		$this->render('view', array('payments' => $q->result()));
		
	}
	function choose_option(){
		$id = $this->input->post('payment_id');
		if(strpos($id,'bt_') !== false):
			$id = str_replace('bt_', '', $id);
			$choosen  = $this->db->where('id', $id)->get('store_payment')->row();
			$data = array(
				'method'	=> $choosen->name .' NO '.$choosen->no_rek.', AN '.$choosen->nm_rek,
				'id'		=> $choosen->id,
				'type' 		=> 'bank_tarnsfer',
				 );
			$this->session->set_userdata(array('payment_data' => $data));
		endif;
	}
	function payment_action(){
		if(element('type', $this->cart->payment_data) != 'bank_tarnsfer') return false;
		$id = element('id', $this->cart->payment_data ) ;
		$data['payment'] = $this->db->where('id', $id)->get('store_payment')->row();
		$data['order_data'] = $this->session->userdata('order_data');
		$this->session->unset_userdata('payment_data');
		$this->session->unset_userdata('order_data');
		$this->render('process', $data);
		
	}

}

