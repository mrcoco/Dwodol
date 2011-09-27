<div class="left left_grid grid_250">
<div class="shipping_label_form">
	<form action="" method="post" accept-charset="utf-8">
		<div class="itemInput box2">
		
		<label>Order id</label>
		<input type="text" name="oid" value="">
		</div>
		
		<div class="itemInput box2">
		<label>Status</label>
		<?=form_dropdown('status', $statuses)?>
		</div>
		
		<div class="itemInput box2">
		<h6>Date Range</h6>
		<label>Start Date</label>
		<input type="text" class="hasdate" name="s_date" value="">
		<div class="clear"></div>
		
		<label>End Date</label>
		<input type="text" name="e_date" class="hasdate" value="">
		</div>
		<input type="submit" value="Continue &rarr;">
	</form>
</div>
</div>
<div class="left right_grid grid_700">
	<h6>Preview</h6>
	<div class="preview_layer">
		<div class="tool right"><a class="hide btnPrint" href="" id="print_trigger">Print</a></div>
		<div class="clear"></div>
		<div class="iframe hide">
			<iframe id="print_preview" src="<?=site_url();?>"></iframe>
		</div>
	</div>
</div>
<div class="clear"></div>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".btnPrint").printPage();
		$('.shipping_label_form form').submit(function(){
		$('.iframe').hide();
		var	prv_lyr = $('.preview_layer');
		var iF = $('#print_preview');
		var query = $(this).serializeArray();
		var prn_trg = $('#print_trigger');
		var new_src = "<?=site_url('backend/store/b_order/print_ship_lab?');?>"+$.param(query);
		iF.attr('src', new_src+'&prev=y&width=650');
		prn_trg.attr('href', new_src);
		$('.iframe').show();
		iF.show();
		prn_trg.show();
		return false;	
		});
		
	});
</script>
