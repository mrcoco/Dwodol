
<div class="clear"></div>
<div class="listprod_v mt10">
	<?if($prods){?>
	   
<div class="table-Ui">
	
<table class="prodList">
 <thead>
  <tr>
	<td class="grid_50">No</td>
  	<td class="grid_120"></td>
    <td class="grid_250">Product Name</td>
    <td>Invetory</td>
	<td class="grid_100"><span class="bold">TOTAL</span></td>
    <td>Action</td>

  </tr>
 </thead>
 <tbody>

<?
foreach($prods as $prod){
	$param = array(
		'id' => $prod->p_id,
		'attr' => true
		);	
	$q = modules::run('store/product/detProd', $param);
	$p = $q['prod'];
	$c = $q['cat'];
	$attrs = $q['attrb'];
	
	$stock = $p->stock;
	?>
 <tr>
	<td class="grid_50"><?=$number?></td>
 	<td><img src="<?=prod_media($p->id, '100-50-crop');?>"></td>
    <td class="vTop">
		<div class="prodDet">
			<span class="left"><?=$p->name?></span><span class="right"><?=$p->sku?></span>
			<br class="clear">
			<div class="horline"></div>
			<p>Publish : <?=$p->publish?> | Category : <?=$c->name;?></p>
		</div>
	</td>
    <td>
    	<div class="list_attr">
    		<?if($attrs):
				foreach($attrs as $attr):
				?>
				<div class="item_attr"><?=prod_attr_to_word(prod_attr_to_array($attr->attribute));?></div>
				<?endforeach;
			endif?>
    	</div>
    </td>
    <td class="text_center"><?=prod_stock($p->id)?></td>
    <td class="action">
		<a href="<?=site_url('store/prod/'.$p->id);?>"><span class="act view"></span></a>
		<a href="<?=site_url('backend/store/b_product/editprod/'.$p->id);?>"><span class="act edit"></span></a>
		<a href="<?=site_url('backend/store/b_product/deleteprod/'.$p->id);?>"><span class="act del"></span></a>
	</td>
	</tr>

  <? $number ++;}?>

 
</tbody>
</table>
<div class="pagination right"><?=$this->dodol_paging->make_link();?></div>
<div class="clear"></div>
		</div>	
		<?}else{
		echo 'there are no product to show';
		}?>
</div>