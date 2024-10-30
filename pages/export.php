<div class="magpie_page">

<?php show_magpieheading("wecpi_export_icon","Export","From WPEC 2 CSV");					
						
						
		
		if (function_exists('export_module')) export_module();
	
		else
		{
			?>
			<div class="alert_box">
			Export module only available in MagPie STANDARD and PRO
			</div>
			<?php
			}

		
		show_wecpi_copyright();
		?>
</div>
