<? if ( $tpls ) :?>
<div class="table-Ui">
	
<table class="postList">
 <thead>
  <tr>
    <td>Name</td>
    <td>Group</td>
	<td>Action</td>

  </tr>
 </thead>
 <tbody>
	<?foreach($tpls as $tpl):?>
		<tr>
			<td><?=$tpl->name?></td>
	    	<td><?=$tpl->grp_name?></td>
	    	<td>	
				<a href="<?=backend_url('newsletter/b_template/edit_tpl/'.$tpl->id);?>"><span class="act edit"></span></a>
				<a href="<?=backend_url('newsletter/b_template/del_tpl/'.$tpl->id);?>"><span class="act del"></span></a>
			</td>
		</tr>
	<?endforeach;?>

</tbody>

</table>
</div>
<?else : ?>
 There is not Template yet
<?endif;?>