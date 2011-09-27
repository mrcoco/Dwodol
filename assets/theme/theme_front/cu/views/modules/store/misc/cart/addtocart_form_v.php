<?=load_jq_validate()?>
<div class="cart_form form-Ui">
	<h4>Add To Cart</h4>
	<form id="addtocartform" action="" method="post" accept-charset="utf-8">
	<?if($attrbs = element('attributes', $prod)):?>
		<div class="attr_option">
		<?foreach(prod_load_attr($attrbs) as $attrb=>$items):?>
			<div class="option_item">
			<select name="attr_<?=$attrb;?>" notsame="none">
				<option value="none"><?=$attrb;?></option>
				<?foreach($items as $item):?>
					<option value="<?=$item;?>"><?=$item;?></option>
				<?endforeach;?>
			</select>
			</div>
		<?endforeach;?>
		</div>
		<div class="clear"></div>
		<input type="hidden" name="have_attrb" value="y">
	<?else:?>
		<input type="hidden" name="have_attrb" value="n">
	<?endif;?>
		<div class="clear"></div>
		<p class="submit_qty">
			<input type="text" name="qty" value="qty" notsame="qty" class="text-input">
			<input type="submit" name="addcart" value="Add To Cart" id="exec_add" class="ajax">
	
		</p>
		<input type="hidden" value="<?=$p->id;?>" name="id_prod"/>
		
	</form>
</div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){

		$('#addtocartform').live('submit', function(){
			var data = $(this).serialize();
			var button = $(this).find('#exec_add');
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
						$('.cart_form.form-Ui').hide('fade' ,{} , 500, function(){
							$(data.request_form).appendTo('.form_area').hide().show('fade', {}, 500);
						});

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
		var validator = $("#addtocartform").validate();
	});
</script>