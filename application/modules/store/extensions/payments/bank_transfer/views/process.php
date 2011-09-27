<div class="ctr grid_500">
	<div class="description">
		<?=$payment->description;?>
	</div>
	<p class="confirm"> Have You Pay Complete it ? </p>
	<p class="confirm">
		<span class="button"><a href="<?=site_url('/');?>">Not Yet, i'll Complete it Letter'</a></span>
		<span class="button"><a href="<?=site_url('store/order/confirm_payment/?oid='.$order_data->id);?>">Yes, and i want confirm it</a></span>
	</p>
</div>