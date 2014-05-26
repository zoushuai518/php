<?php

//http://www.php.net/manual/en/ref.json.php


//首先要记住json_encode返回的是字符串, 而json_decode返回的是对象.

//判断数据不是JSON格式:

function is_not_json($str){
	return is_null(json_decode($str));
}


//判断数据是合法的json数据: (PHP版本大于5.3)

function is_json($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}
//json_last_error()函数返回数据编解码过程中发生的错误.

//注意: json编解码所操作字符串必须是UTF8的.
