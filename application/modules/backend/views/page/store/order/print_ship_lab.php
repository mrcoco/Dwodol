<?foreach($labels as $item):?>
	<div class="label_wrap">
		<div class="name"><?=$item->first_name.' '.$item->last_name?></div>
		<div class="address">
			<p><?=$item->address?><br>
			<?=$item->zip?></p>
			<p><?=$item->province?></p>
		</div>
		<div class="phone"></div>
		<div class="barcode">
			
			<div class="img">
			<img src="<?=site_url('store/order/barcode/'.$item->order_id.'.jpg');?>">
			</div>
			<div class="order_num">
			<?=strtoupper($this->dodol->conf('store', 'barcode_prefix').'_'.$item->order_id);?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
<?endforeach;?>