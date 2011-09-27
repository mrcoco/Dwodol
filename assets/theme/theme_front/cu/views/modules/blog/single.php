<div class="post" id="post_<?=$post->id;?>">
<div class="heading"><h1><?=$post->title?></h1></div>
<div class="meta left"><span class="date"><?=blog_date($post->c_date)?></span>, <span class="cat"><?=$post->cat_name;?></span></div>
<div class="author right"><span>by : <?=$post->first_name.' '.$post->last_name?></span></div>
<div class="clear"></div>
<div class="blog_content">
	<?=$post->content?>
	<div class="clear"></div>
</div>
</div>
<span class="left"><?=post_prev_link($post->ID)?></span>
<span class="right"><?=post_next_link($post->ID)?></span>
<div class="clear"></div>
<?=Modules::run('blog/comment_form');?>