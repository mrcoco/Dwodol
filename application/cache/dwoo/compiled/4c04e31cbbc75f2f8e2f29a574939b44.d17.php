<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><script src="http://localhost/culture-update.com//assets/global_js/zeroclip/ZeroClipboard.js" type="text/javascript" charset="utf-8"></script><script>
	
		$(document).ready(function(){
				ZeroClipboard.setMoviePath('http://localhost/culture-update.com//assets/global_js/zeroclip/ZeroClipboard.swf');
			clip = new ZeroClipboard.Client();
			clip.setHandCursor( true );
			// assign a common mouseover function for all elements using jQuery
			$('.toClipBoard').mouseover( function() {
				// set the clip text to our innerHTML
				text = $(this).attr('alt');
				clip.setText(text);
				// reposition the movie over our element
				// or create it if this is the first time
				if (clip.div) {
					clip.receiveEvent('mouseout', null);
					clip.reposition(this);
				}
				else clip.glue(this);
				// gotta force these events due to the Flash movie
				// moving all around. This insures the CSS effects
				// are properly updated.
				clip.receiveEvent('mouseover', null);

			} );


		});
		</script><div class="clear"></div>
<div class="list_page">
	<div class="table-Ui">
		<table>
			<thead>
				<tr>
					<td>Title</td>
					<td>Category</td>
					<td>Action</td>
				</tr>
			</thead>
							<tr>
					
					<td>Store Policies</td>
					<td>Term</td>
					<td class="action">
							<a href="http://localhost/culture-update.com/page/view/6"><span class="act view"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/update/6"><span class="act edit"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/delete/6"><span class="act del"></span></a>
							<span class="zeroCLipBut"><span class="toClipBoard button" alt="page/view/6">Copy Page Link</span></span>					</td>
				</tr>
							<tr>
					
					<td>Privacy</td>
					<td>Term</td>
					<td class="action">
							<a href="http://localhost/culture-update.com/page/view/7"><span class="act view"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/update/7"><span class="act edit"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/delete/7"><span class="act del"></span></a>
							<span class="zeroCLipBut"><span class="toClipBoard button" alt="page/view/7">Copy Page Link</span></span>					</td>
				</tr>
							<tr>
					
					<td>Contact</td>
					<td>Site Page</td>
					<td class="action">
							<a href="http://localhost/culture-update.com/page/view/5"><span class="act view"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/update/5"><span class="act edit"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/delete/5"><span class="act del"></span></a>
							<span class="zeroCLipBut"><span class="toClipBoard button" alt="page/view/5">Copy Page Link</span></span>					</td>
				</tr>
							<tr>
					
					<td>How To</td>
					<td>Resource</td>
					<td class="action">
							<a href="http://localhost/culture-update.com/page/view/8"><span class="act view"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/update/8"><span class="act edit"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/delete/8"><span class="act del"></span></a>
							<span class="zeroCLipBut"><span class="toClipBoard button" alt="page/view/8">Copy Page Link</span></span>					</td>
				</tr>
							<tr>
					
					<td>About</td>
					<td>Resource</td>
					<td class="action">
							<a href="http://localhost/culture-update.com/page/view/9"><span class="act view"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/update/9"><span class="act edit"></span></a>
							<a href="http://localhost/culture-update.com/backend/page/b_page/delete/9"><span class="act del"></span></a>
							<span class="zeroCLipBut"><span class="toClipBoard button" alt="page/view/9">Copy Page Link</span></span>					</td>
				</tr>
					</table>
	</div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>