<?=$cart;?>

<div class="buyer_info">
	<form action="" method="post">
	<div class="contact_detail">
		<div class="user_contact left">
		<h4>Contact Detail</h4>
		<div class="inputSet">
			<div class="label"><span>Email<span></div>
			<div class="input"><input name="main_email" value="<?=element('email', $bill_data);?>" type="text"></div>
			<div class="clear"></div>
		</div>
		</div>
		<? /// Just Show Contact and Register from when there's not login data
		if(
			(!$this->dodol_auth->userdata() && $this->input->get('do_reg') == 'y')) :?>
		<div class="register_form left">
			<input type="hidden" name="do_reg" value="1">
			<h4>Register Information</h4>
	         <div class="inputSet">
	  			<div class="label">
	              	<span>Password</span>
	              </div>
	  			<div class="input">
	  				<input type="password" name="reg_password" value="">
	  			</div>
	  			<div class="clear"></div>
	  		</div>
	  		 <div class="inputSet">
	  			<div class="label">
	              	<span>Retype Password</span>
	              </div>
	  			<div class="input">
	  				<input type="password" name="re_password" value="">
	  			</div>
	  			<div class="clear"></div>
	  		</div>
	          <div class="inputSet">
	  			<div class="label">
	              	<span>Gender</span>
	              </div>
	  			<div class="input">
	  				<select name="reg_gender">
	                 	  <option value="">Choose One</option>
	                  	  <option value="m">Male</option>
	                      <option value="f">female</option>
	                  </select>
	  			</div>
	  			<div class="clear"></div>
	  		</div>
	           <div class="inputSet">
	  			<div class="label">
	              	<span>Birthday</span>
	              </div>
	  			<div class="input ">
	  				<input class="text-input grid_250"  type="text" name="reg_birthday" value="yyyy-mm-dd">
	  			</div>
	  			<div class="clear"></div>
	  		</div>
		</div>
		<?endif;?>
		<div class="clear"></div>
	</div>


	<div class="clear"></div>
	<div class="main_info">
		<div class="bill_info left">
			<h4>Billing Information</h4>
			<div class="inputSet">
				<div class="label"><span>Name<span></div>
				<div class="input"><input name="main_first_name" value="<?=element('first_name', $bill_data);?>" type="text"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Last Name<span></div>
				<div class="input"><input type="text" name="main_last_name" value="<?=element('last_name', $bill_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Address<span></div>
				<div class="input"><textarea name="main_address"><?=element('address', $bill_data);?></textarea></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Country<span></div>
				<div class="input"><?=form_dropdown('main_country_id', modules::run('store/get_dropdown_country'), element('country_id', $bill_data))?></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Province<span></div>
				<div class="input"><input type="text" name="main_province" value="<?=element('province', $bill_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>City<span></div>
				<div class="input"><input id="bill_city" name="main_city" type="text" value="<?=element('city', $bill_data);?>"></div>
				<input type="hidden" name="main_city_code" value="<?=element('city_code', $bill_data);?>" >
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Zip<span></div>
				<div class="input"><input name="main_zip" type="text" value="<?=element('zip', $bill_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Phone<span></div>
				<div class="input"><input type="text" name="main_phone" value="<?=element('phone', $bill_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Mobile<span></div>
				<div class="input"><input type="text" name="main_mobile" value="<?=element('mobile', $bill_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="extra">
		
				<p>ship to diffrent address<input type="checkbox" <? echo ($this->cart->shipto_data) ? 'checked="checked"' : '';?> name="different_ship" value="1"></p>
			</div>
			
		</div>
		<div class="ship_info left">
			<h4>Shipping Information</h4>
			<div class="inputSet">
				<div class="label"><span>Name<span></div>
				<div class="input"><input name="ship_first_name" value="<?=element('first_name', $ship_data);?>" type="text"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Last Name<span></div>
				<div class="input"><input type="text" name="ship_last_name" value"<?=element('last_name', $ship_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Address<span></div>
				<div class="input"><textarea name="ship_address"><?=element('address', $ship_data);?></textarea></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Country<span></div>
				<div class="input"><?=form_dropdown('ship_country_id', modules::run('store/get_dropdown_country'), element('country_id', $ship_data))?></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Province<span></div>
				<div class="input"><input type="text" name="ship_province" value="<?=element('province', $ship_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>City<span></div>
				<div class="input"><input id="ship_city" name="ship_city" type="text" value="<?=element('city', $ship_data);?>"></div>
				<input type="hidden" name="ship_city_code" value="<?=element('city_code', $ship_data);?>">
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Zip<span></div>
				<div class="input"><input name="ship_zip" type="text" value="<?=element('zip', $ship_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Phone<span></div>
				<div class="input"><input type="text" name="ship_phone" value="<?=element('phone', $ship_data);?>"></div>
				<div class="clear"></div>
			</div>
			<div class="inputSet">
				<div class="label"><span>Mobile<span></div>
				<div class="input"><input type="text" name="ship_mobile" value="<?=element('mobile', $ship_data);?>"></div>
				<div class="clear"></div>
			</div>			
		</div>
		<div class="clear"></div>
	</div>
	<p class=""><span id="submit_continue" class="button">Continue</span></p>
	</form>
</div>
	<style>
		.ui-autocomplete {
			max-height: 150px;
			overflow-y: auto;
			/* prevent horizontal scrollbar */
			overflow-x: hidden;
			/* add padding to account for vertical scrollbar */
			padding-right: 5px;
		}
		/* IE 6 doesn't support max-height
		 * we use height instead, but this forces the menu to always be this tall
		 */
		* html .ui-autocomplete {
			height: 150px;
		}
		</style>
 <script>
$(document).ready(function() {

       var bill_city  = $("#bill_city").autocomplete({
 
            minLength: 2,
            method: "POST",
            source: function(request, response) {
            $.ajax({
              url: "<?=site_url('store/carrier_cont?cr=jne/ajax_getcity');?>",
              data: {city: $('#bill_city').val()},
              dataType: "json",
              type: "POST",
              success: function(data){
                  response(data);
				if(data.city_code == null){
					$(this).autocomplete( "close" );
					}
            	}
            });
          	},
		
            select: function(event, ui) {
                $('#bill_city').val(ui.item.value);
                $('input[name="main_city_code"]').val(ui.item.city_code);
            }
        });

	

	var ship_city =	$("#ship_city").autocomplete({
           
            minLength: 2,
            method: "POST",
            source: function(request, response) {
            $.ajax({
              url: "<?=site_url('store/carrier_cont?cr=jne/ajax_getcity');?>",
              data: {city: $('#ship_city').val()},
              dataType: "json",
              type: "POST",
              success: function(data){
                  response(data);
				if(data.city_code == null){
					$(this).autocomplete( "close" );
					}
            	}
            });
          	},
		
            select: function(event, ui) {
                $('#ship_city').val(ui.item.value);
                $('input[name="ship_city_code"]').val(ui.item.city_code);
            }
        });
	$('select[name="main_country_id"]').blur(function(){
		if($(this).val() != 100){
			$("#bill_city").autocomplete( "option", "disabled", true );
		}else{
			$("#bill_city").autocomplete( "option", "disabled", false );
		}
	})
	$('select[name="ship_country_id"]').blur(function(){
		if($(this).val() != 100){
			$("#ship_city").autocomplete( "option", "disabled", true );
		}else{
			$("#ship_city").autocomplete( "option", "disabled", false );
		}
	})

 });

	</script>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		if($('input[name="different_ship"]').is(':checked')){
			$('.ship_info').show();
		}else{
			$('.ship_info').hide();
		}
		
		
		$('input[name="different_ship"]').click(function(){
			if($(this).is(':checked')){
				$('.ship_info').show('fade');
			}else{
				$('.ship_info').hide('fade');
			}
			
		});
		var main_form = $('.buyer_info form');
		var trigger = $('.buyer_info #submit_continue');
		trigger.live('click',function(){
			var data_post = main_form.serialize();
			$.ajax({
				url : '<?=site_url("store/checkout/ajax?act=buyer_info");?>',
				type : 'post',
				data : data_post,
				dataType : 'json',
				success: function(res){
					if(res.status == 'success'){
						window.location.href = '<?=site_url("store/checkout/shipping_method");?>';
					}
				}
			})
		})
	});
</script>