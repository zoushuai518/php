<?php


error_reporting( E_ERROR | E_WARNING | E_PARSE );  
set_time_limit(0); 
 
$server  = 'www.cit.cn';   // IP address  
$host    = 'www.cit.cn';   // Domain name  
$target  = '/test.php?x=1';    // Specific program  
$referer = 'http://www.cit.net/down/redirect.php?x=downurl&id=39&urlid=65';    // Referer  
$port    = 80; 
 
$re = fsockopen($server, $port, $errno, $errstr, 30);  
if (!$re){  
   echo "<h1>无法连接远程服务器</h1><h3>$errstr ($errno)</h3/>\n";  
}   
else {  
 $strhead = "GET $target HTTP/1.1\r\n";  
 $strhead .= "Host: $host\r\n";  
 //$strhead .= "Cookie: PHPSESSIONIDSQTBQSDA=DFCAPKLBBFICDAFMHNKIGKEG\r\n";  
 $strhead .= "Referer: $referer\r\n";  
 $strhead .= "Connection: Close\r\n\r\n";
 
 fwrite($re, $strhead);  
 while (!feof($re)){  
  echo fgets($re, 128);  
 }  
 fclose($re);  
}  




?>