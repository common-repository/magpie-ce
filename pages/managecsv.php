
		<!--	
	
	MANAGE page
	
	
	
	
	-->
	
	

<div class="magpie_page">
	
		<?php show_magpieheading("wecpi_managecsv_icon","Manage CSV","Get or delete CSV");?>
		
		
		<?php if (function_exists('show_manage_csv')) show_manage_csv(); else echo '<div class="alert_box">Manage CSV online only in PRO</div>';
		?>
		
</div>