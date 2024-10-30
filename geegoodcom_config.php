<?php

if (!function_exists('magpie_curl')) :

function magpie_curl ($thisurl) {
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $thisurl);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, true); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 0);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$headers = array("Cache-Control: no-cache", "Pragma: no-cache"); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
	$result = curl_exec($ch);
	curl_close($ch);
	//echo $thisurl.$result;die();
	return $result;
}
endif;


if (!function_exists('get_wecpi_config2')) : 

function get_wecpi_config2(){
	
	global $wecpi_config;
	$cfg="magpie_wait_get_config";
	$t=get_option($cfg);
		
	if (			((time() - $t) > 600) 
			|| (
				(!$t) || (!isset($_SESSION['wecpi_config']))
				)
				)
			
			{
//echo MAGPIE_CONFIG_URL;die();
			$result = magpie_curl(MAGPIE_CONFIG_URL);
			//echo MAGPIE_CONFIG_URL;die();
			
		
			$wecpi_config=json_decode($result,true);
			
			$_SESSION['wecpi_config']=$wecpi_config;
			
			update_option($cfg,time());
	
	}
	else {
	
		if (isset($_SESSION['wecpi_config'])) $wecpi_config = $_SESSION['wecpi_config'];
		
	}
//	if ($wecpi_config) $_SESSION['wecpi_config'] = $wecpi_config;
	//else if (isset($_SESSION['wecpi_config'])) $wecpi_config=$_SESSION['wecpi_config'];
return;
//echo MAGPIE_CONFIG_URL;die();
	print_r ($wecpi_config);
	die();
	//if ($result) $wecpi_config=parse_ini_string($result);
	
	$json = json_encode(
    array(
		"version"=>1.2,
        "build" => array(
            'UI fix: top menus showed wrong.',
            'Fixed the export folder so that the folder should show Okay and output CSV file be saved.'
                
            ),
		"knownissues" => array(
				'CSV file saving might not work during export and file CSV file import get location needs testing:'=>'On network and single WordPress installs the directory where files are written are different. So we need to test this some more so please provide feedback.',
                'After import is finished, clicking some menus, will make them disappear:'=>'Click the top-left link Go back to the main Import CSV page or click another menu in your WordPress Dashboard and then click the menu for MagPie'
			),
		"news"=>array(
				"June 11<sup>th</sup> 2011: I am doing a major overhaul of upcomming release 1.2 so I am delayed. I do not want to rush this bird. So bare with me. Redoing the whole import/export function which will make for properly mapped field CSV values. And much more.",
"June 9<sup>th</sup> 2011: Working on putting mapping of field names back.",
"June 9<sup>th</sup> 2011: I will start to focus on FUNCTION now rather than UI.",
"Implementing obfuscating and soon strong encoding for future updates!",
"WeCPi is very popular even in its early stage. Many satisfied customers just wanting to be able to do a simple export.",
"Testing the Auto Update Feature. Soon there. THANK YOU VERY MUCH Mr. J.",
"As requested; field names shown under the Settings/Help page."
			)
    	)
	);
echo $json;
die();

}

endif;


if (!function_exists('get_local_wecpi_config2')) :

function get_local_wecpi_config2(){
	
	//ABSPATH . './wp-content/plugins/wecpipro/config.ini';
	if (defined("MAGPIE_ONLINE")) $pre="";else $pre="";
	$inifile=$pre.MAGPIE_FILE_PATH.MAGPIE_CONFIG_FILENAME;
	//echo $inifile;die();
	global $local_wecpi_config;
	//echo $inifile;
//	die();
	/*if (!file_exists($inifile))	{
		$h=fopen($inifile,"w");if($h) fclose($h);
		return;
	}*/
	
	$h=fopen($inifile,"r");
	if ($h) {

			
			$d=fread($h,filesize($inifile));
			$local_wecpi_config=json_decode($d,true);
			fclose($h);
			//print_r($local_wecpi_config);die();
			
		}
	
}
endif;







if (!function_exists('get_tooltip_config')) :

function get_tooltip_config($this){
global $local_wecpi_config;
return $local_wecpi_config['tooltips'][$this];
}
endif;
if (!function_exists('get_tooltip_link')) :

function get_tooltip_link($this){
global $local_wecpi_config;
return '<a class="floatright" target="_blank" href="http://geegood.com/wordpress/?tooltip='.$this.'">...more information online...</a>';
}
endif;


if (!function_exists('show_tooltip')) :

function show_tooltip($this){
global $local_wecpi_config;

return '<span class="ggtooltip"><span class="ggtooltipgfx shadow2 border2"></span><span class="ggtooltipshow shadow2 border2">'.get_tooltip_config($this).'<br />'.get_tooltip_link($this).'</span></span>';

}
endif;

/*
,
"UI fixes",
"Testing auto update so new builds are frequent here in the beginning. Later less frequent.",
"Skype help available in Settings/Help page plus UI fixes",
"Getting some information such as Lastest News directly from geegood.com and improved automatically getting build version.",
"Field names shown under the Settings/Help page."
*/
if (!function_exists('check_bleeding_version2')) :

function check_bleeding_version2(){

$MAGPIEBUILD="http://geegood.com/wordpress/magpieprofessional/magpie-customer/";
	//$dir = 'wp-content/plugins/wecpipro/wecpipro.php';
	//$localfilesize=filesize('../'.$dir);
	if (defined('MAGPIE_ONLINE')) return;
	
	$force=false;
	
	$t=get_option("wecpipro_update");
	
	if (!$t) {update_option("wecpipro_update",time());$force=true;}
	
	if (!$force && time()-$t<120) return; //check only every so often
	
	//echo get_build_version("local").' '.get_build_version("remote");
	//die();
	
	if (get_build_version("local")<get_build_version("remote") ) :

	echo '<div class="magpieopenclose">Build Information</div><div class="thisopenclose infobox" style="background-color:#FFC">There is a new build version '. get_build_version("remote") . ' ready. <a  href="'. $MAGPIEBUILD .'">Download</a> and unzip in WordPress plugin direcory.<br /><br />The new build targets: '.get_build_info() .'</div>';
		
	
		//h=jQuery("#wecpi_bleeding_information").height();
		//jQuery("#wecpi_bleeding_information").css({'height':0,'opacity':0}).show().animate({'height':h,'opacity':1},1000);
		//adY=jQuery("#wecpi_bleeding_information .infobox").height()+50;
		//jQuery(".magpie_page").animate({'top':adY},1500);
		
		//jQuery(".wecpi_center").height(jQuery(".wecpi_center").height()+adY);

else :
	update_option("wecpipro_update",time());
	endif;
	
	
}
endif;

?>