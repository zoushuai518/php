<?php 
/********
	判断输入是否是纯数字，英文，汉字等


利用php的mb_strlen和strlen函数就可以轻松得知字符串的构成
	是全英文、英汉混合、还是纯汉字。简要说明如下（以上示例程序）
	1、如果strlen返回的字符长度和mb_strlen以当前编码计算的长度一
	致，可以判断是纯英文字符串。
	2、如果strlen返回的字符长度和mb_strlen以当前编码计算的长度不一致，
	且strlen返回值同mb_strlen的返回值求余后得0可以判断为是全汉字的字符串。
	3、如果strlen返回的字符长度和mb_strlen以当前编码计算的长度不一致，
	且strlen返回值同mb_strlen的返回值求余后不为0，可以判断为是英汉混合的字符串。
* 
* ****************/
$str = "456abc"; 
$x = mb_strlen($str,'gb2312'); 
$y = strlen($str); echo "------456abc----<br>"; 
echo "$x".'<br />'; 
echo "$y".'<br />'; 
$str = "456我是中国人abc<br />"; 
$x = mb_strlen($str,'gb2312'); 
$y = strlen($str); 
echo "------456我是中国人abc----<br />"; 
echo "$x".'<br />'; echo "$y".'<br />'; 
$str = "我是中国人我爱祖国"; 
$x = mb_strlen($str,'gb2312'); 
$y = strlen($str); 
echo "------我是中国人我爱祖国----<br />"; echo "$x".'<br />'; 
echo "$y".'<br />'; $str = "我";
$x = mb_strlen($str,'gb2312'); 
$y = strlen($str); 
echo "------我----<br />"; echo "$x".'<br />'; 
echo "$y".'<br />'; 
$str = "我ab"; 
$x = mb_strlen($str,'gb2312'); 
$y = strlen($str); 
echo "------我ab----<br />"; echo "$x".'<br />'; echo "$y".'<br />'; 


?>