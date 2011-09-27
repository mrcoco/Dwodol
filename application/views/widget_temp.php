<?if($widgets):?>

	
	<?foreach($widgets['q'] as $widget):?>
	<?$mod_param = jsonToArray($widget->mod_param)?>
	<div class="modularizer <?=$widget->widget_name;?> <?=element('css_suffix', $mod_param);?>">
	
		<?if(element('hide_title', $mod_param) == 'y'):?>
		<?else:?>
		<h3 class="widget_title"><?=$widget->name?></h3>
		<?endif?>
	<?=widget_helper::placed($widget->state.'/'.$widget->widget_name.'/'.$widget->widget_name, jsonToArray($widget->parameter), $widget)?>
	</div>
	<?endforeach;?>

<?endif;?>