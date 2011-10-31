<div class="form-Ui addPage">
<form action="" method="post" accept-charset="utf-8">
	<input type="text" name="title" value="Title" class="grid_500" class="text-input">
	<br/>
	<br/>

	<?ck_editor('content')?>
	<br/>
	<select name="category_id" id="category_id">
		<option value="">Select Category</option>
		<? $cats = modules::run('page/get_allcategory');
		foreach($cats->result() as $cat):?>
		
	
		
		<option value="<?=$cat->id;?>"><?=$cat->name?></option>
		
		<?endforeach?>
		
		
	</select>
	<p><input type="submit" value="Continue &rarr;" name="submit" class="button"></p>
</form>
</div>