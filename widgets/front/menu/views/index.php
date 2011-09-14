<?
if($menus):
$wrap =  'span';
$wrap_open = '<'.$wrap.'>';
$wrap_close = '</'.$wrap.'>';
;?>
<ul class="<?=element('type', $param);?>">
<?foreach($menus as $s):
	$class = ($c = element('class', $s) != '') ? $s.' ' : '';
	$id_widget = '';
 	if(element('id', $s) != '' && strpos(element('id', $s), 'load_wid') !== false): 
		$id_widget = str_replace('load_wid_', '', element('id', $s));
		$load_widget = modules::run('modularizer/load_byid', $id_widget);
	else:
		$load_widget ='';
	endif;
	
	if($child = element('child', $s)) :?>
	
		<li id="<?=element('id', $s);?>" class="<?=$class;?>hv_child"><?=$wrap_open?><a href="<?=$s['link'];?>"><?=$s['anchor'];?></a><?=$wrap_close?><?=_menu_rend($child, 1);?></li>

	<?else:?>
			<li id="<?=($id_widget != '') ? 'wid_'.$id_widget : '';?>" class="<?=$class;?>"><?=$wrap_open?><a href="<?=$s['link'];?>"><?=$s['anchor'];?></a><?=$wrap_close?><?=$load_widget;?></li>

	<?endif;?>



<?endforeach;?>
	<div class="clear"></div></ul>
<?endif;?>	
