<div class="order_detail">
	<div class="left_pane grid_250 left">
		<img src="<?=site_url('store/order/barcode/'.$order->id.'.jpg');?>"/>
		<div class="box2 customer_data">
			
			<div class="left photo_user grid_60 mr10">
				
				
			</div>
			<div class="left data_user grid_130">
			<p>
				<span class="bold"><?echo $order->user->first_name.' '.$order->user->last_name;?></span>
				<br/>
				<span><?echo $order->user->mobile;?></span>
				<br/>
				<span><?echo $order->user->email;?></span>
			</p>
			</div>
			<div class="clear"></div>
		</div>
		<div class="mt20 billing">
			<h3 class="bold">Billing Address</h3>
			<p>
				<?echo $order->billing_data->first_name.' '.$order->billing_data->last_name;?><br/>
				<?= $order->billing_data->address;?><br/>
				<?= $order->billing_data->zip?>, <?= $order->billing_data->city?><br/>
				<?= $order->billing_data->province?><br/>
				<?=modules::run('store/getCountry', $order->billing_data->country_id)?>
			</p>
		</div>
		<div class="mt20 shipping">
			<h3 class="bold">Shipping Address</h3>
			<p>
				<?echo $order->shipto_data->first_name.' '.$order->shipto_data->last_name;?><br/>
				<?= $order->shipto_data->address;?><br/>
				<?= $order->shipto_data->zip?>, <?= $order->shipto_data->city?><br/>
				<?= $order->shipto_data->province?><br/>
				<?=modules::run('store/getCountry', $order->shipto_data->country_id)?>
			</p>
		</div>
	</div>
	<div class="main_pane right grid_650">
		<div class="box2 payment_shipping mb20">
			<h3>Payment Method</h3>
			<span class="left"><?=$order->payment_method?></span>
			<span class="right"><?=show_price($order->total_amount);?></span>
			<br class="clear"/>
			<div class="horline"></div>
			<h3>Shipping Method</h3>
			<span class="left"><?=strtoupper($order->ship_carrier)?> | <?=$order->ship_carrier_service?></span>
			<span class="right"><?=show_price($order->ship_fee)?></span>
			<br class="clear">
		</div>
		<div class="table-Ui order_items">
			<table>
				<thead>
					<tr>
						<td>SKU</td>
						<td>Name</td>
						<td>Price</td>
						<td>Qty</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody>
				
			<?foreach($order->product_item as $item):?>
					<tr>
						<td><?=$this->load->model('store/product_m')->getbyid($item->id_prod, false, 'sku', false)->sku;?></td>
						<td><?=$this->load->model('store/product_m')->getbyid($item->id_prod, false, 'prod.name', false)->name;?></td>
						<td><?=$this->cart->show_price($item->price)?></td>
						<td><?=$item->qty?></td>
						<td class="text_right"><?=$this->cart->show_price($item->price*$item->qty);?></td>
					</tr>
			<?endforeach;?>
					<tr>
						<td colspan="4" class="text_right">Subtotal</td>
						<td class="text_right"><?=$this->cart->show_price($order->sub_amount)?></td>
					</tr>
					<tr>
						<td colspan="4" class="text_right">Shipping</td>
						<td class="text_right"><?=$this->cart->show_price($order->ship_fee)?></td>
					</tr>
					<tr class="final_total">
						<td colspan="4" class="text_right"><span class="bold">Total</span></td>
						<td class="text_right"><?=$this->cart->show_price($order->total_amount)?></td>
					</tr>
			</tbody>
			</table>
		</div>
		<?if($order->customer_note != null):?>
		<div class="customer_note">
			<h3>Customer Note :</h3>
			<div class="box2">
				<?=$order->customer_note?>
			</div>
			
		</div>
		<?endif?>
	
		<?if($order->history):?>
		
		<div class="order_history mt20">
		<h3>Order Feed</h3>
			<ul>
		<?foreach($order_history->result() as $item):?>
			<li class="">
				<div class="feed_item">
					<span class="date"><?=custom_time($item->c_date)?></span> |
					<span class="bold <?=$item->type;?>"><?=$item->type;?></span>
				</div>
			</li>
		<?endforeach?>
			</ul>
		</div>
		<?endif;?>
	</div>
	<div class="clear"></div>
</div>