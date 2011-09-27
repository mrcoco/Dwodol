<div class="shipping_method">
	<?=$cart;?>
	
	<form method="post" action="<?=current_url();?>">
		<div class="all_shippers">
			<div class="loader">
					<p class="text_center">Please White, we determine your shipping cost</p>
			<div class="ctr grid_50">
			<?=ajax_loader();?>
			</div>
			</div>
		</div>
	<input type="submit" name="next" value="next" class="button">
 </form>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		//$('.all_shippers').hide();
		$.ajax({
			url : '<?=site_url("store/checkout/ajax?act=load_ship");?>',
			type : 'get',
			dataType : 'json',
			success : function(res){
				if(res.status == 'success'){
					var new_el = $('<div class="res">'+res.all_shippers+'</div>').appendTo('.all_shippers').hide();
					$('.loader').hide('fade', {}, 500, function(){
							new_el.show('fade');
					});

					
				}
			}
		})
	})
</script>