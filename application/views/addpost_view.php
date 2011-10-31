<form id="my_form" action="<?=site_url('tester/add_post');?>" method="post" accept-charset="utf-8">
	<label for="title"></label><input type="text" name="title" value="" id="title">
	<label for="content">content</label><input type="text" name="content" value="" id="content">
	<p><input type="submit" value="Continue &rarr;"></p>
	
	
	
</form>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$('#my_form').submit(function(){
			$.ajax({
				url : '<?=site_url('tester/add_post');?>',
				data : $('#my_form').serialize(),
				type : 'POST',
				dataType : 'json',
				success : function (res){
					alert(res.status);
				}
			})
			
			
			
			return false;
		})
	})
</script>