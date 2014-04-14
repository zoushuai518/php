<?php



	
		// 模拟切割数据
		$content = "t[宝宝流鼻涕的常见原因1]l[http://www.b5m.com/link?t=23k]d[宝宝流鼻涕怎么办呢？看着小宝宝流鼻涕的难受样子，家长一定会感到很心急，要怎么办呢？首先要找出宝宝流鼻涕的原因，下面小编就介绍下宝宝流鼻涕的原因和缓解办法。当小孩子感冒后，你用干净的毛巾或纱布，蘸上滚热的开水拧干（虽然很烫手）后再层层裹好。（注意因为婴儿的皮肤很嫩，千万别烫伤了孩子。大人可以先在自己的身上试一试温度1]t[宝宝流鼻涕的常见原因2]d[宝宝流鼻涕怎么办呢？看着小宝宝流鼻涕的难受样子，家长一定会感到很心急，要怎么办呢？首先要找出宝宝流鼻涕的原因，下面小编就介绍下宝宝流鼻涕的原因和缓解办法。当小孩子感冒后，你用干净的毛巾或纱布，蘸上滚热的开水拧干（虽然很烫手）后再层层裹好。（注意因为婴儿的皮肤很嫩，千万别烫伤了孩子。大人可以先在自己的身上试一试温度2]t[宝宝流鼻涕的常见原因3]d[宝宝流鼻涕怎么办呢？看着小宝宝流鼻涕的难受样子，家长一定会感到很心急，要怎么办呢？首先要找出宝宝流鼻涕的原因，下面小编就介绍下宝宝流鼻涕的原因和缓解办法。当小孩子感冒后，你用干净的毛巾或纱布，蘸上滚热的开水拧干（虽然很烫手）后再层层裹好。（注意因为婴儿的皮肤很嫩，千万别烫伤了孩子。大人可以先在自己的身上试一试温度3]";
		



		$content2 = "t[宝宝流鼻涕的常见原因1]l[http://www.b5m.com/link?t=23k]t[宝宝流鼻涕的常见原因2]l[http://www.b5m.com/link?t=222]t[宝宝流鼻涕的常见原因3]l[http://www.b5m.com/link?t=222]";

		echo '<pre>';
		$seoList = array();
		$seoList2 = array();
		foreach (explode('t[', $content) as $key => $value) {
			if(empty($value)){
				continue;
			}
			$seoList[$key]['title'] = str_replace(']','',substr($value,0,strpos($value,']l[')));
			$seoList[$key]['link'] = str_replace(']','',substr($value,strpos($value,']l[')+3,strpos($value,']d[')-(strpos($value,']l[')+3)));
			$seoList[$key]['desc'] = str_replace(']','',substr($value,strpos($value,']d[')+3));
		}
		foreach (explode('t[', $content2) as $key => $value) {
			if(empty($value)){
				continue;
			}
			$seoList2[$key]['title'] = str_replace(']','',substr($value,0,strpos($value,']l[')));
			$seoList2[$key]['link'] = str_replace(']','',substr($value,strpos($value,']l[')+3));
		}
		//print_r($seoList);
		print_r($seoList2);
		die;
		





?>
