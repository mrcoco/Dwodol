<?=load_jq_validate()?>
<div class="cart_form form-Ui">
	<form id="addtocartform" action="" method="post" accept-charset="utf-8">
	<?if($attrbs = element('attributes', $prod)):?>
		<?foreach(prod_load_attr($attrbs) as $attrb=>$items):?>
			<select name="attr_<?=$attrb;?>" notsame="none">
				<option value="none"><?=$attrb;?></option>
				<?foreach($items as $item):?>
					<option value="<?=$item;?>"><?=$item;?></option>
				<?endforeach;?>
			</select>
		<?endforeach;?>
		<input type="hidden" name="have_attrb" value="y">
	<?else:?>
		<input type="hidden" name="have_attrb" value="n">
	<?endif;?>
		<input type="text" name="qty" value="qty" notsame="qty" class="grid_50 text-input">
		<input type="hidden" value="<?=$p->id;?>" name="id_prod"/>
		<input type="submit" name="addcart" value="Add To Cart" id="exec_add" class="button ajax">
	</form>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){

		$('#addtocartform').live('submit', function(){
			var data = $(this).serialize();
			var button = $(this).find('.button.ajax');
			var cart  = $('.viewCartWidget');
			button.addClass('onload');
			$.ajax({
				type: 'POST',
				dataType : 'json',
				data : data, 
				url : '<?=site_url("store/store_cart/ajax_buyProd");?>',
				success : function(data){
					
					if(data.status == 'on'){
						cart.replaceWith(data.new_cart);	
					}else if(data.status == 'off'){
						$('.cart_form.form-Ui').hide();
						$('.form_area').append(data.request_form);
					}
					button.delay(1500).queue(function(next){
						button.removeClass('onload');
					next();
					});
					
				}
			})
			return false;
		});

	});
	$(document).ready(function(){
		$('#addtocartform').validate();
	});
</script>