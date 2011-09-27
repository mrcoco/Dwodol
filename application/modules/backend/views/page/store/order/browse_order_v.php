<div class="clear"></div>
<div class="list_order">
	<?if($orders):?>
	<div class="table-Ui">
		<table>
			<thead>
				<tr>
					<td class="grid_70">No.Order</td>
					<td class="grid_200">Date</td>
					<td class="grid_250">Placed By</td>
					<td class="grid_100">Status</td>
					<td class="grid_250">Total</td>
					<td>Action</td>
				</tr>
			</thead>
			<?foreach($orders as $order):?>
		
				<tr>
					<td>#<?=$order->id_order?></td>
					<td><?=show_date($order->c_date)?></td>
					<td><?echo $order->first_name.' '.$order->last_name;?></td>
					<td><?=$order->status?></td>
					<td><span class="bold"><?=show_price($order->total_amount)?></span></td>
					<td class="action">
							<a href="<?=site_url('backend/store/b_order/view/'.$order->id_order);?>"><span class="act view"></span></a>
						<a href="<?=site_url('backend/store/b_order/delete/'.$order->id_order);?>"><span class="act del"></span></a>
					</td>
				</tr>
			<?endforeach;?>
		</table>
	</div>
	<div class="pagination right"><?=$this->dodol_paging->make_link();?></div>
	<div class="clear"></div>
	<?else:?>
	there's no order yet
	<?endif;?>
</div>