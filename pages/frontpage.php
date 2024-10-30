<?php
?>
<div class="magpie_page">
		<?php show_creditcards();?>
		<div class="magpieheading">
		<?php if (MAGPIEBIRD==="PRO") echo '<div class="wecpi_pro_icon floatleft"></div>';
		else if (MAGPIEBIRD==="STANDARD") echo '<div class="wecpi_standard_icon floatleft"></div>';
		else echo '<div class="wecpi_ce_icon floatleft"></div>';
		?>
				<div class="headingtext">
				<?php if (MAGPIEBIRD==="PRO") echo '<div class="magpie_name_pro"></div>';
		else if (MAGPIEBIRD==="STANDARD") echo '<div class="magpie_name_standard"></div>';
		else echo '<div class="magpie_name_ce"></div>';
		?>
				
				WordPress e-Commerce Product Import & Export plugin<br />
				Version <?php echo MAGPIEVERSION.'.'.get_build_version();?>
				
						Release date: <?php echo MAGPIE_RELEASE_DATE;?><br />
						<a target="_blank" href="http://geegood.com/magpie/">geegood.com/magpie/</a> &copy; 2011 geegood.com - All Rights Reserved
				
				</div>
		</div>
		<?php
		//echo '<div class="wph">sd fsd sf f fg sdf</div>';
						global $wecpi_config;
						
						
						
						if (isset($wecpi_config['news'])) :
						
						echo '<div id="magpietopnews">';
						
						//echo get_config_value("topnews");
						//die();
						$f=get_config_value("topnews");
						//echo $f;
						echo magpie_curl($f);
						echo '</div>';
						?>
		<!--	<script>
						jQuery(document).ready(function() {
						aurl="<?php //echo get_config_value("topnews");?>";
						alert(3);
						jQuery("#magpietopnews").load(aurl);
						});
						</script>
				-->
		<?php
						
						echo '<div class="magpieopenclose">Latest News</div>';
						echo '<div id="latest_news" class="thisopenclose boxcontent"><h4 class="margin_top0">Latest News</h4>';
						dump_v($wecpi_config['news'],-1,true,3);
						echo '</div>';
						endif;
						
						?>
		<br style="clear:both" />
		
		<?php //echo magpie_upload_url();?>
			<?php //echo MAGPIE_UPLOAD_CSV_URL;
						?>
		<div class="spacingtop">
				
		</div>
		<?php show_wecpi_copyright();?>
		
		<!--
<h3>Advertising</h3> 
<a href="https://secure.avangate.com/order/product.php?PRODS=2929632&QTY=1&AFFILIATE=26645"><img src="http://www.premiumpress.com/banner/257x125.gif" border="0"></a>
<br />
<h3>Donate</h3>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YHYSCZUUC57VJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110429-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110429-1/en_US/i/scr/pixel.gif" width="1" height="1">
</form>
<br />
<small>Donating any ammount to WeCPi insures its continued development.</small>
<p><small>Donating also give you a promotion change being listed at geegood.com/wordpress for donation at or over USD 50<sup><u>00</u></sup>
</small>
--> 
		<!--
								<p>Notes </p>
								<p> <small>1. On Network WordPress installs, where you have multiple sites, the uploads directory will be in wp-content/blogs.dir/ID/files/ - ID is a number and correspond to to the ID number you see when hovering over your site path name in <i><a href="/wp-admin/network/sites.php">Network Admin->Dashbord->Sites</a></i></strong>. So upload your product images to this directory and <u>not</u> the standard echo gg_create_csv_file_location(true,false); directory. See more information and get the direct directory under Help.</small> </p>
							-->
		
</div>
