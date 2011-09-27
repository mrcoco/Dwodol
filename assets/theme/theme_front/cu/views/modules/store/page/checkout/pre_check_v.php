<div class="ctr grid_400">

	<h1>Who are You ?</h1>
	<p>Are you returning Customer ? please do log first</p>
	<div class="login_form">
		<div class="inputSet">
			<div class="label"><span>Email<span></div>
			<div class="input"><input type="text" name="log_email"></div>
			<div class="clear"></div>
		</div>
		<div class="inputSet">
			<div class="label"><span>Password<span></div>
			<div class="input"><input type="password" name="log_password"></div>
			<div class="clear"></div>
		</div>
		<p class="confirm"><span class="button ajax">Login</span></p>
	</div>
	<p>Or you are a new Customer ? Will you register ? </p>
	<p class="confirm">
		<span class="button"><a href="<?=site_url('store/checkout/buyerinfo?do_reg=y');?>">Yes, I want Register</a></span>
		<span class="button"><a href="<?=site_url('store/checkout/buyerinfo?do_reg=n');?>">No, I just Want Checkout This Order</a></span></p>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		var log_trigger = $('.login_form .button');
		log_trigger.click(function(){
			var log_data    ={ email : $('.login_form input[name="log_email"]').val(), password : $('.login_form input[name="log_password"]').val()};
			$.ajax({
				data : log_data,
				url : '<?=site_url("store/checkout/do_login");?>',
				dataType : 'json',
				type : 'post',
				success : function(res){
					if(res.status == 'success'){
						window.location.href = "<?=site_url('store/checkout/buyerinfo');?>";
					}else{
						addMsg('Something wrong, check again your form', 'warning');
					}
				}
			})
		})
	});
</script>