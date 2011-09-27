<!DOCTYPE>
<html>
<head>
<?=$this->carabiner->display('global', 'css');?>
<?=$this->carabiner->display('global', 'js');?>
<?=$this->carabiner->display('module', 'css');?>
<title><?=$this->dodol->conf('site','name')?> - <?=$pT?></title>
</head>
<body>
<div class="mainlayer">
	<?=element('body', $template)?>
</div>
</body>
</html>

<script type="text/javascript" charset="utf-8">
	<?if($w = $this->input->get('width')):?>
		$(document).ready(function(){
			$('.mainlayer').css('width', '<?=$w;?>')
		})
	<?endif;?>
<?if($this->input->get('prev') != 'y'):?>
		$('link').each(function(){
			var th = $(this);
			th.attr('media', 'print')
		});
	<?endif;?>
</script>
