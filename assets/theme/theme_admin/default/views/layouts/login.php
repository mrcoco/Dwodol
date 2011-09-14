<!DOCTYPE html>
<head>
	<title><?=$this->dodol->conf('site','name')?> - 	<? if(isset($pT)){ echo $pT ;}elseif(!isset($pT) && isset($pH)){echo $pH;}?></title>
	<?=$this->carabiner->display('global');?>
	<?=$this->carabiner->display('module');?>
	<?=modules::run('ajax/js_showmsg')?>

</head>
<body id="<?=str_replace('/', '_', $this->dodol_theme->get_layout());?>_layout">
	<div class="mainLayer">

		<?=element('body', $template)?>
	</div>
</body>
</html>
