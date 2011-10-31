
<div class="heading"></div>
<div class="body font80">
	<div class="msg"></msg>
	<div class="order_item ">
		<div class="table-Ui">
			<table>
			<thead>
			<tr>
				<td class="grid_70">SKU</td>
				<td class="grid_240">Product Name</td>
				<td class="grid_30">QTY</td>
				<td class="grid_100">Price</td>
				<td>Sub Total</td>
			<tr>
			</thead>
			<tbody>
			<?foreach($order->product_item as $p): $the_p = prod_detail($p->id_prod, $p->id_attr)?>
			
			<tr>
				<td><?=$the_p->sku?></td>
				<td>
					<div class="prod_img left mr10"><img src="<?=prod_media($p->id_prod, '50-50-crop');?>"></div>
					<div class="prod_name"><p><span class="bold"><?=$the_p->name?></span><p>
						<?=($the_p->attr != false) ? prod_attr_to_word($the_p->attr->attribute) : ''?>
						</div>
					<div class="clear"></div>
				</td>
				<td><?=$p->qty?></td>
				<td><?=show_price($p->price);?></td>
				<td class="text_right"><?=show_price($p->price_total);?></td>
			<tr>
			<?endforeach?>
				<tr>
					<td colspan="4" class="text_right">Shipping Fee <?=$order->shipping_carrier?></td>
					<td class="text_right bold"><?=show_price($order->shipping_fee)?></td>
				</tr>
				<tr>
					<td colspan="4" class="text_right bold">Total Amount</td>
					<td class="text_right bold"><?=show_price($order->total_amount)?></td>
				</tr>
				
			</tbody>
			</table>
		</div>
	</div>
	
	<div class="clear"></div>
	<div class="meta">
		<div class="billing_data left w_50">
			
			
			<h4>Billing Information</h4>
			<div class="data_rowSet">
				<div class="label">Name </div>
				<div class="data"><?=$order->billing_data->first_name .' '. $order->billing_data->last_name?></div>
				<div class="clear"></div>
			</div>

			<div class="data_rowSet">
				<div class="label">Email </div>
				<div class="data"><?=$order->billing_data->email?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Address </div>
				<div class="data"><?=$order->billing_data->address?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Country </div>
				<div class="data"><?=modules::run('store/getCountry', $order->billing_data->country_id)?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Province </div>
				<div class="data"><?=$order->billing_data->province?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">First Name </div>
				<div class="data"><?=$order->billing_data->city?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Zip </div>
				<div class="data"><?=$order->billing_data->zip?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Phone </div>
				<div class="data"><?=$order->billing_data->phone?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">mobile</div>
				<div class="data"><?=$order->billing_data->mobile?></div>
				<div class="clear"></div>
			</div>
			<div class="data_rowSet">
				<div class="label">Payment Method</div>
				<div class="data"><?=$order->payment_method?></div>
				<div class="clear"></div>
			</div>

		</div>
		<div class="shipping_data right w_50">
			<h3>Aimed to</h3>
					<div class="data_rowSet">
						<div class="label">Name </div>
						<div class="data"><?=$order->shipto_data->first_name .' '. $order->shipto_data->last_name?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Address </div>
						<div class="data"><?=$order->shipto_data->address?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Country </div>
						<div class="data"><?=modules::run('store/getCountry', $order->shipto_data->country_id)?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Province </div>
						<div class="data"><?=$order->shipto_data->province?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">First Name </div>
						<div class="data"><?=$order->shipto_data->city?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Zip </div>
						<div class="data"><?=$order->shipto_data->zip?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">Phone </div>
						<div class="data"><?=$order->shipto_data->phone?></div>
						<div class="clear"></div>
					</div>
					<div class="data_rowSet">
						<div class="label">mobile</div>
						<div class="data"><?=$order->shipto_data->mobile?></div>
						<div class="clear"></div>
					</div>
		</div>
		<div class="clear"></div>
		<div class="payment">
			
		</div>
	</div>
</div>