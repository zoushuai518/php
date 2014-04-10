<?php
#zs curl 测试

$cookie_jar = tempnam('cookie','cookie1.txt'); 
$url ='http://suggestion.baidu.com/su?wd=%E5%8C%97%E5%8E%9F%E5%A4%8F%E7%BE%8E%20%E4%B9%89%E6%AF%8D&action=opensearch&ie=UTF-8';

curlfunc($url,'',$cookie_jar);

function curlfunc($url,$post_data='',$cookie_jar)
{
	//$post_data = "action=7&CARD_NO1=".$cust_arr["CARD_NO1"]."&CARD_NO2=".$cust_arr["CARD_NO2"]."&CARD_NO3=".$cust_arr["CARD_NO3"]."&CARD_NO4=".$cust_arr["CARD_NO4"]."&page=SWMW13C0&SEARCH_BTN=0&SEIKYUU_ID=";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; CIBA)"; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar ); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);

	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	if(!empty($post_data))curl_setopt($ch, CURLOPT_POST, 1);

	if(!empty($post_data))curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$output =curl_exec($ch);
	wput($output);
	return $output;
}

function wput($con)
{
	$name = "put.txt";
	$handel = fopen($name,"a+");
	fwrite($handel,$con);
	fclose($handel); 
}


?>
