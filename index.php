<?php 
/*
@package MagPie<sup>PRO</sup>
Plugin Name: MagPie CE
Plugin URI: http://geegood.com/wordpress
Description: Product Import/Export (PIE) - MagPie is the name - all via CSV file format. Imports, exports , inserts and updates products incl. adding product image from WordPress Media Library. Basic but highly recommendable... Keep backups of your products with MagPie in PRO and sort the CSV file and import back into WPEC - as easy as a bird can fly. This is a serious professional solution for the serious business owner. It is a one-of-a-kind and the first major solution for WP e-Commerce. Happy Shopping.
Version: 3.0.9
Author: geegood.com/wordpress
Author URI: http://geegood.com/wordpress
************************************************************************/



//if (!defined( 'MAGPIE_DEVELOPMENT' )) define ( 'MAGPIE_DEVELOPMENT' , true );
//if (!defined( 'MAGPIE_PRODUCTION')) define('MAGPIE_PRODUCTION','Alpha');
//if (!defined( 'MAGPIE_FORCE_VERSION')) define('MAGPIE_FORCE_VERSION','ULTRA');
//global $magpie_object;


$domainname=$_SERVER['HTTP_HOST'];

$magpie_upload_dir_data = wp_upload_dir();
$magpie_upload_dir = $magpie_upload_dir_data['basedir'];
$magpie_upload_url = $magpie_upload_dir_data['baseurl'];
$magpie_upload_dir=str_replace('\\','/',$magpie_upload_dir);
/*echo $magpie_upload_dir.'<br>';
echo $magpie_upload_url.'<br>';
die();
*/
define ('MAGPIE_BASE_URL',get_bloginfo("url"));
//http://geegood.com
define ( 'MAGPIE_FILE_PATH' , dirname( __FILE__ ) .'/'); 
//Websites/geegood.june25/wp-content/plugins/magpiealpha/
define ( 'MAGPIE_URL' , plugins_url( '', __FILE__ ) .'/'); 
//http://geegood.site/wp-content/plugins/magpiealpha/
$MAGPIE_URL_PATH = str_replace('http://'.$domainname,"",MAGPIE_URL);
define ( 'MAGPIE_URL_PATH' ,$MAGPIE_URL_PATH);
//wp-content/plugins/magpiealpha/
/*echo $domainname.'<br />';
echo MAGPIE_BASE_URL.'<br />';
echo MAGPIE_FILE_PATH.'<br />';
echo MAGPIE_URL.'<br />';
echo MAGPIE_URL_PATH.'<br />';
*/
//define ( 'MAGPIE_URL_PATH' ,WP_PLUGIN_URL.dirname(__FILE__));

//echo '----'.MAGPIE_URL_PATH.'<----';
//die();//. '<br /> '.$magpie_url.'<br /> ' .MAGPIE_FILE_PATH;die();
define ('BIRD_PATH','bird/');

define ('BIRD_ULTRA',BIRD_PATH.'ultra.php');
define ('BIRD_PRO',BIRD_PATH.'pro.php');
define ('BIRD_STANDARD',BIRD_PATH.'standard.php');
define ('BIRD_CE',BIRD_PATH.'ce.php');
define ('BIRD_SPECIAL',BIRD_PATH.'special.php');


define ('MAGPIETEMPLATE','template.php');
define ('MAGPIEMEDIA','media.php');
define ('MAGPIETOOLBOX','toolbox.php');
define ('MAGPIEEXPORT','export.php');
define ('MAGPIEIMAGE','image.php');
define ('MAGPIEIMPORT','import.php');

define ('MAGPIE_MODULES_PATH' , BIRD_PATH.'modules/');

if (!defined('MAGPIE_FORCE_VERSION')) {
if (file_exists ( MAGPIE_FILE_PATH.BIRD_SPECIAL)) include_once (MAGPIE_FILE_PATH.BIRD_SPECIAL);
if (file_exists ( MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIETEMPLATE )) include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIETEMPLATE);
if (file_exists ( MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEMEDIA )) include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEMEDIA);
if (file_exists ( MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIETOOLBOX )) include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIETOOLBOX);
if (file_exists ( MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEEXPORT )) include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEEXPORT);
if (file_exists ( MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT )) include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT);
}
elseif (MAGPIE_FORCE_VERSION === "CE") {
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT );
	}
elseif (MAGPIE_FORCE_VERSION === "STANDARD") {
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMAGE);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT);
}
elseif (MAGPIE_FORCE_VERSION === "PRO") {
	include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEEXPORT);
	include_once (MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMAGE);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT);
}
else {

	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEMEDIA);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIETOOLBOX);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEEXPORT);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMAGE);
	include_once(MAGPIE_FILE_PATH.MAGPIE_MODULES_PATH.MAGPIEIMPORT);
}




//(dirname ( __FILE__ )) . '/pro/ultra.php' )
//if (!defined( 'MAGPIE_BETA' )) define ( 'MAGPIE_BETA' , true );


if (!defined( 'MAGPIE_ONLINE_URL')) define ('MAGPIE_ONLINE_URL','http://geegood.com/wp-content/plugins/magpiepro/');
if (!defined( 'MAGPIE_NAME')) define ('MAGPIE_NAME','MagPie<sup>NULL</sup>');
//if (!defined( 'MAGPIE_ONLINE_PATH')) define ( 'MAGPIE_ONLINE_PATH', './wp-content/plugins/magpie');
if (!defined( 'MAGPIEVERSION')) define ('MAGPIEVERSION','3.0');
if (!defined( 'MAGPIE_RELEASE_DATE')) define ('MAGPIE_RELEASE_DATE','July 3<sup>rd</sup> 2011');
if (!defined( 'EXPORT_CSV_FILENAME')) define ('EXPORT_CSV_FILENAME','magpie_product_export');
if (!defined( 'MAGPIE_PAGE_URL')) define ('MAGPIE_PAGE_URL','edit.php?post_type=wpsc-product&page=magpie');

if (!defined( 'MAGPIE_WP_UPLOAD_FOLDER' )) define ( 'MAGPIE_WP_UPLOAD_FOLDER' ,$magpie_upload_dir.'/');
if (!defined( 'MAGPIE_UPLOAD_FOLDER' )) define ( 'MAGPIE_UPLOAD_FOLDER' ,$magpie_upload_dir.'/magpie/');
if (!defined( 'MAGPIE_UPLOAD_CSV_FOLDER' )) define ( 'MAGPIE_UPLOAD_CSV_FOLDER' ,''.$magpie_upload_dir.'/magpie/csv/');
if (!defined( 'MAGPIE_UPLOAD_CSV_URL' )) define ( 'MAGPIE_UPLOAD_CSV_URL' ,$magpie_upload_url.'/magpie/csv/');


//$u=str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
//if (!defined( 'MAGPIE_BASEURL')) define( 'MAGPIE_BASEURL','/wp-content/plugins/'.$u);


if (!defined( 'MAGPIE_ONLINE' )) define ( 'MAGPIE_INCLUDE_PATH' ,MAGPIE_FILE_PATH );else define ( 'MAGPIE_INCLUDE_PATH',MAGPIE_ONLINE_PATH );

if (!defined('MAGPIE_CONFIG_FILENAME')) define ( 'MAGPIE_CONFIG_FILENAME','config/config.'.MAGPIEVERSION.'.cfg'); 

//if (!defined('MAGPIE_CONFIG_URL')) 
define ( 'MAGPIE_CONFIG_URL', MAGPIE_ONLINE_URL.MAGPIE_CONFIG_FILENAME);


include(MAGPIE_INCLUDE_PATH . 'magpie_data.php' );
include(MAGPIE_INCLUDE_PATH . 'magpie_functions.php' ); 
include(MAGPIE_INCLUDE_PATH . 'geegoodcom_config.php' ); 
include(MAGPIE_INCLUDE_PATH . 'magpie_ajax.php' ); 


//include(MAGPIE_INCLUDE_PATH . '/magpie_wordpress_calls.php' ); 

add_action('wp_ajax_magpie_list_csv_callback', 'magpie_list_csv_callback');
add_action('wp_ajax_magpie_delete_csv_callback', 'magpie_delete_csv_callback');

add_action('wp_ajax_update_selection_callback', 'update_selection_callback');
add_action('wp_ajax_get_selection_callback', 'get_selection_callback');
add_action('wp_ajax_get_media_callback', 'get_media_callback');

//add_action('wp_ajax_nopriv_magpie_get_field_names_callback', 'magpie_get_field_names_callback');
add_action('wp_ajax_magpie_get_field_names_callback', 'magpie_get_field_names_callback');
//add_action('wp_ajax_magpie_dump_csv_mysql', 'magpie_dump_csv_mysql');

//add_action('wp_ajax_nopriv_magpie_fetch_csv_callback', 'magpie_fetch_csv_callback');
add_action('wp_ajax_magpie_fetch_csv_callback', 'magpie_fetch_csv_callback');

add_action('wp_ajax_import_callback', 'ajax_import_callback');

add_action('wp_ajax_export_callback', 'ajax_export_callback_func');

//MagPie ToolBox
add_action('wp_ajax_delete_all_wpsc_products', 'delete_all_wpsc_products');

//else wp_die("Need to be admin to run MagPie!");






if (!defined( 'MAGPIE_ONLINE')) :

add_filter('contextual_help', 'wecpi_plugin_help', 10, 3);
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

	}
}
endif;



if (!function_exists('wecpi_plugin_admin_init')) :
function wecpi_plugin_admin_init() {
    
	/* Register our stylesheet. */
	wp_register_style( 'magpiePluginStylesheet', MAGPIE_URL. 'style.css' );
	//wp_register_style( 'datatables_demo_table', WP_PLUGIN_URL . '/wecpi/datatables/css/demo_table.css' );
	//wp_register_style( 'flexigridcss', WP_PLUGIN_URL . '/wecpi/js/flexigrid/css/flexigrid.css' );
//wp_enqueue_script("wece123","/wp-content/plugins/wecpi/jquery.easing.1.3.js");
	//wp_register_script("easing",MAGPIE_URL_PATH.'js/jquery.easing.1.3.js');
/*	wp_register_script('flexigrid', WP_PLUGIN_URL . '/wecpi/js/flexigrid/js/flexigrid.pack.js');
	wp_register_script('jeditable', WP_PLUGIN_URL . '/wecpi/js/jquery.jeditable.mini.js');
*/
	wp_register_script("magpiejs",MAGPIE_URL . 'js/magpie.js');
	
	
	wp_register_script("jquery_iphoneswitch",MAGPIE_URL. 'js/jquery.iphone-switch.js');
	
	wp_register_style ( 'jquery-ui-css', MAGPIE_URL. 'css/ui-lightness/jquery-ui-1.8.13.custom.css');	
	
	wp_register_script( 'jquery-ui-js', MAGPIE_URL . 'js/jquery-ui-1.8.13.custom.min.js');

	
	wp_register_script( 'mousewheel', MAGPIE_URL . 'fancybox/jquery.mousewheel-3.0.4.pack.js');
	wp_register_script( 'fancybox', MAGPIE_URL . 'fancybox/jquery.fancybox-1.3.4.pack.js');
	wp_register_style ( 'fancyboxcss',  MAGPIE_URL .'fancybox/jquery.fancybox-1.3.4.css');
	
	//http://flowplayer.org/tools/download/index.html
	//http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js
	//wp_register_script( 'jquerytools', geegood_com_get_plugin_url() . 'js/jquery.tools.min.js');
	//wp_register_script( 'jquerytools', 'http://cdn.jquerytools.org/1.2.5/jquery.tools.min.js');

	
	
	
	
	
	if (!get_option('wecpi_primary_key')) update_option('wecpi_primary_key','_wpsc_sku');
	if (!get_option('wecpi_import_images_from')) update_option('wecpi_import_images_from','image');
	if (!get_option('wecpi_import_show_rows')) update_option('wecpi_import_show_rows','12');
	if (!get_option('dump_export')) update_option('dump_export','on');

}
endif;




if (!function_exists('wecpi_include_css_and_js')) :
function wecpi_include_css_and_js() {
	
	//wp_register_script("wece123","/wp-content/plugins/wecpi/jquery.easing.1.3.js");
	//wp_enqueue_script("jquery");
	
	

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
/*wp_enqueue_style('thickbox');
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script( 'swfupload-handlers' );
*/

//http://codex.wordpress.org/Function_Reference/wp_enqueue_script
wp_enqueue_script( 'jquerytools' );

wp_enqueue_style( 'magpiePluginStylesheet' );

/* Fancy Box http://fancybox.net/ */
wp_enqueue_style('fancyboxcss');
wp_enqueue_script('mousewheel');
wp_enqueue_script('fancybox');


/* MagPie spesifics */
wp_enqueue_style( 'jquery-ui-css');
wp_enqueue_script( 'jquery-ui-js' );

//wp_enqueue_script( 'jquery-ui-core');

wp_enqueue_script('jquery_iphoneswitch');
//wp_enqueue_script('easing');

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

function magpie() {

ini_set("memory_limit","512M");

if (!defined('MAGPIE_ONLINE')) magpie_create_upload_directories();

get_wecpi_config2();

get_local_wecpi_config2();

check_bleeding_version2();

if (!defined('MAGPIE_ONLINE'))  magpie_write_name_and_version();

include(MAGPIE_INCLUDE_PATH . 'magpie_pages.php' );



}

endif;




?>