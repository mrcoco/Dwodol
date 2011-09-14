<div class="form-Ui">
	<form action="<?=current_url();?>" method="post" accept-charset="utf-8">
		<div class="inputSet">
			<div class="label"><span>First Name<span></div>
			<div class="input"><input name="main_first_name" type="text"></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Last Name<span></div>
			<div class="input"><input name="main_last_name" type="text"></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>EMail<span></div>
			<div class="input"><input name="main_email" type="text"></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Twiiter Account<span></div>
			<div class="input"><input name="ext_twitter_account" type="text"></div>
			<div class="clear"></div>
		</div>
		
		<p><input type="submit" name="submit" value="Continue &rarr;"></p>
	</form>
	<?if(isset($data)) echo print_arrayRecrusive($data)?>
</div>