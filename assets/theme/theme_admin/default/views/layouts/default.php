<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=$this->dodol->conf('site','name')?> - <?=$pT?></title>
<!-- CSS and JS Global -->

<?=$this->carabiner->display('module', 'css');?>
<?=$this->carabiner->display('theme', 'css');?>
<?=$this->carabiner->display('global', 'css');?>

<?=$this->carabiner->display('global', 'js');?>
<?=$this->carabiner->display('theme', 'js');?>
<?=$this->carabiner->display('module', 'js');?>


<!-- js for HighCharts and CSS -->
<script src="<?=base_url();?>/assets/global_js/hc/highcharts.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=base_url();?>/assets/global_js/hc/modules/exporting.js" type="text/javascript" charset="utf-8"></script>

<?=modules::run('ajax/js_showmsg')?>

</head>


<body  id="<?=$this->router->class.'_'.$this->router->method;?>" class="backend">

<div class="navigation"><div class="inner ctr grid_990">
	<div class="left left_grid">

		<script type="text/javascript">

		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("backendMenu")

		</script>

		<div class="topMenu droplinetabs" id="backendMenu">
		<?=menu_rend(modules::run('nav/nav_item/getnested', 9))?>
		</div>
	
	</div>
	<div class="right right_grid">
		
		
		<div class="backend_userPane left ml20 right">
			<div class="triggerWrap"><p class="trigger">Administrator</p></div>
			<div class="paneContainer">
				<div class="menu left">
				<ul>
					<li><span><a href="#">Account</a></span></li>
					<li><span><a href="#">Setting</a></span></li>
					<li><span><a href="<?=backend_url();?>/logout">Logout</a></span></li>
				<ul>
				</div>
				<div class="user_img right">
					<img src="http://a1.twimg.com/profile_images/1479705438/mypic.jpg" width="70">
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>
	<br class="clear"/>
	</div>
</div>
<div class="grid_990 ctr">
<div class="mainGrid ui-corner-bottom">
	<div class="header grid_950 ctr relative">
		<div class="left logoTop">
			<h1><?=$this->dodol->conf('site', 'name')?></h1>
		</div>
		<?if(isset($pageMenu)):?>
			<div class="pageMenu right absolute"><?=$pageMenu?></div>
		<?endif?>
		<div class="clear"></div>
	</div>


<!END HEADER/>

<div id="component">
<div class="mainWrap grid_950 ctr" id="mainArea">

<!PAGE HEADING AND TOOL/>

	<div class="pageHeading">
		<div class="headingTitle left">
			<h1><?=$pH?></h1>
		</div>
	
		
		<?if(isset($pageTool)):?>
		<div class="pageTool right">
			<?if(is_array($pageTool)):?>
				<?foreach($pageTool as $pt):?>
					<?= $pt ?>
				<?endforeach?>
			<?else:?>
				<?= $pageTool?>
			<?endif?>
		
		</div >
		<?endif?>
		<div class="clear"></div>
	</div>
	

<!END OF PAGE HEADING>
		
<!component start here/>

<?=element('body', $template)?>
<!component end here/>
</div>
</div>
</div>


</div>
<!FOOTER START/>

	<div class="footerWrap">
	<div class="footer_inner ctr grid_990">
		<div class="left_grid left">
			<img class="small_logo left" src="<?=base_url();?>assets/global_img/dodolan_logo_smallers.png" width="82" height="25" alt="Dodolan Logo Smallers">
			<p class="left">Dodolan Framework &copy; 2011 Alright Reserved, Develop by BarockProjects</p>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	</div>
<div id="ajaxdialog" class="ajaxdialog hide msg-Ui">
	
</div>
<?if($this->input->get('first') == 'true') :?>
<script type="text/javascript" charset="utf-8">

	$(document).ready(function(){
	
			//$('body').css('overflow', 'hidden');
			$('body .navigation').hide();
			$('body .mainGrid').hide();
			$('body .navigation').show('slide', {direction: 'up'}, 500 , 
				function(){
						$('body .mainGrid').show('slide', {direction: 'up'}, 500 ,function(){
						//	$('body').css('overflow', 'auto');
							$('body .navigation').removeAttr('style');
							});
				}
			);
	
	});
</script>
<?endif;?>
</body>
</html>
