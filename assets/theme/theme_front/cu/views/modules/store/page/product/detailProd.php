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
	<div class="main_block">
	<div class="product_media left">
		<div class="otherImg left">
		
			<div class="img_list">
				<ul>
				<?foreach($m as $med){?>
					<li class="item">
					<a href='<?=site_url('store/product/thumb/980-1145-crop//dir/assets/modules/store/product_img/'.$med->path);?>' 
						class='cloud-zoom-gallery' 
						title='<?=$med->name;?>'
						rel="useZoom: 'zoom1', smallImage: '<?=site_url('store/product/thumb/360-420-crop/dir/assets/modules/store/product_img/'.$med->path);?>' ">
	        			<img src="<?=site_url('store/product/thumb/90-80-crop/dir/assets/modules/store/product_img/'.$med->path);?>"   
							alt ="<?=$med->name;?>"/>
					</a>

				</li>

				<?}?>
				</ul>
			</div>
		
		</div>
		<span class="cur_step"></span>
		<script language="javascript">
			dw_carousel();
			function dw_carousel(){

				var stp = $('.cur_step');
				var canvas 		= $('.img_list');
				var wrap		= canvas.find('ul');
				var item   		= canvas.find('li.item');
				var num    		= item.size();
				var item_h 		= item.outerHeight(true);
				var item_w 		= item.outerWidth(true);
				var visible 	= 4;
				var step 		= 1;
				var speed 		= 500;
				var av_step 	= Math.ceil((num-visible)/step);
				var cur_step 	= 0;
				var itm_bot_mrg = item.css('margin-bottom').substring(0,(item.css('margin-bottom').length-2));
				var screnn_h 	= item_h*visible;
				var cur_item 	= 0;
				if(num > 4){
					canvas.before('	<div class="nav up"></div>');
					canvas.after('	<div class="nav down"></div>');
					var next 		= $('.nav.down');
					var prev 		= $('.nav.up');
				
				}else{
					canvas.addClass('single_screen');
					return false;
				}
				canvas.css({
					'height' 	: (item_h*visible)-itm_bot_mrg+'px',
					'position' 	: 'relative', 
					'visibility': 'visible', 
					'overflow' 	: 'hidden' 
				}) ;
				wrap.css({
					'height' 	: item_h*num+'px', 
					'position'	: 'absolute'
				});	
				
				next.click(function(){
				
					if(cur_step <= av_step ){
					
						if(cur_step < av_step  && cur_step != av_step){
						
							cur_step = cur_step + 1;
							cur_item = cur_item + step;
						
							wrap.animate(
								{	
									top: -(item_h * cur_item) ,
									opacity: 0.5,
								}, 
								speed, 
								function(){
									wrap.animate(
										{	
											opacity: 1,
										})
								}
							);
						}else if(cur_step == av_step ){
							cur_step = 0;
							cur_item = 0;
							wrap.animate(
								{
									top : 0,
									opacity: 0.5,
								},
								speed,
								function(){
									wrap.animate(
										{	
											opacity: 1,
										})
								}
							)
						}
					
				
						
					}
					
					
				});
				prev.click(function(){
				
					if(cur_step <= av_step ){
					
						if(cur_step <= av_step  && cur_step != 0){
						
							cur_step = cur_step - 1;
							cur_item = cur_item - step;
						
							wrap.animate(
								{	opacity: 0.5,
									top: -(item_h * cur_item)
								}, 
								speed, 
								function(){
									wrap.animate(
										{	
											opacity: 1,
										})
								}
							);
						}else if(cur_step == 0 ){
							
							cur_step = av_step;
							cur_item = av_step;
							
							wrap.animate(
								{
									opacity: 0.5,
									top : -(item_h * (step*av_step))
								},
								speed,
								function(){
									wrap.animate(
										{	
											opacity: 1,
										})
								}
							)
						}
					
				
						
					}
					
				});
			
			
			
				
			};
		</script>
		<div class="currentImg right">
			<a href='<?=site_url('store/product/thumb/980-1145-crop/dir/assets/modules/store/product_img/'.$defimg->path);?>' 
				class = 'cloud-zoom' 
				id='zoom1'
				rel="position: 'inside' ,tint: '#ffffff',tintOpacity:0.5 ,smoothMove:5,zoomWidth:300,zoomHeight:400">
	        	<img  src="<?=site_url('store/product/thumb/360-420-crop/dir/assets/modules/store/product_img/'.$defimg->path);?>"
					class="zoom_curent_img" 
					alt='' 
					title="<?=$defimg->name;?>" />
	    	</a>
		</div>
		<div class="clear"></div>
		
		<script type="text/javascript" charset="utf-8">
			$('.otherImg .item').each(function(index, value){
				index = index+1;
				if(index%4 == 0){
					$(this).addClass('last_in_line_item');
				}
			});
		</script>
	</div>
	<div class="product_content right">
		<div class="head_prod">
		<h1 class="product_name text_center timeless"><?=element('product', $prod)->name?></h1>
			<p class="text_center cat_name">Tops</p>
		<p class="price"><?=prod_price(element('product', $prod)->id)?></p>
		</div>
		<div class="content">
		<div class="content_desc v_ctr"><?=element('product', $prod)->l_desc?>
			<div class="clear"></div>
			
		</div>

		</div>
	
		<div class="prev_next">
			<div class="right"><?=prod_next_link(element('product', $prod)->id)?></div>
			<div class="left"><?=prod_prev_link(element('product', $prod)->id)?></div>
			<div class="clear"></div>
		</div>
			
		<div class="list_decor_right"></div>
	
	</div>	

</div>

	<div class="clear"></div>
		<div class="product_tool">

			<div class="form_area">
				<?=modules::run('store/store_cart/addToCartForm', element('attributes', $prod), element('product', $prod));?>
			</div>


		</div>
	<div class="product_relation">
	<?if(element('relations', $prod)):?>
	<h4>Relations</h4>
	<?foreach(element('relations', $prod) as $rel) : $rel?>
		<?=prod_snap($rel->p_rel)?>
	<?endforeach;endif;?>
	<div class="clear"></div>	
	</div>

	

</div>
