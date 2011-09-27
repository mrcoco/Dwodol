<div class="summary_cart">

	<div class="itemlist left">
		<?foreach($items as $item ):?>
		 <div class="item left mr10">
			<div class="img_item left">
			
	    	<img src="<?=prod_media(element('id', $item), '100-100-crop');?>">
			</div>
			<div class="item_detail left">
				<div class="name"><h6><?=element('name', $item)?></h6>
				<small><?=($opt = element('options', $item))  ? prod_attr_to_word($opt) : '';?>	</small>
				</div>
				<p><? echo element('qty', $item).' x '.$this->cart->show_price(element('price', $item)) ?></p>
				<p class="bold"><?=$this->cart->show_price(element('subtotal', $item));?></p>
				
			</div>
			<div class="clear"></div>
		 </div>

		<?endforeach;?>
		<div class="clear"></div>

	</div>
	<div class="total_amout right grid_230">
		<p class="text_center">Subtotal</p>
		<h1><?=show_price($this->cart->total())?></h1>
	</div>
	
	<div class="clear"></div>
	<?if($this->cart->shipping_data):?>
	<div class="shipping_data">
		<div class="left_grid left">
			
		<h4>Shipping and Packing
			<?if(element('nope', $this->cart->shipping_data)):?>
			<small>*Will confirm Later</small>
			<?endif;?></h4>
		</div>
		<div class="right_grid right">
			<h1><?=show_price(element('fee', $this->cart->shipping_data))?></h1>
			
		</div>
		<div class="clear"></div>
	</div>
	<?endif;?>
	<div class="final_amount">
		<div class="left_grid left">
		<h4>Total Amount</h4>
		</div>
		<div class="right_grid right">
			<h1><?=show_price($this->cart->total() + element('fee', $this->cart->shipping_data))?></h1>
		</div>
		<div class="clear"></div>
	</div>
	<div class="horline"></div>
</div>