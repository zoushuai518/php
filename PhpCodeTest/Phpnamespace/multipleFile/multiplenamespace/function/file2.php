<?php

error_reporting(E_ALL);

require_once('./file1.php');
//use foo;	//namespace快速,别名导入方式

FooOne\bar();
echo '<br />';
echo FooOne\MYCONST;
echo '<br />^_^ define s<br />';
echo foo;  // 111.
echo '<br />';
echo \foo;  // 222.
echo '<br />';
echo \FooOne\foo;  // 111
echo '<br />';
echo FooOne\foo;  // fatal error. assumes \FooOne\FooOne\foo.
echo '<br />^_^ define e<br />';

//###
FooTwo\namespaceSingleFunctionTest();
echo '<br />';
echo FooTwo\MYCONST;

?>
