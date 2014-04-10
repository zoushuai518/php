<?php

class DCApi {

	const GET = 'GET';
	const POST = 'POST';

	static public $host = '';

	public static function open($uri, $type,$post_data= '') {
		//echo $uri;
		//$post_data = "action=7&CARD_NO1=".$cust_arr["CARD_NO1"]."&CARD_NO2=".$cust_arr["CARD_NO2"]."&CARD_NO3=".$cust_arr["CARD_NO3"]."&CARD_NO4=".$cust_arr["CARD_NO4"]."&page=SWMW13C0&SEARCH_BTN=0&SEIKYUU_ID=";
		$user_agent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; CIBA)";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uri);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		//post
		curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($ch, CURLOPT_HEADER, false);
		//curl_setopt ($ch,CURLOPT_REFERER,'HTTP://www.baidu.com');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
			curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		}
		switch ($type) {
			case "GET":
				curl_setopt($ch, CURLOPT_HTTPGET, 1);
				break;
			case "POST":
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
				break;
			case "PUT":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
				break;
			default:
				curl_setopt($ch, CURLOPT_HTTPGET, 1);
				break;
		}

		//默认ipv4
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}

	public static function getDbTable($json){
		$uri = self::$host . '/cms/db/table/'.urlencode($json).'';
		$jdata = self::open($uri, 'GET');
		return json_decode($jdata, true);
	}

	/**
	 * 获取 帮5游 楼层数据 javaapi
	 * @param string $city_type
	 * @return string $city_data
	 * @author shuai zou <weiyan@b5m.com>
	 */
	public static function getYouTypeCity($city_type) {
		$url = Yii::app()->params['youCityApiUrl'] . '/getYouCitysByType?type=' . $city_type;
		$city_data = self::open($url, self::GET);
		return json_decode($city_data, ture);
	}

	/**
	 * 从表中获取数据
	 * @author shuai zou<weiyan@b5m.com>
	 * @param string $param
	 * @return array $ArticleData
	 */
	public static function getTableData($param) {
		$url = self::$host . '/cms/db/table/'.$param;
		$ArticleData = self::open($url,'GET');
		return json_decode($ArticleData, true);
	}

	/**
	 * 向表中插入数据
	 * @author shuai zou<weiyan@b5m.com>
	 * @param string @param 
	 * @return array $returnStat
	 */
	public static function putTableData($param) {
		$url = self::$host . '/cms/db/table/';
		$returnStat = self::open($url,'PUT',$param);
		return json_decode($returnStat, true);
	}

	/**
	 * 更新表中数据
	 * @author shuai zou<weiyan@b5m.com>
	 * @param string $param
	 * @return array $returnStat
	 */
	public static function postTableData($param){
		$url = self::$host . '/cms/db/table/';
		$returnStat = self::open($url,self::POST,$param);
		return json_decode($returnStat, true);
	}


	/**
	 * 帮豆充值操作
	 * @author shuai zou<weiyan@b5m.com>
	 * @param string $param
	 * @return json $returnStatus
	 */
	public static function setBangDouData($ip,$port,$param){
		$url = 'http://'.$ip.$port.'/b5m-bean/recharge.htm?';
		$returnStatus = file_get_contents($url.$param);
		return json_decode($returnStatus, true);
	}


	/**
	 * 帮豆查询
	 * @author shuai zou<weiyan@b5m.com>
	 * @param string $param
	 * @return $douData
	 */
	public static function getBangDouData($ip,$port,$param){
		$url = 'http://'.$ip.$port.'/b5m-bean/accountQuery.htm?';
		$douData = self::open($url,self::POST,$param);
		return json_decode($douData, true);
	}

	/**
	 * 帮豆扣除操作
	 * @author Jingqing <jingqing@b5m.cn>
	 * @param string $ip
	 * @param int $port 
	 * @param string $param
	 * @return string
	 */
	public static function reduceBangdou($ip,$port,$param) {
		$url = 'http://'.$ip.$port.'/b5m-bean/trade.htm?';
		$douData = self::open($url,self::POST,$param);
		return json_decode($douData, true);
	}


}

