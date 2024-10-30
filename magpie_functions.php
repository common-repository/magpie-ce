<?php




/*
Sort multi array:
http://www.phpfreaks.com/forums/index.php?topic=209483.0
*/


//global $product_columns;
//global $product;
if (!function_exists('magpie_meta')) :

function magpie_meta ($this) {
$val=@unserialize($this[0]);
if ($val) return json_encode($val);
//if (is_array($this[0])) return 'fffffff'.json_encode($this);
//$val=@unserialize($this);
//$out=array();
//foreach ($this as $k=>$v) $out=$v;
return $this[0];
}
endif;


if (!function_exists('magpie_decode')) :

function magpie_decode ($this,$out="") {

	
	
	if (is_array($this)) {
		array_push ($out,$this);
		magpie_decode(array_shift($this),$out);
	}
	return array($out);
	//$out.=magpie_decode(array_shift($this),$out);
//	foreach ($v as $k2=>$v2) {$csvline[$k]=magpie_json($v[0]);}
}
endif;
				
if (!function_exists('magpie_uns')) :
					
function magpie_uns($this) {
if (is_array($this)) return json_encode($this);
return $this;
}
endif;


if (!function_exists('magpie_json')) :

function magpie_json($this) {
if (is_array($this)) return json_encode($this);
return $this;
}
endif;

if (!function_exists('init_product_columns')) :
function init_product_columns($product){
//global $product_columns;
//global $product;
$product_columns = array(
	
				"ID" =>	$product['ID'],
				"post_author" => $product['post_author'],
				"post_date" => $product['post_date'],
				"post_date_gmt" => $product['post_date_gmt'],
				"post_content" => $product['post_content'],
				"post_title" => $product['post_title'],
				"post_excerpt" => $product['post_excerpt'],
				"post_status" => $product['post_status'],
				"comment_status" => $product['comment_status'],
				"ping_status" => $product['ping_status'],
				"post_password" => $product['post_password'],
				"to_ping" => $product['to_ping'],
				"pinged" => $product['pinged'],
				"post_modified" => $product['post_modified'],
				"post_modified_gmt" => $product['post_modified_gmt'],
				"post_content_filtered" => $product['post_content_filtered'],
				"post_parent" => $product['post_parent'],
				"guid" => $product['guid'],
				"menu_order" => $product['menu_order'],
				"post_type" => $product['post_type'],
				"post_mime_type" => $product['post_mime_type'],
				"comment_count" => $product['comment_count'],
				"ancestors" => $product['ancestors'],
				"filter" => $product['filter'],
				'import_id' => $product['import_id'],
				
				
				
				
				
				/*'wpsc_product_category' => json_decode($product['wpsc_product_category']),
				'product_tag' => json_decode($product['product_tag']),
				'wpsc-variation' => json_decode($product['wpsc-variation']),
				*/
				'wpsc_product_category' => $product['wpsc_product_category'],
				'product_tag' => $product['product_tag'],
				'wpsc-variation' => $product['wpsc-variation'],
				
					
				
				//'image' => $product['image'],
				//'image_url' => $product['image_url'],//added2
				//'quantity_limited' => $product['quantity_limited'],
				//'quantity' => $product['quantity'],
				//'special' => $product['special'],
				
				//'display_frontpage' => esc_attr( $product['display_frontpage'] ),
				//'notax' => esc_attr( $product['notax'] ),
				//'active' => esc_attr( $product['active'] ),
				//'donation' => esc_attr( $product['donation'] ),
				//'no_shipping' => $product['no_shipping'] ,
				//'sticky' => esc_attr( $product['sticky'] ), //added2
				
				/*'thumbnail_image' => esc_attr( $product['thumbnail_image'] ),
				'thumbnail_state' => esc_attr( $product['thumbnail_state'] ),
				*/
				//'new_custom_meta' => '', //added2 needs fixing is an array see product-functions.php line 810
				//'newCurrency' => explode(';',$product['newcurrency'] ),//added2
				//'newCurrPrice' => array(), //added2 needs what to do?
			
			
				'custom_meta' => json_decode($product['custom_meta'],true),
				'new_custom_meta' => json_decode($product['new_custom_meta'],true),
				
				
				'meta' => array(
					'_wpsc_price' => str_replace( '$', '', $product['_wpsc_price'] ),
					'_wpsc_special_price' => $product['_wpsc_special_price'],
					'_wpsc_sku' => $product['_wpsc_sku'] ,
					'_wpsc_stock' => $product['_wpsc_stock'] ,
					'_wpsc_is_donation' => $product['_wpsc_is_donation'],
					'_wpsc_currency'=> json_decode($product['_wpsc_currency'],true),
					'_thumbnail_id'=>$product['_thumbnail_id'],
					
					'_wpsc_limited_stock'=>$product['_wpsc_limited_stock'],
					
					 //added
					
					'_wpsc_product_metadata' => array(
						'file'=>$product['product_file'],
						'wpec_taxes_taxable_amount' => $product['wpec_taxes_taxable_amount'], //added2
						'weight' => $product['weight'],
						'weight_unit' =>$product['weight_unit'],						
						'unpublish_when_none_left' =>  $product['unpublish_when_none_left'], //added
						'no_shipping' =>  $product['no_shipping'], //added
						//'quantity_limited' =>  $product['quantity_limited'], //added
						'external_link' =>  $product['external_link'], //added
						'external_link_text' =>  $product['external_link_text'], //added
						'external_link_target' =>  $product['external_link_target'], //added
						'enable_comments' => $product['enable_comments'], //added
						'merchant_notes' => $product['merchant_notes'],
						'dimensions' =>  json_decode($product['dimensions'],true),
								/*array(
								'height' =>  $product['height'], //added2
								'height_unit' =>  $product['height_unit'], //added2
								'width' => $product['width'], //added2
								'width_unit' =>  $product['width_unit'], //added2
								'length' =>  $product['length'], //added2
								'length_unit' =>  $product['length_unit'] //added2
								),*/
						'shipping' => json_decode($product['shipping'],true),
						/*array(
								'local' =>  $product['shipping']['local'], //added
								'international' => $product['shipping']['international'],true) //added
								),*/
						//'local' =>  json_decode($product['local'],true), //added
						//'international' => json_decode($product['international'],true), //added
						'table_rate_price' => json_decode($product['table_rate_price'],true),
						'engraved' => $product['engraved'], //added2
						'can_have_uploaded_image' =>  $product['can_have_uploaded_image'], //added2
						'special' =>  $product['special'], //added2
						'display_weight_as' =>  $product['display_weight_as'], //added2
						'google_prohibited' =>  $product['google_prohibited'] //added2
						
						
					)
				)			
			);
			
return $product_columns;
}
endif;



/*
$buildinfo = array();
$buildinfo[]="Implemented build version";
$buildinfo[]="Auto update from build version";
$buildinfo[]="Small fixes";
$buildinfo[]="Auto message when new build ready fixed";
$buildinfo[]="Save to upload folder on single and network WP changed - testing. Implemented build info message";
$buildinfo[]="Adjustments to the UI and contextual Help top-right in production";
$buildinfo[]="UI fixes";
$buildinfo[]="Testing auto update so new builds are frequent here in the beginning. Later less frequent.";
$buildinfo[]="Skype help available in Settings/Help page plus UI fixes";
*/



if (!function_exists('dump_this')) :
function dump_this($this){
if (!is_array($this)) return "";
$out="";
foreach ($this as $k=>$v)
	{
		//if (is_array($v)) dump_r($v);
		$out.= $k.'=>'.$v.',';
	}
return $out;
}
endif;

if (!function_exists('dump_r')) :
function dump_r($this,$tab=""){
foreach ($this as $k=>$v)
	{
		if (is_array($v)) dump_r($v,$tab.' => ');
	//	echo $tab.$k.'=>'.$v.'<br />';
		printf ("%s%'_-35s %s<br />",$tab,$k,$v);

	}
}
endif;


if (!function_exists('dump_v')) :
function dump_v($this,$num=-1,$list=true,$headlines=-1){
	if (!$this) return;
if ($list) echo '<ul>';
foreach ($this as $k=>$v)
	{
		if (is_array($v)) dump_v($v,$num,$list);
		if ($list) echo '<li>';
		if ($headlines-->0) echo '<span style="font-size:1.2em;font-weight:bold">';
		echo $v;
		if (!$list) echo '<br />';
		if ($headlines>0) echo '</span>';
		if ($list) echo '</li>';
		$num--;
		if ($num==0) break;
	}
if ($list) echo '</ul>';
}
endif;

global $first_dump_k;
if (!function_exists('dump_k')) :
function dump_k($this,$num=-1,$list=true,$array=false){
global $first_dump_k;
foreach ($this as $k=>$v)
	{
		
		if ($list) $first_dump_k.='<li>';
		if ($array) $first_dump_k.=$k.',';else $first_dump_k.= $k;
		if ($list) $first_dump_k.= '</li>';
		$num--;
		if ($num==0) break;
		if (is_array($v)) dump_k($v,$num,$list,$array);
	}
return $first_dump_k;
}
endif;



if (!function_exists('get_build_version')) :
function get_build_version($where="local"){
global $wecpi_config;
global $local_wecpi_config;
//dump_r($local_wecpi_config);
$p="";
if ($where==="local") {
	
	if (!isset($local_wecpi_config['build'])) $r=" No local config found!"; else $r=count($local_wecpi_config['build'])-1;

	} 
		else {
			if (!isset($wecpi_config['build'])) $r=" No external config fetched!";
			else if (isset($wecpi_config['production'])) $r="";//p=count($wecpi_config['production'])-1;
			else $r=count($wecpi_config['build'])-1;
	}
	//if (isset($local_wecpi_config['production'])) $p=$local_wecpi_config['production'][0]. ' build ' . (count($local_wecpi_config['production'])-1); else $p="NULL";
	//if (defined('MAGPIE_BETA')) $r.= ' BETA';

return $r;//.' - '.$p;

}
endif;




if (!function_exists('get_build_info')) :
function get_build_info(){
global $wecpi_config;
//echo $wecpi_config['build'][count($wecpi_config['build'])-1];
//die();
if (isset($wecpi_config['production'])) $b=$wecpi_config['production'][1];
else
$b=$wecpi_config['build'][count($wecpi_config['build'])-1];
if (!isset($b) && !$b) return "No build information!";
return $b;
}
endif;





if (!function_exists('get_config_value')) :

function get_config_value($key) {
	global $wecpi_config;
	if (isset($wecpi_config[$key])) return $wecpi_config[$key];
	return NULL;
}
endif;




if (!function_exists('show_magpieheading')) :

function show_magpieheading($class,$head,$text,$func=NULL) {
show_creditcards();
echo '<div class="magpieheading"><div class="'.$class.' floatleft"></div><div class="headingtext"><h1>'.$head.'</h1>'.$text.'</div>';
if ($func) $func();
show_magpie_upgrades();
echo '</div>';

}

endif;



if (!function_exists('show_creditcards')) :

function show_creditcards() {
echo '<div style="float:right;text-align:right;">';
echo '<div class="wecpi_creditcards"></div>'.MAGPIE_NAME;
echo '</div>';
}

endif;


if (!function_exists('show_magpie_upgrades')) :

function show_magpie_upgrades() {
global $magpie_object;
$upgrade2='<div class="menuitem">Upgrade<sup>2</sup></div>';
$proultra='<div class="menuitem">MagPie<sup>PRO ULTRA</sup></div>';
$pro='<div class="menuitem">MagPie<sup>PRO</sup></div>';
$standard='<div class="menuitem">MagPie<sup>STANDARD</sup></div>';
$u=NULL;
if (defined('MAGPIEPRO')) $u=$proultra;
elseif (defined('MAGPIESTANDARD')) $u=$pro.$u;
elseif (defined('MAGPIECE')) $u=$standard.$u;
if ($u) {
	$u=$upgrade2.$u;
echo '<div><div style="position:relative;">';
echo $u;
echo '</div></div>';
}
}

endif;




if (!class_exists('magpie_module')) :

class MagPie_Module {
	
	public $modules=array();
	
	function MagPie_Module() {
		}
		
	function set_module($name) {
		
		$this->modules[$name]=true;
		
		}
	
	function is_module($name) {
		
		if (isset($this->modules[$name])) return $this->modules[$name];
		
		}
}

endif;



if (!function_exists('show_important_id_sku')) :

function show_important_id_sku(){
?>

<div class="wecpi_pro_hide_help">
		<div class="infobox" style="background:#FFD;">
				<div class="important" style="padding-left:70px">
						<h2>Important</h2>
				</div>
				<p> Please read below once and remember it before continuing editing your ID and _wpsc_sku values in your exported CSV file. </p>
				<ul>
						<li><strong> Do not edit the values (numbers) of the ID field name in the exported CSV file because they are used when importing and updating your WPEC product database. The field name ID is a PRIMARY KEY and is UNIQUE and if you change the ID-values you will mess up your products unless you do it intentionally.</strong></li>
						<li><strong>The same goes for _wpsc_sku. But you can edit the _wpsc_sku if you update via ID hence you can change your SKU values. But if you change your SKU values in your exported CSV file and you import this using _wpsc_sku as update key you will mess up your products and they will be overwritten with new data.</strong></li>
						<li><strong>Emphasis: there is a relation between exported ID and _wpsc_sku values and imported so make sure you know what you are doing and do not change any of the ID values.</strong></li>
				</ul>
		</div>
</div>
<p>
		<?php
	}

endif;













if (!function_exists('show_wecpi_copyright')) :

function show_wecpi_copyright() {
echo '<br style="clear:both" /><div style="border-top:#aaa 1px solid;margin-top:40px;color:#666;font-size:0.7em">';
echo 'WPEC is WordPress e-Commerce from <a target="_blank" href="http://getshopped.org/">getshopped.org</a>';
echo '<div style="float:right;text-align:right">';
echo MAGPIE_NAME.' is <i>WordPress e-Commerce Product import</i> from <a target="_blank" href="http://geegood.com/wordpress/">geegood.com/wordpress/</a> &copy; MMXI All Rights Reserved.<br />This software is distributed with this license <a href="'.MAGPIE_URL.'/pages/license.php" class="fancythis">'.MAGPIE_NAME.' License</a>, Version 1, June 2011 - Copyright &copy; Niels Ulrik Reinwald';
echo '</div></div>';
echo '<br style="clear:both" /><div style="width:95%;margin-top:0px;">';
echo '</div><br style="clear_both" />';
}

endif;



























if (!function_exists('show_html_tag_stripped')) :

function show_html_tag_stripped(){
echo '<div class="wecpi_pro_hide_help"><div style="background-color:#F4FFCC;border:gray 1px solid;padding:10px;font-weight:bold;"><p>HTML TAG stripped and shortened here for readability</p></div></div>';
}

endif;






if (!function_exists('check_checked')) :

function check_checked($thisname){
	if (get_option($thisname)=="on") echo ' checked="on" ';
	}

endif;







if (!function_exists('wecpi_update_option')) :
function wecpi_update_option($thisname){
	if (isset($_POST[$thisname])) {update_option($thisname,$_POST[$thisname]);}
	else {update_option($thisname,"");}
	}

endif;




if (!function_exists('show_fade_text')) :
function show_fade_text($text){
	echo '<div class="fadethis" style="display:block;opacity:1">'.$text.'</div>';
	}

endif;





if (!function_exists('show_go_back')) :
function show_go_back($text){
	echo '<p><a href="javascript:history.go(-1);">Go back to the main '.$text.' page</a></p>';
	}

endif;


if (!function_exists('show_go_back_url')) :
function show_go_back_url($url,$text){
	echo '<p><a href="'.$url.'">'.$text.'</a></p>';
	}

endif;









if (!function_exists('show_skype_twitter')) :

function show_skype_twitter(){
?>
<div class="thirdpartybutton">
		<!--
		Skype 'My status' button
		http://www.skype.com/go/skypebuttons
		--> 
		<script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script> 
		<a href="skype:nielsulrik?call"><img src="http://mystatus.skype.com/bigclassic/nielsulrik" style="border: none;" width="182" height="44" alt="My status" /></a>
</div>
<?php
}
endif;









if (!function_exists('magpie_selection')) :

function magpie_selection ($type,$id,$label) {
	echo '<label>';
	switch ($type) {
		case "checkbox":
				echo '<input type="checkbox" name="'.$id.'" id="'.$id.'"';
				if (get_option($id)=="on") echo ' checked="on"';
				echo '/> ';
		break;
		}
	echo $label.'</label>';
}
endif;





if (!function_exists('magpie_update_option')) :

function magpie_update_option ($key) {
	//echo $_POST[$key];
	update_option($key,$_POST[$key]);
}
endif;





if (!function_exists('magpie_sortArrayByArray')) :

function magpie_sortArrayByArray($array,$orderArray) {
    $ordered = array();
    foreach($orderArray as $key=>$value) {
        if(array_key_exists($key,$array)) {
                $ordered[$key] = $array[$key];
                unset($array[$key]);
        }
    }
    return $ordered;
}
endif;





if (!function_exists('show_deleted_exported_csv')) :

function show_deleted_exported_csv() {
?>
<div class="do_not_show_delete_all_csv">
		<div class="infobox">
				<?php
						$delete_all_csv=0;
			if (isset($_POST['delete_csv_files'])) 
			 {
	 $tmp_path = gg_create_csv_file_location(true,false);

				echo '<h3 class="border-top">These files have been delete in '. $tmp_path.':</h3>';
				echo '<small>';
				
$handle = opendir($tmp_path);
foreach ($_POST['delete_csv_files'] as $file) {
	
	unlink($tmp_path.$file);
	echo $tmp_path.$tmp.'<br />';
	}
/*  while($tmp=readdir($handle)){ 
    if($tmp!='..' && $tmp!='.' && $tmp!=''){ 
        
			if (strstr($tmp,'wecpi_product_export'))
			if (strstr($tmp,'.csv'))
			if(is_writeable($tmp_path.$tmp) && is_file($tmp_path.$tmp))
            {
				echo $tmp.'<br />';
			//chmod($tmp,0666); 
			unlink($tmp_path.$tmp);
			$delete_all_csv=1;
			}
				    } 
				  }
				  echo '</small>'; 
*/
 closedir($handle);
 //header('location:'.$_SERVER['PHP_SELF']);
 unset($_POST['delete_all_csv']);
 
if ($delete_all_csv==1) echo '<script>do_not_show_delete_all_csv=1;</script>';
				
				}
				?>
		</div>
</div>
<?php	
}
endif;





if (!function_exists('get_list_of_files')) :

function get_list_of_files($dir,$type,$havefiles=false) {

$filelist = array();

if ($handle = opendir($dir)) 
	{
		while (false !== ($file = readdir($handle)))
		{
			
			if (strstr($file,$type)) 
				{
					$filelist[] = $file;
					
					$havefiles=true;
				}
		
		}
	}
	closedir($handle);
	
	return $filelist;
}
endif;






if (!function_exists('dump_the_file_list')) :

function dump_the_file_list($files,$str) {

foreach ($files as $file) {
	
	printf($str,$file,$file);
	}
}
endif;





if (!function_exists('show_box_edit_csv')) :

function show_box_edit_csv() {
echo '<a class="listcsv" href="javascript:void()">Show CSV files</a>';
echo '<div class="infobox">';
echo '<h4>Your CSV files';
echo '<input type="button" class="button" title="Select the CSV you want to edit." style="margin-left:20px;" id="edit_csv_files_but" value="Edit CSV file" /></small></h4>';
//echo '<span style="cursor:pointer" id="delete_csv_files_but">Delete selected CSV files</span>';
echo '<div class="column3"><div class="checkbox_exported_csv">';
echo '</div></div></div>';
}
endif;













if (!function_exists('show_field_names')) :

function show_field_names($style="") {

		global $sort_order;
		
		$pre=NULL;$after=",";
		
		$out="";
		
		if ($style=="table") {$pre="<th>";$after="</th>";$out.='<table class="exported_table"><thead><tr>';}
		
		foreach ($sort_order as $key=>$value) $out.=$pre.$key.$after;
		
		if ($style=="table") $out.='</tr></thead></table>';
		
		return $out;

}
endif;







if (!function_exists('magpie_input_button')) :

function magpie_input_button($name,$value) {
	
		if (!defined('MAGPIE_ONLINE')) :
			return '<input id="submit" class="button" type="submit" name="'.$name.'" value="'.$value.'"/>';
		else :
			return '<span class="wecpi_online_but">'.$value.'</span>';
		endif;

}
endif;




if (!function_exists('magpie_input_action')) :

function magpie_input_action($action_name) {

	if (isset($_POST[$action_name])) return true;
	
	return false;

}
endif;








if (!function_exists('build_images_dropdown')) :

function build_images_dropdown($thisid) {

$query_images_args = array(
    'post_type' => 'attachment',
	'post_mime_type' =>'image',
	'post_status' => 'inherit',
	'posts_per_page' => -1,
);

$query_images = new WP_Query( $query_images_args );
//image_attachments_id[]
$out = '<select name="select" class="customselect" title="Choose an image" id="customselector">';
$outimg_selected='<div class="magpie_image_selected">';
$outimg='<div class="magpie_select_images">';
foreach ( $query_images->posts as $image) {
	
	$ID=$image->ID;
	$dandy=image_get_intermediate_size($ID,'admin-product-thumbnails');
	//$out.='<optgroup class="magpie_image_optgroup" style="background:url('.$dandy['url'].') no-repeat 100% 50%" label="">';
	$outimg.='<div class="imgrow';
	$out.='<option ';
	if ($ID==$thisid) {$out.='selected ';$outimg.=' selected';$outimg_selected.='<img src="'.$dandy['url'].'"/>';}
	$outimg.='"><img src="'.$dandy['url'].'"/></div>';
	$out.='value="'.$ID.'">'.$ID.'</option>';
	//$out.='</optgroup>';
	
}

$out .= '</select>';
$outimg.='</div>';
$outimg_selected.='</div>';
echo $outimg_selected.$out.$outimg;
return "";//$out;

}
endif;





	
	

if (!function_exists('show_import_info_boxes')) :

function show_import_info_boxes() {
?>
<div class="infobox">

<div class="wecpiinfobox">
</div>

<div class="wecpicancel_div">
<div class="pausemagpie">
</div>
<div class="continuemagpie" style="display:none">
</div>
</div>

</div>
<?php
}
endif;







if (!function_exists('magpie_upload_url')) :

function magpie_upload_url() {

$uploads = wp_upload_dir();
//echo $uploads['path'] . '<br />';
//echo $uploads['url'] . '<br />';
//echo $uploads['subdir'] . '<br />';
//echo $uploads['basedir'] . '<br />';
//echo $uploads['baseurl'] . '<br />';
//echo $uploads['error'] . '<br />';
//$siteurl=bloginfo ("url");
$baseurl=$uploads['baseurl'];
//return str_replace($siteurl,"",$baseurl);
return str_replace(get_bloginfo ("url"),"",$baseurl).'/magpie/csv';

}
endif;










if (!function_exists('show_radio_csv_files')) :

function show_radio_csv_files(){
		$files=get_list_of_files(gg_create_csv_file_location(true,false),".csv",&$have_csv_file);
		foreach ($files as $file) printf( '<label><input type="radio" name="editcsvfile" id="radio" value="%s">%s</label><br />',$file,$file);
} 

endif;




























if (!function_exists('wecpi_get_the_category_id')) :

function wecpi_get_the_category_id($cat_name){
	$term = get_term_by('slug', $cat_name, 'wpsc_product_category');//'category');
	if (!$term) return false;
	return $term->term_id;
}
endif;



if (!function_exists('get_post_meta_all')) :

function get_post_meta_all($post_id){
    global $wpdb;
    $data   =   array();
    $wpdb->query("
        SELECT `meta_key`, `meta_value`
        FROM $wpdb->postmeta
        WHERE `post_id` = $post_id
    ");
    foreach($wpdb->last_result as $k => $v){
        $data[$v->meta_key] =   $v->meta_value;
    };
    return $data;
}

endif;













if (!function_exists('geegood_com_get_plugin_url')) :

function geegood_com_get_plugin_url() {
	return WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	}
endif;







if (!function_exists('gg_show_terms')) :

function gg_show_terms($handle,$taxonomy_name) {
	
$terms = get_terms($taxonomy_name);
$count = count($terms);
if ( $count > 0 ){
     echo '<div class="taxonomies"><ul>';
     foreach ( $terms as $term ) {
       echo "<li>" . $term->name . "</li>";
        wecpi_write_export($handle,$taxonomy_name,$term->name);
     }
     echo "</ul></div>";
 }
}

endif;


















if (!function_exists('gg_get_upload_dir')) :

function gg_get_upload_dir($get_this="") {
/*
	$uploads now contains something like the following (if successful)
	Array ( 
		[path] => C:\path\to\wordpress/wp-content/uploads/2010/05 
		[url] => http://example.com/wp-content/uploads/2010/05 
		[subdir] => /2010/05 
		[basedir] => C:\path\to\wordpress/wp-content/uploads 
		[baseurl] => http://example.com/wp-content/uploads 
		[error] => 
	) 
	// Descriptions
	[path] - base directory and sub directory or full path to upload directory.
	[url] - base url and sub directory or absolute URL to upload directory.
	[subdir] - sub directory if uploads use year/month folders option is on.
	[basedir] - path without subdir.
	[baseurl] - URL path without subdir.
	[error] - set to false.
*/	$uploads = wp_upload_dir();
	return $uploads[$get_this];
}

endif;














if (!function_exists('show_uploads_dir')) :

function show_uploads_dir() {
	echo gg_create_csv_file_location(true,false);
//echo true == defined('UPLOADS') ? UPLOADS : 'UPLOADS directory not defined.';
}
endif;





if (!function_exists('gg_get_datetime')) :

function gg_get_datetime() {
$date = date('Y_M_d');
$time = date('h.i.sA');
$week = date('W');
//$datestr = date_format($date, 'Y-m-d H:i:s');
//$datestr = str_replace(" ","_",$datestr);
//$datestr = str_replace(":",".",$datestr);
return $date.'-WEEK'.$week.'-'.$time;
}
endif;






if (!function_exists('gg_create_csv_file_location')) :

function gg_create_csv_file_location($dir=true,$filename=true,$timestamp=false){
$upload_path="";$b="";$c="";$d="";
if ($dir) {
$upload_path = MAGPIE_UPLOAD_CSV_FOLDER;
//$upload_path = trim($upload_path);
}
//$a=gg_get_upload_dir('basedir');
if ($filename) $b=EXPORT_CSV_FILENAME;
if ($timestamp!="") $c='_'.gg_get_datetime();
if ($filename) $d='.csv';
return $upload_path.$b.$c.$d;
}

endif;



if (!function_exists('gg_create_csv_url_location')) :

function gg_create_csv_url_location($dir=true,$filename=true,$timestamp=false){
$a="";$b="";$c="";$d="";
$uploads = wp_upload_dir();
if ($dir) {
	$a=$uploads['baseurl'].'/';
	//$a2=$uploads['subdir'];
	//$a=str_replace($a2,"",$a);
}
if ($filename) $b=EXPORT_CSV_FILENAME;
if ($timestamp!="") $c='_'.gg_get_datetime();
if ($filename) $d='.csv';
return $a.$b.$c.$d;
}

endif;




if (!function_exists('magpie_csv_dir')) :

function magpie_csv_dir($dir=true,$filename=true){
$uploads = wp_upload_dir();
return $uploads['baseurl'].'/';
}

endif;




if (!function_exists('gg_create_csv_url2_location')) :

function gg_create_csv_url2_location($dir=true,$filename=true,$timestamp=false){
$a="";$b="";$c="";$d="";
$uploads = wp_upload_dir();
if ($dir) {
	$a=$uploads['baseurl'].'/';
	//$a2=$uploads['subdir'];
	//$a=str_replace($a2,"",$a);
}
if ($filename) $b=EXPORT_CSV_FILENAME;
if ($timestamp!="") $c='_'.gg_get_datetime();
if ($filename) $d='.csv';
return $a.$b.$c.$d;
}

endif;
















if (!function_exists('show_csv_table')) :

function show_csv_table($csv,$num=0) {

$c=0;
$htmlfields=array("post_content","post_excerpt");

echo '<table class="exported_table"><thead>';
		
		$head=true;
		foreach ($csv as $k=>$v)
		{
			
			echo '<tr>';
			if ($head) echo '<th>Row#</th>';
			if (!$head) echo '<td>'.$k.'</td>';
			foreach ($v as $k2=>$v2)
			{
			if ($head) {
					echo '<th';
					if (in_array($k2,$htmlfields)) echo ' class="htmlfields" ';
					echo '>'.$k2.'</th>';
			
				}
			else
				{
					echo '<td';
					//if (in_array($k2,$htmlfields)) echo ' class="htmlfields"';
					echo '>';
					if (in_array($k2,$htmlfields)) {echo strip_tags(substr($v2,0,42));}
					else echo $v2;
					echo '</td>';

				//echo '<td>'.$v2.'</td>';
				}
			}
			echo '</tr>';
			if ($head) echo '</thead><tbody>';
			$head=false;
			if ($num>0) if ($c++ >= $num) break;

		}

echo '</tbody></table>';
}
endif;












if (!function_exists('start_dump')) :
function start_dump($headline){
echo '<h2>'.$headline.'</h2><div style="padding-left:50px;font-family:monospace !important">';
}
endif;
if (!function_exists('end_dump')) :
function end_dump($headline){
echo '</div>';
}
endif;



if (!function_exists('dump_data')) :
function dump_data($k,$v){
printf ("%'_-35s %s<br />",$k,$v);
}
endif;














if (!function_exists('wecpi_insert_image_attachment_gg')) :
function wecpi_insert_image_attachment_gg($product_id,$filename) {
	
		if (!$filename) {
			echo '<td>No image to insert</td>';
			return false;
		}
		if (!file_exists(gg_create_csv_file_location(true,false).$filename)) {
			echo '<td>File '.$filename.' in your CSV was not found in: '.gg_create_csv_file_location(true,false).'</td>';
			return false;
			}
		$wp_filetype = wp_check_filetype(basename($filename), null );
		$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'guid' => $filename,
		'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
		'post_content' => '',
		'post_status' => 'inherit'
		);
		
		$attach_id = wp_insert_attachment( $attachment, $filename, $product_id );
		// you must first include the image.php file
		// for the function wp_generate_attachment_metadata() to work
		//require_once(ABSPATH . 'wp-admin/includes/image.php');
		
		
		
		$image = get_post( $attach_id );
		$fullsizepath = get_attached_file( $image->ID );
		$metadata = array();
		$metadata = array_merge(wp_generate_attachment_metadata( $image->ID, $fullsizepath),$metadata);
		wp_update_attachment_metadata( $image->ID, $metadata );
		
		$imgurl = gg_create_csv_url_location(true,false).$filename;
		echo '<td align="center"><a target="_blank" href="'.$imgurl.'"><img width="45" src="'.$imgurl.'"/></a></td>';
		return $attach_id;
		
		
		/*$metadata = wp_get_attachment_metadata( $attach_id );
		$metadata = array_merge(wp_generate_attachment_metadata( $attach_id, $filename ),$metadata);
		
		add_post_meta( $attach_id, '_wp_attachment_metadata', $metadata );
		return $attach_id;
		*/
}
endif;





if (!function_exists('magpie_write_name_and_version')) :

function magpie_write_name_and_version () {
	
	
$source=MAGPIE_FILE_PATH."/pages/index_orig.php";
//echo MAGPIE_FILE_PATH;die();

$destce=MAGPIE_FILE_PATH."/pages/indexce.php";
$deststandard=MAGPIE_FILE_PATH."/pages/indexstandard.php";
$destpro=MAGPIE_FILE_PATH."/pages/indexpro.php";

$writeother=false;
if (file_exists($destce)) $writeother=true;

$dest=MAGPIE_FILE_PATH."/index.php";

$magpieline=array();

$handle = @fopen($source, "r");
if ($handle) {
	while (!feof($handle)) $magpieline[] = fgets($handle, 4096);
	fclose($handle);
}

$magpieline[1]="/*".PHP_EOL;
$magpieline[2]="@package ".MAGPIE_NAME.PHP_EOL;
$magpieline[3]="Plugin Name: ".MAGPIE_NAME.PHP_EOL;
$magpieline[4]="Plugin URI: http://geegood.com/wordpress".PHP_EOL;
$magpieline[5]="Description: Product Import/Export (PIE) - MagPie is the name - all via CSV file format. Imports, exports , inserts and updates products incl. adding product image from WordPress Media Library. Basic but highly recommendable... Keep backups of your products with MagPie in PRO and sort the CSV file and import back into WPEC - as easy as a bird can fly. This is a serious professional solution for the serious business owner. It is a one-of-a-kind and the first major solution for WP e-Commerce. Happy Shopping.".PHP_EOL;
$magpieline[6]="Version: ".MAGPIEVERSION.".".get_build_version().PHP_EOL;
$magpieline[7]="Author: geegood.com/wordpress".PHP_EOL;
$magpieline[8]="Author URI: http://geegood.com/wordpress".PHP_EOL;
$magpieline[9]="************************************************************************/".PHP_EOL;

if ($writeother) $handlece = fopen($destce, "w");
if ($writeother) $handlestandard = fopen($deststandard, "w");
if ($writeother) $handlepro = fopen($destpro, "w");

$handle = fopen($dest, "w");

if ($handle) {
	foreach ($magpieline as $k=>$v) {
		if ($k==3) $v="Plugin Name: MagPie CE".PHP_EOL;
		if ($writeother) fwrite($handlece,$v/*.PHP_EOL*/);
		if ($k==3) $v="Plugin Name: MagPie STANDARD".PHP_EOL;
		if ($writeother) fwrite($handlestandard,$v/*.PHP_EOL*/);
		if ($k==3) $v="Plugin Name: MagPie PRO".PHP_EOL;
		if ($writeother) fwrite($handlepro,$v/*.PHP_EOL*/);
		
		fwrite($handle,$v/*.PHP_EOL*/);
		//if ($k>0 && $k<9) fwrite($handle,PHP_EOL);
	//	echo $v;
	}
	fclose($handle);
	}
}
endif;





if (!function_exists('magpie_create_upload_directories')) :

function magpie_create_upload_directories() {
	$folders = array(
		MAGPIE_UPLOAD_FOLDER,
		MAGPIE_UPLOAD_CSV_FOLDER
	);
	foreach ( $folders as $folder ) {
		wp_mkdir_p( $folder );
		@ chmod( $folder, 0775 );
	}
}
endif;



if (!class_exists('magpie_module')) :

class MagPie_Module {
	
	private $modules=array();
	
	function MagPie_Module() {
		}
		
	function set_module($name) {
		
		$modules[$name]=true;
		
		}
	
	function is_module($name) {
		
		if (isset($modules[$name])) return $modules[$name];
		
		}
		
	function unset_module($name) {
		if (isset($modules[$name])) unset($modules[$name]);
	}
	
	function set_modules($allthese) {
		
		foreach ($allthese as $k=>$v) set_module($v);
	}
	
	
}

endif;


if (!function_exists('magpie_toolbox')) :

function magpie_toolbox($onoff,$div_class,$ajax_on_function,$ajax_off_function) {

?>

<script>

 jQuery('<?php echo $div_class;?>').iphoneSwitch( function() {
     //  $('#ajax').load('off.html');
	 return "<?php echo $onoff;?>";
      },
	   <?php echo $ajax_on_function;?>,
     
       <?php echo $ajax_off_function;?>
     );
</script>
<?php
}

endif;

if (!function_exists('dump_data_box')) :

function dump_data_box() {
	echo '<div class="infobox" style="word-wrap:break-word;height:400px;overflow:auto;" id="dump_data_box"></div>';
	
	}
endif;
?>