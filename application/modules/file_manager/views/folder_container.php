<div class="folder_container" path="<?=$path;?>">
	<?if($items != false) : 
	$items = array_sort($items, 'type');
		foreach($items as $item):?>
			<div class="item" path="<?=element('path', $item);?>">
				<div class="icon_file <?=element('type', $item);?>"><span class="file_extension"><?=element('type', $item);?></span></div>
				<p><span class="file_name "><?=ellipsize(element('name', $item), 10, .3)?></span></p>
			</div>
	<?	endforeach ;?> 
		<div class="clear"></div>
	<? else:?>
	there is nothing
	<?endif;?>
</div>