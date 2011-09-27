<?
class Store_new_arrival extends Widget_helper
{
	var $detail = array(
		'name' => 'Store New Arrival',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'store_new_arrival',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Widget for store'
	);
	function getdetail(){
		return $this->detail;
	}
	function run(){
		$param['order_role'] = 'ASC';
		$param['order_by'] = 'prod.c_date';
		$q = modules::run('store/product/api_browse', $param);
		if(!$q) return false;
		$data = array('prods' => element('prods', $q));
		$this->render('index', $data);
	}
}