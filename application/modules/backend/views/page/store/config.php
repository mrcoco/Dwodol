<div class="tab-Ui" id="config_tab">
	<div class="tab_pane">
		<ul>
			<li><a>Main Config</a></li>
			<li><a>Payment</a></li>
			<li><a>Shipping</a></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="tab_content">
		<div class="content main">
		<div class="form-Ui grid_450 left">

			<h4>Store Contact Detail</h4>
			<div class="inputSet">
				<div class="label"><span>Owner Mail<span></div>
				<div class="input"><input type="text" value="" name="store_owner_mail"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Address<span></div>
				<div class="input"><textarea name="store_address"></textarea></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>City<span></div>
				<div class="input"><input type="text" value="" name="store_city"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Country<span></div>
				<div class="input"><input type="text" value="" name="store_country_id"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Province<span></div>
				<div class="input"><input type="text" value="" name="store_Province"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Zip<span></div>
				<div class="input"><input type="text" value="" name="store_zip"></div>
				<div class="clear"></div>
			</div>
	
			<div class="inputSet">
				<div class="label"><span>Phone<span></div>
				<div class="input"><input type="text" value="" name="store_phone_1"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Phone 2<span></div>
				<div class="input"><input type="text" value="" name="store_phone_2"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Currency<span></div>
				<div class="input"><input type="text" value="" name="store_currency"></div>
				<div class="clear"></div>
			</div>
	
		</div>
		<div class="right grid_420 form-Ui">
			<div class="box2">
			<h4>Store Manager Mail</h4>
			<div class="inputSet">
				<div class="label"><span>Mail 1<span></div>
				<div class="input"><input type="text" value="" name="store_manager_mail_1"></div>
				<div class="clear"></div>
			</div>
			</div>
			<br/>
			<div class="box2">
			<h4>Core Setting</h4>
			<div class="inputSet">
				<div class="label"><span>Check Stock<span></div>
				<div class="input">
					<?=form_radios('store_check_stock', array('y' => 'Yes', 'n' => 'No'), 'y')?>
				</div>
				<div class="clear"></div>
			</div>
			</div>
			<br/>
			<div class="box2">
			<h4>Twitter Integration</h4>
			<p>integrate with twitter, such when store have new product automatically will create an update to the twitter account which connected</p>
			<p><span class="button">Yes. Conect me <span></p>
			</div>
	
		</div>

		<div class="clear"></div>
	</div>
		<div class="content payment">
			<div class="payments_list">
			<?foreach($payments as $pay):?>
				<div class="item">
				<p><?=element('name', $pay)?><p>
				<small><?=element('description', $pay)?></small>
				</div>
			<?endforeach;?>
			</div>
		</div>
		<div class="content shipping">
			<div class="carriers_list">
			<?foreach($carriers as $carr):?>
				<div class="item">
				<p><?=element('name', $carr)?><p>
				<small><?=element('description', $carr)?></small>
				
				</div>
			<?endforeach;?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" charset="utf-8">
		$('#config_tab').dodolTab();
</script>