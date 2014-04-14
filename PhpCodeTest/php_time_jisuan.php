<?php

	// 取得每天的 12:00 临界时间
	// 取得服务器时间：
	$time_ser = time();
	$time_day_linjie = strtotime(date('Y/m/d').' 12:00:00');
	$tomorrow_day = strtotime(date('Y/m/d',strtotime('+1 day')).' 12:00:00');

	if($time_ser<$time_day_linjie){
		$time = ($time_day_linjie-$time_ser)*1000;
	}else{
		$time = ($tomorrow_day-$time_ser)*1000;
	}


	// 取得每周六的 20:00 临界时间
	// ag：1
	// 取得服务器时间：
	$time_ser = time();
	$time_week_linjie = strtotime(date('Y/m/d').' 20:00:00');
	$tomorrow_week = strtotime(date('Y/m/d',strtotime('+1 day')).' 20:00:00');

	$weekTime = array('Sun'=>0,'Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6);
	// $weekTime = array('Fri'=>0,'Sat'=>1,'Sun'=>2,'Mon'=>3,'Tue'=>4,'Wed'=>5,'Thu'=>6);
	$weekDay = date('D',time());
	$chaDay = (6-$weekTime[$weekDay])*86400;

	if($time_ser<$time_week_linjie){
		$time = (($time_week_linjie-$time_ser)+$chaDay)*1000;
	}else{
		$time = (($tomorrow_week-$time_ser)+$chaDay)*1000;
	}

	// 取得每周六的 20:00 临界时间
	// ag：2
	$time_ser = time();
	$time_week_linjie = strtotime(date('Y/m/d').' 12:00:00');
	$tomorrow_week = strtotime(date('Y/m/d',strtotime('+1 day')).' 12:00:00');

	// $weekTime = array('Sun'=>0,'Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6);
	$weekTime = array('Fri'=>0,'Sat'=>1,'Sun'=>2,'Mon'=>3,'Tue'=>4,'Wed'=>5,'Thu'=>6);
	$weekDay = date('D',time());
	$chaDay = (6-$weekTime[$weekDay])*86400;

	if($time_ser<$time_week_linjie){
		$time = (($time_week_linjie-$time_ser)+$chaDay)*1000;
	}else{
		$chaDay = (6-$weekTime[$weekDay]-1)*86400;
		$time = (($tomorrow_week-$time_ser)+$chaDay)*1000;
	}

	// 取得每周六的 12:00 临界时间
	// ag：3
	// 取得服务器时间：
	$time_ser = time();
	$time_week_linjie = strtotime(date('Y/m/d').' 12:00:00');
	$tomorrow_week = strtotime(date('Y/m/d',strtotime('+1 day')).' 12:00:00');

	// $weekTime = array('Sun'=>0,'Mon'=>1,'Tue'=>2,'Wed'=>3,'Thu'=>4,'Fri'=>5,'Sat'=>6);
	// $weekTime = array('Fri'=>0,'Sat'=>1,'Sun'=>2,'Mon'=>3,'Tue'=>4,'Wed'=>5,'Thu'=>6);
	$weekDay = date('N',time());
	$chaDay = ((4-$weekDay)*86400)<0?(4-$weekDay+7)*86400:(4-$weekDay)*86400;

	if($time_ser<$time_week_linjie){
		$time = (($time_week_linjie-$time_ser)+$chaDay)*1000;
	}else{
		$chaDay = ((4-$weekDay)*86400)<0?(4-$weekDay+6)*86400:(4-$weekDay-1)*86400;
		$time = (($tomorrow_week-$time_ser)+$chaDay)*1000;
	}


?>