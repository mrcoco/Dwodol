<?if($prod){?>
	<?$price = modules::run('store/product/prod_price', $prod->id)?>
<div class="productSnap">
	<div class="productImg relative">
		<div class="label absolute">
			<?=prod_label($prod->id)?>
		</div>
		<? if($media){ ?>
			<a href="<?=site_url('store/prod/'.$prod->id.'/'.nice_strlink($prod->name));?>">
		<img class="prod" src="<?=site_url('store/product/thumb/223-270-crop/dir/assets/modules/store/product_img/'.$media->path);?>" alt="<?=$media->name?>">
			</a>
		<?}?>
		
		<div class="w_50 ctr snap_tool">
		  <div class="triangle ctr"></div>
		  <h3 class="prod_name"><?=$prod->name?></h3>
		<div class="product_detail">
			<div class="left"><a href="<?=site_url('store/prod/'.$prod->id.'/'.nice_strlink($prod->name));?>"><span class="productame">View Detail</span></a></div>
			<div class="right"><span class="finalPrice"><?=$price['formated']?></span></div>
			<div class="clear"></div>
		</div>
		
		</div>
		
	</div>

	
</div>
<?}?>