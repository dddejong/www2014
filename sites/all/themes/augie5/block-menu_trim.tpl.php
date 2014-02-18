<div id="block-<?php print $block->module .'-'. $block->delta; ?>" class="clear-block block block-<?php print $block->module ?>">

<?php
//print_r($path_root_array);
//print_r($block->subject);


// Next section is for exceptions to areas under College Offices and other specific areas so that they do not get double links on menu trimmed menus

       if ($path_root_array[2] && 
       ($path_root_array[1] == 'college-offices-and-affiliates'))
        	{ if ($block->subject &&
				($block->subject != "College Offices and Affiliates" && $block->subject != "Autism Conference" && $block->subject !="Commencement Weekend" && $block->subject !="Sesquicentennial Celebration" && $block->subject != "The Spark! Gala Event" && $block->subject != "Viking Days"))
				{ ?>
					<h2 style="border-bottom: 1px solid #ECECEC;">
						<a style="color:#002866" href="/about/college-offices-and-affiliates/<?php print $path_root_array[2] ?>">
						<?php print $block->subject ?>
						</a>
					</h2> 
				<?php }
			}
?>

<?php
	if ($path_root_array[2] == 'midwest-conference-deaf-education')
	{ ?>
		<h2 style="border-bottom: 1px solid #ECECEC;">
		<a style="color:#002866" href="/academics/continuing-education-and-workshops/midwest-conference-deaf-education">
		<?php print $block->subject ?>
		</a>
		</h2>
		<?php
	}
?>

<?php
	if ($path_root_array[2] == 'autism')
	{ ?>
		<h2 style="border-bottom: 1px solid #ECECEC;">
		<a style="color:#002866" href="/academics/continuing-education-and-workshops/autism">
		<?php print $block->subject ?>
		</a>
		</h2>
		<?php
	}
?>

<?php
        if ($path_root_array[2]
        && ($path_root_array[0] == 'academics'))
         { if ($block->subject &&
	($block->subject != "Academics" && 
	($block->subject != "Disability Services" &&
	($block->subject != "Midwest Conference on Deaf Education" &&
	($block->subject != "Autism Conference"))))) { ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
	<a style="color:#002866" href="/academics/<?php print $path_root_array[1] ?>">
<?php print $block->subject ?>
        </a>
	</h2> 
<?php }
}
?>

<?php
        if ($path_root_array[2] == 'disability-services'
        && ($path_root_array[0] == 'academics'))
         { if ($block->subject &&
	($block->subject != "Academics")) { ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
	<a style="color:#002866" href="/academics/academic-support/disability-services">
<?php print $block->subject ?>
        </a>
	</h2> 
<?php }
}
?>

<?php
        if ($path_root_array[1] == 'financing-your-education'
        && ($path_root_array[0] == 'admission'))
         { if ($block->subject) { ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
	<a style="color:#002866" href="/admission/financing-your-education">
	Financial Aid
        </a>
	</h2> 
<?php }
}
?>

<?php
    if ($path_root_array[4] == 'commencement'
    && ($path_root_array[0] == 'about'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/about/college-offices-and-affiliates/marketing/college-events/co
mmencement">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[4] == 'spark'
    && ($path_root_array[0] == 'about'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/about/college-offices-and-affiliates/marketing/college-events/spark">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[4] == 'viking-days'
    && ($path_root_array[0] == 'about'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/about/college-offices-and-affiliates/marketing/college-events/viking-days">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[4] == 'sesquicentennial-celebration'
    && ($path_root_array[0] == 'about'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/about/college-offices-and-affiliates/marketing/college-events/sesquicentennial-celebration">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[1]
    && ($path_root_array[0] == 'information-technology'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/information-technology">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[2] == 'tracy-riddle'
    && ($path_root_array[0] == 'campuslife'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/campuslife/dean-students-office/tracy-riddle">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

<?php
    if ($path_root_array[2] == 'new-student-orientation'
    && ($path_root_array[0] == 'campuslife'))
	{ ?>
        <h2 style="border-bottom: 1px solid #ECECEC;">
			<a style="color:#002866" href="/campuslife/getting-involved/new-student-orientation">
				<?php print $block->subject ?>
	        </a>
		</h2> 
	<?php }
?>

	<div class="content"><?php print $block->content ?></div>
</div>
