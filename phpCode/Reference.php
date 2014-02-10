<?php

//php 引用传递
//php 引用返回
//php 取消引用
//http://www.php.net/manual/zh/language.references.pass.php

function foo(&$var)
{
	//$var++;
    return $var++;
}

$a=5;
var_dump(foo($a));
echo '<pre>';
echo $a;
	


?>
