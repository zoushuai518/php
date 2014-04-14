<?php
// php mysql 多表插入
/*需注意的是：
The mysql_insert_id() function returns the AUTO_INCREMENT ID generated from the previous INSERT operation.
mysql_insert_id()函数的作用是：取得上一步 INSERT 操作产生的 ID。

This function returns 0 if the previous operation does not generate an AUTO_INCREMENT ID, or FALSE on MySQL connection failure.
如果先前的操作不产生一个自动增加的ID[AUTO_INCREMENT ID]，那么，函数返回0；如果MySQL连接失败，将返回False。*/

$conn = mysql_connect("localhost","charles","charles");
mysql_select_db("test");
$query = "INSERT INTO contact(user_name,nom, prenom, mail, passcode) values('sa','se','sf', 'safd@p.com', '123')";
$result = mysql_query($query) or die("insert contact failed:".mysql_error());
$lastid = mysql_insert_id(); //得到上一个 插入的id值
echo "last insert id :".$lastid."<br>";
$query2 = "INSERT INTO contactdroit(contact_id, droit_id) values('$lastid','11')";
echo $query2."<br>";
$result2 = mysql_query($query2) or die("insert contactdroit failed: ".mysql_error());
if(isset($result) && isset($result2)){
    echo "Good Insertion<br>";
    echo $lastid;
}