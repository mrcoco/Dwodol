<div class="content grid_600 ctr">
<div class="form-Ui"id="login_page_backend">
	<div class="dodol_logo ctr">
		<p>
		<img src="<?=base_url();?>assets/global_img/dodolan_logo.png" width="250" >
		</p>
	</div>
	<form action="" method="post">
	<div class="inputSet">
		<div class="label"><p>Email</p></div>
		<div class="input"><input type="text" name="email"></div>
		<div class="clear"></div>
	</div>
	<div class="inputSet password">
		<div class="label"><p>Password</p></div>
		<div class="input">
			<input type="password" name="pass">
			<div class="recover"><a href="#">Password Recovery</a></div>
			<div class="clear"></div>
			</div>
		<div class="clear"></div>
	</div>
		<p class="text_center"><input type="submit" name="submit" value="login" class="button ajax"></p>
	</form>
</div>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('#login_page_backend form').submit(function(){
			var button = $('#login_page_backend form input[name="submit"]');
			var email = $(this).find('input[name="email"]').val();
			var pass = $(this).find('input[name="pass"]').val();
			var url = $(location).attr('href');
	
			if(pass == '' && email != ''){
				$.jGrowl("password required", {position : 'center',  header: 'warning', theme: 'warning' });
				return false;
			}else if(email == '' && pass != ''){
				$.jGrowl("email required", {position : 'center',  header: 'warning', theme: 'warning' });
				return false;
			}else if(email == '' && pass == ''){
				$.jGrowl("Check Your input", {sticky : true , position : 'center',  header: 'warning', theme: 'warning' });
				return false;
			}
			
			button.addClass('onload');
			
			$.ajax({
			 	type : "POST",
				dataType : "json",
				data : {email : email, pass : pass, url : url},
				url : "<?=site_url('backend/b_auth/ajx_do_login');?>",
				success : function(data){
					if(data.msg == 1){
						
						
						button.delay(1500).queue(function(next){
							$('#login_page_backend').hide('fade', {}, 500, function(){					   	$(location).attr('href','<?=site_url();?>'+data.location);});
							
						  next();
						});
						
						
					}else{
						button.delay(1500).queue(function(next){
						    $(this).removeClass("onload");
						    next();
						});
						
						return false;
					}
				}
			});
			return false;
		});
	});
</script>
</div>