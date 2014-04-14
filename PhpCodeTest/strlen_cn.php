<?php 

// form network
function length($str){//可以统计中文字符
   $len=strlen ($str);
   $i=0;
   while($i<$len){
     if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/",$str[$i])){
       $i+=2;
     }else{
       $i+=1;
     }
     $n+=1;
   }
   return $n;
}


var_dump(length("你好啊！"));


?>