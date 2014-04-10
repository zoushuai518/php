<?php
	#zs
	#php 程序模拟 HTTP请求,也可以请求资源；浏览器提示要下载的 PHP也可以 echo出来。即:提示下载只是浏览器的行为
	function curlfunc($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$output =curl_exec($ch);
		return $output;
	}
?>
