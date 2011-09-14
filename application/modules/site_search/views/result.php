<?foreach($results as $item):?>
<h4><a href="<?=$item->link;?>"><?=$item->title;?></a></h4>
<div class="prev"><?=$item->content?></div>
<?endforeach;?>
