<div class="table-Ui ups_carrier">
	<div class="carrier_logo">
		<img src="<?=base_url();?>/assets/modules/store/carrier_logo/ups_logo.png" alt="UPS" height="50">
	</div>
	<table>
		<thead>
		<tr>
			<?foreach($index_header as $head):?>
			<td><?=str_replace('_', ' ',$head)?></td>
			<?endforeach;?>
		</tr>
		</thead>
		<tbody>
			<?foreach($data as $item):?>
			<tr> 
					<td class="grid_300">
						<div class="ui_choose">
						<span class="service"><?=element('service', $item);?></span>
						<input type="radio" class="hide" name="rate_id" value="<?=element('ups_rate_id', $item);?>">				</div>
					</td>
						
					<td><?=show_price(element('basic_charge', $item));?></td>
					<td><?=show_price(element('option_charge', $item));?></td>
					<td><?=show_price(element('total_charge', $item));?></td>
					<td><?=element('days', $item);?></td>
					<td><?=element('times', $item);?></td>
			</tr>
			<?endforeach?>
		</tbody>
	</table>
	
	
</div>


<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('.ups_carrier .ui_choose .service').click(function(){
			$('.ups_carrier .ui_choose .service').removeClass('selected');
			$(this).addClass('selected');
			$(this).next().attr('checked', true )
		});
	});
</script>
