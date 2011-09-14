<!DOCTYPE HTML>
<html>
<head>
<title><?=$this->dodol->conf('site','name')?> <? if(isset($pT)){ echo ' | '.$pT ;}elseif(!isset($pT) && isset($pH)){echo ' |  '.$pH;}?></title>
<?=$this->carabiner->display('global');?>
<?=$this->carabiner->display('module');?>
<?=$this->carabiner->display('theme');?>


<?=$template['metadata']?>
<?=modules::run('ajax/js_showmsg')?>
</head>
<body id="<?=str_replace('/', '_', $this->dodol_theme->get_layout());?>_layout" >
	<div id="<?=$this->router->class.'_'.$this->router->method;?>">