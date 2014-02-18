<?php cache_clear_all(); ?>

<div id="wrapper">
	<div id="wrapper-shade">
	
	  <div id="titlebar">
			<h1 class="<?php print $title_class; ?>"><?php print $title_class; ?></h1>
	
	
	<?php print $channel; ?>


	  			<?php
	  		
		if ($breadcrumb != '') {
			print $breadcrumb;
		} ?>
	  </div>
	  <!--END TITLE BAR -->

		<div id="content" class="clearfix">
		
			<div id="sidebar">
			
					<?php print $left; ?>
			<!-- 				
				<h3 class="title">Choose your path:</h3>
				
				<ul id="secondary-nav">
					<li><a href="">Prospective Students</a></li>
					<li><a href="">Current Students</a></li>
					<li><a href="">Faculty &amp; Staff</a></li>
					<li><a href="">Alumni</a></li>
					<li><a href="">Parents</a></li>
					<li><a href="">Church &amp; Community</a></li>
				</ul>		-->
			</div><!--END SIDEBAR -->
			
			<div id="main">
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

