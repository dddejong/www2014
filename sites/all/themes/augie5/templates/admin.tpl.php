

<div id="wrapper">
	<div id="wrapper-shade">
	
		<div id="titlebar">
					<?php
		if ($breadcrumb != '') {
			print $breadcrumb;
		}?>	
		
		</div>
	
		<div id="content" class="clearfix">
		
			
			
			<div id="main-admin">
			
    <?php	
			if ($tabs != '') {
			print '<div class="tabs">'. $tabs .'</div>';
		}
		
		if ($messages != '') {
			print '<div id="messages">'. $messages .'</div>';
		}
				      
	 
			if ($title != '') {
			print '<h2>'. $title .'</h2>';
		}      	
		print $help; // Drupal already wraps this one in a class      
				
		print $content; ?>
		
		
			</div><!--END MAIN-->
		</div><!--END CONTENT -->
	</div><!--END WRAPPER SHADE-->
</div><!--END WRAPPER-->
