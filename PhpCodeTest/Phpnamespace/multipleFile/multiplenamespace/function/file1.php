<?php

namespace FooOne;
function bar()
{
	echo 'this is php namespace test';
}
const MYCONST = 1;
define(__NAMESPACE__ .'\foo','111');
define('foo','222');

//###
//namespace foo2;
namespace FooTwo;
function namespaceSingleFunctionTest()
{
	echo 'this is php namespace2 SingleFunctionTest';
}
const MYCONST = 2;

//###


?>
