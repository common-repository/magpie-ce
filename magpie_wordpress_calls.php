<?php



if (!defined( 'MAGPIE_ONLINE')) :

add_action('admin_head', 'wecpi_include_css_and_js' );   
add_action('admin_init', 'wecpi_plugin_admin_init' );
add_action('admin_menu', 'wecpi_admin_menu');
register_activation_hook(__FILE__,'wecpipro_install');
register_deactivation_hook(__FILE__, 'wecpipro_uninstall');

endif;




if (!function_exists('wecpipro_install')) :
function wecpipro_install(){
	if(!class_exists('WP_eCommerce')){
			 deactivate_plugins(plugin_basename(__FILE__)); // Deactivate
			 wp_die( __('Looks like you have not activated WP e-Commerce. Please do so first.', 'magpie'), __('MagPie not compatible', 'magpie'), array('back_link' => true));
			return;
		}
}
endif;


if (!function_exists('wecpipro_uninstall')) :
function wecpipro_uninstall(){

	if (get_option("wecpi_uninstall") == "on")
	{
		delete_option("wecpi_uninstall");
		delete_option("check_ex_timestamp");
		delete_option("wecpi_pro_hide_help");
		delete_option("wecpi_primary_key");
		delete_option("wecpi_import_images_from");
		delete_option('wecpi_import_show_rows');
		delete_option("wecpipro_update");
		delete_option("wecpi_pro_ultra_backup");
		delete_option('dump_export');
		delete_option('insert_if_not_present');
		delete_option('magpie_bulk');

	}
}
endif;


if (!function_exists('wecpi_plugin_admin_init')) :
function wecpi_plugin_admin_init() {
    
	/* Register our stylesheet. */
	wp_register_style( 'magpiePluginStylesheet', MAGPIE_URL_PATH. 'style.css' );
	//wp_register_style( 'datatables_demo_table', WP_PLUGIN_URL . '/wecpi/datatables/css/demo_table.css' );
	//wp_register_style( 'flexigridcss', WP_PLUGIN_URL . '/wecpi/js/flexigrid/css/flexigrid.css' );
//wp_enqueue_script("wece123","/wp-content/plugins/wecpi/jquery.easing.1.3.js");
	wp_register_script("easing",MAGPIE_URL_PATH.'js/jquery.easing.1.3.js');
/*	wp_register_script('flexigrid', WP_PLUGIN_URL . '/wecpi/js/flexigrid/js/flexigrid.pack.js');
	wp_register_script('jeditable', WP_PLUGIN_URL . '/wecpi/js/jquery.jeditable.mini.js');
*/
	wp_register_script("magpiejs",MAGPIE_URL_PATH . 'js/magpie.js');
	
	
	wp_register_script("jquery_iphoneswitch",MAGPIE_URL_PATH. 'js/jquery.iphone-switch.js');
	
	wp_register_style ( 'jquery-ui-css', MAGPIE_URL_PATH. 'css/ui-lightness/jquery-ui-1.8.13.custom.css');	
	
	wp_register_script( 'jquery-ui-js', MAGPIE_URL_PATH . 'js/jquery-ui-1.8.13.custom.min.js');

	
	wp_register_script( 'mousewheel', MAGPIE_URL_PATH . 'fancybox/jquery.mousewheel-3.0.4.pack.js');
	wp_register_script( 'fancybox', MAGPIE_URL_PATH . 'fancybox/jquery.fancybox-1.3.4.pack.js');
	wp_register_style ( 'fancyboxcss',  MAGPIE_URL_PATH .'fancybox/jquery.fancybox-1.3.4.css');
	
	//http://flowplayer.org/tools/download/index.html
	//http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js
	//wp_register_script( 'jquerytools', geegood_com_get_plugin_url() . 'js/jquery.tools.min.js');
	wp_register_script( 'jquerytools', 'http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js');

	
	
	
	
	
	if (!get_option('wecpi_primary_key')) update_option('wecpi_primary_key','_wpsc_sku');
	if (!get_option('wecpi_import_images_from')) update_option('wecpi_import_images_from','image');
	if (!get_option('wecpi_import_show_rows')) update_option('wecpi_import_show_rows','12');
	if (!get_option('dump_export')) update_option('dump_export','on');
	if (!get_option('import_bulk')) update_option('import_bulk','10');

}
endif;





if (!function_exists('wecpi_include_css_and_js')) :
function wecpi_include_css_and_js() {
	
	//wp_register_script("wece123","/wp-content/plugins/wecpi/jquery.easing.1.3.js");
	wp_enqueue_script("jquery");
	
	

	//wp_enqueue_script('easing');//, WP_PLUGIN_URL . '/wecpi/jquery.easing.1.3.js');
	//wp_enqueue_script('easing', get_bloginfo('stylesheet_directory') . '/js/jquery.easing.1.3.js', array('jquery'), '1.32', true );
//	wp_enqueue_script('easing', '/wp-content/themes/wecpi/jquery.easing.1.3.js',false,'1.3');
}
endif;






if (!function_exists('wecpi_admin_menu')) :
function wecpi_admin_menu(){

	//http://codex.wordpress.org/Roles_and_Capabilities
	//$page = add_submenu_page( 'tools.php', 'WeCPi', 'WeCPi', 'administrator', 'wecpi', 'wecpi');
	
	global $wecpi_plugin_hook_page;
	$wn = MAGPIE_NAME;
	$wecpi_plugin_hook_page = add_submenu_page( 'edit.php?post_type=wpsc-product', $wn, $wn, 'administrator', 'magpie', 'magpie');

if (isset($_GET['page']) && $_GET['page'] == 'magpie') :	
	add_action( 'admin_print_styles-' . $wecpi_plugin_hook_page, 'wecpi_plugin_admin_styles' );
endif;

}
endif;

if (!function_exists('wecpi_plugin_help')) :
function wecpi_plugin_help($contextual_help, $screen_id, $screen) {

/*
Wraps around inside: <div id="contextual-help-wrap" class="hidden">
*/
	global $wecpi_plugin_hook_page;
	if ($screen_id == $wecpi_plugin_hook_page) {

$contextual_help = '<div style="width:700px;"><div class="wecpi_help_icon" style="position:relative;float:left;margin-right:20px;"></div><h4>Quick help can be found by selecting the <i>Settings/Help</i> menu where a selection of topics has been collected to ensure that '.MAGPIE_NAME.' and terminologies are explained to ease the process of dealing with import and export of data.</h4><br style="clear:both"><p>Further support, help and FAQ can be found on the website of <a target="_blank" href="http://geegood.com/wordpress/plugins/wecpi/pro/">'.MAGPIE_NAME.'</a></p><p>If you get to a point where you need personal support, just contact Mr. Neil any day/time at <a href="mailto:wecpi@geegood.com">wecpi@geegood.com</a> and I will get back to you as soon as I can.<br style="clear:both"></div>';
	}
	return $contextual_help;
}
endif;







if (!function_exists('wecpi_plugin_admin_styles')) :
function wecpi_plugin_admin_styles() {
       
// It will be called only on your plugin admin page, enqueue our stylesheet here


/* Here for WP upload to media WP standard stuff not WORKING!! */
//wp_enqueue_style('thickbox');
//wp_enqueue_script('media-upload');
//wp_enqueue_script('thickbox');
//wp_enqueue_script( 'jquerytools' );

wp_enqueue_style( 'magpiePluginStylesheet' );

/* Fancy Box http://fancybox.net/ */
wp_enqueue_style('fancyboxcss');
wp_enqueue_script('mousewheel');
wp_enqueue_script('fancybox');


/* MagPie spesifics */
wp_enqueue_style( 'jquery-ui-css');
wp_enqueue_script( 'jquery-ui-js' );


wp_enqueue_script('jquery_iphoneswitch');
wp_enqueue_script('easing');

wp_enqueue_script('magpiejs');
/*wp_enqueue_style( 'flexigridcss' );
	*/

/*	  wp_enqueue_script('flexigrid');
	  wp_enqueue_script('jeditable');
*/
}
endif;






/*
*
*
*
*
*
*
*
*/
if (!function_exists('magpie')) :

function magpie(){


include(MAGPIE_INCLUDE_PATH . '/magpie_data.php' );
include(MAGPIE_INCLUDE_PATH . '/magpie_functions.php' ); 
include(MAGPIE_INCLUDE_PATH . '/geegoodcom_config.php' ); 
include(MAGPIE_INCLUDE_PATH . '/magpie_ajax.php' ); 

if (!defined('MAGPIE_ONLINE')) magpie_write_name_and_version();

magpie_create_upload_directories();

get_wecpi_config2();

get_local_wecpi_config2();

include(MAGPIE_INCLUDE_PATH . '/magpie_pages.php' );

}

endif;
/*
*
*
*
*
*
*
*
*/


if (!defined('MAGPIE_ONLINE')) add_filter('contextual_help', 'wecpi_plugin_help', 10, 3);

if (defined('MAGPIE_ONLINE')) wecpi_online();

