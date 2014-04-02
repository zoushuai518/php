<?php 


	/*
	 * PHP file down
	 * Author:shuai zou <zoushuai518@126.com>
	 * ID:php_downfile.php 2013-09-05
	 */

	/*Example 1 for 思路1*/
	function downfile1(){
		$filename=realpath("test.txt"); //文件名
		$date=date("Ymd-H:i:m");
		Header( "Content-type: application/octet-stream "); 
		Header( "Accept-Ranges: bytes "); 
		Header( "Accept-Length: " .filesize($filename));
		header( "Content-Disposition: attachment; filename= {$date}.txt"); 
		// echo file_get_contents($filename);
		readfile($filename); 
	}
	// downfile1();
	
	// echo realpath('./php_singleton.php');


	/*Example 2 for 思路1*/
	//下载文件保存到本地
	//www.jbxue.com
	function downfile2($fileurl){
		ob_start(); 
		$filename=$fileurl;
		$date=date("Ymd-H:i:m");
		header( "Content-type: application/octet-stream "); 
		header( "Accept-Ranges: bytes "); 
		header( "Content-Disposition: attachment; filename= {$date}.doc"); 
		$size=readfile($filename); 
		header( "Accept-Length: " .$size);
	}
	// $url="url地址";
	$url="www.baidu.com";
	// downfile2($url);



	/*Example 3 for 思路2*/
	//下载文件保存至本地
	//www.jbxue.com
	function downfile3($fileurl){
		$filename=$fileurl;
		$file = fopen($filename, "rb"); 
		Header( "Content-type: application/octet-stream "); 
		Header( "Accept-Ranges: bytes "); 
		Header( "Content-Disposition: attachment; filename= 4.doc"); 
		$contents = "";
		while (!feof($file)) {
		$contents .= fread($file, 8192);
		}
		echo $contents;
		fclose($file); 
	}
	$url="test.txt";
	// downfile3($url);


?>