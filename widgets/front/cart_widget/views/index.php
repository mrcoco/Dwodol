<div class="viewCartWidget widget smallcart" id="cart_wid">
	<?if($total_item == 0){?>
	<p>Your Cart Is Empty</p>
		<?}else{?>
	<p><span class="totalitems"><?=$total_item?></span> items, <span class="totalcartvalue"><?=show_price($total_price);?></span> | <a href="<?=site_url('store/cart/viewcart');?>"><span class="">View Cart</span></a> <a href="<?=site_url('store/checkout');?>"><span class="">checkout</span></a></p>
	<?}?>
</div>