<div class="request_stock_form form-ui grid_250">
	<form method="post" action="#">
	<p>Please Insert Your email or Twitter, and we'ill notify you soon when product available</p>
	<input type="hidden" name="prod_id" value="<?=$id_prod;?>" >
	<?if($id_attrb != false) echo '<input type="hidden" name="attrb_id" value="<?=$id_attrb;?>"> ';?> 
	<?if($attrb_key != false)echo '<input type="hidden" name="attrb_key" value="<?=$attrb_key;?>">';?>
	<p><input type="text" name="email_twitter" value="email or twitter" id="email_twitter" class="text-input grid_200"><span><input type="submit" name="submit_request" class="button ajax" value="Submit" id="submit_request"></span><p>
	</form>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('.request_stock_form form').live('submit', function(){
			var button 		= $(this).find('.button.ajax');
			var data_post 	= $(this).serialize();
			button.addClass('onload');
			$.ajax({
				type : 'post',
				dataType : 'json',
				data : data_post,
				url : '<?=site_url("store/ajax_requestRestock");?>',
				success : function(data){
					
				}
			});
			return false;
		});
	})
</script>