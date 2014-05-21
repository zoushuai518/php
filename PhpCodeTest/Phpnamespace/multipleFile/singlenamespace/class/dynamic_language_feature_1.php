<?php

error_reporting(E_ALL);

#命名空间和动态语言特征
#http://www.php.net/manual/zh/language.namespaces.dynamic.php

#Example #1 动态访问元素

class classname
{
	function __construct()
	{
		echo __METHOD__,"<br />";
	}
}

function funcname()
{
	    echo __FUNCTION__,"<br />";
}

const constname = "global";

//$a = 'classname';
//$obj = new $a; // prints classname::__construct
//$b = 'funcname';
//$b(); // prints funcname
//echo constant('constname'), "<br />"; // prints global



#必须使用完全限定名称（包括命名空间前缀的类名称）。注意因为在 "动态的类名称、函数名称或常量名称中， 限定名称 和 完全限定名称 没有区别，因此其前导的反斜杠是不必要的"。


?>
