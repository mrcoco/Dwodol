<? if($order_data->ship_fee > 0 ) 
	$nclude = 'include shipping and Packing '.show_price($order_data->ship_fee);
	else
	$nclude = 'Not include shipping and Packing';
?>
<div class="order_detail ctr">
	<div class="barcode left">
		<img src="<?=site_url('store/order/barcode/'.$order_data->id.'.jpg');?>">
		<p>CU-<?=$order_data->id?></p>
	</div>
	<div class="eglible">
		<p>Amount Have to Pay </p>
		<h1><?=show_price($order_data->total_amount)?></h1>
		<p class="include"><?=$nclude?></p>
	</div>

	<div class="clear"></div>
</div>
<?=$this->cart->payment_action();?>