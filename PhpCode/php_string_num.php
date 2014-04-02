<?php


	/*
	 * PHP 字符串 与 数字 比较
	 * Author:shuai zou <zoushuai518@126.com>
	 * ID:php_string_num.php 2013-09-05
	 */

	/*PHP中的比较运算符有点诡异，很容易出错，现列出比较规则：

	1、当两个字符进行大小比较时，是比较着这两个字符的ASCII码大小——这条很容易理解。

	2、当两个字符串进行大小比较时，是从第一个字符开始，分别比教对应的ASCII大小，只要从从某个对应位置开始，其中一个字符串的当前位置字符大于另一个字符串对应位置字符，即直接判别出这两个字符串大小，如'ba'>'az'——这条其实大家也都知道的。

	那么'10'与'a'比较呢，当然还是一样的啦，首先将'1'和'a'ASCII码进行比较，'a'大。

	3、当一个数字与一个字符串/字符进行大小比较时，首先系统尝试将此字符串/字符转换为整型/浮点型，然后进行比较，如'12bsd'转型为12，'a'转型为0，千万需要注意的是此时不是将其对应的ASCII码值与数字进行大小比较了。

	其实同样的道理，'a'+10结果也是10。

	并且容易忽略的：0 与任意不可转化为数字的字符串比较(操作符为==), 均返回 true。

	最后就会出现如下结果：*/

	var_dump('1000000'<'a');    //result: boolean true
	var_dump('a'<1);            //result: boolean true
	var_dump(1<'1000000');      //result: boolean true


	echo '<br>';

	//==============

	$a = '511203199106034578';
	$b = '511203199106034579';
	if ($a==$b) {
	echo 'equal';
	} else {
	echo 'notEqual'; 
	}

	echo '<br>';

	$a = '5112';
	$b = '5113';
	if ($a==$b) {
	echo 'equal';
	} else {
	echo 'notEqual'; 
	}

	//----
	echo '<br>';

	/*数字与字符串比较时, 先尝试将字符串转换为数字, 再比较, 一个不能转换为数字的字符串, 转换结果为0, 故, 与0比较总返回 true
	-+
	0 与任意非数字(或者说,不可转化为数字的字符)前导的字符串比较(操作符为==), 均返回 true.

	原因是, 数字与字符串比较时, 先尝试将字符串转换为数字, 再比较, 一个不能转换为数字的字符串, 转换结果为0, 故, 与0比较总返回 true.

	更加详细的比较规则, 多种类型的比较规则, 在 [PHP手册/语言参考/运算符/比较运算符] 可以找到.

	在PHP里当两个数字型字符串(只含数字的字符串)进行比较的时候是直接转换成数值进行比较的
	如下示例:(注意$a和$b两个变量的最后一位不相等) */

	//示例1
	$a = '511203199106034578';
	$b = '511203199106034579';
	if ($a==$b) {
	echo 'equal';
	} else {
	echo 'notEqual';
	}
	// 运行上面的程序却发现结果为equal(非我们认为的结果) 

	// 我们把$a与$b分别加一个字母a进去
	//示例2 
	$a = 'a511203199106034578'; 
	$b = 'a511203199106034579'; 
	if ($a==$b) { 
	echo 'equal'; 
	} else { 
	echo 'notEqual'; 
	} 
	// 这次输出的是notEqual(正确的结果) 
	// -+
	// 示例1为equal是因为PHP把两个数字型字符串转换成数字型,而这两个数字刚好相等如下示例 
	$a = 511203199106034578; 
	$b = 511203199106034579; 
	echo $a; // 输出 5.1120319910603E+17 即511203199106030000 
	echo $b; // 输出 5.1120319910603E+17 即511203199106030000 

	// 所以我们在示例1中得到的结果是equal 

	// 避免出现这种非预期结果的情况是使用类型比较符===如下示例(如果 $a 等于 $b，并且它们的类型也相同) 
	//示例4 
	$a = '511203199106034578'; 
	$b = '511203199106034579'; 
	if ($a===$b) { 
	echo 'equal'; 
	} else { 
	echo 'notEqual'; 
	} 

	// 这样我们就可以得到预期中的notEqual了

?>