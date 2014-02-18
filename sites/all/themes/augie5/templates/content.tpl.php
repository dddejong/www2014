
<div id="wrapper">
	<div id="wrapper-shade">
	
		<div id="titlebar">
			<h1 class="<?php print $title_class; ?>"><?php print $title_class; ?></h1>
			<?php
		if ($breadcrumb != '') {
			print $breadcrumb;
		}?>	
		
		</div>
	
		<div id="content" class="clearfix">
		
			<div id="sidebar">
				<?php print $left; ?>
				
				
			</div><!--END SIDEBAR -->
			
			<div id="main">
			
    <?php	
		if ($tabs != '') {
			print '<div class="tabs">'. $tabs .'</div>';
		}
		
		if ($messages != '') {
			print '<div id="messages">'. $messages .'</div>';
		}
				      
	 
	
				
		print $content; ?>
		
		
			</div><!--END MAIN-->
		</div><!--END CONTENT -->
	</div><!--END WRAPPER SHADE-->
</div><!--END WRAPPER-->
