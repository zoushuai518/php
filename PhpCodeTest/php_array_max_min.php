<?php

//还有什么会比PHP的方法高效?
//最大的
$a=array('1','3','55','99');
$pos = array_search(max($a), $a);
echo $a[$pos];
//最小的
$a=array('1','3','55','99');
$pos = array_search(min($a), $a);
echo $a[$pos];

?>
