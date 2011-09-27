<?
class Latest_blog extends Widget_helper
{
	var $detail = array(
		'name' => 'latest Blog',
		'Author' => 'Zidni Mubarock',
		'file_name' => 'latest_blog',
		'state' => 'front',
		'Email' => 'zidmubarock@gmail.com',
		'version' => '1.0',
		'description' => 'widget for latest blog'
	);
	function __construct(){
		$this->load->helper('dodol');
	}
	function getdetail(){
		return $this->detail;
	}
	function run(){
		$data = array('posts' => $this->get_latest());
		$this->render('index',$data);
	}
	function get_latest(){
		$this->db->order_by('c_date', 'DESC');
		$q = $this->db->get('blog_post', 3);
		if($q->num_rows() > 0){
			return $q->result();
		}
		
	}
	function test(){
		echo 'suh';
	}
	function post_thumb($content, $param = '300_300_crop'){

		$ci =& get_instance();
		$ci->load->library('PhpThumbFactory');
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
		$first_img = element(0,element(1 , $matches));
		if($first_img == false){ 
			$first_img = base_url().'assets/gen_img/no_imge.jpg';
		}
		$return = site_url('blog/thumb/'.$param.'/source/'.str_replace('http://', '', $first_img));
		return $return;

	}
}