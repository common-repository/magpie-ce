<?php


/*
Testing
*/

if (!function_exists('get_media_callback')) :

function get_media_callback() {

error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$query_images_args = array(
    'post_type' => 'attachment',
	'post_mime_type' =>'image',
	'post_status' => 'inherit',
	'post_parent' => '',
	'posts_per_page' => -1,
);

$query_images = new WP_Query( $query_images_args );
$images = array();
$thumbs = array();
foreach ( $query_images->posts as $image) {
	
	$images[]= $image;//->guid;
	$thumbs[]=wp_get_attachment_thumb_url( $image->ID );
}

$ret=array('images' => $images,'thumbs'=>$thumbs);

die(json_encode($ret));

}
endif;







if (!function_exists('ajax_export_callback_func')) :

function ajax_export_callback_func() 
{
//add_action( 'all', create_function( '', 'var_dump( current_filter() );' ) );

error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$echo=false;




$numero = (int) $_REQUEST['numero'];

//$id = (int) $_REQUEST['id'];

$head=(int) $_REQUEST['magpiehandle'];

$csvfilename = $_REQUEST['csvfilename'];

$export_bulk=$_REQUEST['export_bulk'];

$export_countdown=$_REQUEST['export_countdown'];

global $sort_order;

global $inmeta;

global $wpsc_meta;

global $magpie_date_time;

$csvline=array();

$custom_meta = array();

$csvline = array_fill_keys($inmeta,"");

$left=0;

$info=array();$info=NULL;


//global $taxonomies;
$taxonomies = get_object_taxonomies('wpsc-product');

//$head=1;
//$csvfilename = MAGPIE_UPLOAD_CSV_FOLDER."4.csv";

global $not_this_meta;


if ($head==1) {
		$magpiehandle =fopen($csvfilename, "w");
		@chmod($csvfilename,0775 );
		$args = array( 
	'numberposts'     => 10000000,
    'offset'          => 0,
    //'category'        => -1,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    //'include'         => 0,
    //'exclude'         => 0,
    //'meta_key'        => 0,
    //'meta_value'      => 0,
    'post_type'       => 'wpsc-product',
    //'post_mime_type'  => 0,
    //'post_parent'     => 0,
    //'post_status'     => 'all'
	 );
	$totalposts = get_posts( $args );
	$export_countdown=$totalposts=count($totalposts);
		}
else
//if (!isset($_SESSION['magpiehandle'])) {
	//$magpiehandle =fopen($csvfilename, "a");
	$magpiehandle =fopen($csvfilename, "a");
//	$_SESSION['magpiehandle']=$magpiehandle;}

	//if (isset($_SESSION['magpiehandle'])) $magpiehandle=$_SESSION['magpiehandle'];
//	else $_SESSION['magpiehandle']=$magpiehandle;

	
//$post = get_post( $id );


$args = array( 
	'numberposts'     => $export_bulk,
    'offset'          => $numero,
    //'category'        => -1,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    //'include'         => 0,
    //'exclude'         => 0,
    //'meta_key'        => 0,
    //'meta_value'      => 0,
    'post_type'       => 'wpsc-product',
    //'post_mime_type'  => 0,
    //'post_parent'     => 0,
    //'post_status'     => 'all'
	 );

$myposts = get_posts( $args );




while ($export_countdown>0 && $export_bulk>0) {


$csvline=NULL;


//$post_thumbnail_id = get_post_thumbnail_id( $post->id );
//$imgsrc = wp_get_attachment_image_src( $post_thumbnail_id, 'small' );
//if ($echo) echo $post_thumbnail_id.'<br />';
//$p=get_post($post_thumbnail_id);
//$imgsrc=$p;
//if ($echo) print_r($p);
$attached_images=get_post_meta( $myposts[$left]->ID, '_thumbnail_id' );
//$imgsrc = wp_get_attachment_image_src( $attached_images[0], 'small' );

$images = array();
if ($attached_images) {
	foreach ($attached_images as $attachment) {
		//if ($echo) echo $attachment.'<br />';
		
		$images[]=$attachment;
	}
}
$csvline['_thumbnail_id']=magpie_json($images);







//wpsc_select_product_file()
$args = array(
	'post_type' => 'wpsc-product-file',
	'numberposts' => -1,
	'post_status' => "all",
	'post_parent' => $myposts[$left]->ID);

$attachments = get_posts($args);

$files=array();
if ($attachments) {
	foreach ($attachments as $attachment) {
		//echo apply_filters('the_title', $attachment->post_title);
		$files[]=$attachment->ID;
	}
}
//$csvline['product_file']=magpie_json($files);

//$prodfile=get_product_meta($myposts[$left]->ID,'wpsc_files',true);
//$csvline['wpsc_files']=magpie_json($prodfile);




$csvline['import_id']=0;

foreach ($myposts[$left] as $k=>$v) 
{
	if (array_key_exists($k,$magpie_date_time))
	$csvline[$k] = '"'.$v.'"';
	else
	$csvline[$k]=magpie_json($v);
}

$csvline['guid'] = get_permalink($myposts[$left]->ID);

//$term = get_term();
//$term = get_term_by( 'id', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
//$term = get_the_term_list($post->ID,'','');
//$term=get_taxonomies();
//foreach ($term as $k=>$v) $csvline[$k]='TERM'.$k;


//$csvline['state']="";

$meta = get_post_meta( $myposts[$left]->ID,'');

$i=0;

//$csvline['META']=json_encode($meta); 
foreach ($meta as $k=>$v) {
if (array_key_exists($k,$inmeta)) 
		$csvline[$k] = magpie_meta($v);
else 
	if (!array_key_exists($k,$wpsc_meta))
	{
		$custom_meta[$i]['name'] = $k;
		$custom_meta[$i]['value'] = magpie_meta($v);
		$i++;
	}
}
	/*else
	if ($k==="new_custom_meta")
	{
		$custom_meta[$ii]['name'] = $k;
		$custom_meta[$ii]['value'] = magpie_meta($v);
		$ii++;
	}*/

/*
$custom_field_keys = get_post_custom_keys();
  foreach ( $custom_field_keys as $key => $value ) {
    $valuet = trim($value);
      if ( '_' == $valuet{0} )
      continue;
	 	$custom_meta[$i]['name'] = $key;
		$custom_meta[$i]['value'] = $value;
		$i++;
//    echo $key . " => " . $value . "<br />";
  }
  
*/


//if (!$echo) 


$d=unserialize($meta["_wpsc_product_metadata"][0]);
//$csvline['META']=json_encode($d);
foreach ($d as $k=>$v)
if (array_key_exists($k,$sort_order)) 
{
		if (is_array($v)) 
						//$csvline[$k]=$v[0];echo $k.' => '.$v[0].'<br />';
			//foreach ($v as $k2=>$v2) $csvline[$k2]=$v2;
			$csvline[$k]=json_encode($v);
		
			else $csvline[$k]=$v;
}
/*else {
	if (is_array($v)) $new_custom_meta[$k] = json_encode($v);
	else $new_custom_meta[$k] = $v;
}
*/


//$csvline["wpsc-variation"]="";

//$cats=array();

foreach ( $taxonomies as $keytaxonomy=>$taxonomy_name ) { 

	$post_terms = wp_get_object_terms( $myposts[$left]->ID, $taxonomy_name );
	
	$d=array();
	
	foreach ($post_terms as $k=>$v) $d[] = $v->slug;
	
	$csvline[$taxonomy_name]=implode(',',$d);	
	
	//
						
	/*	$cats=NULL;
		$post_terms = wp_get_object_terms( $myposts[$left]->ID, $taxonomy_name );
		$terms = get_terms($taxonomy_name);
		//$count = count($terms);
		if ( $count > 0 ) 
		foreach ( $terms as $term ) $cats[]=$term->name;
			
		$csvline[$taxonomy_name]=implode(',',$d);	
		//$csvline[$taxonomy_name]=json_encode($post_terms);	
		*/
	}


$csvline['custom_meta']=json_encode($custom_meta);


/*$cats=get_the_product_category($post->ID);
$csvline['cats']=json_encode($cats);
*/


/*
if ($head=="1" && $echo) { echo '<tr>';foreach ($csvline as $k=>$v) echo '<th>'.$k.'</th>';echo '</tr>';}
if ($echo) echo '<tr>';
if ($echo) foreach ($csvline as $k=>$v) echo '<td>'.$v.'</td>';
if ($echo) echo '</tr>';
if ($echo) echo  '<hr />';
if ($echo) echo '</table>';
	*/

//http://www.w3schools.com/php/php_ajax_php.asp
unset($csvline['_edit_last']);
unset($csvline['_edit_lock']);

/*$diff=array_diff($meta,$csvline);
$csvline = magpie_sortArrayByArray($csvline,$sort_order);
$csvline['DIFF']=json_encode($diff);
*/
unset($csvline[0]);

if ($head==1) fputcsv($magpiehandle,array_keys($csvline),',','"');

fputcsv($magpiehandle,$csvline,',','"');

$info[$left]['ID']=$csvline['ID'];
$info[$left]['_wpsc_sku']=$csvline['_wpsc_sku'];
$info[$left]['post_title']=$csvline['post_title'];
$info[$left]['_wpsc_price']=$csvline['_wpsc_price'];



$head=0;
$left++;
$export_countdown--;
$export_bulk--;

} //end while product bulk loop

if ($export_countdown<=0) fclose($magpiehandle);

$ret=array("export_countdown"=>$export_countdown,"totalposts"=>$totalposts,"info"=>$info);
die(json_encode($ret));


$pid=$myposts[$left]->ID;

//timer_stop();
$ret=array( 
'line' => sprintf( '&quot;%1$s&quot; (ID %2$s) was successfully exported.', esc_html( get_the_title( $pid )) , $pid ),
'csvline' => implode(',',$csvline),
'error' => sprintf( '&quot;%1$s&quot; (ID %2$s) was not exported.', esc_html( get_the_title( $pid ) ), $pid )
);
die(json_encode($ret));
}
endif;

















if (!function_exists('ajax_import_callback')) :

function ajax_import_callback() 
{


error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$numero=$_REQUEST['numero'];

$bulk = $_REQUEST['bulk'];

global $magpie_date_time;

//$remain = $_REQUEST['remain'];

$import_countdown = $_REQUEST['import_countdown'];

$left=0;

$wecpicolumn=$_SESSION['wecpicolumn'];
			
$value_name=$_SESSION['value_name'];

$insert_if_not_present=$_SESSION['insert_if_not_present'];
$wecpi_primary_key=$_SESSION['wecpi_primary_key'];

$csv = $_SESSION['csv'];

$info=array();$info=NULL;

while ($import_countdown>0 && $bulk>0) {

//while ((($numero+$left) < $rt_to) && $left<$bulk) {

unset($product_mapped);
$product_mapped['_wpcs_sku']=NULL;
$product_mapped['ID']=NULL;


foreach ( $value_name as $k=>$v)
				{
					
					
					
					//$k = index 0..n a number
					//$wecpicolumn some from prepare_the_import and there is comes from $sort_order;
					//$product_mapped[$csv[0][$v]] = $v;
					//$fieldvalue = $csv[$i][$csv[0][$v]];
					
					
					//$fieldvalue = $csv[$i][$wecpicolumn[$k]];
					

					$fieldvalue = $csv[$numero][$wecpicolumn[$k]];
					$product_mapped[$v] = $fieldvalue;
					//$magpiekeyname	= $v;//csv[$i][$csv[0][$v]];
					//$product_mapped[$wecpicolumn[$k]] = $fieldvalue;
					
					//dump_r($csv[$i][$csv[0]]);
					//if ($echo) echo $k.' => '.$wecpicolumn[$k].' = Key: '.$keyname.' ,CSV value: '.$fieldvalue.'<br />';
					//if ($echo) echo $k.' => '.$wecpicolumn[$k].' mapped to: '.$v.' ,CSV value: '.$fieldvalue.'<br />';
					
					//$product_mapped[$wecpicolumn[$k]] = ;
						
					
					//echo $product_mapped[$cvs_data[0][$v]].' - ' .$k.'=>'.$v.'<br />';
					
					
				
					/*foreach ( $cvs_data[$i] as $k2=>$v2) 
					{
						
						$product_mapped[$cvs_data[0][$k2]] = $v2;
					//echo $cvs_data[0][$k2].'=>'.$product_mapped[$cvs_data[0][$k2]].'<br />';
					//echo '=====>'.$product_mapped[$cvs_data[0][$k2]].'<br />';
					}
					*/
					
				}
			
		//if ($echo) echo '<br />';
		//die();
	
			//global $sort_order;
			
			//$product_columns = array();
			
			/*$cats=$product_mapped['wpsc_product_category'];
			$tags=$product_mapped['product_tag'];
			$variations=$product_mapped['wpsc-variation'];
			$sku=$product_mapped['_wpsc_sku'];
			if (!$sku) $sku="N/A";	
			*/
			
			$info[$left]=$product_mapped;
			
			
			$product_mapped = init_product_columns($product_mapped); //do some MagPie Magic.
			if (empty($product_mapped['post_status'])) $product_mapped['post_status']="publish";
			$product_mapped['post_type'] = "wpsc-product";
			
			
			foreach ($magpie_date_time as $k=>$v)
			{
					if (strstr($k,'_gmt'))
					$product_mapped[$k] = get_gmt_from_date (date( 'Y-m-d H:i:s' ));
						else
					$product_mapped[$k] = date( 'Y-m-d H:i:s' );
			
			}
			//$product_columns = wpsc_sanitise_product_forms( $product_columns );
			
			
			
			/*
			
			foreach ($meta as $k=>$v) 
				if (array_key_exists($k,$inmeta)) 
					$csvline[$k] = magpie_meta($v);
				else
				if (!array_key_exists($k,$wpsc_meta))
					$custom_meta[$k] = magpie_meta($v);
			
			*/
			
			
			
	
	
				$statusid=0;
				$status="UNKNOWN IMPORT STATE";
				
				$magpie_product_id=NULL;
				$result=NULL;
				unset($result);
				
				if ($wecpi_primary_key==="_wpsc_sku")  {
		//		global $post;
	//				query_posts('meta_key=_wpsc_sku&meta_value='.$product_mapped['_wpsc_sku']);
						/*$params=array();
						unset($params);
						*/
						$result[0]->ID=0;
						$params=array(
						'showposts'=>1,
						'post_type' => 'wpsc-product',
						//'post_status' => 'publish',
						'meta_key'=>'_wpsc_sku',
						'meta_value'=>$product_mapped['meta']['_wpsc_sku']
						);
						$query = new WP_Query;
						$result = $query->query($params);
						
					//$magpie_product_id=gg_find_sku($product_mapped['_wpsc_sku']);
					if( count($result)>0 ) {
					if ($result[0]->ID >0) $magpie_product_id=$result[0]->ID;
					if ($magpie_product_id) $status="UPDATED by SKU";
					}
					wp_reset_query();
				}
				
				else {
						$id=$product_mapped['ID'];
						if (get_post_type( $id ) === 'wpsc-product' && is_numeric($id)) {
							$magpie_product_id = $id;
							$statusid=2;
							$status="UPDATED USING ID";
						} else {
							$status="Product with ID: ".$id." IS NOT PRESENT FOR UPDATE.";
							$statusid=3;
						}
				}
				
			$product_mapped['_thumbnail_id']=explode(',',$product_mapped['_thumbnail_id']);
			if (count($product_mapped['_thumbnail_id'])<1) $product_mapped['_thumbnail_id']=NULL;
			
			
			if ($magpie_product_id) {
				
					
					
					$product_mapped['ID'] = $magpie_product_id;
					//$status="UPDATED";
					
					$product_id = wp_update_post( $product_mapped);
					
					$info[$left]['ID']=$product_id;
					
					if (!$product_id) {$statusid=4;$status="CAUGHT an ERROR during UPDATE: ".$product_id;}
					//$product_id = wpsc_insert_product( $product_columns );
				}
			
			else if ($insert_if_not_present) {
				
		/*			$product_id = wpsc_insert_product( $product_columns );
					$status="INSERTED";
			*/		
					unset($product_mapped['ID']);
					
					$status="INSERTED";
					
					$statusid=1;
					
					//$product_mapped['post_title']=serialize($product_mapped['product_tag']);
					$product_id = wp_insert_post( $product_mapped, &$error );
					
					$info[$left]['ID']=$product_id;
					
					$product_mapped['ID']=$product_id;
					
					if (!$product_id) {$statusid=4;$status="CAUGHT an ERROR during INSERT ID: ".$product_id.' Error: '.$error;}
					
			}
			
			
		
			if ($product_id)
				{
						//product-functions.php
					
					$info[$left]['ID'] = $product_id;
			
					wpsc_update_product_meta($product_id, $product_mapped['meta']);
			
					wpsc_update_custom_meta($product_id, $product_mapped);
					//update_post_meta($product_id,$product_mapped['_wpsc_price'] /*, $prev_value*/);
	
//
//[
//{"term_id":"4","name":"Shabby Chic Collection","slug":"shabby-chic-collection","term_group":"0","term_taxonomy_id":"4","taxonomy":"wpsc_product_category","description":"","parent":"0","count":"3"},
//{"term_id":"22","name":"Tables","slug":"tables","term_group":"0","term_taxonomy_id":"25","taxonomy":"wpsc_product_category","description":"","parent":"0","count":"2"}]
	
//[
//{"term_id":"22","name":"Tables","slug":"tables","term_group":"0","term_taxonomy_id":"25","taxonomy":"wpsc_product_category","description":"","parent":"0","count":"2"}]


//[
//{"term_id":"22","name":"Tables","slug":"tables","term_group":"0","term_taxonomy_id":"25","taxonomy":"wpsc_product_category","description":"","parent":"0","count":"1"}]
					//delete_option("wpsc_product_category_children");
					//_get_term_hierarchy('wpsc_product_category');
					wp_set_object_terms( $product_id , explode (",",$product_mapped['wpsc_product_category']),'wpsc_product_category');
					wp_set_object_terms( $product_id , explode (",",$product_mapped['product_tag']),'product_tag');
					wp_set_object_terms( $product_id , explode (",",$product_mapped['wpsc-variation']),'wpsc-variation');
			/*
					$c=array();
					$cats=$product_mapped['wpsc_product_category'];
					foreach ($cats as $cat) {
						$parent_term = term_exists( $cat->parent, 'wpsc_product_category' ); // array is returned if taxonomy is given
						$parent_term_id = $parent_term['term_id']; // get numeric term id
						$cat->parent=$parent_term_id;
						wp_insert_term( $cat->name, 'wpsc_product_category', $cat ); 
						$c[]=$cat->name;
					}
					wp_set_object_terms( $product_id , $c,'wpsc_product_category');
					//delete_option("wpsc_product_category_children");
					
					$t=array();
					$tags=$product_mapped['product_tag'];
					foreach ($tags as $tag) {
						//wp_update_term( $tag->term_id, $tag->taxonomy, $tag ); 
						$t[]=$tag->name;
					}
					//$t[0]="hello";
					wp_set_object_terms( $product_id , $t ,'product_tag');
				*/	
					//wp_set_object_terms( $product_id , json_decode($product_mapped['wpsc-variation']),'wpsc-variation');
					
					/*
					wp_set_object_terms( $product_id , explode(',',$cats),'wpsc_product_category');
					wp_set_object_terms( $product_id , explode(',',$tags),'product_tag');
					wp_set_object_terms( $product_id , explode(',',$variations),'wpsc-variation');
					*/
					
					
					//foreach ($product_mapped['your_custom_meta'] as $meta_key=>$meta_value) {
					//update_post_meta($product_id, $meta_key, $meta_value/*, $prev_value*/);
				}
			else
			{
				$info[$left]['ID'] = "N/A";
			}
			
//			wp_set_object_terms( $product_id , explode (",",$product_mapped['wpsc-variation']),'wpsc-variation');
			
			
			
			//echo 'ROW: '.$i.' inserted with SKU: '.$product_mapped['sku'][$i].' and NAME: '.$product_mapped['name'][$i].' into CATEGORY: '.$category_name .' - ';
	/*		echo '
			<td align="right">'.$i.'</td>
			<td align="center">'.$status.'</td>
			<td>'.$product_id.'</td>
			<td align="right">'.$product_mapped['_wpsc_sku'].'</td>
			<td>'.$product_mapped['post_title'].'</td>
			<td>'.$product_mapped['_wpsc_price'].'</td>
			<td align="right">'.$product_mapped['wpsc_product_category'].'</td>
			<td align="right">'.$product_mapped['product_tag'].'</td>';
*/
		
	$info[$left]['status']=$status;
	$info[$left]['statusid']=$statusid;



$bulk--;
$numero++;
$left++;
$import_countdown--;

		} // end bulk
//$prod=count($csv);
//$d=array();
//foreach ($csv as $v) $d[]=$v;
if ($import_countdown <0) $import_countdown=0;

//$p=$_REQUEST['post_title'];
//if (isset($_SESSION['csv'])) $p=$_SESSION['csv'][2]['post_title'];
echo json_encode(array("import_countdown"=>$import_countdown,"info"=>$info));//csv['post_title']));

die();
}

endif;

/*

$prod=count($csv);
//$d=array();
//foreach ($csv as $v) $d[]=$v;

$p=$_REQUEST['post_title'];
if (isset($_SESSION['csv'])) $p=$_SESSION['csv'][2]['post_title'];
echo json_encode(array("success"=>"1","post_title"=>$p,"sku"=>$prod));//csv['post_title']));

*/



if (!function_exists('update_selection_callback')) :

function update_selection_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$name = $_REQUEST['name'];

$value = $_REQUEST['value'];

update_option($name,$value);

$ret=array('ok' => $name.'=>'.$value);

die(json_encode($ret));


}
endif;



if (!function_exists('get_selection_callback')) :

function get_selection_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$name = $_REQUEST['name'];

$value = get_option($name);

$ret=array('ok' => $value);

die(json_encode($ret));


}
endif;



if (!function_exists('magpie_list_csv_callback')) :

function magpie_list_csv_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$have_csv_file=NULL;

//$files = glob(MAGPIE_UPLOAD_CSV_FOLDER."/*.csv"); 

$files=array("3"=>"jj");
$files=get_list_of_files("..".magpie_upload_url(),".csv",&$have_csv_file);

die(json_encode( array("list"=>$files)));

}
endif;





if (!function_exists('magpie_delete_csv_callback')) :

function magpie_delete_csv_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$csvfiles=$_REQUEST['list'];

$tmp_path = MAGPIE_UPLOAD_CSV_FOLDER."/";
 
foreach ($csvfiles as $file) unlink($tmp_path.$file);
	
die(json_encode( array("list"=>"ok")));

}
endif;





if (!function_exists('magpie_get_field_names_callback')) :

function magpie_get_field_names_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$csvfile=$_POST['csvfile'];

$h =fopen($csvfile, "r");

$fieldnames=fgetcsv($h,','); // "" as the last parameter must be gone!!!

global $sort_order;

$sort=array();
/*$field=array();
foreach ($fieldnames as $k=>$v) 
{
	$field[]=$v;
	
}*/
foreach ($sort_order as $k=>$v) 
{
	$sort[]=$k;
	
}
echo(json_encode( array("csvfile"=>$fieldnames,"sort_order"=>$sort)));
//echo json_encode($sort);
die();
//die(json_encode( array("csvfile"=>$fieldnames,"sort_order"=>$sort)));

}
endif;






if (!function_exists('magpie_fetch_csv_callback')) :

function magpie_fetch_csv_callback() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$csvfile = $_REQUEST['csvfile'];

$handle = fopen($csvfile,"r");

if (!$handle) die(-1);

$rows=0;
$keys=array();
$csv=array();

while ( ($csv_data = @fgetcsv($handle, filesize( $csvfile ), "," )) !== false ) 
{
	if ($rows==0) $keys = $csv_data;
	
	$csv[]=
	$csv_data;
	//array_combine($keys,$csv_data);
	
	$rows++;

}

die(json_encode(array("ok"=>"Okay","data"=>$csv,"rows"=>$rows)));

}
endif;




if (!function_exists('delete_all_wpsc_products')) :

function delete_all_wpsc_products() {

@error_reporting( 0 ); // Don't break the JSON result

header( 'Content-type: application/json' );

$first_total = $_REQUEST['first_total'];

$totalposts = wp_count_posts("wpsc-product");

$left=0;

foreach ($totalposts as $k=>$v) $left=$left+$v;

if ($first_total==-1) $first_total=$left;

$something_deleted=false;

foreach ($totalposts as $k=>$v) {

		$args = array(
			'numberposts'     => 100,
			'offset'          => 0,
			//'orderby'         => 'post_date',
			//'order'           => 'DESC',
			'post_type'       => 'wpsc-product',
			'post_status'     => $k );//stdClass Object ( [publish] => 331 [future] => 0 [draft] => 0 [pending] => 0 [private] => 0 [trash] => 17 [auto-draft] => 1 [inherit] => 0 )
		
		$the_post = get_posts($args);
		
		foreach ($the_post as $post) 
		{
			//setup_postdata($post);
			//$postid=$post->ID;//get_post($the_post[0]->ID);
			$del=wp_delete_post( $post->ID, true );
			if ($del) {$something_deleted=true;//break;
			}
		//else die(json_encode(array("status"=>-1,"total"=>$total)));
		//
		//if ($del) $something_deleted=true;
		}
}
$totalposts = wp_count_posts("wpsc-product");		
die(json_encode(array("status"=>$something_deleted,"left"=>$left,"first_total"=>$first_total,"totalposts"=>$totalposts)));

}
endif;


