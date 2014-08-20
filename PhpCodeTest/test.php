<?php

echo '<pre>';
//echo file_get_contents('http://cart.b5m.com/protected/runtime/debug_cart.2014-08-04.log');



$thisz = 'text'; // error
//$this = 'text'; // error
$name = 'thisz';
//$name = 'this';
//$$name = 'text1'; // sets $this to 'text'
echo $$name;
die;




	function start(){//程序运行开始
		$StartTime = 0;//程序运行开始时间
		$StartTime = microtime(true);
		return $StartTime;
	}
	function stop(){//程序运行结束
		$StopTime = 0;//程序运行结束时间
		$StopTime = microtime(true);
		return $StopTime;
	}
	function spent($StartTime, $StopTime){//程序运行花费的时间	
		$TimeSpent = 0;//程序运行花费时间
		$TimeSpent = $StopTime - $StartTime;
		echo number_format($TimeSpent*1000, 4).'毫秒'; //返回获取到的程序运行时间差

	}

	$StartTime = start();


// getenv
//phpinfo();
//if(!defined('TEST_GETENV')) define('TEST_GETENV', 1);
//echo TEST_GETENV;die;
//var_dump(getenv('REMOTE_ADDR'));
//var_dump(getenv(TEST_GETENV));
//die;


// cookie
//setcookie('zs_cart', '333333', time() + 60 * 60 * 24 * 30, './', '.b5m.com');		  //有限期1个月,  ./ ie浏览器设置cookie失败
//setcookie('zs_cart', 'q0000', time() + 60 * 60 * 24 * 30, './', '.b5m.com');		  //有限期1个月
//setcookie('show_name', '2222', time() + 60 * 60 * 24 * 30, '/', '.b5m.com');		  //有限期1个月
//print_r($_COOKIE);
//die;


//echo date('Y-m-d h:i:s', 1406215279);
//die;

$url_param = urlencode('ipLevel_1#_#memLevel_2#_#annualFlag_3#_#memberFlag_4#_#vipFlag_5#_#user_id#_#expireTime#_#timestamp');
echo $url_param;
echo '<br />';
$test_explore = 'qqqqqq-sssss';
echo '<pre>';
print_r(explode('-', $test_explore));
echo '<br />';
echo $test_explore;

// $t2= '84d53feceabc815a809aee877f92d820';
$t1 = md5(md5('ca1029d20b6740c2be097693059a78c2DG20140703371389c21b5m_new_daigou'));
var_dump($t1);

//echo date('Y-m-d H:i:s', time()).'<br />';
echo strtotime('2014-07-10 00:00:00').'<br />';
//echo strtotime('2014-07-04 00:00:00').'<br />';
// b5m cart pay test



// 返回字符串的长度
echo strlen(1000);
echo '<br />';
echo strlen('ab12b');
echo '<br />';
echo strlen('你好啊');
echo '<br />';


//变量类型判断
var_dump(is_integer(12));
echo '<br />';

echo mt_rand(1, 3);
echo '<br />';

echo '<pre>';
print_r($_SERVER);


echo '<br />';
function test()
{
	$count = 100000;
	$str = '';
	for ($i = 0; $i < $count; $i++) {
		$str .= $i.'<br />';
	}
	echo $str;
}
//echo test();
echo '<br />';

// cms-admin weiyan密码
echo substr(md5('weiyan'),0,10);
echo '<br />';

echo md5('caidan_fuhua');
echo '<br />';

echo '<pre>';
print_r($_SERVER);
echo '<br />';

// 科学计数法
//$test_num = -2.15251376055367e-06;
//$test_num = 2.15251376055367e+06;
//$test_num = 1.2313223123423E+017;
$test_num = -8.28918463219633e-08;
$test_num_format = str_ireplace(array('e-', '-'), array('e+', ''), $test_num);
echo number_format($test_num_format, 0, '', '');
//echo number_format($test_num);
echo '<br />';


$mem_dajiang_array = array('name' => '5Q币');
echo str_ireplace(array('5Q币', '10Q币'), 'Q币', $mem_dajiang_array['name']);
echo '<br />';


//##################
// php关联数组,冒泡排序|键值已经变更,需要修改次程序
echo '<br />';
$arr= array(
	'yhd' => 23,
	'tmall' => 10,
	'jd' => 123,
	'yixun' => 5,
	'taobao' => 1,
	'vip' => 1,
);

//$arr = array('a'=>123, 'b'=>4444, 'c'=>11, 'd'=>132, 'e'=>555);

function bubbleSort($arr = array(), $sort = 'ASC')
{
	foreach($arr as $k) {
		$k1 = '';
		$k2 = '';
		foreach($arr as $k => $v)
		{
			$k2 = $k;
			if(isset($arr[$k1]) && isset($arr[$k2])) {
				if($arr[$k1]>$arr[$k2]) {
					$tmp = $arr[$k1];
					$arr[$k1] = $arr[$k2];
					$arr[$k2] = $tmp;
				}
			}
			$k1 = $k;
		}
	}

	return $arr;
}

$arr = bubbleSort($arr);
print_r($arr);


// oschina
// php索引数组冒泡排序函数
echo '<br />';
function bubble_sort(&$array) {
	$is_ordered = true; // 认为默认是有序的
	$array_length = count($array);
	$temp = 0;

	// 进行数组排序
	for ($i = 0; $i < $array_length - 1; $i++) {
		for ($j = 0; $j < $array_length - 1 - $i; $j++) {
			if ($array[$j] > $array[$j + 1]) {
				$temp = $array[$j];
				$array[$j] = $array[$j + 1];
				$array[$j + 1] = $temp;

				$is_ordered = false; // 数组是无序的
			}
		}

		// 判断是否可以结束数组的排序
		if (!$is_ordered) {
			$is_ordered = true; // 再次认为数组是有序的
		} else {
			break; // 此时数组是有序的，无需继续循环，跳出外层for循环。
		}
	}
}

// 数组打印函数
function print_array($array) {
	foreach ($array as $key => $value) {
		echo "\$array[$key] = $value <br />";
	}
}

// 初始化数组
$array = array(1, -1, 3, 3, 2, 9, -10, 7, 6, 5);

// 调用函数
bubble_sort($array);
print_array($array);
//##################

$StopTime = stop();
spent($StartTime, $StopTime);
?>
