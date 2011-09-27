<div class="left form-Ui">
	<form action="<?=current_url();?>" method="post" accept-charset="utf-8">
		<div class="box2 grid_500">
		<div class="inputSet">
			<div class="label"><span>Name<span></div>
			<div class="input"><input type="text" name="main_name" value="<?=$grp->name;?>"></div>
			<div class="clear"></div>
		</div>
		
		</div> 
		<?=load_ck_editor();?>
		<?=ck_editor('main_desc', false, $grp->desc)?>
		

		<p><input type="submit" name="submit" value="Save &rarr;"></p>
	</form>
</div>
<div class="clear"></div>