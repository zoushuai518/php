<?php

	/*
	 * PHP DOM 操作
	 * Author:shuai zou <zoushuai518@126.com>
	 * ID:php_SimpleXMLElement.php 2013-09-05
	 */

	// Php simplexml 添加节点

	//创建xml对象
	$xml = new SimpleXMLElement('<Messages></Messages>'); 
	   
	   
	for($i=0;$i<10;$i++)
	{
		// $xml->message[$i] = ''; //新节点
		$xml->message[$i]['id'] = "id".$i; 
		$xml->message[$i]->title = "title".$i; 
		$xml->message[$i]->content = "content".$i; 
		$xml->message[$i]->time = "time".$i; //根据消息id 查询它相关的回复信息 
	 }

	$xml->message[0] = "";
	$xml->message[0]->title1="this is new att";

	//$xml->asXML('messages.xml'); 
	//直接输出成xml内容
	// echo '<pre>';
	// echo $xml->asXML();;


	// var_dump($xml->message);



?>