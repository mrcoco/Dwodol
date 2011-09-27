<?=load_ck_editor()?>
<div class="form-Ui createPost">
<form action="" method="post" accept-charset="utf-8">
	<div class="grid_650 left">
		<div class="title  mb20" ><label>Title : </label>
		<input type="text" name="bl_title" value="" class="grid_630">
		</div>
		<div class="box2">
		<?=ck_editor('bl_content')?>
		</div>
	</div>
	
	<div class="blog_meta box2 grid_250 right">
		<div class="left"><input type="submit" name="publish" value="Publish" class="button"></div>
		<div class="left ml20"><input type="submit" name="save" value="Save" class="button"></div>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$('input[name="publish"]').hover(function(){
						$('input[name="bl_status"]').val('publish');
				});
				$('input[name="save"]').hover(function(){
						$('input[name="bl_status"]').val('draft');
				});
			});
		</script>
		<input type="hidden" name="bl_status" value="" id="bl_publish">
		<div class="clear mb10"></div>
		<div class="horline mb10"></div>
		
		<div class="inputSet">
		
			<div class="label"><span>Category</span></div>
			<div class="input relative">
				<?=form_dropdown('bl_cat_id', cat_array())?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Tag</span></div>
			<div class="input">
				<input type="text" name="tag" value="" id="tag">
			</div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Publish Date</span></div>
			<div class="input">
					<script>
					$(document).ready(function(){

					$(".hasTime").datetimepicker({
						dateFormat:"yy-mm-dd",
						timeFormat: 'hh:mm:ss'
						});
					});
					</script>
				<input type="text" name="bl_p_date" value="" class="hasTime">
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	
</form>
</div>