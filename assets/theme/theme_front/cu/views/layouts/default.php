<?=$this->dodol_theme->partial('head');?>
<div class="wrapper">
	<div class="inner_wrap ctr grid_960">
			<div class="header" id="some">
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
				<script type="text/javascript" charset="utf-8">
					keepBar();
					function keepBar(){
						
						
							var me = $('.topBar');
						  	var position = me.position();
							var h =  me.outerHeight();
							var w = me.outerWidth()
							var yPos ;
						
						
						
						
						$(window).scroll(function () {
					            yPos = $(window).scrollTop();
					    	 	if (yPos >= position.top) {
					         		
					       			me.addClass('onMove');
					            } else {
					                me.removeClass('onMove');
					            }
					        });
					 
					}
				</script>
				<div class="comp_content">
				
					<?=$template['body'];?>
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
<?=$this->dodol_theme->partial('footer')?>