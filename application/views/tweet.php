<?=print_arrayRecrusive($token);?>
<?=print_arrayRecrusive($tw_data);?>
<form action="<?=current_url();?>" method="post" accept-charset="utf-8">
	<textarea name="status" rows="8" cols="40"></textarea>

	<p><input type="submit" name="send_tweet" class="button" value="Update &rarr;"></p>
</form>
