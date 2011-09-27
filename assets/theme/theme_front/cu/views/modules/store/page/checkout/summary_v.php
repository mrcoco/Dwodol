<div class="summary">
<?=$cart;?>
	<div class="customer_info grid_350 left">
	<h4>Personal Information</h4>

	<div class="data_rowSet">
		<div class="label">Name </div>
		<div class="data"><?=$bill_data['first_name']?> <?=$bill_data['last_name']?></div>
		<div class="clear"></div>
	</div>

	<div class="data_rowSet">
		<div class="label">Email </div>
		<div class="data"><?=$bill_data['email']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Address </div>
		<div class="data"><?=$bill_data['address']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Country </div>
		<div class="data"><?=$bill_data['country_id']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Province </div>
		<div class="data"><?=$bill_data['province']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">City</div>
		<div class="data"><?=$bill_data['city']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Zip </div>
		<div class="data"><?=$bill_data['zip']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Phone </div>
		<div class="data"><?=$bill_data['phone']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Mobile </div>
		<div class="data"><?=$bill_data['mobile']?></div>
		<div class="clear"></div>
	</div>
		
	</div>
	<div class="customer_info grid_350 right">
	<h4>Shipping Address</h4>

	<div class="data_rowSet">
		<div class="label">Aimed to </div>
		<div class="data"><?=$ship_data['first_name']?> <?=$ship_data['last_name']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Address </div>
		<div class="data"><?=$ship_data['address']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Country </div>
		<div class="data"><?=$ship_data['country_id']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Province </div>
		<div class="data"><?=$ship_data['province']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">City </div>
		<div class="data"><?=$ship_data['city']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Zip </div>
		<div class="data"><?=$ship_data['zip']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Phone </div>
		<div class="data"><?=$ship_data['phone']?></div>
		<div class="clear"></div>
	</div>
	<div class="data_rowSet">
		<div class="label">Mobile </div>
		<div class="data"><?=$ship_data['mobile']?></div>
		<div class="clear"></div>
	</div>
		
	</div>
	<div class="clear"></div>
	<div class="shipping_and_payment">
		
		<h4>Shipping and Payment</h4>
		<div class="data_rowSet">
			<div class="label">Payment Method </div>
			<div class="data"><?=$payment['method']?></div>
			<div class="clear"></div>
		</div>
		<div class="data_rowSet">
				<div class="label">Shipping Carrier </div>
				<div class="data"><?=$shipping?></div>
				<div class="clear"></div>
		</div>
	</div>
	<div class="customer_note mt20">
		<form action="" method="post">
			<div class="grid_300 left mr20">
			Give me a few line of note,if you want it :)
			<textarea name="customer_note" class="grid_300" rows="8"></textarea>
			</div>
			<div class="right ui-captcha">
				<?$this->recaptcha->show_it();?>
				<br class="clear"/>
					<input type="submit" name="process" class="button right" value="Process">
				<br class="clear"/>
			</div>
			<br class="clear"/>
		</form>
	
	</div>

</div>