<?php
class JsEncrypt {
	
	public static $encodeTab = array(108,122,83,101,99,8,33,20,64,126,109,71,43,82,53,36,105,127,95,84,40,52,46,75,97,76,17,106,59,28,13,90,6,65,77,15,14,56,48,31,16,18,47,113,111,118,5,120,7,62,68,69,92,89,124,73,88,37,26,12,114,34,74,4,25,78,32,61,72,116,102,10,100,29,24,41,30,70,39,121,87,80,96,22,123,86,125,57,21,58,1,110,117,44,11,45,49,23,94,93,27,2,103,85,55,60,3,91,19,54,50,79,38,9,112,115,104,98,51,81,67,66,0,63,35,107,42,119);

	public static function encode($str,$enTab='') {
		$tab = empty($enTab)?(self::$encodeTab):$enTab;
		//$enStr = self::encodeURIComponent($str);
		$enStr = $str;
		$arr = str_split($enStr);
		$re = '';
		foreach($arr as $k=>$v) {
			$as = ord($v);
			$re .= chr($tab[$as]);
		}
		return urlencode($re);
	}

	public static function encodeURIComponent($str) {
		$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
		return strtr(rawurlencode($str), $revert);
	}
}
?>
