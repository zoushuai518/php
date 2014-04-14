<?php
    // error_reporting(E_ALL ^E_NOTICE );
    // error_reporting(E_ALL ^E_NOTICE ^E_WARNING);
    error_reporting(0);
    function calc($size){
        $units = array(3=>'G',2=>'M',1=>'K',0=>'B');//单位字符,可类推添加更多字符.
        foreach($units as $i => $unit){
                if($i>0){
                        $n = $size /pow(1024,$i)%pow(1024,$i);
                }else{
                        $n = $size24;
                }
                if($n!=0){
                        @$str.=" $n{$unit} ";
                }
        }
        return  $str;
    }

    echo calc(20480000);
?>