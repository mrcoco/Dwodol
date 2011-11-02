<div id="addeditprod">
	
<div class="tab-Ui" id="product_tab">
	<div class="right submit_tool">
		<span class="button" id="submitprod">Publish</span>
	</div>
	<div class="tab_pane">
		<ul>
			<li><a>Main Info Product</a></li>
			<li><a>Invetory and Stock</a></li>
			<li><a>S.E.O Setup</a></li>
			<li><a>Media</a></li>
			<li><a>Relation</a></li>
		</ul>
	</div>
	<div class="clear"></div>
	<div class="tab_content form-Ui">
	
	<form id="addprod">
		<div class="content main_info">
			
			<fieldset>
				<legend>Product Detail</legend>
				<div class="fieldset_wrapper">
			
				<div class="inputSet">
					<div class="label"><span>Name<span></div>
					<div class="input"><input class="required" type="text" name="main_name" value="<?=$prod->name;?>" ></div>
					<div class="clear"></div>
				</div>
				<div class="inputSet">
					<div class="label"><span>SKU<span></div>
					<div class="input"><input type="text" name="main_sku" value="<?=$prod->sku;?>"></div>
					<div class="clear"></div>
				</div>
				<div class="inputSet">
					<div class="label"><span>Price<span></div>
					<div class="input"><input type="text" name="main_price" value="<?=$prod->price;?>"></div>
					<div class="clear"></div>
				</div>
				<div class="inputSet">
					<div class="label"><span>Category<span></div>
					<div class="input"><?=form_dropdown('main_cat_id', modules::run('store/category/catselopt'), $prod->cat_id	);
					?></div>
					<div class="clear"></div>
				</div>
				<div class="inputSet">
					<div class="label"><span>Global Stock<span></div>
					<div class="input"><input type="text" name="main_stock" value="<?=$prod->stock;?>"></div>
					<div class="clear"></div>
				</div>
				<div class="inputSet">
						<div class="label"><span>Weight<span></div>
						<div class="input"><input type="text" name="main_weight" value="<?=$prod->weight;?>"></div>
						<div class="clear"></div>
				</div>
				<div class="inputSet">
					<div class="label"><span>Publish<span></div>
					<div class="input"><?=form_radios('main_publish', array('y' => 'yes', 'n' => 'no'), $prod->publish)?></div>
					<div class="clear"></div>
				</div>
			
				</div>
				
			</fieldset>
			<fieldset>
			<legend>Description</legend>
				<div class="fieldset_wrapper">
					<?=load_ck_editor()?>
					<?=ck_editor('main_l_desc', 'main_desc', $prod->l_desc)?>
				</div>
			</fieldset>
	
			
		</div>
		<div class="content attr_prod_form">
		
				<fieldset>
					
				<div class="fieldset_wrapper">
						
					<h3>Product Attribute and Inventory<span class="button" id="clone_attr">Add More</span></h3>
					<div class="cloneAble_area">
						<?if($attributes != false) : $i = 0; foreach($attributes as $a):?>
						<div class="inputColl_ver">
							<div class="item">
								<label for="attr_attribute">Attribute</label><input type="text" name="attr_attribute[<?=$i;?>]" value="<?=$a->attribute;?>">
							</div>
							<div class="item">
								<label for="attr_stock">Stock</label><input type="text" name="attr_stock[<?=$i;?>]" value="<?=$a->stock;?>">
							</div>
							<div class="item">
								<label for="attr_prod_opt">Price Option</label><input type="text" name="attr_prod_opt[<?=$i;?>]" value="<?=$a->price_opt;?>">
							</div>	
							<input type="hidden" name="attr_id[<?=$i;?>]" value="<?=$a->id;?>" id="attr_id">				
						</div>
						<?$i++ ; endforeach; else:?>
						<div class="inputColl_ver">
							<div class="item">
								<label for="attr_attribute">Attribute</label><input type="text" name="attr_attribute[0]" value="">
							</div>
							<div class="item">
								<label for="attr_stock">Stock</label><input type="text" name="attr_stock[0]" value="">
							</div>
							<div class="item">
								<label for="attr_prod_opt">Price Option</label><input type="text" name="attr_prod_opt[0]" value="">
							</div>						
						</div>
						<?endif;?>
					</div>
				</div>
				</fieldset>
				<script type="text/javascript" charset="utf-8">
					$(document).ready(function(){
					
						var trigger = $('#clone_attr');

						$('#clone_attr').live('click', function(){
							var index = $('.content.attr_prod_form .cloneAble_area .inputColl_ver').size();
							
							var clone_area = $('.cloneAble_area');
							var tpl = ''+
							'<div class="inputColl_ver">'+
								'<div class="item">'+
									'<label for="attr_attribute">Attribute</label><input type="text" name="attr_attribute['+index+']" value="">'+
								'</div>'+
								'<div class="item">'+
									'<label for="attr_stock">Stock</label><input type="text" name="attr_stock['+index+']" value="">'+
								'</div>'+
								'<div class="item">'+
									'<label for="attr_prod_opt">Price Option</label><input type="text" name="attr_prod_opt['+index+']" value="">'+
								'</div>'+						
							'</div>';
							$(tpl).appendTo(clone_area).hide().show('fade',{direction: 'up'});
						})
						
						
					});
				</script>
		
		</div>
		<div class="content seo">
			<div class="left box2 grid_430">
				<h3>Meta Keyword</h3>
				<textarea name="main_meta_key" class="grid_410" ><?=$prod->meta_key?></textarea>
			</div>
			<div class="right box2 grid_430">
				<h3>Meta Description</h3>
				<textarea name="main_meta_desc" class="grid_410" ><?=$prod->meta_desc?></textarea>
			</div>
			<div class="clear"></div>
		</div>
		<div class="content prod_media">	
		<h3>Product Medias</h3>
			<div class="form_engine ctr grid_300 left">
				<p class="drop-instructions">drag and drop files here to start upload</p>
				<div id="drop-area" class="ctr drop_area">
					<p class="drop-over">Drop files here!</p>
					<p class="drop-over_here hide">Release File Here to Upoad</p>
					<div class="to_list">
					
						<div class="clear"></div>
					</div>
				</div>
				
			
				<div class="" id="result-area">
						
				</div>
			</div>
			<div class="the_medias left grid_600">
				<?if($medias != false): foreach($medias as $m):?>
				<div class="item" id="<?=$m->id;?>">
					<span class="button delete">X</span>
					<img src="<?=site_url('store/product/thumb/200-200-crop/dir/assets/modules/store/product_img/'.$m->path);?>"/>
					<div class="clear"></div>
					<p class="name_media"><?=$m->name?></p>
					<input class="input_name_media" name="media_name" value="<?=$m->name;?>" type="text"/>
					
				</div>
				<?endforeach;endif;?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			
				<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){

						$(function() {
							$( ".the_medias" ).sortable({
							   update: function(event, ui) { saveOrder() }
							});


						});
						function saveOrder(){
								var array = $(".the_medias" ).sortable('toArray')
								var order = "";
								$.each(array, function(i, val) {
								    order += val+",";
								});
								order = order.substring(0,(order.length-2));	
								$.ajax({
											type: "POST",
											dataType : "json",
											data : {'sort_state' : order},	
											url: "<?=site_url('backend/store/b_product/reorder_media')?>",
								});			

						}

				});

					
						$(document).ready(function(){
							$('.name_media').live('click', function(){
								var suspect = $(this);
								var id = suspect.parent().attr('id');
								var input_el = suspect.parent().find('.input_name_media');
								input_el.val(suspect.text());
								suspect.hide();
								input_el.show().focus().select();
								
								$(input_el).keyup(function(event) {
								  if (event.keyCode == '13') {
								    	
										$.ajax({
											url 		: '<?=site_url("backend/store/b_product/ajx_media?func=rename");?>',
											data 		: {id : id, name : $(this).val() },
											dataType 	: 'json',
											type 		: 'post',
											success		: function(res){
												if(res.status == 'success'){
													
												}else{
													
												}
											},
										})
										suspect.text($(this).val());
										suspect.show();
										input_el.hide();
								   }
								});
								

							});
							$('.the_medias .item .delete').live('click', function(){
								var object = $(this).parent();
								object.hide(
									'fade', 
									{}, 
									'slow', 
									function(){ 
										$(this).remove();
										}
									)
								
								$.ajax({
									url			: "<?=site_url('backend/store/b_product/aj	x_media?func=delete');?>",
									data		: {id : object.attr('id')},
									dataType	: 'json',
									type		: 'post',
									success		: function(data){
										if(data.status == 'success'){
											
											object.hide(
												'fade', 
												{}, 
												'slow', 
												function(){ 
													$(this).remove();
													}
												)
										}
									}
								})
								
							});
						});
					
						function add_media_res(res){

							$.each(res, function(index, item){
								var new_el = '<div class="item" id="'+item.id+'">'+
											 '<span class="button delete">X</span>'+
											 '<img src="'+item.img_url+'"/>'+
											 '<div class="clear"></div>'+
											 '<p class="name_media" >'+item.name+'</p>'+
											 '<input class="input_name_media" name="media_name" value="'+item.name+'" type="text">'+
											 '</div>';
								$(new_el).prependTo('.the_medias').hide().show('slide', {direction: 'left'});
					
							});
						}
						
						function add_error_show(r){
							
							$.each(r, function(index, item){
								var new_el = '<div class="error_item">'+
											 '<span>'+index+'</span>'+
											 '<ul>';
											$.each(item, function(i, val){
											new_el += '<li>'+val+'</li>';
											});
									new_el += '<ul></div>';
									
								$(new_el).prependTo('#result-area');
							});
						}
						
						var	dropArea = document.getElementById("drop-area");
						var	result_area = $("#result-area");
						var jq_dropArea = $('#drop-area');

						dropArea.addEventListener("dragleave", function (evt) {
							var target = evt.target;
					
							jq_dropArea.animate({
							    	backgroundColor : '#F6F6F6',
									height : 100,
							  		}, 500 );
						 	$('.drop-over').show();
							$('.drop-over_here').hide();
							evt.preventDefault();
							evt.stopPropagation();
						}, false);

						dropArea.addEventListener("dragenter", function (evt) {
						//	this.className = "over";
						
							jq_dropArea.animate({
							    	backgroundColor : 'red',
									height : 100,
							  		}, 500 );
						 	$('.drop-over').hide();
							$('.drop-over_here').show();
							evt.preventDefault();
							evt.stopPropagation();
						}, false);

						dropArea.addEventListener("dragover", function (evt) {
							evt.preventDefault();
							evt.stopPropagation();
						}, false);

						dropArea.addEventListener("drop", function (evt) {
							
							result_area.empty();
							dw_ajxUpload(
								evt.dataTransfer.files, {
									action_url : '<?=site_url("backend/store/b_product/ajx_media?func=upload");?>',
									data_post :{p_id : <?=$prod->id;?>},
									files_key : 'image',
									start : function(){
										alert('start');
									},
									oncomplete : function(res){
										if(res.status == 'success'){
											add_media_res(res.uploaded);
											add_error_show(res.errors);
										}
									} }
								);
							
							jq_dropArea.animate( {
						    	backgroundColor : '#c3f595',
								height : 50,
					  		}, 500 ) 
							.animate({
								backgroundColor : '#F6F6F6',
							}, 500)	;
							$('.drop-over').show();
							$('.drop-over_here').hide();
							evt.preventDefault();
							evt.stopPropagation();
						}, false);


				</script>
			
		</div>
		
		<div class="content relation">
			<h3>Product Relations</h3>
			<div class="form_engine left grid_280">
				<div class="box2">
				<small>Relations wording label</small>
				<input type="text" name="ext_rel_label" value="<?=element('rel_label', prod_ext_data($prod->id));?>" class="w_90">
				</div>
				<br/>
				<div class="box2">
				<small>Search The product by Name or SKU, to add relation with </small>
				<input type="text" name="src_prod" value="" class="w_90">
				</div>
				<div class="result">
					
				
				</div>
			</div>
			<div class="the_relations left">
				<?if($relations != false) : foreach($relations as $rel) :?>
					<div class="item" id="<?=$rel->id;?>">
						<span class="button delete">X</span>
						<img src="<?=prod_media($rel->p_rel, '200-200-crop');?>"/>
						<p><?=$rel->p_own;?></p>
						<span class="button delete">Del</span>
					</div>
				<?endforeach; endif;?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					//search prod
					var delayer = delayTimer(1000);
					var src_input = $('.content.relation .form_engine input[name="src_prod"]');
					var add_trigger = $('.result .item .button.add');
					var del_trigger = $('.the_relations .item .button.delete');
					src_input.live('keyup', function(event){
						
						delayer(function(){
							$.ajax({
								data : {q : src_input.val()},
								url : '<?=site_url("backend/store/b_product/ajx_relation?func=search");?>',
								type: 'post',
								dataType : 'json',
								success :function(data){
									if(data.status == 'success'){
										src_res_tolist(data.prods);
									}else{
											$('.relation .form_engine .result').html('<p>no thing match</p>')
										}
								}
							})
					
						});
						
					});
				
					add_trigger.live('click', function(){
						var id = $(this).parent().attr('id');
						var suspect = $(this).parent();
						$.ajax({
							data : {id : id, p_own : <?=$prod->id;?>},
							dataType : 'json',
							type : 'post',
							url : '<?=site_url("backend/store/b_product/ajx_relation?func=add");?>',
							success : function(data){
								if(data.status == 'success'){
									suspect.hide();
									add_to_rel(data.rel);
								}
							}
						})
						
					});
					del_trigger.live('click', function(){
						var id = $(this).parent().attr('id');
						var suspect =$(this).parent();
						$.ajax({
							data : {id : id},
							dataType : 'json',
							type : 'post',
							url : '<?=site_url("backend/store/b_product/ajx_relation?func=del");?>',
							success : function(data){
								if(data.status == 'success'){
									suspect.hide('fade' ,{}, 'slow', function(){
										suspect.remove();
									})
								}
							}
						})
					});
					function src_res_tolist(objects){
						$('.relation .form_engine .result').empty();
						$.each(objects, function(index, item){
							var tpl = ''+
							'<div class="item" id="'+item.id+'">'+
								'<img src="<?=site_url();?>/store/product/thumb/120-50	-crop/dir/'+item.img+'"/>'+
								'<p class="left">'+item.name+'</p>'+
								'<span class="button add">add</span>'+
								'<div class="clear"></div>'+
							'</div>';
							$(tpl).appendTo('.relation .form_engine .result').hide().show('fade');
						});
						
					}
					function add_to_rel(object){
						var tpl = ''+
						'<div class="item" id="'+object.id+'">'+
							'<img src="<?=site_url("store/product/thumb/200-200-crop/dir");?>/'+object.img+'"/>'+
							'<p>'+object.name+'</p>'+
							'<span class="button delete">del</span>'+
						'</div>';
						$(tpl).prependTo('.the_relations').hide().show('fade');
					}
				});
			</script>
		</div>
	</form>	
	</div>
</div>
</div>
<?=load_jq_validate()?>
<script type="text/javascript" charset="utf-8">
	$('#product_tab').dodolTab();
	$(document).ready(function(){
		
		$('.submit_tool span#submitprod').click(function(){
			var trigger = $(this);
			var formData = 	$('#addprod').serializeJSON();
			var medias ='';
			$('.the_medias .item').each(function(index,value){ medias = medias+','+$(this).attr('id') });
			var relations = '';
			$('.the_relations .item').each(function(index,value){ relations = relations+','+$(this).attr('id') });
			formData['medias'] = medias.substring(1, medias.length);
			formData['relations'] = relations.substring(1, relations.length);
			formData['main_l_desc'] = main_desc.getData();
			formData['prodid'] = <?=$prod->id;?>;
			$.ajax({
				data : formData,
				url : '<?=backend_url("store/b_product/ajx_editprod");?>',
				dataType : 'json',
				type : 'post',
				success : function(res){
					if(res.status == 'success'){
						setTimeout(function() {
						  window.location.href = '<?=backend_url("store/b_product/listprod");?>';
						}, 2000);
						
					}else{
						addMsg('check again your input, we found some warning', 'warning');
					}
				}
			})
		});
	});
</script>