<script src="<?=base_url();?>widgets/front/latest_blog/assets/js/jquery.sideswap.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
$(window).load(function()
{
	$('.latest_blog_wid').sideswap({
		next : '<span class="next">next &rarr;</span>',
		previous : '<span class="prev">prev &rarr;</span>',
		display_time : 8000,
		animate_in_type : 'drop',
		animate_out_type : 'drop',
		animate_in_opt : {direction : 'down'},
		animate_out_opt : {direction : 'down'},
	});
});
</script>

<div class="latest_blog_wid">
<?foreach($posts as $post):?>
	<div class="item">
	
		<div class="img-prev" style="background : url(<?=$this->post_thumb($post->content, '450_150_crop')?>)">
		<div class="img-decor"></div>
		</div>
		<div class="item_cont">
		<h4 class="title"><?=$post->title?></h4>
		<div class="prev-cont">
			<?=html_word_limiter($post->content, 30)?>
		</div>
		<div class="hyplink right">
			<a href="<?=site_url('blog/read/'.$post->slug);?>">Read more &rarr;</a>
		</div>
		<div class="clear"></div>
		</div>
	</div>
<?endforeach;?>
</div>
<div class="clear"></div>