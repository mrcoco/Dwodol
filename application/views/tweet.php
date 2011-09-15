<?=print_arrayRecrusive($tw_data);?>
<form action="<?=current_url();?>" method="post" accept-charset="utf-8" ENCTYPE="multipart/form-data">
	<textarea name="status" rows="8" cols="40"></textarea>
	<input type="file" name="media" value="" id="media">
	<p><input type="submit" name="send_tweet" class="button" value="Update &rarr;"></p>
</form>
