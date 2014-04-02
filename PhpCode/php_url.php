<?php


	/*
	 * PHP url处理
	 * Author:shuai zou <zoushuai518@126.com>
	 * ID:php_url.php 2013-09-05
	 */

//例举一个URL格式的字符串:
$str = 'http://test.com/testdir/index.php?param1=10&param2=20&param3=30&param4=40&param5=50&param6=60';

echo '<pre>';
//1.0 用parse_url解析URL,此处是$str
$arr = parse_url($str);
var_dump($arr);


//2.0 将URL中的参数取出来放到数组里
$arr_query = convertUrlQuery($arr['query']);
var_dump($arr_query);


//3.0 将 参数数组 再变回 字符串形式的参数格式
var_dump(getUrlQuery($arr_query));


/** 
 * Returns the url query as associative array 
 * 
 * @param    string    query 
 * @return    array    params 
 */ 
function convertUrlQuery($query)
{ 
    $queryParts = explode('&', $query); 
    
    $params = array(); 
    foreach ($queryParts as $param) 
	{ 
        $item = explode('=', $param); 
        $params[$item[0]] = $item[1]; 
    } 
    
    return $params; 
}

function getUrlQuery($array_query)
{
	$tmp = array();
	foreach($array_query as $k=>$param)
	{
		$tmp[] = $k.'='.$param;
	}
	$params = implode('&',$tmp);
	return $params;
}