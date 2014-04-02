<?php 

// http://vtrtbb.iteye.com/blog/607091
/*
PHP计算字符串长度，包括计算英文、GBK、UTF-8多种字符集下PHP如何计算字符串长度。英文字符串长度
strlen()是PHP自带的计算英文字符串的函数。

GBK字符串长度
中文字符计算为2个字符，英文字符计算为1个，可以统计中文字符串长度的函数。
*/
function abslength($str){
	$len=strlen($str);
	$i=0;
while($i<$len)
{
       if(preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/",$str[$i]))
       {
         $i+=2;
       }
       else
       {
         $i+=1;
       }
}
return $i;
} 
$str = "询";
echo abslength($str)."<br />";
/*
UTF8字符串长度
下面定义的strlen_utf8函数可以统计UTF-8字符串的长度，但不同的是，该函数并不考虑字节，这有些类似 Javascript 中字符串的length方法，一个字符全部按 1 个长度计算。 <?php // 说明：计算 UTF-8 字符串长度（忽略字节的方案） 
*/
function strlen_utf8($str) {
	$i = 0;
	$count = 0;
	$len = strlen ($str);
	while ($i < $len) {
		$chr = ord ($str[$i]);
		$count++;
		$i++;
	if($i >= $len) break;
	if($chr & 0x80) {
		$chr <<= 1;
		while ($chr & 0x80) {
			$i++;
			$chr <<= 1;
		}
	}
	}
return $count;
}
$str = "www.phpq.net-PHP资讯";
echo strlen_utf8($str);
?>
