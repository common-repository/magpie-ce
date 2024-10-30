<?php


function http_request( 
    $verb = 'GET',             /* HTTP Request Method (GET and POST supported) */ 
    $ip,                       /* Target IP/Hostname */ 
    $port = 80,                /* Target TCP port */ 
    $uri = '/',                /* Target URI */ 
    $getdata = array(),        /* HTTP GET Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $postdata = array(),       /* HTTP POST Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $cookie = array(),         /* HTTP Cookie Data ie. array('var1' => 'val1', 'var2' => 'val2') */ 
    $custom_headers = array(), /* Custom HTTP headers ie. array('Referer: http://localhost/ */ 
    $timeout = 1000,           /* Socket timeout in milliseconds */ 
    $req_hdr = false,          /* Include HTTP request headers */ 
    $res_hdr = false           /* Include HTTP response headers */ 
    ) 
{ 
    $ret = ''; 
    $verb = strtoupper($verb); 
    $cookie_str = ''; 
    $getdata_str = count($getdata) ? '?' : ''; 
    $postdata_str = ''; 

    foreach ($getdata as $k => $v) 
                $getdata_str .= urlencode($k) .'='. urlencode($v) . '&'; 

    foreach ($postdata as $k => $v) 
        $postdata_str .= urlencode($k) .'='. urlencode($v) .'&'; 

    foreach ($cookie as $k => $v) 
        $cookie_str .= urlencode($k) .'='. urlencode($v) .'; '; 

    $crlf = "\r\n"; 
    $req = $verb .' '. $uri . $getdata_str .' HTTP/1.1' . $crlf; 
    $req .= 'Host: '. $ip . $crlf; 
    $req .= 'User-Agent: Mozilla/5.0 Firefox/3.6.12' . $crlf; 
    $req .= 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8' . $crlf; 
    $req .= 'Accept-Language: en-us,en;q=0.5' . $crlf; 
    $req .= 'Accept-Encoding: deflate' . $crlf; 
    $req .= 'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7' . $crlf; 
    
    foreach ($custom_headers as $k => $v) 
        $req .= $k .': '. $v . $crlf; 
        
    if (!empty($cookie_str)) 
        $req .= 'Cookie: '. substr($cookie_str, 0, -2) . $crlf; 
        
    if ($verb == 'POST' && !empty($postdata_str)) 
    { 
        $postdata_str = substr($postdata_str, 0, -1); 
        $req .= 'Content-Type: application/x-www-form-urlencoded' . $crlf; 
        $req .= 'Content-Length: '. strlen($postdata_str) . $crlf . $crlf; 
        $req .= $postdata_str; 
    } 
    else $req .= $crlf; 
    
    if ($req_hdr) 
        $ret .= $req; 
    
    if (($fp = @fsockopen($ip, $port, $errno, $errstr)) == false) 
        return "Error $errno: $errstr\n"; 
    
    stream_set_timeout($fp, 0, $timeout * 1000); 
    
    fputs($fp, $req); 
    while ($line = fgets($fp)) $ret .= $line; 
    fclose($fp); 
    
    if (!$res_hdr) 
        $ret = substr($ret, strpos($ret, "\r\n\r\n") + 4); 
    
    return $ret; 
} 



function md5_decrypt($enc_text, $password, $iv_len = 16)
{
    $enc_text = base64_decode($enc_text);
    $n = strlen($enc_text);
    $i = $iv_len;
    $plain_text = '';
    $iv = substr($password ^ substr($enc_text, 0, $iv_len), 0, 512);
    while ($i < $n) {
        $block = substr($enc_text, $i, 16);
        $plain_text .= $block ^ pack('H*', md5($iv));
        $iv = substr($block . $iv, 0, 512) ^ $password;
        $i += 16;
    }
    return preg_replace('/\\x13\\x00*$/', '', $plain_text);
}


function activate_magpie($unlock_code,$key,$value) {

	$encodedfiles=array(
	'pages/import_encoded.php'
	);
	
	foreach ($encodedfiles as $v) {
		
		$filename_in=MAGPIE_INCLUDE_PATH.$v;
		$h=fopen($filename_in,"r");
		if ($h) {
				$content=fread($h,filesize($filename_in));
				fclose($h);
				$content=md5_decrypt($content, $unlock_code);
				unlink($filename_in);
			
				
				$filename_out=MAGPIE_INCLUDE_PATH.str_replace("_encoded","",$v);
				$h=fopen($filename_out,"w");
				fwrite ($h,$content);
				fclose($h);
				$keyset=array("key"=>$key,"value"=>$value);
				$keyset=serialize($keyset);
				update_option("magpie_activation_key",$keyset);
				}
		}
		
	}
?>
<div id="magpiewrapper">
<div id="magpie_main">
<div class="infobox">
<div class="wecpi_home_icon" style="position:relative;">
</div>
<br />

<?php

if (isset($_POST['activation_key']) && isset($_POST['activation_email'])) {

	$activation_key = $_POST['activation_key'];
	$activation_email = $_POST['activation_email'];
	$unlock_code=http_request('POST', 'geegood.site', 80, '/magpie/unlock.php', array('api' => 'keyopen'), array('activation_key'=>$activation_key), array('activation_email'=>$activation_email));
	
	if (is_numeric($unlock_code))
	{
		?><h4>MagPie has been activated already.</h4>
		<p>There is no need to re-activate. Please contact <a href="mailto:admin@geegood.com">admin@geegood.com</a> for any inqueries regarding registration.</p>
		<?php	
		
		}
		else if ($unlock_code==="invalid")
		{?>
			<h4>Sorry, the returned unlock code is not valid.</h4>
			<p>Should there be an error in the registration process because the Internet connection is down or similar, please contact <a href="mailto:admin@geegood.com">admin@geegood.com</a>.</p>
			
			<?php
			}
			else {
				activate_magpie($unlock_code,$activation_key,$activation_email);
			?>	<h4>MagPie is unlocked</h4>
			<p><a href="<?php echo MAGPIE_PAGE_URL;?>">Click here to enter MagPie.</a></p>
			<?php
			}

} else {
?>
<h4>Activation of <?php echo MAGPIE_NAME;?></h4>

		<form name='magpieform' enctype='multipart/form-data' id='magpieform' method='post' action='<?php echo MAGPIE_PAGE_URL; ?>' class='magpieform'>
		<table>
		<tr><td>Activation Key:</td><td><input  size="64" type="text" name="activation_key" /></td></tr>
		<tr><td>Purchase Email:</td><td><input  size="64" type="text" name="activation_email" /></td></tr>
		<tr><td colspan="2">
		<input type="submit" class="button"/>
		</td></tr>
		<tr><td colspan="2">
		After submitting, MagPie Activation will verify your Activation Key and when success, will open <?php echo MAGPIE_NAME;?>.
		</td></tr>
		</table>
		</form>
<?php
}
?>
</div>		
</div>	
</div>				
				
