<?php
?>

<div class="magpie_page">
		<!--	<script language="javascript">
						
						jQuery(document).ready(function() {
						output="";
						jQuery("#settingshelp_page .infobox").each(function() {
		
							$c=jQuery(this).find("h4");
							if (!$c.hasClass("notoc")) {
								inner=$c.html();
								if (inner!=null) {
								output+='<div class="menuitem">'+inner+'</div>';
							//	aname='<a name="'+inner+'">';
								//$c.prepend(aname);
								//$c.append('</a><div style="float:right"><small><a href="#TOC">Table of Content</a></small></div>');
								
								}
							}
							});
						
						jQuery("#outhelpmenu").html(output);
	
						alert(output);
						});
						</script>
	-->
		<?php show_magpieheading("wecpi_help_icon","Support","Getting it right is a Shop to Success&trade;");?>
		<!-- <div class="coffeeshop_big">
										</div>-->
		<div class="infobox">
				<div class="magpiemenu">
						<div class="menuitem">
								Settings
						</div>
						<div class="menuitem">
								MagPie<sup>PRO</sup> Instant
						</div>
						<div class="menuitem">
								Documentation</sup>
						</div>
						<div class="menuitem">
								CSV field names
						</div>
						<div class="menuitem">
								CSV field names comma separated
						</div>
						
						
						<div class="menuitem">
								Folder information
						</div>
						
						<div class="clear">
						</div>
				</div>
		</div>
		<div id="settingshelp_page" class="sub_import_container">
				<div class="sub_import_page">
						<div class="infobox">
								<?php
					global $local_wecpi_config;
						dump_v($local_wecpi_config['production'],-1,true,3);
						
						?>
								<h2>Settings</h2>
								<table class="helptable">
										<tr>
												<th>Set this</th>
												<th>Explanation</th>
										</tr>
										<tr>
												<td valign="top"><div class="iphoneswitch_checked_box margin10" id="wecpi_uninstall">
														</div>
														Do you want to delete all options you have set and revert to standard when you deactivate <?php echo MAGPIE_NAME;?>?
														<?php $name1="wecpi_uninstall";?>
														<script>
	
function ajax_magpie_save_option (name,value) {	
		jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					cache: false,
					data: { action: "update_selection_callback", name:name, value:value },
					success: function( response ) {
						//alert(response.ok);
					}
				});	
}
function ajax_magpie_get_option (name) {	
		jQuery.ajax({
						
					type: 'POST',
					url: ajaxurl,
					cache: false,
					data: { action: "get_selection_callback", name:name },
					success: function( response ) {
						//alert(response.ok);
						
					}
					
				});
}											
jQuery('.iphoneswitch_checked_box').iphoneSwitch("<?php echo get_option($name1);?>",
		function() {
			
    		ajax_magpie_save_option("<?php echo $name1;?>","on");
		},
		function() {
			
			ajax_magpie_save_option("<?php echo $name1;?>","off");
		},
		{
		switch_on_container_path: '<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch_container_on.png',
		switch_off_container_path:'<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch_container_off.png',
		switch_path:'<?php echo MAGPIE_URL_PATH;?>images/iphoneswitch/iphone_switch.png'
		});
		</script> 
														<!--<label>
																<input type="checkbox" name="wecpi_uninstall"  class="ajax_update_selection_checked" />
																</label>
													--></td>
												<td valign="top"> You can keep it unchecked so that options are saved/remembered if you deside to activate <?php echo MAGPIE_NAME;?> later. <br />
														<br />
														No options are deleted by toggling this option. This option is only checked when deactivating <?php echo MAGPIE_NAME;?> and if checked, will delete all options.</td>
										</tr>
										<tr>
												<td valign="top"><div class="iphoneswitch_checked_box2 margin10" name="wecpi_pro_hide_help">
														</div>
														Hide some of the headline text and help? 
														<!--<label><strong>
																<input type="checkbox" name="wecpi_pro_hide_help"  class="ajax_update_selection_checked" />
																 </strong></label>
																 --></td>
												<td valign="top"> Just to keep it minimal, and when you have read it once or twice, it is nice to be able to remove some of the support/help text so you can focus on what is important namely import and export.</td>
										</tr>
										<tr>
												<td valign="top"><?php if (defined('WECPI_PRO_ULTRA')) {
							show_wecpi_pro_ultra_backup_selections();
						}
						else {
						?>
														<div class="iphoneswitch_checked_box3 margin10" name="wecpi_pro_ultra_backup">
														</div>
														Automatically export CSV file once every day? 
														<!--<label><strong>
																<input type="checkbox" name="wecpi_pro_ultra_backup"  class="ajax_update_selection_checked" />
																</strong></label>
														<?php } ?>
														
														--></td>
												<td valign="top"><?php if (defined('WECPI_PRO_ULTRA')) {
							show_wecpi_pro_ultra_backup_information();
						}
						else {
						?>
														This option <u><strong>only</strong></u> has effect in MagPie<sup>PRO</sup>
														<?php } ?></td>
										</tr>
								</table>
								<p>Options are automatically saved both here and on other <?php echo MAGPIE_NAME;?> pages once you toggle their selection.</p>
						</div>
				</div>
				<!--		<div class="sub_import_page">
		<div class="infobox">
				<a name="TOC"></a>
				<h4 class="notoc">Table of Content</h4>
				<div id="settingshelp_page_toc">
				</div>
		</div>
		</div>-->
				<div class="sub_import_page">
						<div class="infobox">
								<h4><?php echo MAGPIE_NAME;?> Instant</h4>
								Contact me any day and time for quick response and support and issues. Leave a message if I'm out and I'll MagPie you ASAP. <br />
								<?php show_skype_twitter();?>
						</div>
				</div>
				<div class="sub_import_page">
						<div class="infobox">
								<h4>Documentation</h4>
								<p>MagPie's full documentation is online. The basics of CSV is pretty but there are a few things to know to get it right. Some field values are stored as JSON values and you need to understand those. </p>
								<p>The userinterface of MagPie is made as intuitive	as possible and you should be able to import and export in minutes.</p>
								<p>Please visit the support section of MagPie at <a target="_blank" href="http://geegood.com/wordpress/">geegood.com/wordpress/</a></p>
						</div>
				</div>
				<div class="sub_import_page">
						<div class="infobox" style="overflow:auto">
								<h4>CSV field names</h4>
								<p> <a target="_blank" href="http://codex.wordpress.org/Function_Reference/get_post">Read about some of the fields that are utilized for products.</a> </p>
								<p>These are the field names in the exported CSV file. You need these as well in your file used for importing.</p>
								<p>Mapping your own field names and WP/WPEC's field names is not supported yet so you need to use below field names in your own CSV file.</p>
								<p>The first field name "id" is only produced when exporting and is used during import to update your products.</p>
								<?php echo show_field_names("table");?>
						</div>
				</div>
				<div class="sub_import_page">
						<div ID="copyfieldtext" class="infobox">
								<h4>CSV field names comma separated</h4>
								<p>Copy below and paste into your spreadsheet program in the first row. Or save in a file and import into your database program to auto-generate a database with below field names.</p>
								<textarea id="fieldnamescomma" onclick="this.focus();this.select();" cols="100%" rows="5"/>
								<?php $out = show_field_names();$out = substr($out,0,-1);echo $out;?>
								</textarea>
						</div>
				</div>
				
				<div class="sub_import_page">
						<div class="infobox">
								<h4>Folder information</h4>
								<table class="helptable" border="0" cellpadding="0" cellspacing="0">
										<tr>
												<th>What</th>
												<th>Where</th>
										</tr>
										<tr>
												<td>Directory where you upload your product images:</td>
												<td><?php echo gg_create_csv_file_location(true,false);?></td>
										</tr>
										<tr>
												<td>Directory where external product images are saved:</td>
												<td><?php echo gg_create_csv_file_location(true,false);?></td>
										</tr>
										<tr>
												<td>Directory where your exported CSV file is saved:</td>
												<td><?php echo gg_create_csv_file_location(true,false);?></td>
										</tr>
										<tr>
												<td>URL address of above folders</td>
												<td><?php echo gg_create_csv_url2_location(true,false);?></td>
										</tr>
										<tr>
												<td>Full path to your upload directory:</td>
												<td><?php echo gg_get_upload_dir('basedir');?></td>
										</tr>
										<tr>
												<td>Example of CSV filename saved including the date/time stamp:</td>
												<td><?php echo gg_create_csv_file_location(false,true,true);?></td>
										</tr>
								</table>
						</div>
				</div>
			
				
		</div>
		<?php show_wecpi_copyright();?>
</div>
