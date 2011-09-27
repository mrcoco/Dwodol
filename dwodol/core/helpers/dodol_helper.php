<?



// INPUT
function ddl_post_filter($suffix){
			$new_post = array();
			foreach($_POST as $post => $value){
				if(strpos($post, $suffix) !== false):
				$new_index = str_replace($suffix, '', $post);
				$new_post[$new_index] = $value;
				endif;
			}
			if(count($new_post)>0){
				return $new_post;
			}else{
				return false;
			}
}
function post_filter($suffix){
			$new_post = array();
			foreach($_POST as $post => $value){
				if(strpos($post, $suffix) !== false):
				$new_index = str_replace($suffix, '', $post);
				$new_post[$new_index] = $value;
				endif;
			}
			if(count($new_post)>0){
				return $new_post;
			}else{
				return false;
			}
}
function enable_get(){
	parse_str($_SERVER['QUERY_STRING'], $_GET); 
	$ci =& get_instance();
	$ci->input->_clean_input_data($_GET);
}

// STRING ,TEXT and HTML
function html_word_limiter($string, $limiter = false){
	$output = strip_tags($string);
	if($limiter != false){
		$output = word_limiter($output, $limiter);
	}
	return $output;
}

// ARRAY
function merge(){
	    //check if there was at least one argument passed.
	    if(func_num_args() > 0){
	        //get all the arguments
	        $args = func_get_args();
	        //get the first argument
	        $array = array_shift($args);
	        //check if the first argument is not an array
	        //and if not turn it into one.
	        if(!is_array($array)) $array = array($array);
	        //loop through the rest of the arguments.
	        foreach($args as $array2){
	            //check if the current argument from the loop
	            //is an array.
	            if(is_array($array2)){
	                //if so then loop through each value.
	                foreach($array2 as $k=>$v){
	                    //check if that key already exists.
	                    if(isset($array[$k])){
	                        //check if that value is already an array.
	                        if(is_array($array[$k])){
	                            //if so then add the value to the end
	                            //of the array.
	                            $array[$k][] = $v;
	                        } else {
	                            //if not then make it one with the
	                            //current value and the new value.
	                            $array[$k] = array($array[$k], $v);
	                        }
	                    } else {
	                        //if not exist then add it
	                        $array[$k] = $v;
	                    }
	                }
	            } else {
	                //if not an array then just add that value to
	                //the end of the array
	                $array[] = $array2;
	            }
	        }
	        //return our array.
	        return($array);
	    }
	    //return false if no values passed.
	    return(false);
}
function array_sort($a,$subkey) {
	foreach($a as $k=>$v) {
		$b[$k] = strtolower($v[$subkey]);
	}
	asort($b);
	foreach($b as $key=>$val) {
		$c[] = $a[$key];
	}
	return $c;
}

// TIME
function custom_time($date, $nodate=false){
	if(empty($date) || $date == null) {
		if($nodate==false){
	        return "No date provided";
		}else{
			return $nodate;
		}
	    }

	    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	    $lengths         = array("60","60","24","7","4.35","12","10");

	    $now             = time();
	    $unix_date         = strtotime($date);

	       // check validity of date
	    if(empty($unix_date)) {    
	        return "Bad date";
	    }

	    // is it future date or past date
	    if($now > $unix_date) {    
	        $difference     = $now - $unix_date;
	        $tense         = "ago";

	    } else {
	        $difference     = $unix_date - $now;
	        $tense         = "from now";
	    }

	    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	        $difference /= $lengths[$j];
	    }

	    $difference = round($difference);

	    if($difference != 1) {
	        $periods[$j].= "s";
	    }
		if($difference == 0 || $periods[$j] == 'seconds'):
		return 'Just Now';
		else:
	    return "$difference $periods[$j] {$tense}";
		endif;
}
function show_date($date){
/*
	$date = new DateTime($date);
	$date = DateTime('Y-m-d H:i:s', $date);

	$str_date = $date->format('l, F j,  Y');
*/
       $date = new datetime($date, new datetimezone('UTC'));
      $str_date = $date->format('l, F j,  Y');

	return $str_date;
}
function datetime($sort=false){
	if($sort){
		return date('Y-m-d H:i:s', strtotime($sort));
	}else{
		return date('Y-m-d H:i:s');
	}
}

// OBJECT Conversion
function arrayObject($array){
	return json_decode(json_encode($array));
}
function objectToArray($object){
		$array=array();
		foreach($object as $member=>$data)
		{
			$array[$member]=$data;
		}
		return $array;
}
function jsonToArray($json){
	return json_decode($json, true);
}
function jsonToObject($json){
	return json_decode($json);
}
function arrayToJson($array){
	return json_encode($array);
}
function objectToJson($objects){
	return json_encode($this->objectToArray($objects));
}
function arrayToObject($myarray) {
$return = new stdClass();
foreach ($myarray as $key => $value) {
if (is_array($value)) {
$return->$key = convertArrayToObject($value);
}
else {
$return->$key = $value;
}
}
return $return;
} 

// HELPER PRINT ARRAY
function print_arrayRecrusive($array){
	if(is_array($array) || is_object($array)) :
	$array = (is_object($array)) ? objectToArray($array) : $array;
	$output = '';
	foreach($array as $key => $value){
		$output .= '<div class="box2 mb10"><span class="bold">'.$key.'</span> =';
		if(is_array($value) || is_object($value)){
			$output .= print_arrayRecrusive($value);
		}else{
			$output .= $value;
		}
		$output .= '</div>';
	}
	return $output;
	else:
		return 'not valid data type of array or object';
	endif;
	
}

// URI 
function backend_url($uri = ''){
	
	$CI =& get_instance();
	$uri = 'backend/'.$uri;
	return $CI->config->site_url($uri);
}
function nice_strlink($string){
		$new_string = strtolower(str_replace(' ', '-', $string));
		return $new_string;
}

// JS AND AJAX
function isAjax() {
	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
		($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
}
function ajax_loader($width=50, $class="loader"){
	$loader = '<img class="'.$class.'" src="'.base_url().'/assets/gen_img/loader.gif" alt="loader" width="'.$width.'">';
	return $loader;
}
function menu_rend($source, $type = 'menu_hor', $style = array()){
	$wrap = ($wrap = element('link_wrap', $style)) ? $wrap : 'span';
	$wrap_open = '<'.$wrap.'>';
	$wrap_close = '</'.$wrap.'>';
	$out = '<ul class="'.$type.'">';
	foreach($source as $s){
		$id = (element('id', $s) != '') ? 'id="'.element('id', $s).'"' : '';
		$class = ($c = element('class', $s) != '') ? $s.' ' : '';
		if(element('id', $s) != '' && strpos(element('id', $s), 'load_wid') !== false):
			$id = str_replace('load_wid_', '', element('id', $s));
			$load_widget = modules::run('modularizer/load_byid', $id);
		else:
			$load_widget ='';
		endif;
		
		if($child = element('child', $s)) :
			$out .= '<li '.$id.'  class="'.$class.'hv_child">'.$wrap_open.'<a href="'.$s['link'].'">'.$s['anchor'].'</a>'.$wrap_close._menu_rend($child, 1, $style).'</li>';
		else:
			$out .= '<li '.$id.' class="'.$class.'">'.$wrap_open.'<a href="'.$s['link'].'">'.$s['anchor'].'</a>'.$wrap_close.''.$load_widget.'</li>';
		endif;
	}
	$out .= '<div class="clear"></div></ul>';
	return $out;
}
function _menu_rend($source , $level, $style){
	$wrap = ($wrap = element('link_wrap', $style)) ? $wrap : 'span';
	$wrap_open = '<'.$wrap.'>';
	$wrap_close = '</'.$wrap.'>';
	$level = $level+1;
	$out = '<ul class="level_'.$level.'">';
	foreach($source as $s){
			$id = ($i = element('id', $s) != '') ? 'id="'.$i.'"' : '';
			$class = ($c = element('class', $s) != '') ? $s.' ' : '';
		if($child = element('child', $s)) :
			$out .= '<li '.$id.'  class="'.$class.'hv_child">'.$wrap_open.'<a href="'.$s['link'].'">'.$s['anchor'].'</a>'.$wrap_close._menu_rend($child, $level, $style).'</li>';
		else:
		$out .= '<li '.$id.' class="'.$class.'">'.$wrap_open.'<a href="'.$s['link'].'">'.$s['anchor'].'</a>'.$wrap_close.'</li>';
		endif;
	}
	$out .= '</ul>';
	return $out;
}
function load_ck_editor(){
	echo ('
	<!-- CK EDITOR -->
	<script src="'.base_url().'/assets/global_js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8"></script>
	<!-- CK FINDER -->
	<script src="'.base_url().'/assets/global_js/ckfinder/ckfinder.js" type="text/javascript" charset="utf-8"></script>
	');
}
function ck_editor($id='myeditor', $var = false, $value = ''){
	$ci =& get_instance();
 	$ci->load->library('ckeditor');
	//configure base path of ckeditor folder
	$ci->ckeditor->basePath = base_url().'/assets/global_js/ckeditor/';

	$ci->ckeditor->config['toolbar'] = array(
	    array( 'Source'),

	 	array('Bold','Italic','Underline','Strike','-',
		          'Subscript','Superscript','-',
		          'NumberedList','BulletedList','-',
		          'Outdent','Indent','Blockquote','-',
		          'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-',
		          ),
	
	 	array('Format','Font','FontSize','-',
	          'TextColor','BGColor', '-', 'Link','Unlink','Anchor','-',
		          'Image','Table',)
	
	)
	;
	$ci->ckeditor->config['removePlugins']='resize';//Remove resize image
	
	$ci->ckeditor->config['language'] = 'en';
	$ci->ckeditor->config['uiColor'] = 'transparent';
	$ci->ckeditor->config['filebrowserImageUploadUrl'] = site_url('file_manager/ck_upload_img');
	//configure ckfinder with ckeditor config
	echo $ci->ckeditor->editor($id, $var, $value);
}
function load_text_editor($id){
		$this->_ci->load->helper('url');
		$this->_ci->load->helper('ckeditor');
		//Ckeditor's configuration
		
		$config = array(
			'id' 		=> 	$id, 
			'path'		=>	'assets/global_js/ckeditor', 
			'config' 	=> array(
				'toolbar' 	=> 	"Full", 'width' 	=> 	"100%", 'height' 	=> 	'200px'),
			'toolbar'	=> 'Basic',
			'styles' 	=> array(
				// STYLE 1 
				'style 1' => array (
					'name' 		=> 	'Blue Title','element' 	=> 	'h2', 'styles' => array(
						'color' 	=> 	'Blue','font-weight' 	=> 	'bold')
						),
				// STYLE 2
				'style 2' => array (
				'name' 	=> 	'Red Title','element' 	=> 	'h2','styles' => array(
					'color' 	=> 	'Red',	'font-weight' 		=> 	'bold','text-decoration'	=> 	'underline')
						)				
					)
			);

			echo display_ckeditor($config);

}
function copy_this($string, $anchor = 'copy this' ){
		$object = '<span class="zeroCLipBut"><span class="toClipBoard button" alt="'.$string.'">'.$anchor.'</span></span>';
		return $object;
}
function load_ZeroClip(){
	echo ('<script src="'.base_url().'/assets/global_js/zeroclip/ZeroClipboard.js" type="text/javascript" charset="utf-8"></script>');
	echo ("<script>
	
		$(document).ready(function(){
				ZeroClipboard.setMoviePath('".base_url()."/assets/global_js/zeroclip/ZeroClipboard.swf');
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			// assign a common mouseover function for all elements using jQuery
			$('.toClipBoard').mouseover( function() {
				// set the clip text to our innerHTML
				text = $(this).attr('alt');
				clip.setText(text);
				// reposition the movie over our element
				// or create it if this is the first time
				if (clip.div) {
					clip.receiveEvent('mouseout', null);
					clip.reposition(this);
				}
				else clip.glue(this);
				// gotta force these events due to the Flash movie
				// moving all around. This insures the CSS effects
				// are properly updated.
				clip.receiveEvent('mouseover', null);

			} );


		});
		</script>");
}
function load_tableSort(){
	echo ('
	<!-- TAble SOrt -->
	<script src="'.base_url().'/assets/global_js/tableSort/jquery.tablednd_0_5.js" type="text/javascript" charset="utf-8"></script>');
}
function load_jq_validate(){
	echo ('
	<!-- jQuery Validate -->
	<script src="'.base_url().'/assets/global_js/jq_validate/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>');
}

// STATISTIC FORMATER
function stt_formater($data, $key_date, $key_value){
	$storage = array();
	foreach($data as $item):
		$new_item = array();
		$new_item['date'] =  show_date(element($key_date, $item));
		$new_item['value'] = element($key_value, $item);
		array_push($storage, $new_item);
	endforeach;
	return $storage;
}
// FORM 
function form_radios($name, $items = array(), $default = false ){
	if(!is_array($items)) return 'items is not array';
	$output = '';
	foreach($items as $item => $value):
		$output .= '<input type="radio"';
		$output .= ($default == $item) ? 'checked="checked"' : '';
		$output .= 'value="'.$item.'" name="'.$name.'">';
		$output .= '<span>'.$value.'</span>';
	endforeach;
	return $output;
}
// STRING AND TEXT 
function strpos_array($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = strpos_array($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return $pos;
            }
        }
    } else {
        return strpos($haystack, $needles);
    }
}


// MISC
function test($var){
	echo 'link='.$var;
}
function tinyurl($text){
		$search = array('|(http://[^ ]+)|', '|(https://[^ ]+)|', '|(www.[^ ]+)|');
		$replace = test('$1');
		$text = preg_replace($search, $replace, $text);
		return $text;
}
function mod_run($mod){
	$args = func_get_args();
	$output = call_user_func_array(array('modules', 'run'), $args);
	return $output;
}
