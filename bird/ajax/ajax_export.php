<?php

//if (!function_exists('magpie_export_callback_func')) :

function ajax_export_callback_func() 
{

error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$echo=false;

$id = (int) $_REQUEST['id'];

$head=(int) $_REQUEST['magpiehandle'];

$csvfilename = $_REQUEST['csvfilename'];

//$head=1;
$csvfilename = MAGPIE_UPLOAD_CSV_FOLDER."/f.csv";

global $not_this_meta;

$csvline=array();

if ($head==1) $magpiehandle =fopen($csvfilename, "w");
else
//if (!isset($_SESSION['magpiehandle'])) {
	//$magpiehandle =fopen($csvfilename, "a");
	$magpiehandle =fopen($csvfilename, "a");
//	$_SESSION['magpiehandle']=$magpiehandle;}

	//if (isset($_SESSION['magpiehandle'])) $magpiehandle=$_SESSION['magpiehandle'];
//	else $_SESSION['magpiehandle']=$magpiehandle;

	
$post = get_post( $id );
	
$post_thumbnail_id = get_post_thumbnail_id( $post->id );
//$src = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );
//if ($echo) echo $post_thumbnail_id.'<br />';
//$p=get_post($post_thumbnail_id);
//if ($echo) print_r($p);
$attached_images=get_post_meta( $post->id, '_thumbnail_id' );
$images = array();
if ($attached_images) {
	foreach ($attached_images as $attachment) {
		if ($echo) echo $attachment.'<br />';
		
		$images[]=$attachment;
	}
}

		
$csvline['_thumbnail_id']=$images;
if ($echo) dump_r($images);






if ($echo) dump_r($post);


foreach ($post as $k=>$v) {$csvline[$k]=$v;if ($echo) echo $k.' => '.$v.'<br />';}




$meta = get_post_meta( $post->ID, '' );
foreach ($meta as $k=>$v) 
if (!array_key_exists($k,$not_this_meta)) 
					{
						if (is_array($v)) {
							$csvline[$k]=$v[0];if ($echo)  echo $k.' => '.$v[0].'<br />';
							//foreach ($v as $k2=>$v2) {$csvline[$k2]=$v2;echo $k2.' => '.$v2.'<br />';}
						}
						else {$csvline[$k]=$v;if ($echo) echo $k.' => '.$v.'<br />';}
					}
//if (!$echo) dump_r($meta);	






//if (!$echo) 
$d=unserialize($meta["_wpsc_product_metadata"][0]);
foreach ($d as $k=>$v)
if (is_array($v)) {
						//$csvline[$k]=$v[0];echo $k.' => '.$v[0].'<br />';
						foreach ($v as $k2=>$v2) {$csvline[$k2]=$v2;if ($echo) echo  $k2.' => '.$v2.'<br />';}
					}
				else {$csvline[$k]=$v;if ($echo) echo  $k.' => '.$v.'<br />';}
						
{
//	echo $k.' => '.$v.'<br />';
//$csvline[$k]=$v;
}


$csvline["wpsc-variation"]="";


foreach ( $taxonomies as $keytaxonomy=>$taxonomy ) { 
		
		$post_terms = wp_get_object_terms( $post->ID, $taxonomy );
		$csvline[$taxonomy]=json_encode($post_terms);	
							//$post_terms =get_post_meta( $record->id, $taxonomy );
				//if (!$echo) 
				if ($echo) echo  '<h2>Name: '.$taxonomy.'</h2>';
		}

if ($head=="1" && $echo) { echo '<tr>';foreach ($csvline as $k=>$v) echo '<th>'.$k.'</th>';echo '</tr>';}
if ($echo) echo '<tr>';
if ($echo) foreach ($csvline as $k=>$v) echo '<td>'.$v.'</td>';
if ($echo) echo '</tr>';

if ($echo) echo  '<hr />';
 
if ($echo) echo '</table>';
	

//http://www.w3schools.com/php/php_ajax_php.asp

if ($head==1) fputcsv($magpiehandle,array_keys($csvline),',','"');

fputcsv($magpiehandle,$csvline,',','"');

$ret=array( 
'line' => sprintf( '&quot;%1$s&quot; (ID %2$s) was successfully exported in %3$s seconds.', esc_html( get_the_title( $post->ID )) , $post->ID, timer_stop() )
//,'error' => sprintf( '&quot;%1$s&quot; (ID %2$s) was not exported.', esc_html( get_the_title( $post->ID ) ), $post->ID )
);
die(json_encode($ret));
}
//endif;
?>