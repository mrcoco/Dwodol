<div class="payment_List_v">
<div class="table-Ui">
	
<table>
 <thead>
  <tr>
  	<td>no</td>
    <td>Name</td>
    <td>No Rek</td>
    <td>AN Rek</td>
    <td>Action</td>
    

  </tr>
 </thead>
 <tbody>
	<?foreach($payments as $payment) :?>
	 <tr>
	  	<td><?=$payment->id?></td>
	    <td><?=$payment->name?></td>
	    <td><?=$payment->no_rek?></td>
	    <td><?=$payment->nm_rek?></td>
		<td class="action">
			
			<a href="<?=backend_url('store/b_extension/edit_payment/'.$payment->id);?>"><span class="act edit"></span></a>
			<a href="<?=backend_url('store/b_extension/del_payment/'.$payment->id);?>"><span class="act del"></span></a>
		</td>
 	</tr>
	
	<?endforeach;?>
</tbody>
</table>
</div>
</div>