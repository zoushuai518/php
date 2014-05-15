<?php

namespace ClassNamespace;

/**
 *
 **/
class ClassOneNamespace
{

	function __construct()
	{
		// code...
	}

	public function multipleClassOneTest()
	{
		echo 'this is multiple class one namespace';
	}
}


/**
 *
 **/
class ClassTwoNamespace
{

	function __construct()
	{
		// code...
	}

	public function multipleClassTwoTest()
	{
		echo 'this is multiple class two namespace';
	}
}

//$test_namespace_object = new \ClassNamespace;
//$test_namespace_object = new ClassNamespace\ClassNamespace;
$test_namespace_object = new \ClassNamespace\ClassOneNamespace;
echo $test_namespace_object->multipleClassOneTest();
echo '<br />';

$test_namespace_object = new \ClassNamespace\ClassTwoNamespace;
echo $test_namespace_object->multipleClassTwoTest();


?>
