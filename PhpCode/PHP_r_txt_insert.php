<?php

    
$m = mysql_connect('127.0.0.1','root','') or die("Invalid query: " . mysql_error());
mysql_select_db('discuz', $m) or die("Invalid query: " . mysql_error());
$handle = fopen("aa.txt", "r");
while (!feof($handle)) {
    $buffer =  ($handle);
    $ss[] = explode(' ', $buffer);
}

mysql_query("set names 'utf8'",$m);

foreach($ss as $k => $v){
        //addslashes($v);
        //foreach($v as $k = $value){
        //$vv = addslashes($value);
    //mysql_query("insert into match_view_test_2 (`kanum`, `username`, `mid`, `rank`, `num` ,`zunum` ,`sex` ,`yucolor` ,`eye` ,`backtime` ,`kongju` ,`fengspeed` )
        //values ('123','123', 20111014060110765 ,1,'123','123','123','123','123','123','123','123')") or die("Invalid query: " . mysql_error());
    //}
    $kanum = $v[1];
    $username = $v[2];
    $rank = (int)$v[0];
    $num = $v[3];
    $zunum = $v[4];
    $sex = $v[5];
    //echo $sex;
    $yucolor = $v[6];
    //$eye = $v[7];
    $backtime = $v[8].' '.$v[9];
    $kongju = $v[10];
    $fengspeed = $v[11];
    mysql_query("insert into match_view_test (`kanum`, `username`, `mid`, `rank`, `num` ,`zunum` ,`sex` ,`yucolor` ,`eye` ,`backtime` ,`kongju` ,`fengspeed` )
        VALUES('$kanum','$username', 20111014060110765,$rank,'$num','$zunum','$sex','$yucolor','$eye','$backtime','$kongju','$fengspeed')") or die("Invalid query: " . mysql_error());
}
