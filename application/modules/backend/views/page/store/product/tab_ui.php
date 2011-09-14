<div class="tab-Ui" id="product_tab">
	<div class="tab_pane">
		<ul>
			<li><a>Main Info Product</a></li>
			<li><a>Invetory and Stock</a></li>
			<li><a>S.E.O Setup</a></li>
			<li><a>Media</a></li>
			<li><a>Relation</a></li>
		</ul>
	</div>
	<div class="tab_content">
		<div class="content">
			<h3>Choose file(s)</h3>
			
			<div id="drop-area">
				<span class="drop-instructions">or drag and drop files here</span>
				<div class="drop-over box2">Drop files here!</div>
			</div>
			<br>
			<div class="box2" id="result-area">
				
			</div>

		
			<script type="text/javascript" charset="utf-8">
			
					var	dropArea = document.getElementById("drop-area");
					var	result_area = document.getElementById("result-area");
					

				
					/*
					 * -----------------------------
					 *    DRAG AND DROP EXECUTION
					 * ----------------------------
					*/
					/*
					filesUpload.addEventListener("change", function () {
						traverseFiles(this.files);
					}, false);
					*/
					dropArea.addEventListener("dragleave", function (evt) {
						var target = evt.target;

						if (target && target === dropArea) {
							this.className = "";
						}
						evt.preventDefault();
						evt.stopPropagation();
					}, false);

					dropArea.addEventListener("dragenter", function (evt) {
						this.className = "over";
						evt.preventDefault();
						evt.stopPropagation();
					}, false);

					dropArea.addEventListener("dragover", function (evt) {
						evt.preventDefault();
						evt.stopPropagation();
					}, false);

					dropArea.addEventListener("drop", function (evt) {
						dw_ajxUpload(
							evt.dataTransfer.files, {
								action_url : '<?=site_url("backend/store/b_product/ajx_upload_prod_media");?>',
								files_key : 'image',
								oncomplete : function(res){
									addMsg(res.status, 'success');
								}, }
							);
						
						this.className = "";
						evt.preventDefault();
						evt.stopPropagation();
					}, false);
			
				
			</script>
			 
		</div>
		<div class="content">
			
			<script src="<?=base_url();?>/assets/global_js/fileUploader/fileuploader.js" type="text/javascript" charset="utf-8"></script>
		
			<div id="file-uploader">       
			     
			</div>
			<script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					var uploader = new qq.FileUploader({
					    element: document.getElementById('file-uploader'),
					 	multiple: true,
				        maxConnections: 10,
					    action: '<?=site_url("backend/store/b_product/ajx_upload_img");?>',
					 	params: {prod_id : '56', prod_name : 'Test Product'},
						onComplete: function(id, fileName, res){
                                     alert(res.full_path);
				        },
						//dragDrop: fa,
						
					});
				});
			</script>
		</div>
		<div class="content">
			
			<h3>Bagian 1.10.32 dari "de Finibus Bonorum et Malorum", ditulis oleh Cicero pada tahun 45 sebelum masehi</h3>	
			<form action="<?=site_url('backend/store/b_product/test_ajx_upd');?>" method="post" enctype="multipart/form-data">
				
				<input type="file" name="images[]" value="">
				<input type="file" name="images[]" value="">
				<input type="file" name="images[]" value="">
				<p><input type="submit" value="Continue &rarr;"></p>
			</form>
		</div>
		<div class="content">
			<h3>Terjemahan tahun 1914 oleh H. Rackham</h3>
			<p>"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"</p>
			
		</div>
		<div class="content">
			<h3>Terjemahan tahun 1914 oleh H. Rackham</h3>
			<p>"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."</p>
			
		</div>
		
	</div>
</div>
<script type="text/javascript" charset="utf-8">
	$('#product_tab').dodolTab({active : 0});
</script>