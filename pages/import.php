



<?php


if (!function_exists('prepare_the_import')) :

function prepare_the_import($file) {


?>
		<script type="text/javascript">
			jQuery(document).ready(function(){

			jQuery(".magpiemenu").eq(0).find(".menuitem").eq(1).trigger('click');
			
			
					
		});
		</script>
		<?php
				
		//if (!isset($_SESSION['cvs_start_import1']))
		
		//session_unset();
		//$_SESSION['cvs_start_import']=true;
		ini_set( "auto_detect_line_endings", 1 );
		
		
		
		//update_option('wecpi_import_images_from',$_POST['wecpi_import_images_from']);
		//update_option('wecpi_import_show_rows',$_POST['wecpi_import_show_rows']);
		
		
		
		
		//$file = $_FILES['csv_file'];
		
		//if (isset($_SESSION['csv_file'])) $file=$_SESSION['csv_file'];
		
			//if ( move_uploaded_file( $file['tmp_name'], MAGPIE_UPLOAD_FOLDER . $file['name'] ) ) {
		if (file_exists($file)) {	
				$_SESSION['csv_file']=$file;
			//	$content = file_get_contents( MAGPIE_UPLOAD_FOLDER . $file['name'] );
				$handle = @fopen( $file, 'r' );
				$rows=0;
				$keys=array();
				$csv=array();
				$error=false;
				while ( ($csv_data = @fgetcsv( $handle, filesize( $handle ), "," )) !== false ) {
					if ($rows==0) $keys = $csv_data;
					
					
					$csv[]=array_combine($keys,$csv_data);
					
					if (count($keys) != count($csv_data)) $error=true;
						
				
					/*
					$fields = count( $csv_data );
					
					$ic++;
					for ( $i = 0; $i < $fields; $i++ ) {
						if (!isset($data1[$i])) {
						
							$data1[$i] = array();
						}
						$data1[$rows][] = 
						//array_push( $data1[$i], $csv_data[$i] ); //last onto first
						
					}
					*/
					//$data1[$rows] = $csv_data;
					//echo $data1[$rows][4].'<br />';
					$rows++;
				}
			}
			else 
			{
				echo "<p>There was an error uploading your CSV file</p>";
				/*echo '$file: '. $file.'<br />';*/
				echo '<br />$file[tmp_name]: '.$file['tmp_name'].'<br />';
				echo 'Make sure below folders exists:<br />Whole path: '. $file .'<br />';
				die();
			}
		
		
		
		
		$_SESSION['csv'] = $csv;
		//$_SESSION['cvs_data'] = $data1;
		//$_SESSION['wecpi_to']=$rows;
	
	//die();
	
		global $sort_order;
		/*global $first_dump_k;
		$first_dump_k=dump_k($product_columns,0,false,true);
		$wecpi_product_columns = explode(",",$first_dump_k);
*/
		//foreach ($wecpi_product_columns as $key=>$v) echo $v.'<br />';
		
		//die();
		
		//echo $first_dump_k;
		//echo dump_k($product_columns,0,false,true);
		//die();
		if ($error) { ?>

<div class="infobox" style="background-color:#ffe0b0;font-size:1.2em !important;">
		<h4>Field name and value combine error!</h4>
		The field names and their values ust have the same length in your CSV file. If you have 16 field names there must also be 16 values separated by a comma. Each value can be empty but must have commas: value1,,,value2,value3,,,,,
		<h6>Some things that could be wrong</h6>
		<ul>
				<li>There are the right number of field names in the first line of your CSV but on the next lines somehwere there are less values than the number of field names.</li>
				<li>Your CSV file has been exported from a third party program and you might need to set the export settings to match those of MagPie ie. comma separated and double quote delimited. One product on each line</li>
				<li>If all fails contact MagPie support.</li>
		</ul>
		<h6>May work okay!?</h6>
		Even if this error looks alarming the fields below might have been found and you might be able to continue your import.
</div>
<?php
		}
		
		
		
	
	
	
		$GOES_TO_WPEC_CUSTOM_META="Goes into WPEC Custom Meta";
		$DO_NOTHING_WITH_FIELD="Do nothing with this field";
		echo '<div class="infobox">';
		echo show_tooltip("fieldmapping1").'<h4>Mapping of Field Names</h4>';
	?>
<form name='magpieform' enctype='multipart/form-data' id='magpieform' method='post' action='<?php echo MAGPIE_PAGE_URL; ?>' class='magpieform'>
		<?php
		echo '<table class="helptable" border="0" cellpadding="0" cellspacing="0">';
		
		
						
		/*
		*
		*
		*   Get Template
		*
		*
		*/
		$template=NULL;
		//echo $_POST["templatename"].'fffffffffff';
		//die();
		$templatename=NULL;
		if (function_exists('load_magpie_template') && isset($_POST["templatename"])) 
		{
			
			$template = load_magpie_template($_POST["templatename"]);
	
			
		}
		
		/*
		*
		*
		*
		*/
		echo '<tr><th>Field names found in your CSV file</th><th>';
		if ($template) echo '<div class="alert_box">Template "'.$templatename.'" is mapped. Change and save below if you like.</div>';
		echo 'Map to these '.MAGPIE_NAME.'/WPEC field names</th></tr>';
		
		
		$not_this_field=array("your_custom_meta"=>"");
		$magpie_field_names = array_diff_key($sort_order,$not_this_field);
		
		$magpie_field_names = $sort_order;
		$i=0;
		foreach ($csv[0] as $csvkey => $datum ) {
											
					echo '<tr><td style="width:50%;">';
					echo '<input type="hidden" name="wecpicolumn[]" value="'.$csvkey.'">';
					echo $csvkey;//.' - '.$datum;
					echo '</td>';

					echo '<td><select name="value_name[]">';
					echo '<optgroup label="Do this:">';
					
					echo '<option class="magpiecharcase" value="DO_NOTHING">'.$DO_NOTHING_WITH_FIELD.'</option>';
					echo '<option class="magpiecharcase" value="your_custom_meta">'.$GOES_TO_WPEC_CUSTOM_META.'</option>';
					
					echo '</optgroup>';
					echo '<optgroup label="Map to this internal field:">';
					
					
					if ($template)
					//if ($template)
					{
						foreach ($magpie_field_names as $magpiekey=>$v)
						{
						
						echo '<option ';
						if ($csvkey===$template[$i]) echo ' selected ';
						echo 'value="'.$magpiekey.'">';
						echo $magpiekey;
						echo '</option>';

					
						}
					}
						else
					
					foreach ($magpie_field_names as $magpiekey=>$v)
					{
						
						echo '<option ';
						if ($template && $template[$i]===$magpiekey) echo ' selected ';
							else 
						if ($csvkey===$magpiekey) echo ' selected ';
						echo 'value="'.$magpiekey.'">';
						echo $magpiekey;
						echo '</option>';

					
					}
					$i++;
					echo '</select></td></tr>';
					
		}
		echo '</table></div>';
	
		
		
		//show_html_tag_stripped();
		
		/*switch (get_option('wecpi_import_show_rows')) {
			case "ALL":show_csv_table($csv);break;
			case "NONE":break;
			default:
				show_csv_table($csv,get_option('wecpi_import_show_rows'));
		}
		*/
		$_SESSION['wecpi_total'] = count($csv)-1;
		/*if (!isset($_SESSION['wecpi_from'])) $_SESSION['wecpi_from'] = 1;
		if (!isset($_SESSION['wecpi_to'])) $_SESSION['wecpi_to'] = $_SESSION['wecpi_total'];
		if ($_SESSION['wecpi_from']>$_SESSION['wecpi_to']) $_SESSION['wecpi_from']=$_SESSION['wecpi_to'];
		if ($_SESSION['wecpi_to']>$_SESSION['wecpi_total']) $_SESSION['wecpi_to']=$_SESSION['wecpi_total'];
			*/	
		?>
		<div class="infobox">
				<?php echo show_tooltip("fieldmapping2").'<h4>'.MAGPIE_NAME. 'is ready to import.</h4>';?>
				
				<table class="helptable">
						<tr>
								<td><p>Total products found in your CSV file:</p></td>
								<td><?php echo $_SESSION['wecpi_total'];?></td>
						</tr>
						<tr>
								<td><p>Start import from products N<sup>o</sup>:</p></td>
								<td><input name="magpiefrom" type="text" value="1" /></td>
						</tr>
						<tr>
								<td><p>End import at products N<sup>o</sup>:</p></td>
								<td><input name="magpieto" type="text" value="<?php echo $_SESSION['wecpi_total'];?>"/></td>
						</tr>
						<tr>
								<td><p>Choose which CSV field name you want to update your WPEC products with</p></td>
								<td><label>
												<input type="radio" name="wecpi_primary_key" class="ajax_update_selection" value="_wpsc_sku" <?php if (get_option('wecpi_primary_key')=="_wpsc_sku") echo 'checked="checked"';?>/>
												_wpsc_sku </label>
										<br />
										<label>
												<input type="radio" name="wecpi_primary_key" class="ajax_update_selection" value="id" <?php if (get_option('wecpi_primary_key')=="id") echo 'checked="checked"';?> />
												ID</label>
										<br /></td>
						</tr>
						<tr>
								<td><p>Insert new product if product with _wpsc_sku or ID not found in your current products?</p>
										<?php if (get_option('insert_if_not_present')) : ?>
										<p><strong>You currently have <?php echo MAGPIE_NAME;?> set to create new product records even if they already exist. Uncheck this box to prevent creating duplicate products. </strong></p>
										<?php endif;?></td>
								<td><input type="checkbox" name="insert_if_not_present" id="insert_if_not_present" <?php check_checked('insert_if_not_present');?>/>
										<br /></td>
						</tr>
						<tr>
								<td><p>Save as a Template.</p>
									<p>(If you type a name that already exists, the old one will be overwritten).</p> </td>
								<td>
								<?php 
								if (function_exists('load_magpie_template')) {
																	
								if ($template) echo '<div class="alert_box">';?>
								<input name="templatename" size="32"  type="text" value="<?php if ($template) echo $templatename;?>"/>
								<p>Here are the names of your current template names:</p>
								<?php	$templates = get_option("magpietemplate");
										$templates = unserialize($templates);
										if (is_array($templates)) foreach ($templates as $k=>$v) if ($k) echo '['.$k.']';
								if ($template) echo '</div>';
								}
								else {
									echo '<div class="alert_box">Template system only available in PRO.</div>';
									}
									?>
								
								</td>
						</tr>
						<tr>
						<td><p>Importing in bulk is probably faster on a slower connection.</p>
						<p>
						 If you import only 1 row at a time the import engine has to communicate over the Internet for each import.</p>
						 <p>So the higher the bulk should make the import faster.</p>
						 <p>
						 If bulk is higher than 1, you will only see response data for verification for each bulk step row.
						 </p>
						 </td>
						<td><input name="import_bulk" size="8"  type="text" value="<?php echo get_option('import_bulk');?>"/></td>
						</tr>
						<tr>
								<td colspan="2" align="right"><input style="margin:20px !important" type="submit" class="button" name="startimport" id=""  value="Start the import..."/></td>
						</tr>
				</table>
		</div>
</form>

<?php	
		
}

endif;

?>
<!--
-
-
-
-
-
-
-
-
-
-
-->
<div class="magpie_page">
		<?php show_magpieheading("wecpi_import_icon","Import","From CSV 2 WPEC");?>
		<div class="infobox">
				<div class="magpiemenu">
						<div class="menuitem">
								Select CSV
						</div>
						<div class="menuitem">
								Map Fields
						</div>
						<div class="menuitem">
								Import
						</div>
				</div>
				<div class="clear">
				</div>
		</div>
		<div class="sub_import_container">
				<div class="sub_import_page" id="select_import_csv">
						<form name='magpieform' enctype='multipart/form-data' id='magpieform' method='post' action='<?php echo MAGPIE_PAGE_URL; ?>' class='magpieform'>
								<div class="infobox">
										<h4>Select CSV for mapping and final import</h4>
										<p>On this page you select a CSV file you want to map to <?php echo MAGPIE_NAME;?> and WPEC. After mapping, on the next page, the final import is activated by you, when you are ready.</p>
										<p>You can either import one of the below allready present CSV files or load one from your computer.</p>
								</div>
								<div class="infobox">
										<h4>Choose local CSV file</h4>
										<input type='file' name='csv_file' id="submit_csv_file" class="button"/>
										<?php if (defined('MAGPIE_ONLINE')) echo '<span class="wecpi_online_but">Load CSV File</span>';
										else echo '<input type="submit" value="Load CSV File" id="submit" class="button">';	?>
								</div>
								
								
								<?php if (function_exists('show_template_import')) show_template_import();
								else echo '<div class="alert_box">Template system only available in PRO</div>';
								?>
								
								<?php


?>

								<?php if (function_exists('show_online_csv')) show_online_csv();
								else echo '<div class="alert_box">Loading CSV online only in PRO</div>';
								?>
								
								
								<!-- <div id="dump_data_box" class="infobox">
								</div>-->
						</form>
						<?php get_import_page1();?>
				</div>
				
				<!--
						
						
						
						
						
						MAPPING PAGE 
										
				
				
				-->
				
				<div class="sub_import_page" id="mapping_field_names">
						
								<?php
				 
				 $csvfile="";
				 if (isset($_POST['singlecsv']) && $_POST['singlecsv']) {
					
					 if (isset( $_POST['map_csv_file'] ) && ($_POST['map_csv_file'] != ''))
					 {
					 //if (isset($_SESSION['csv_file'])) unset($_SESSION['csv_file']);
					 $csvfile=MAGPIE_UPLOAD_CSV_FOLDER.$_POST['map_csv_file'];
					 }
				/*	foreach ($_POST['map_csv_file'] as $k=>$v) {
						echo $k.' => '.$v .'<br />';
						}
				*/
					
				 }
				 elseif (isset( $_FILES['csv_file']['name'] ) && ($_FILES['csv_file']['name'] != '')) {
					 
					 $file=$_FILES['csv_file'];
					 
					$upload_dir_data = wp_upload_dir();
					$upload_dir = $upload_dir_data['basedir'];
		
					$thefile = $upload_dir . '/'.$file;
					 
					 if ( move_uploaded_file($file['tmp_name'], $upload_dir . '/'. $file['name'] ) ) {
						 //if (isset($_SESSION['csv_file'])) unset($_SESSION['csv_file']);
						 $csvfile= $upload_dir . '/'.$_FILES['csv_file']['name'];
					 }
				 }
				 //elseif (isset($_SESSION['csv_file'])) $csvfile=$_SESSION['csv_file'];
				 
				if ($csvfile!="") prepare_the_import($csvfile);
				
				else
				echo '<div class="boxcontent"><h4>Select a CSV for mapping first</h4>Please select a CSV file or upload a new one for mapping, then this page will show automatically, ready for you to map fields.</div>';
					
					
					?>
						
				</div>
				
				<!--
						
						
						
						
						
						DO THE IMPORT 
						
						
						
						
						
						
						
						
						-->
				
				<div class="sub_import_page">
						<div class="infobox" id="import_in_progress">
								<?php	
								if (!isset($_POST['startimport']))
								{echo '<h4>No import started</h4>Please select a CSV file, then map it and finally this page will load with the import status.';
									}
								
								else
								{
									

									
									//$csv = $_SESSION['csv'];
		
								/*
								
								Do som CACHING
								
								*/
								
									update_option('wecpi_primary_key',$_POST['wecpi_primary_key']);
									
									if (isset($_POST['insert_if_not_present'])) update_option('insert_if_not_present',$_POST['insert_if_not_present']);else update_option('insert_if_not_present',NULL);
								
	
	
									global $import_bulk;
									if (isset($_POST['import_bulk'])) $import_bulk=$_POST['import_bulk'];else $import_bulk=10;
									if ($import_bulk<1) $import_bulk=10;
									update_option('import_bulk',$import_bulk);
	
	
									
									$_SESSION['wecpicolumn']=$_POST['wecpicolumn'];
									
									$_SESSION['value_name']=$_POST['value_name'];
									
									
									
									
									if (isset($_POST['insert_if_not_present'])) $_SESSION['insert_if_not_present']=get_option('insert_if_not_present');else $_SESSION['insert_if_not_present']="";
									
									$_SESSION['wecpi_primary_key']=get_option('wecpi_primary_key');
									
									//$taxonomies = get_object_taxonomies('wpsc-product');
									
									/*
									*
									*	
									*	CSV Template system save
									*
									*
									*/
									if (function_exists('save_magpie_template')) save_magpie_template($_POST['templatename']);
									
									/*
									*
									*	
									*	
									*
									*
									*/
									
	
			//$csv_import_data=json_encode($csv);
									
									
									
									?>
								<h4>Import</h4>
								<div id="iphoneswitch_import_wrap">
								<div class="iphoneswitch_import  margin10"></div>
								</div>
								<div id="import-bar" style="position:relative;height:23px;width:100%;">
										<div id="import-bar-percent" style="position:absolute;left:50%;top:50%;width:300px;margin-left:-150px;height:25px;margin-top:-9px;font-weight:bold;text-align:center;">
										</div>
								</div>
								<div class="infobox shadowinset whiteb" id="import_status" style="overflow:auto;height:180px;">
								</div>
								
								<table class="helptable" cellspacing="0" cellpadding="0">
								<tr><td class="alignright">Total Products Selected For import</td><td><span id="noproducts">0</span></td></tr>
								<tr><td class="alignright">From Product Row</td><td><span id="importrowfrom">0</span></td></tr>
								<tr><td class="alignright">To Product Row</td><td><span id="importrowto">0</span></td></tr>
								<tr><td class="alignright">Products Imported</td><td><span id="prod_import_status1">0</span></td></tr>
								<tr><td class="alignright">Products Updated</td><td><span id="prod_import_status2">0</span></td></tr>
								<tr><td class="alignright">Product IDs not present for update</td><td><span id="prod_import_status3">0</span></td></tr>
								<tr><td class="alignright">Product Transaction Unknowns</td><td><span id="prod_import_status0">0</span></td></tr>
								<tr><td class="alignright">Product Transaction Errors</td><td><span id="prod_import_status4">0</span></td></tr>
								<tr><td class="alignright">Remaining Rows</td><td><span id="importremain">0</span></td></tr>
								<tr><td class="alignright">Products Import Failures</td><td><span id="importfailure">0</span></td></tr>
								</table>
								
								
								<?php }
								
		$text_failures =   sprintf( 'All done! %1$s transactions in %2$s seconds and there were %3$s failure(s).', "' + rt_successes + '", "' + rt_totaltime + '", "' + rt_errors +'" );
		$text_nofailures = sprintf( 'All done! %1$s transactions in %2$s seconds and there were 0 failures.', "' + rt_successes + '", "' + rt_totaltime + '" );
		
		get_import_page3();
								 ?>
						</div>
				</div>
		</div>
		<?php show_wecpi_copyright();?>
	<!--	</form>-->
</div>









<?php

function get_import_page1() {
?>
<div id="listcsv" style="display:none">
				</div>
<script type="text/javascript">
	// <![CDATA[
		jQuery(document).ready(function(){
			
	jQuery("#listcsv").click(function(){
				
				show_existing_exported_csv();
				return;
				});
		
	
			//jQuery(".magpiemenu").eq(0).find(".menuitem").eq(1).trigger('click');						
			
									
									
/*jQuery("#check_all_csv_files").click(function()				
			{
				var checked_status = this.checked;
				jQuery("input[class=paradigm]").each(function()
				{
					this.checked = checked_status;
				});
			});	

jQuery("#inverse_all_csv_files").click(function()				
			{
				var checked_status = this.checked;
				jQuery("input[class=paradigm]").each(function()
				{
					if (this.checked) this.checked = 0;
					else this.checked = 1;
				});
			});	
*/		
		var csvfile;
		var magpie_csv_url="<?php echo MAGPIE_UPLOAD_CSV_URL;?>";
	
	//alert(magpie_csv_dir);
			function list_csv_files(json) {
				
				jQuery(".exported_csv").html('<fieldset>');
				jQuery(".selectbox_exported_csv").html('<fieldset>');
				
				jQuery.each(json.list, function (k,v){
				k++;
				if (k<10) ok="00"+k;else if (k<100) ok="0"+k;else ok=k;
					
					//alert(ok);
					
					jQuery(".exported_csv").append('<label>'+ok+'<input type="checkbox" class="delete_csv_files" name="delete_csv_files[]" value="'+v+'"/></label>'+'<span class="show_csv_content"><a href="'+magpie_csv_url+v+'">'+v+'</a></span><br />');
							
					
					
					
					//jQuery(".checkbox_exported_csv").append('<label>'+ok+'<input type="radio" name="edit_csv_file" value="'+v+'" />'+v+'</label><br />');
					
					jQuery(".selectbox_exported_csv").append('<label>'+ok+'<input type="radio"  name="map_csv_file" id="map_csv_file" value="'+v+'" />'+v+'</label><br />');
					
				});
				
				
				
				//jQuery("#exported_csv").append('<br /><label><input type="checkbox" id="check_all_csv_files"/>Select All</label><br />');
				
				jQuery(".exported_csv").append('</fieldset>');
				jQuery(".selectbox_exported_csv").append('</fieldset>');
					
		};



			
			function show_existing_exported_csv() {
			jQuery(".exported_csv").html("");
			jQuery(".checkbox_exported_csv").html("");
			
				jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					data: { action: "magpie_list_csv_callback" },
					success: function( json ) {
						
						if ( json.list ) {
							
							list_csv_files(json);
						}
						else {
						
						jQuery(".exported_csv").html("CSV files not fetched! You might need to log in again to the Dashboard of WordPress.");
						}

					},
					error: function( json ) {
						
						jQuery(".exported_csv").html("Ajax call error1. Are you logged in? Consult the developer!");
					}
				});
			}
			
			
			show_existing_exported_csv();
			
			
			jQuery(".listcsv").click(function(){
				show_existing_exported_csv();
				return;
				});
			
			
			
			
			function get_csv_name() {
				
				csvfile=jQuery("input[id=map_csv_file]:checked").val();
				
				
				if (!csvfile) {alert("Please select a CSV file...");return false;}
								
				csvfile='..'+magpie_csv_dir+'/'+csvfile;
				
				return csvfile;
			}
			
			
			
			function dump_json(response) {
				jQuery(response.data).each(function(k,v){
					jQuery("#dump_data_box").append(v+'<hr />');
				});
				
			}
				
			
			
			function map_csv_file() {
			
				csvfile=get_csv_name();
				
				if (!csvfile) return false;
				
				//return;
				//function delete_csv_now() {
			
			
	
			jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					data: { action: "magpie_get_field_names_callback", csvfile:csvfile },
					//data: { action: "magpie_dump_csv_mysql", csvfile:csvfile },
					success: function( response ) {
						
						if ( response) {
							//alert("Okay "+response.csvfile);
							jQuery("#dump_data_box").append('CSV file:<br />'+response["sort_order"][0]+'<hr />');
							
							//jQuery("#dump_data_box").append('Sort Order:<br />'+response.sort_order+'<hr />');
							
							//var obj = jQuery.parseJSON(response.csvfile);
							//alert(obj);
							//for (i in response.sort_order)
							var data = response;
							
							jQuery(data["csvfile"]).each(function(k,v)
							{
							
								
								jQuery("#dump_data_box").append('<div class="tablerow">');
								
										jQuery("#dump_data_box").append('<div class="tablecell tcw250">'+v+'</div>');
										
										//jQuery("#dump_data_box").append('<div class="tablecell tcw250">');
										//mapping_fieldnames
										jQuery("#dump_data_box").append('<div class="tablecell tcw250">'+k);
										
										
										jQuery("#dump_data_box").append(response["sort_order"][k]);//+'=>'+v2);
											/*		jQuery(data["sort_order"]).each(function(k2,v2) {
														
														jQuery("#dump_data_box").append(k2[0]);//+'=>'+v2);
														//myOptions[k2] = v2;
														//jQuery('#dump_data_box').append();
														//jQuery('#mapthesefields').append('<option value="'+ v2 +'">'+ v2 +'</option>');
														// output.push('<option value="'+ v2 +'">'+ v2 +'</option>');
       
														//output+='<option value="jjj">Jhgt 5saskd hsf  dsdfsdfg</option>'; 
												//		jQuery("#dump_data_box").append('<option'); 
												///		if (v==k2) jQuery("#dump_data_box").append(' selected ');
													//	jQuery("#dump_data_box").append(' value="'+k2+'">'+k2+'</option>');
													});
												*/
										jQuery("#dump_data_box").append('</div>');
								
								
								
								
								jQuery("#dump_data_box").append('</div>');
								
								
								
								
														
							});
							
						
						}
						else {
						alert("1"+response);
						//jQuery(".exported_csv").html("Error while trying to delete CSV files!");
						}

					},
					error: function( response ) {
						alert("2"+response.ok);
						//jQuery(".exported_csv").html("Ajax call error. Are you logged in? Consult the developer!");
					}
				});
				
			}
				
			
			
			
			function fetch_csv_file() {
				
				csvfile=get_csv_name();
				if (!csvfile) return false;
				//alert(csvfile);
				jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					data: { action: "magpie_fetch_csv_callback", csvfile:csvfile },
					//data: { action: "magpie_dump_csv_mysql", csvfile:csvfile },
					success: function( response ) {
						
						if ( response.data) {
							//jQuery("#dump_data_box").append("response.data");
							//var obj = jQuery.parseJSON(response.data);
							//alert(response.data.post_title[0]);
							//dump_json(response);
							jQuery("#dump_data_box").append("<br />Okay=><br />");
							//for (i in response.data)
							//jQuery("#dump_data_box").append(i+response.data[i]+'<br /><br /><hr />');
							/*
							jQuery(response.data).each(function(k,v){
								
								
								jQuery("#dump_data_box").append(k+' => '+v+'<br /><br /><hr />');
								
								
								});
							*/
							//return;
							//show_existing_exported_csv();
							//jQuery(".listcsv").trigger("click");
						}
						else {
						alert("Import - should not get here. Err Code 1"+response);
						//jQuery(".exported_csv").html("Error while trying to delete CSV files!");
						}

					},
					error: function( response ) {
						alert("Import - should not get here. Err Code 2"+response);
						//jQuery(".exported_csv").html("Ajax call error. Are you logged in? Consult the developer!");
					}
				});
				
			}
				
	
	jQuery("#map_csv_file_but").click(function(){
				
				//return false;
				map_csv_file();
				fetch_csv_file();
				});
			
	
	
	/*
	
	jQuery("#start_magpie_import").click(function(){
				
				
				//jQuery("#startimport").submit();
				});
				
	*/
	
	
			
			
		});
	// ]]>
	
	
	</script>
<?php
		}



function get_import_page3() {
	
?>
<script type="text/javascript">
	// <![CDATA[
		jQuery(document).ready(function(){
			
			
					window.onbeforeunload = function(){
		if (!stop_import) return "You have attempted to leave this page.  If you do, the import process will stop. You can start from start again later. Are you sure you want to exit this page?";
		
	};
	

		
		jQuery(".magpiemenu").eq(0).find(".menuitem").eq(2).trigger('click');						
		
					
			
			// Create the progress bar
			jQuery("#import-bar").progressbar();
			jQuery("#import-bar-percent").html( "0%" );
			
		
			
			var rt_from = <?php echo $_POST['magpiefrom'];?>;
			var rt_from2 = rt_from;
			var rt_to = <?php echo $_POST['magpieto'];?>;
			var rt_total = (rt_to-rt_from)+1;
			//var remain = rt_total;
			
			var import_countdown = rt_total;
			
			var bulk=<?php echo get_option('import_bulk');?>;
			
			jQuery("#noproducts").html(rt_total);
			jQuery("#importrowfrom").html(rt_from);
			jQuery("#importrowto").html(rt_to);
			
			var rt_percent = 0;
			var rt_successes = 0;
			var rt_errors = 0;
			var rt_failedlist = '';
			var rt_resulttext = '';
			var rt_timestart = new Date().getTime();
			var rt_timeend = 0;
			var rt_totaltime = 0;
			//var rt_continue = true;
			var csvscroll=true;
			var stop_import=false;
			var import_status = new Array(0,0,0,0,0);


			// Clear out the empty list element that's there for HTML validation purposes
			//jQuery("#regenthumbs-debuglist li").remove();
			// Called after each resize. Updates debug information and the progress bar.
			function import_posts_to_csvUpdateStatus( number,success,response ) {
				
				
				
				
				

				if ( success ) {
					rt_successes = rt_total-import_countdown;
					jQuery("#import-bar").progressbar( "value", ( rt_successes / rt_total ) * 100 );
					jQuery("#import-bar-percent").html( Math.round ( ( rt_successes / rt_total ) * 100) + "%" );
				//rt_from = rt_from + bulk; //not used!!
					//jQuery("#prod_imported_ok").html(rt_successes);
					//jQuery("#importremain").html(rt_to-number);
					jQuery("#importremain").html(import_countdown);
					
					
					//rt_timeend = new Date().getTime();
					//rt_totaltime = ( ( rt_timeend - rt_timestart ) / 1000 );
					//jQuery("#timeremain").html(Math.round(rt_totaltime*(rt_total/number)));
					out="";
					jQuery(response['info']).each(function(k,v){
						//alert(k+' '+v['status']);
						out+=sprintf("Row# %4d, SKU:%s, ID:%s, TITLE:%s, PRICE:%s STATUS:%s<br />",(number+k),v["_wpsc_sku"],v["ID"],v["post_title"],v["_wpsc_price"],v["status"]);
						
						import_status[v["statusid"]]++;
						
						});
					
					jQuery(import_status).each(function(k,v){
						//alert(0);
						statusid="#prod_import_status"+k;
						jQuery(statusid).html(import_status[k]);
					});
					
					jQuery("#import_status").append(out);
					//jQuery("#import_status table").addClass('helptable');
				}
				else {
					rt_errors = rt_errors + bulk;
					rt_failedlist = rt_failedlist + ',' + id;
					jQuery("#prod_other_ok").html(rt_errors);
					//jQuery("#import_status").append("<li>" + response.error + "</li>");
				}
				
				if (csvscroll===true) jQuery("#import_status").scrollTop(1000000);
			}

			jQuery('#import_status').hover(function() {
		  	csvscroll=false;
			//alert("stop");
			});













			// Called when all images have been processed. Shows the results and cleans up.
			function import_posts_to_csvFinishUp() {
				
			
				rt_timeend = new Date().getTime();
				rt_totaltime = ( ( rt_timeend - rt_timestart ) / 1000 );


				jQuery('.iphoneswitch_import').trigger('click');
				jQuery('#regenthumbs-stop').hide();
/*
				if ( rt_errors > 0 ) {
					rt_resulttext = '<?php //echo $text_failures; ?>';
				} else {
					rt_resulttext = '<?php //echo $text_nofailures; ?>';
				}
*/
				
			rt_resulttext =   'All done! '+(rt_successes)+' product(s) were successfully imported in '+rt_totaltime+' seconds and there were '+rt_errors+' failure(s).';

			jQuery("#import_status").append('<div id="message"><p><strong>' + rt_resulttext + '</strong></p></div>');
				//jQuery("#message").show();
				jQuery("#import_status").scrollTop(1000000);

				
				
				
				
				
			}





			function import_csv(number) {
			
				//var thiscsv = csv[number];
				//.serializeArray();
				//var thiscsv=jQuery.parseJSON(csv[number]);
					//jQuery("#import_status").append('thiscsv: '+thiscsv["post_title"]+' - ');
			
				jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					cache: false,
					data: { action: "import_callback", numero:number,bulk:bulk,import_countdown:import_countdown },
					//data: { action: "import_callback", csv:thiscsv,post_title:thiscsv['post_title'] },
					success: function( response ) {
						
						//jQuery("#regenthumbs-debuglist").append("<br />"+csvfilename+"<br />");
						//jQuery("#regenthumbs-debuglist").append(response + ' ' +response.status + ' ' + response.statusText+ ' ' +response.readyState + ' ' +response.responseJSON);
							
							//remain-=bulk;
							/*
							if (remain <0) {
								//step back numbers
								bulk=remain+bulk;remain=0;
								number=number-bulk;
							}*/
							import_countdown=response['import_countdown'];
							
								if ( response['import_countdown']!="undefined" ) {//alert(number);
								
								
									/*if (!response) {
										jQuery("#import_status").append("<li>Please log in again to WordPress to continue exporting...</li>");
										stop_import=true;//$aj.stop();
									}*/
									//else jQuery("#import_status").append('Post: '+response['post_title']);
									
									import_posts_to_csvUpdateStatus( number,true,response );
								}
								else {
									jQuery("#import_status").append('<br />ajax.response.undefined.import_csv()!');
									import_posts_to_csvUpdateStatus( number,false,response );
								}

						
						if (import_countdown>0 && !stop_import ) {
							
							
							import_csv( number+bulk);
						}
					
						else {
							
							import_posts_to_csvFinishUp();
						}
					},
					
					
					
					error: function( response ) {
						number+=bulk;
						//remain-=bulk;
						jQuery("#import_status").append(response.statusText+ ' ' +response.readyState + ' ' +response.responseJSON);
						import_posts_to_csvUpdateStatus( number,false,response);

						if (number<rt_to && !stop_import ) {
							
							import_csv(number );
						} 
						else {
							import_posts_to_csvFinishUp();
						}
					}
				});
			
			}


		
			
			//_e( 'Start Exporting Products', 'regenerate-thumbnails' ) 
		function start_magpie_import() {
		
			//jQuery("#export_start_control_button").hide();
			//jQuery("#export_stop_control_button").show();
			//jQuery("#message").hide();
			
			
			jQuery(".ui-progressbar-value").toggleClass('vis');
	
//jQuery("#import_status").html('<strong>Row#, SKU, ID, TITLE, Status</strong><br />');
			
			 //rt_total = csv.length-1;
			 rt_from = rt_from2;
			 rt_percent = 0;
			 rt_successes = 0;
			 rt_errors = 0;
			 rt_failedlist = '';
			 rt_resulttext = '';
			 rt_timestart = new Date().getTime();
			 rt_timeend = 0;
			 rt_totaltime = 0;
			 //rt_continue = true;
			stop_import=false;
			
				//	alert(rt_total);	
			import_csv(rt_from);
			
			//jQuery("#import_status").append('</table>'); 
			
		}
		
		function continue_import(){
			stop_import = false;
			start_magpie_import();

	//		import_csv(number);
			}



jQuery('.iphoneswitch_import').iphoneSwitch( "on",
	 continue_import(),
      function() {
   	 stop_import = true;
	 jQuery('#iphoneswitch_import_wrap').html("Reload your browser to start over again with same import settings or select a new CSV.");
      },
      {
 		switch_on_container_path: '<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch_container_on.png',
		switch_off_container_path:'<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch_container_off.png',
		switch_path:'<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch.png'
 
      });


//start_magpie_import();








		/*
		
		 jQuery('.iphoneswitch_export').iphoneSwitch( function() {
     //  $('#ajax').load('off.html');
	 return "off";
      },
	   start_the_export,
      function() {
     //  $('#ajax').load('off.html');
	 rt_continue = false;
      },
      {
 //       switch_on_container_path: 'iphone_switch_container_off.png'
      });
 */
		
		
		
			
		});
	// ]]>
	</script>
<?php

//http_request('POST', 'geegood.com', 80, '/magpie/support/', array('api' => 'keyopen'), array('activation_key'=>get_bloginfo("url")), array('activation_email'=>$activation_email));





}
?>

<!--
								<div class="infobox">
										<h4> Do you w want to import images: </h4>
										<label>
												<input type="radio" name="wecpi_import_images_from" value="no_image" <?php //if (get_option('wecpi_import_images_from')=="no_image") echo 'checked="checked"';?>/>
												Do not import any images </label>
										<br />
										<label>
												<input type="radio" name="wecpi_import_images_from" value="image" <?php // if (get_option('wecpi_import_images_from')=="image") echo 'checked="checked"';?>/>
												Import images from your upload folder <span class="wecpi_pro_hide_help"><?php //echo gg_create_csv_file_location(true,false);?> field name in CSV: image</span> </label>
										<br />
										<label>
												<input type="radio" name="wecpi_import_images_from" value="image_url" <?php ///if (get_option('wecpi_import_images_from')=="image_url") echo 'checked="checked"';?> />
												Download, save and import images from external URL field name in CSV: image_url</label>
										<div class="wecpi_pro_hide_help infobox_help">
												If you have no changes in product images then select not to import - this is faster.
										</div>
								</div>
								--> 