<h1>New Arrival</h1>
<div class="browseProduct">
<? if($prods){ foreach($prods as $prod){?>
<?=modules::run('store/product/prodSnap',$prod->id )?>
<?}?>
<div class="clear"></div>
<?}else{?>
	there aren't product in this category
<?}?>
<div class="clear">></div>
</div>