<div id="wrapper">
	<div id="wrapper-shade">
		
		<div id="titlebar">
			<h1 class="<?php print $title_class; ?>"><?php print $title_class; ?></h1>
			
			<?php
	  		if ($breadcrumb != '') {
				print $breadcrumb;
			} 
			?>
	  	</div>
	  	<!--END TITLE BAR -->

		<div id="content" class="clearfix">
		
			<div id="sidebar">
				
				<?php print $left; ?>
			
			</div><!--END SIDEBAR -->
			
			<?php if (!$node->type) { ?>
				<div id="main-news" class="clearfix">
			<?php } else { ?>
				<div id="main" class="clearfix">
			<?php }  ?>
						
				<?php	
				if ($tabs != '') {
					print '<div class="tabs">'. $tabs .'</div>';
				}
		
				if ($messages != '') {
					print '<div id="messages">'. $messages .'</div>';
				}
				print $top;		      
	 		
				if (!$_GET['page']) {
				if ($title != '') {
					print $title;
				}      	
				}
		
				print $help; // Drupal already wraps this one in a class      

				print $content; 
				
				?>
			
			
				
			
				
			</div><!--END MAIN-->
			
			<?php if (!$node->type) { ?>
			<div id="side" class="clearfix">
				<?php print $right; ?>
			</div>
			<?php } ?>
		
				
		</div><!--END CONTENT -->
	
	</div><!--END WRAPPER SHADE-->

</div><!--END WRAPPER-->

