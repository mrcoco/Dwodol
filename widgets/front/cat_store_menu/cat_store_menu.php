<?
class Cat_store_menu extends Widget_helper
{	
	

	var $detail = array(
		'name' => 'Category Store Menu',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'cat_store_menu',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'Widget for Category'
	);
	function __construct(){
		$this->load->model('store/category_m');
	}
	function getdetail(){
		return $this->detail;
	}
	function run($param=array()){
		$data['menus'] = $this->getCategoryMenu(0);
		$data['param'] = $param;
		$this->render('index',$data);
	}
	function getCategoryMenu($par = 0){
			$storage = array();
			if($root = $this->category_m->getCatByPar($par)):
				foreach($root as $item):
					$menu_item = array();
					$menu_item['anchor'] = $item->name;
					$menu_item['link'] = site_url('store/cat/'.$item->id.'/'.nice_strlink($item->name));
					if($child = $this->_getnested($item->id)):
					$menu_item['child'] = $child;
					endif;
					array_push($storage, $menu_item);
				endforeach;
				return $storage;
			else:
				return false;
			endif;
		
	}
	function _getnested($parent){
		$storage = array();
		if($root = $this->category_m->getCatByPar($parent)):
			foreach($root as $item):
				$menu_item = array();
				$menu_item['anchor'] = $item->name;
				$menu_item['link'] = site_url('store/cat/'.$item->id);
				if($child = $this->_getnested($item->id)):
					$menu_item['child'] = $child;
				endif;
				array_push($storage, $menu_item);
			endforeach;
			return $storage;
		else:
			return false;
		endif;
	}
	
}