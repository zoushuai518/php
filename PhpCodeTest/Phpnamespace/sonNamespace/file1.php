<?php

//Example #1 声明分层次的单个命名空间
//namespace MyProject\Sub\Level;

//const CONNECT_OK = 1;
//class Connection { /* ... */ }
//function connect() { /* ... */  }

//上面的例子创建了常量MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection和函数 MyProject\Sub\Level\Connection


#==
namespace parent\son;

/**
 *
 **/
class SonNamespace
{

	function __construct()
	{
		// code...
	}

	public function sonCFunTest()
	{
		echo 'this is son namespace function for class';
	}
}


function sonFunTest()
{
	echo 'this is son namespace function';
}

echo sonFunTest();
echo '<br />';

//$test_namespace_object = new \parent\son;
//$test_namespace_object = new parent\son\SonNamespace;
$test_namespace_object = new \parent\son\SonNamespace;
echo $test_namespace_object->sonCFunTest();


?>
