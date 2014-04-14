<?php 

/**
* 
*/
class ClassName extends AnotherClass
{

	/**
     * 截取 UTF-8编码字符串
     * @author：zoushuai <weiyan@b5m.com>
     * @param string $string, string $length, string $etc
     * @return string
     */
    public static function truncate_utf8_string($string, $length, $etc = '...') {
        $result = '';
        $string = html_entity_decode(trim(strip_tags($string)), ENT_QUOTES, 'UTF-8');
        $strlen = strlen($string);
        for ($i = 0; (($i < $strlen) && ($length > 0)); $i++) {
            if ($number = strpos(str_pad(decbin(ord(substr($string, $i, 1))), 8, '0', STR_PAD_LEFT), '0')) {
                if ($length < 1.0) {
                    break;
                }
                $result .= substr($string, $i, $number);
                $length -= 1.0;
                $i += $number - 1;
            } else {
                $result .= substr($string, $i, 1);
                $length -= 0.5;
            }
        }
        $result = htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
        if ($i < $strlen) {
            $result .= $etc;
        }
        return $result;
    }

     // 围绕关键词，截取指定长度字符(按照整句截取)
    public static function seo_substr_keyword($str,$keyword){
        $str = strip_tags($str);
        $str_length = strpos($str,$keyword);
        $str_keyword_length = mb_strlen($keyword,'utf8');
        if($str_length!=false){

            // 向前 联想距 关键词最近的 一句结尾的位置
            $str_s = mb_substr($str,0,$str_length,'utf8');
            $str_e = mb_substr($str,$str_length,50,'utf8');
            if(count(explode('。', $str_s))>1){
                $str_s_s = explode('。', $str_s);
                $string = end($str_s_s).$str_e;
            }elseif(count(explode('.', $str_s))>1){
                $str_s_s = explode('.', $str_s);
                $string = end($str_s_s).$str_e;
            }elseif(count(explode('！', $str_s))>1){
                $str_s_s = explode('！', $str_s);
                $string = end($str_s_s).$str_e;
            }elseif(count(explode('!', $str_s))>1){
                $str_s_s = explode('!', $str_s);
                $string = end($str_s_s).$str_e;
            }elseif(count(explode('？', $str_s))>1){
                $str_s_s = explode('？', $str_s);
                $string = end($str_s_s).$str_e;
            }elseif(count(explode('?', $str_s))>1){
                $str_s_s = explode('?', $str_s);
                $string = end($str_s_s).$str_e;
            }else{
                $string = mb_substr($str,0,$str_length+50,'utf8');
            }

            // 关键词 距离 字符串开始位置 长度 <100
            ($str_length-$str_keyword_length < 100 ) && $string = mb_substr($str,0,$str_length+50,'utf8');

        }else{
            $string = self::truncate_utf8_string($str,100);
        }
        return $string = strip_tags($string);
    }

    // 围绕指定词，各截取30个长度字符
    public static function seo_substr_string($str,$str_search,$length=30,$code_type='utf8'){
        $string = '';
        $string_s = '';
        $string_e = '';
        $str_len = mb_strlen(strip_tags($str),$code_type);
        $str_search_len = mb_strlen($str_search,$code_type);
        $str_length = strpos(strip_tags($str),$str_search);
        $sub_e_len = ($str_len-($str_length+$str_search_len)-30)>0?30:($str_len-($str_length+$str_search_len)-30);
        if($str_length!=false){
            $string_s = ($str_length>30)?mb_substr($str,$str_length-30,30,$code_type):mb_substr($str,0,$str_length,$code_type);
            $string_e = ($str_length>30)?mb_substr($str,$str_length,$sub_e_len,$code_type):mb_substr($str,$str_length,$sub_e_len,$code_type);
            $string = $string_s.$string_e;
        }else{
            $string = self::truncate_utf8_string($str,50);  //搜索不到关键词，截取 50个长度字符
        }
        return $string = strip_tags($string);
    }


}

?>