<?=$this->dodol_theme->partial('head');?>
	<div class="wrapper">
		<div class="wrapper_inner  grid_800 ctr">
			<div class="header">
				<div class="checkout_bar left">
					<?=mod_run('store/checkout/checkoutbar')?>
					<?=isset($bar) ? $bar : ''?>
				</div>
				<h1 class="site_name"><?=$this->dodol->conf('site', 'name')?></h1>
				<div class="clear"></div>
			</div>
			<div class="content_body ctr">
				<?=element('body', $template)?>
			</div>
		</div>
		<div class="footer grid_800 ctr">
			
		</div>
	</div>
	
<?=$this->dodol_theme->partial('footer')?>