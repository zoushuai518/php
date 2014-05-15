<?php

//也可以在同一个文件中定义多个命名空间。在同一个文件中定义多个命名空间有两种语法形式

//##不建议使用这种语法在单个文件中定义多个命名空间
/*
namespace OneNamespace;

class OneNamespace
{

	function __construct()
	{
		// code...
	}

	public function oneCTest()
	{
		echo 'this is one namespace for class';
	}
}

function oneFTest()
{
	echo 'this is one namespace for function';
}

$test_onenamespace_object = new \OneNamespace\OneNamespace;
echo $test_onenamespace_object->OneCTest();
echo '<br />';
echo oneFTest();
echo '<br />';



//###
namespace TwoNamespace;

class TwoNamespace
{

	function __construct()
	{
		// code...
	}

	public function twoCTest()
	{
		echo 'this is two namespace for class';
	}
}


function twoFTest()
{
	echo 'this is two namespace for function';
}

echo '<br /> ^_^ <br />';
$test_twonamespace_object = new \TwoNamespace\TwoNamespace;
echo $test_twonamespace_object->twoCTest();
echo '<br />';
echo twoFTest();
echo '<br />';
*/



//##建议使用下面的大括号形式的语法

namespace OneNamespace{

	class OneNamespace
	{

		function __construct()
		{
			// code...
		}

		public function oneCTest()
		{
			echo 'this is one namespace for class';
		}
	}

	function oneFTest()
	{
		echo 'this is one namespace for function';
	}


	$test_onenamespace_object = new \OneNamespace\OneNamespace;
	echo $test_onenamespace_object->OneCTest();
	echo '<br />';
	echo oneFTest();
	echo '<br />';
}



//###
namespace TwoNamespace{

	class TwoNamespace
	{

		function __construct()
		{
			// code...
		}

		public function twoCTest()
		{
			echo 'this is two namespace for class';
		}
	}


	function twoFTest()
	{
		echo 'this is two namespace for function';
	}


	echo '<br /> ^_^ <br />';
	$test_twonamespace_object = new \TwoNamespace\TwoNamespace;
	echo $test_twonamespace_object->twoCTest();
	echo '<br />';
	echo twoFTest();
	echo '<br />';
}


//Example #3 定义多个命名空间和不包含在命名空间中的代码
/*

declare(encoding='UTF-8');
namespace MyProject {

	const CONNECT_OK = 1;
	class Connection { // code ... }
		function connect() { // code ...  }
}

namespace { // 全局代码
	session_start();
	$a = MyProject\connect();
	echo MyProject\Connection::start();
}

*/

?>
