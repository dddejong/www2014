<div id="wrapper">
	<div id="wrapper-shade">
		<div id="feature">
<?php print $channel; ?>
			<h2 id="nav-flag">Choose Your Path</h2> 
<?php $filename = '/var/www/html/alerts/alert.html';

if (file_exists($filename)) { ?>
			<iframe src="/alerts/alert.html" id="alert-img" scrolling="no">
			</iframe> <?php } ?>
<?php 
		
			$menuhtml = home_menu_tree(313);
			print $menuhtml;
			?>
		</div>
<!--END FEATURE NAV-->
		<div id="content" class="clearfix">
			<div id="main">
				<div id="leadin">
<p class="lead">At Augustana, we believe certain individuals are called to “<em>Go</em> Viking.” They understand that in order to create an even better tomorrow, they must explore and discover bold concepts and important ideas today. Review our <a href="/admission/value">Value Proposition</a> and learn why your decision to “<em>Go</em> Viking” is so significant.</p>
			  </div>
<!--END LEAD IN -->
				<div class="column">
<?php print $homepage_left; ?>
					<a href="news">More news</a> 
				</div>
<!--END COLUMN 1 -->
				<div class="column">
<?php print $homepage_right; ?>
					<a href="events">All events</a> 
				</div>
<!--END COLUMN 2-->
			</div>
<!--END MAIN-->
			<div id="feature-bar">
<?print $right; ?>
			</div>
<!--END FEATURE BAR-->
		</div>
<!--END CONTENT -->
	</div>
<!--END WRAPPER SHADE-->
</div>
<!--END WRAPPER-->

