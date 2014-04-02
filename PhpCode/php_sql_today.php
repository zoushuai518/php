<?php

	// 从数据中 取出 当天的记录

	$todaytime = strtotime(date('Y-m-d',time()));
	$tomorrow = strtotime(date('Y-m-d',strtotime('+1 day')));

	$sql = "select prize_name from ".DB::table('bean_lottery')." where lottery_type = 'zajindan' and prize_name='".$prizeName."' and email = '".$email."' and '".$todaytime."' < create_time < '".$tomorrow."'";

?>