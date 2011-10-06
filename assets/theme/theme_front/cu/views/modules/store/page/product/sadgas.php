	<div class="socio text_center grid_150 ctr">
			<div class="left w_50">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?=current_url();?>" data-text="<?=$this->dodol->conf('site', 'name');?> >> <?=element('product', $prod)->name?>" data-count="none" data-via="barockzid" data-related="dwodol:dwodol">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
			</div>
			<div class="left w_50">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) {return;}
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>

			<span><div class="fb-like" data-href="<?=current_url();?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div></span>
			</div>
			<div class="clear"></div>
		</div>