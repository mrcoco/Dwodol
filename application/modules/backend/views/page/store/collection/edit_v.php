<div class="edit_collection">
<div class="form-Ui">
		<form action="" method="POST" enctype="multipart/form-data">
			<input type="text" name="title" value="<?=$coll->name?>" class="grid_500 mb10">
			

		<?ck_editor('text_editor', false, $coll->description)?>
		<script>
		$(document).ready(function(){

			$(".hasTime").datetimepicker({
				dateFormat:"yy-mm-dd",
				timeFormat: 'hh:mm:ss'
				});
		});
		</script>
		<br/>
		<div class="grid_250 mr20 left">
			<input type="text" name="p_date" value="<?=$coll->p_date;?>" class="hasTime">
		</div>
		<div class="grid_250 left">
			<input type="file" name="img_file" value=""><br class="clear">
		</div>

		<div class="clear"></div>
					<br/>
			<input type="submit" name="submit" value="Update Collection" class="button">
		</form>
</div>
</div>

<div class="clear"></div>