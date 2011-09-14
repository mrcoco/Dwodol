<script>
$(document).ready(function(){
	$('a.cloud-zoom-gallery').click(function(){
		var title = $(this).attr('title');
		$('img.zoom_curent_img').attr('title', title);
	});
});
</script>
<? $defimg = element('media', $prod); $m = element('medias', $prod);?>
<div class="view_product">
	<div class="product_content left">
		<h1 class="product_name text_center"><?=element('product', $prod)->name?></h1>
		<p><?=prod_price(element('product', $prod)->id)?></p>
		<span>stock : <?=element('product', $prod)->stock;?></span>
		<div class="content"><?=element('product', $prod)->l_desc?></div>
		<br class="clear"/>
		<span class="right"><?=prod_next_link(element('product', $prod)->id)?></span>
		<span class="left"><?=prod_prev_link(element('product', $prod)->id)?></span>
		<br class="clear"/>
		
	</div>	
	

	<div class="product_media right">
		<div class="currentImg grid_320">
			<a href='<?=site_url('store/product/thumb/960-1260-crop/dir/assets/modules/store/product_img/'.$defimg->path);?>' 
				class = 'cloud-zoom' 
				id='zoom1'
				rel="position: 'inside' ,tint: '#ffffff',tintOpacity:0.5 ,smoothMove:10,zoomWidth:300,zoomHeight:400">
	        	<img  src="<?=site_url('store/product/thumb/320-420-crop/dir/assets/modules/store/product_img/'.$defimg->path);?>"
					class="zoom_curent_img" 
					alt='' 
					title="<?=$defimg->name;?>" />
	    	</a>
		</div>
	
		<div class="otherImg">
				<?foreach($m as $med){?>
					<div class="item left">
					<a href='<?=site_url('store/product/thumb/960-1260-crop/dir/assets/modules/store/product_img/'.$med->path);?>' 
						class='cloud-zoom-gallery' 
						title='<?=$med->name;?>'
						rel="useZoom: 'zoom1', smallImage: '<?=site_url('store/product/thumb/320-420-crop/dir/assets/modules/store/product_img/'.$med->path);?>' ">
	        			<img src="<?=site_url('store/product/thumb/75-75-crop/dir/assets/modules/store/product_img/'.$med->path);?>"   
							alt ="<?=$med->name;?>"/>
					</a>

				</div>

				<?}?>
			<div class="clear"></div>	
		</div>
		
	</div>
	<div class="clear"></div>
	<div class="product_tool">
	
		<div class="form_area">
			<?=modules::run('store/store_cart/addToCartForm', element('attributes', $prod), element('product', $prod));?>
		</div>

	
	</div>	
	<div class="clear"></div>
	
	<div class="decor hide">
		
		<img class="right" src="<?=site_url('store/product/thumb/1000-300-crop/dir/assets/modules/store/product_img/'.$defimg->path);?>"
			alt='<?=element('product', $prod)->name?>' 
			title="<?=$defimg->name;?>" />
		<div class="right cover"></div>
		<div class="clear"></div>
	</div>
</div>
