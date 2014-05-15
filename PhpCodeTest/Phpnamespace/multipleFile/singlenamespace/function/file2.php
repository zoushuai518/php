<?php

error_reporting(E_ALL);

require_once('./file1.php');
//use foo;	//namespace快速,别名导入方式
foo\bar();
echo '<br />';
foo\namespaceSingleFunctionTest();

?>
