<?php
global $image_module_description;
$image_module_description='<h4>Media</h4>'.
'This module is present in PRO displaying ID numbers for image media files and product downlodables.';

?>

<div class="magpie_page">
		
		<?php show_magpieheading("wecpi_media_icon","Media","MagPie<sup>Media Library</sup>");?>
		
		<?php if (function_exists('media_module')) media_module(); else echo $image_module_description;?>
		
		<?php show_wecpi_copyright();?>
</div>
