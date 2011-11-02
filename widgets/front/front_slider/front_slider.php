<?
class Front_slider extends Widget_helper
{
	var $detail = array(
		'name' => 'Front Slider',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'front_slider',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Some Koplak Widget',
		'path'		=> './widgets/front/front_store_slide/',
	);
	function getdetail(){
		return $this->detail;
	}
    function run($data=array()) {
	 $this->render('index');
    }
	function register($data=array()){
	
	}
	function create(){
		$this->render('create');
	}

}