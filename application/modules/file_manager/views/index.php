<div class="main_section">
	<div class='toolbar'>
		<div class="left">
		<span class="tool up"> Upper 	</span>
		<span class="nav_path_address"><input type="text" name="path_address" class="grid_500" value="<?=$path;?>"></span>
		<span class="tool go"> go </span>
		</div>
		<div class="right">
			<span class="tool new_folder"> New Folder	</span>
			<span class="tool upload"> Upload	</span>
		</div>
		<div class="clear"></div>
		
	</div>
	<div class="layer_main">
	<?=$items?>
	</div>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			// go to specify folder by click
			$('.folder_container .icon_file.dir').live('click',function(){
				var path = $(this).parent().attr('path');
				$('.toolbar input[name="path_address"]').val(path);
					$.ajax({
						type : "POST",
						dataType : "json",
						data : {path : path},
						url : "<?=site_url('file_manager/ajx_request_all');?>",
						success : function(data){
							if(data.msg == 1){
								$('.layer_main .folder_container').hide('drop' , {}, 500, function(){$(this).remove()});
								$(data.items).prependTo('.layer_main').hide().delay(500).show('drop' , {direction: 'right'});
							}
						}
					});
			});
			
			// Go Upper
			$('.toolbar .up').click(function(){
			
				var path = $('.toolbar input[name="path_address"]').val().split('/');
				path.pop();
				path.pop();
				var path = path.join('/')+'/';
				
				$('.toolbar input[name="path_address"]').val(path);
					$.ajax({
						type : "POST",
						dataType : "json",
						data : {path : path},
						url : "<?=site_url('file_manager/ajx_request_all');?>",
						success : function(data){
							if(data.msg == 1){
								$('.layer_main .folder_container').hide('drop' , {direction:'rigth'}, 500, function(){$(this).remove()});
								$(data.items).prependTo('.layer_main').hide().delay(500).show('drop' , {direction: 'left'});
							}
						}
					});
				
			});
			
			//go to path , with specify input
			$('.toolbar .go').click(function(){
				var path = $('.toolbar input[name="path_address"]').val();
				alert(path);
			});
			
			$('.toolbar .new_folder').live('click',function(){
				var new_object = '<div path="" class="item new_folder"><div class="icon_file dir"><span class="file_extension">dir</span></div><p><span class="file_name "><input name="new_folder_name" value="untitled folder"></span></p></div>'
				var new_object = $(new_object).prependTo('.folder_container');
				new_object.hide().show('drop', {}, 500, add_folder);
			
				
			});
			function add_folder() {
				var new_folder_name = $('.new_folder input[name="new_folder_name"]');
				var path = $('.folder_container').attr('path');
				new_folder_name.focus().select();
			
				new_folder_name.keyup(function(e) {
			    //alert(e.keyCode);
				var post_data = { path : path+new_folder_name.val()}
			    if(e.keyCode == 13) {
			    		$.ajax({
							type : "POST",
							dataType : "json",
							data : post_data,
							url : "<?=site_url('file_manager/ajx_crt_folder');?>",
							success : function(data){
								if(data.msg == 1){
									$('.item.new_folder').attr('path',path+new_folder_name.val() );
									$('.item.new_folder .file_name input').remove();
									$('.item.new_folder .file_name').text(new_folder_name.val());
									$('.item.new_folder').removeClass('new_folder');
								}else{
									$('.item.new_folder').hide('drop', {}, 500, remove_el('.item.new_folder'));
								}
							}
						});
			    }
			    });
				
			
				
			};
			function remove_el(element){
				var element = element;
				$(element).remove();
			}
		});
	</script>
</div>
<div class="clear"></div>
