
<div class="chekout_bar_step">
	<span <?=($method == 'buyerinfo') ? $active : '';?>><a href="<?=site_url('store/checkout/buyerinfo');?>">Contact Detail</a></span>
	<span <?=($method == 'shipping_method') ? $active : '';?>><a href="<?=site_url('store/checkout/shipping_method');?>">Shipping</a></span>
	<span <?=($method == 'payment') ? $active : '';?>><a href="<?=site_url('store/checkout/payment');?>">Payment</a></span>
	<span <?=($method == 'summary') ? $active : '';?>><a href="<?=site_url('store/checkout/summary');?>">Summary</a></span>
</div>