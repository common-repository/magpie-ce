<?php

?>

<div class="magpiewrapper">
		
		
		
		<!--
				
									WECPI MAIN MENU and HEADER
				

				
				-->
		
		<div id="wecpiheader">
				<div class="mainmenu">
						MagPie
				</div>
				<div class="mainmenu">
						Import
				</div>
				<div class="mainmenu">
						Export
				</div>
				<div class="mainmenu">
						Manage CSV
				</div>
				<div class="mainmenu">
						Media
				</div>
				<div class="mainmenu">
						ToolBox
				</div>
				<div class="mainmenu">
						Setting+?
				</div>
				<div class="mainmenu">
						Upgrade
				</div>
		</div>
		<div id="magpie_main">
		
		
				
				
				<!--
								
				
									FRONT PAGE
				
				
				-->
				<?php include(MAGPIE_FILE_PATH.'pages/frontpage.php');?>
				<!--
								
				
									IMPORT PAGE
				
				
				-->
				<?php include(MAGPIE_FILE_PATH.'pages/import.php');?>
				
				<!--
				
				
							EXPORT PAGE
						
						
						
				-->
				
				<?php include(MAGPIE_FILE_PATH.'pages/export.php');?>
				
				<!--
				
				
							MANAGE CSV PAGE
						
						
						
				-->
				
				<?php include(MAGPIE_FILE_PATH.'pages/managecsv.php');?>
				
				<!--
				
				
							MEDIA PAGE
						
				
				-->
				<?php include(MAGPIE_FILE_PATH.'pages/media.php');?>
				
				
				<!--


							TOOLBOX PAGE

-->
				
				<?php 
						
					include(MAGPIE_FILE_PATH.'pages/toolbox.php');?>
				<!--
				
				
				
				
							SETTINGS / HELP PAGE
							
							
							
				-->
				<?php include(MAGPIE_FILE_PATH.'pages/settings.php');?>
				<!--


							UPGRADE PAGE

-->
				
				<?php include(MAGPIE_FILE_PATH.'pages/upgrade.php');?>
				<!--


							WORDPRESS PAGE

-->
				
				<?php //include(MAGPIE_FILE_PATH.'pages/wordpress.php');?>
		</div>
</div>
<?php


