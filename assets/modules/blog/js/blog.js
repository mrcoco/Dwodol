$(document).ready(function(){
	$('.blog_content img').each(function(index, value){
		var img = $(this);
		var img_pos = img.css('float');
		var width = img.width();
		if(img_pos == 'none'){
			img_pos = 'ctr';
		}
		var caption = $(this).attr('alt');
		var tmpl = '<div class="img_caption '+img_pos+'" style="width:'+width+'px">';
		if(caption != ''){
			$(this).wrap(tmpl).after('<p>'+caption+'</p>');
		}
	});
});