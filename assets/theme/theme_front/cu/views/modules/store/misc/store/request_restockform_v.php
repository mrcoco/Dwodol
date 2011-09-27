<div class="request_stock_form form-ui">
	<form method="post" action="#">
	<h4 class="out_stock">Out of Stock</h4>
	<p class="confirm_msg">Dont you Mind, if we notify you when product is back in stock</p>
	<input type="hidden" name="prod_id" value="<?=$id_prod;?>" >
	<input type="hidden" name="attrb_id" value="<?=$id_attrb;?>">
	<input type="hidden" name="attrb_key" value="<?=$attrb_key;?>">
	
	<p><input type="text" name="email_twitter" value="email or twitter" id="email_twitter" class="text-input"><span class="yes_req">Yes, notify me</span></p>
	</form>
	

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			var no_req		= $('.no_req');
			var addcart_fr 	= $('.cart_form');
			var suspect		= $('.request_stock_form');
			if(addcart_fr.size() > 0){
				$('.yes_req').after('<spam class="no_req">No, Thanks</span>');
			}
			no_req.live('click', function(){
				if(addcart_fr.is(':visible') == false){
					$('.request_stock_form').hide(
						'fade', 
						{}, 
						1000 , 
						function(){ 
							$('.request_stock_for').remove(); 
							addcart_fr.show('fade', {}, 1000)
							}
						);
				}
			});
			$('.request_stock_form .yes_req').live('click', function(){
				var parent		= $(this).parent().parent().parent();
				var data_post 	= parent.find('form').serialize();	
				$.ajax({
					type : 'post',
					dataType : 'json',
					data : data_post,
					url : '<?=site_url("store/ajax_requestRestock");?>',
					success : function(data){
						if(addcart_fr.size() > 0){
						if(addcart_fr.is(':visible') == false){
							
							parent.hide('fade', {}, 1000 , function(){ suspect.remove(); addcart_fr.show('fade', {}, 1000)});
						}
						}
					}
				});
				return false;
			});
		})
	</script>
</div>
