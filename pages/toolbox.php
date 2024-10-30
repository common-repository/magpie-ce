<?php

		
		
		
?>
<div class="magpie_page">
		
		<?php show_magpieheading("wecpi_toolbox_icon","ToolBox","Plugins for MagPie? Right here.");?>
		
		<?php
		
		if (function_exists("toolbox_module")) toolbox_module();
		
		else
		{
			?>
			<div class="infobox">
			<h4>MagPie PRO's ToolBox</h4>
			<p>A set of tools is included in PRO and more can be added.</p>
			<?php
			
			$rectool=get_config_value('toolboxnews');
			if ($rectool) echo '<div class="recommended_toolbox">'.$rectool.'</div>';
			
			?>	</div>			
			<?php
			}
		
		?>
		
		
		<?php show_wecpi_copyright();?>
</div>
