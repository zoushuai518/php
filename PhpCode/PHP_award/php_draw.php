<?php



	/**
 * 最大支持0.001%，即10万分之1的概率
 * 根据设定的概率给玩家一个奖励,奖励完全按照百分比来,如果存在所有奖励概率加起来不足100%的制造一个空奖励给前端显示没有抽中奖励
 * 规则如下:
 * 奖励名称   抽中概率,抽中的范围
 * A          20%    1     -  20000
 * B          20%    20001 -  40000
 * C          10%    40001 -  50000
 * D          10%    50001 -  60000
 * E          0.001% 60001 -  60002
 * 空奖      39.999% 60003 -  100000
 */
function get_award(){

	/*
	// test 抽奖
	// 声明空数组
 	$rs = array();
	$rs[] = array('name'=>'A','probability'=>'20');
	$rs[] = array('name'=>'B','probability'=>'20');
	$rs[] = array('name'=>'C','probability'=>'10');
	$rs[] = array('name'=>'D','probability'=>'10');
 	$rs[] = array('name'=>'E','probability'=>'0.001');
 	*/

 	// B5M 抽奖
 	/**
 	 *	纪念版T恤 5%     7
	 *	5元话费 0%       2,8
	 *	小米3 0%         1
	 *	50元话费 0%      4
	 *	谢谢参与 47.50%  3
	 *	10元话费 0%      6
	 *	再来一次 47.50%  5 
 	 */
 	$rs = array();
 	$rs[] = array('name'=>'3','probability'=>'47.50');
 	$rs[] = array('name'=>'5','probability'=>'47.50');
 	$rs[] = array('name'=>'7','probability'=>'5');


 	// 声明每个奖品的概率
 	$probability = 0;
 	$award = array();

	foreach ($rs as $v){
		$probability += $v['probability']*1000;
		$award[] = array('name' => $v['name'],'num'=>$probability);
	}

 	//当所有奖品的概率加起来不足100时,制造一个空奖让前端显示没有得奖
 	if($probability < 100000){
  		$award[] = array('name' => 'not prize','num'=>100000);
 	}

 	//返回给客户端的奖品名称
 	$return = '';
 	// 1，100000取随机数
 	$rand = rand(1,100000);
 
	foreach ($award as $key => $val){
		if(isset($award[$key - 1])){
			if($rand > $award[$key -1]['num'] && $rand <= $val['num']){
				$return = $val['name'];
				break;
			}
	  	}else{
	    	if($rand > 0 && $rand <= $val['num']){
	    		$return = $val['name'];
	    		break;
	    	}
	  	}
	}
	return $return;
}


echo get_award();


?>