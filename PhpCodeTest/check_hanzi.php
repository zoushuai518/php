<?php 
/*
由于中文的ASCII码是有一定的范围的。所以你可以用下面的正则表达式来表示中文。



中文字符判断是根据字符串编码来的，/^[chr(0xa1)-chr(0xff)]+$这就是判断


/^[chr(0xa1)-chr(0xff)]+$/

下面是一个使用的例子：


纯中文字符检测

*/

header("Content-type: text/html; charset=utf-8");

$str = "超越PHP";
if  (preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/", $str)) {
    echo "这是一个纯中文字符串";
} else {
    echo "这不是一个纯中文字串";
}






/*
if($en_utf8){    

	$joid = preg_replace("[^0-9a-za-z_-|x4e00-x9fa5|:|/|#|.]","",$joid);       //utf-8的中文匹配      

}else{    

	$joid = preg_replace("[^0-9a-za-z_-|".chr(0xa1)."-".chr(0xff)."|:|/|#|.]","",$joid);   //gb2312的中文匹配

}   
*/


// php中来判断字符串是否为中文，就会沿袭这个思路：

/*
$str = "php编程";
if (preg_match("/^[u4e00-u9fa5]+$/",$str)) {
	print("该字符串全部是中文");
} else {
	print("该字符串不全部是中文");
}
*/



?>