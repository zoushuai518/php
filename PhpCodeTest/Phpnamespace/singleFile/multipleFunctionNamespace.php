<?php

namespace TestFunction;

function test()
{
	echo 'This php namespace test';
}

function testOne()
{
	echo 'This php namespace one for two test';
}


test();
echo '<br />';




//###
namespace TestTwoFunction;

function test()
{
	echo 'This php namespace2 test';
}


test();
echo '<br />';


//testOne();
//TestFunction\testOne();
\TestFunction\testOne();
echo '<br />';

//TestTwoFunction\testOne();
//\TestTwoFunction\testOne();




?>
