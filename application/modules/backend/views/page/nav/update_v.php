<div class="grid_500 ctr box2">
	<div class="form-Ui">
		<form action="<?=current_url()?>" method="post">
		<div class="inputSet">	
			<div class="label"><span>Name Navigation</span></div>
			<div class="input"><input name="name" type="text" value="<?=$nav->name?>" /></div>
			<div class="clear"></div>
		</div>
		<div class="desc">
			<span>Description</span>

			<?ck_editor('description',false, $nav->description)?>
		</div>
		<div class="right">
			<input type="submit" name="update" value="Submit" class="button save-button-Ui">
		</div>
		<div class="clear"></div>
		</form>
	</div>
</div>