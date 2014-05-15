<?php

namespace ClassNamespace;

/**
 *
 **/
class ClassNamespace
{

	function __construct()
	{
		// code...
	}

	public function singleClassTest()
	{
		echo 'this is single class namespace';
	}
}


//$test_namespace_object = new \ClassNamespace;
//$test_namespace_object = new ClassNamespace\ClassNamespace;
$test_namespace_object = new \ClassNamespace\ClassNamespace;
echo $test_namespace_object->singleClassTest();


?>
