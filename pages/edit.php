<?php


?>


<div class="magpie_page">
		<?php show_magpieheading("wecpi_edit_icon","Edit","Edit CSV file<sup>s</sup> online");?>
		<div class="wecpi_pro_hide_help">
				
				<?php //show_radio_csv_files();?>
<?php

if (!function_exists('show_box_edit_csv')) :

show_box_edit_csv();

endif;

/*if (magpie_input_action('delete_selected_images')) 

	foreach ($_POST['delete_image_files'] as $attachmentid) :
	wp_delete_attachment( $attachmentid, $force_delete = true );
	//echo $file.'<br />';
	endforeach;
*/

?>





	
		</div>
		<?php show_wecpi_copyright();?>
</div>