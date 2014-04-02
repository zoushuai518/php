<?php


// test  data

$str = "1,2,3,";
$strEnd = ",";
function trimEnd($str,$strEnd)
{
    return substr($str,-(strlen($strEnd)))==$strEnd?substr($str,0,strlen($str)-strlen($strEnd)):$str;
}

echo trimEnd($str,$strEnd);

?>