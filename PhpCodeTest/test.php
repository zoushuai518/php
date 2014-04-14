<?php

	error_reporting(0);

	header("Content-type:text/html;charset=utf-8");

	echo '<br>^_^ echo ^_^<br>';
	$str1 = 'This ';
	$str2 = 'is zoushuai';
	echo $str1,$str2;
	echo '<br>^_^ ^_^<br>';

	echo '^_^ strtotime ^_^<br>';
	echo strtotime("2009-10-21 16:00:10");
	echo '<br>';
	echo strtotime('20091021160010');
	echo '<br>';
	echo $tomorrow = date('Y-m-d',strtotime('+1 day'));
	echo '<br>';
 	$time = strtotime(date('Y-m-d',strtotime('-1 day')))+60*60*9+1800;
	echo date('Y-m-d H:i:s',$time);
	echo '<br>';
 	echo date('Y-m-d H:i:s',strtotime('-1 day'));
	echo '<br>^_^ ^_^<br>';

	// echo mktime();


	echo '<br>^_^ strpos_substr ^_^<br>';
	$str = '网上购物>钟表饰品>时尚饰品';
	echo strpos($str,'>').'<br>';
	var_dump(strpos($str,'|')).'<br>';
	echo substr($str,0,strpos($str,'>')).'<br>';
	echo trim(substr($str,0,-(strpos($str,'>'))),'>').'<br>';
	echo '<br>^_^ ^_^<br>';

	echo '<br>^_^ htmlspecialchars ^_^<br>';

	echo htmlspecialchars(strip_tags(str_ireplace(array(',','#','i'),'','http://s.b5m.com/search/s/___image________________你好  , 我好 # i.html')));
	echo str_ireplace(array('#',',','%'),array('1','2','3'),'#,%^&*(');

	echo '<br>^_^ ^_^<br>';


	echo '<br>^_^ 帮豆充值 ^_^<br>';
	/*
	$str_json = array('orderId'=>'zdm_111','userId'=>'1b4b59d15f824e0f93665c9ca049e151','amount'=>2,'eventName'=>'zdm_commmit','eventId'=>1,'type'=>2,'memo'=>'值得买评论从帮豆');
	echo json_encode($str_json);
	*/

	echo 'http://10.10.99.162:8281/b5m-payment-service/b5m-coin/recharge.htm?orderId=zdm_111&userId=1b4b59d15f824e0f93665c9ca049e151&amount=2&eventName=zdm_commmit&eventId=1&type=2&memo=值得买评论从帮豆';

	echo '<br>^_^ ^_^<br>';


	echo '<br>^_^ date ^_^<br>';
	// echo date('Y年m月d日 H时i分s秒',time());
	echo '|<br />';
	echo date('Y年m月d日 H时i分s秒',1389244283);
	echo '<br />|';
	echo '<br />';
	echo date('d日',time());
	echo '<br />';
	var_dump(date('j',time()));

	echo '<br>^_^  ^_^<br>';


	echo '<br>^_^ strtotime - SQL语句按照天数判断 - ^_^<br>';
	// 不要使用 mysql函数，mysql函数 回事 程序执行效率呈倍数 下降！
	echo $d = date('Y-m-d',time());
	$d_t = strtotime($d);
	echo '<br />';
	// echo date('j',strtotime('2013-11-11'));
	echo date('j',strtotime(date('Y-m-d',time())));
	echo '<br />';
	echo date('j',strtotime("{$d} +1 days"));
	echo '<br />';
	echo $sql = "select * from test where create_time < $d_t";  // 取出记录创建日期小于当天的。
	echo '<br>^_^ ^_^<br>';


	echo '<br>^_^ $_GET && $_POST - ^_^<br>';
	var_dump($_GET);
	echo '<br />';
	var_dump($_POST);
	echo '<br>^_^ ^_^<br>';


	echo '<br>^_^ rand - ^_^<br>';
	echo rand(5,10);
	echo '<br>^_^ ^_^<br>';

	echo '<br>^_^ array_rand - ^_^<br>';
	$beanPoll_f = array(5,10,30);
    //array_rand($beanPoll_f);
    //print_r(array_rand($beanPoll_f));
    echo '<br />';
    print_r($beanPoll_f[array_rand($beanPoll_f)]);
    echo '<br>^_^ ^_^<br>';


	// 方法调用  test

	test();

	function test(){

		echo 'zs';

	}
	// 方法调用  test


	echo '<br>^_^ foreach ^_^<br>';

	// $test_data_s = array(array('r'=>'q','s'=>1),array('r'=>'w','s'=>2),array('r'=>'e','s'=>6),array('r'=>'r','s'=>369));
	// $test_data = array(1,3,5,7,9,369);
	$test_data = array(
		array('name'=>'iPhone5s土豪金','type'=>'phone','number'=>1,'probability'=>'0.01','consume_bean'=>6000000),
		array('name'=>'100元话费','type'=>'huafei','number'=>8,'probability'=>'0.05','consume_bean'=>12000),
		array('name'=>'50Q币','type'=>'qq','number'=>2,'probability'=>'0.1','consume_bean'=>6000),
		array('name'=>'1000帮豆','type'=>'dou','number'=>6,'probability'=>'5','consume_bean'=>1200),
		array('name'=>'200帮豆','type'=>'dou','number'=>4,'probability'=>'20','consume_bean'=>240),
		array('name'=>'100帮豆','type'=>'dou','number'=>3,'probability'=>'50','consume_bean'=>120),
		array('name'=>'再来一次','type'=>'noprize','number'=>5,'probability'=>'4.84','consume_bean'=>0),
		array('name'=>'50帮豆','type'=>'dou','number'=>7,'probability'=>'20','consume_bean'=>60),
	);
	foreach ($test_data as $k_p => $v_p) {
		foreach ($test_data as $key => $value) {
			if($key==0){

				$max = $value['consume_bean'];
			}else{
				$max = max($max,$value['consume_bean']);
			}
		}
		/*if($v_p['consume_bean']==$max){
			$max_arr = $v_p['consume_bean'];
		}*/
	}
	
	print_r($max);
	echo '<br>';
	// print_r($max_arr);


	$test_arr =  array('q'=>1,'w'=>2);
	print_r($test_arr['qq']).'<br>';

	if($test_arr['qq']!=0){
	// if($test_arr['qq']!==0){
	// if(isset($test_arr['qq'])){
		echo 'true';
	}else{

		echo 'false';
	}


	echo '<br>^_^ isset ^_^<br>';
	$testArr['test'] = $b;
	var_dump($testArr);
	echo '<br>';


	echo '<br>^_^ PHP获取本周本月第一天、最后一天时间戳的代码 ^_^<br>';

	// 获取本周第一天/最后一天的时间戳
	function getWeek(){

		$year = date("Y");
		$month = date("m");
		$day = date('w');
		$nowMonthDay = date("t");

		$firstday = date('d') - $day;
		if(substr($firstday,0,1) == "-"){
			$firstMonth = $month - 1;
			$lastMonthDay = date("t",$firstMonth);
			$firstday = $lastMonthDay - substr($firstday,1);
			// $time_1 = strtotime($year."-".$firstMonth."-".$firstday);
			$time_1 = $year."-".$firstMonth."-".$firstday;
		}else{
		  	// $time_1 = strtotime($year."-".$month."-".$firstday);
		  	$time_1 = $year."-".$month."-".$firstday;
		}
		   
		$lastday = date('d') + (7 - $day);
		if($lastday > $nowMonthDay){
			$lastday = $lastday - $nowMonthDay;
			$lastMonth = $month + 1;
			// $time_2 = strtotime($year."-".$lastMonth."-".$lastday);
			$time_2 = $year."-".$lastMonth."-".$lastday;
		}else{
			// $time_2 = strtotime($year."-".$month."-".$lastday);
			$time_2 = $year."-".$month."-".$lastday;
		}

		return $data = array('first'=>$time_1,'end'=>$time_2);
	}

	echo '<pre>';
	print_r(getWeek());
	echo '<br />';

	 
	// 获取本月第一天/最后一天的时间戳
	function getMonth(){
		$year = date("Y");
		$month = date("m");
		$allday = date("t");
		// $strat_time = strtotime($year."-".$month."-1");
		$strat_time = $year."-".$month."-1";
		// $end_time = strtotime($year."-".$month."-".$allday);
		$end_time = $year."-".$month."-".$allday;
		return $data = array('first'=>$strat_time,'end'=>$end_time);
	}

	print_r(getMonth());
	echo '<br />';



	$ksort = array(
		140=> array(0=>1274,1=>1275,2=> 1276),
		136 => array(0=>1262,1=>1263,2 =>1264),
		137 => array(0=> 1268,1=>1269),
	);

	$ksort_s = array(23=>2,25=>3,10=>3);

	echo '<pre>';
	ksort($ksort_s);
	print_r($ksort);


	echo '<br>^_^ 去除HTML标签 ^_^<br>';
	$html_str = <<<EOT
	<div>
		<url>
			<li style="color:red">
				hello 我要去除html;
			</li>
		</url>
	</div>
EOT;
	echo strip_tags($html_str);

	echo '<br>^_^ <<<EOT 中使用PHP函数 ^_^<br>';
	$time_eot = date('Y-m-d',strtotime('+1 day'));
	$php_function = <<<EOT
	<div>
		<url>
			<li style="color:red">
				{$time_eot};
				$time_eot;
			</li>
		</url>
	</div>
EOT;
	echo $php_function;
	

?>