<?=$this->dodol_theme->partial('head');?>
<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			var side = $('.sideBar').height();
			var main = $('.main_layer').height();
			if(main < side){
				$('.main_layer').css('min-height', side);
			}
		});
</script>
<div class="wrapper">
	<div class="inner_wrap ctr grid_960">
			<div class="header">
				<div class="logo ctr">
					<img src="<?=$this->dodol_theme->path();?>/img/top_logo_width.png" width="870" height="33" alt="Top Logo Width">
				</div>
			</div>
			<div class="component">
				<div class="topBar">
					<div class="navTop left">
						<?=load_widget('topmenu');?>
					</div>
					<div class="barRight right">
						<?=load_widget('top_right')?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="comp_content">
					<div class="sideBar">
						<div class="store_category_menu">
								<?=menu_rend(modules::run('store/category/getCategoryMenu'))?>
						</div>
						
						<div class="clear"></div>
					</div>
					<div class="main_layer">
						<?=$template['body'];?>
					</div>
					
					<div class="clear"></div>
				</div>
			</div>
			<div class="footer">
			<div class="site_copyright left">
				<p>&copy; <?=$this->dodol->conf('site', 'name')?> all right reserved</p>
			</div>
			<div class="dev_sign right mr10">
				<p>Develop by BarockProject</p>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$('.main_layer').hide();
	$(document).ready(function(){
		$('.main_layer').show('fade', 1000);
	});
</script>
<?=$this->dodol_theme->partial('footer')?>