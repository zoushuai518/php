<?php
	//类的用法
     // 读取数据库类
	include("inc/mysql.class.php");
	// 读取分页类
	include("inc/pager.class.php");
	// 数据库连接初始化
	$db = new mysql();
	// 这是一个sql查询语句，并得到查询结果
	$sql = "select * from member";
	// 分页初始化
	$page = new pager($sql,20);
	// 20是每页显示的数量
	$result = $db->query($page->sqlquery());
	while($info = $db->fetch_array($result,MYSQL_ASSOC)){
	echo $info["name"]."<br />";
	}
	// 页码索引条
	echo $page->set_page_info();
?>