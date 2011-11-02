<link rel="stylesheet" href="<?=$this->base_path;?>/assets/back_style.css" type="text/css" media="screen" title="no title" charset="utf-8">
<div class="front_slider">
	<div class="some_tool mb10 right"><span id="addSlide" class="button">Add Item</span></div>
	<br class="clear">
	<div class="horline"></div>
	<div class="item_list">
	</div>
</div>
<div class="mb20 clear"></div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var addTrig = $('#addSlide');
		addTrig.live('click', function(){
			if($('.itemSlide').size() == 0){
				var num = 1;
			}else{
				var num = $('.itemSlide').size()+1;
			}
		var tpl =''+ 
				'<div class="itemSlide" id="slide_'+num+'"><div class="meta left w_60">'+
				'<div class="title"><input type="text" name="wi_par_title_'+num+'" name="title" value="title"></div>'+
				'<div class="link"><input type="text" name="wi_par_link_'+num+'" name="title" value="link"></div>'+
				'<div class="del_trig"><span class="button">del</span></div></div>'+
					'<div class="image right w_40"><div class="drop_area" id="slide_img_'+num+'">Drop Image here</div><input type="hidden" name="wi_par_title_'+num+'" value=""></div>'+
				'<br class="clear"/>'+
				'</div>';
		$(tpl).appendTo('.front_slider .item_list').hide().show('slide', {direction:'up'});
			
			if($('.itemSlide').size() == 0){
				var drgarea = null
			}else{
				var drgarea = $('.drop_area');
			}
			drgarea.live('drop', function(evt){
				var suspect = $(this);
				var source = evt.dataTransfer.files.toSource();
				$(source).appendTo(suspect);
				return false;
			})
				
		});
	});
</script>