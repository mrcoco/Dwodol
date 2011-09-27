<div class="left form-Ui">
	<form action="<?=current_url();?>" method="post" accept-charset="utf-8">
		<div class="box2 grid_500">
		<div class="inputSet">
			<div class="label"><span>Name<span></div>
			<div class="input"><input type="text" name="main_name"></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Name<span></div>
			<div class="input"><?=form_dropdown('main_group_id', $groups);?></div>
			<div class="clear"></div>
		</div>
		</div> 
		<?=load_ck_editor();?>
		<?=ck_editor('main_template')?>
		

		<p><input type="submit" name="submit" value="Save &rarr;"></p>
	</form>
</div>
<div class="clear"></div>