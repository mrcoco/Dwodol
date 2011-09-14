<? 

class Twitter_wid_backend extends Widget_helper {
	var $detail = array(
		'name' => 'Twitter Widget Backend',
		'file_name' => 'twitter_wid_backend',
		'Author' => 'Zidni Mubarock',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'state'=> 'admin',
	);
	function run() {
		$this->render('index');
    }
	function getdetail(){
		return $this->detail;
	}
	function create(){
		$this->render('create');
		
	}
	function update(){
		$this->render('update');
	}
	
}?>