<?php 

/*
 *
 * PHP 程序执行时间
 * @param StartTime
 * @param StopTime
 * @return string time
 *
 */
// DEMO 1  start
class runtime
{ 
    var $StartTime = 0; 
    var $StopTime = 0; 
 
    function get_microtime() 
    { 
        list($usec, $sec) = explode(' ', microtime()); 
        return ((float)$usec + (float)$sec); 
    } 
 
    function start() 
    { 
        $this->StartTime = $this->get_microtime(); 
    } 
 
    function stop() 
    { 
        $this->StopTime = $this->get_microtime(); 
    } 
 
    function spent() 
    { 
        return round(($this->StopTime - $this->StartTime) * 1000, 1); 
    } 
 
}
 
 
//例子 
$runtime= new runtime;
$runtime->start();
 
//你的代码开始
 
$a = 0;
for($i=0; $i<1000000; $i++)
{
    $a += $i;
}
 
//你的代码结束
 
$runtime->stop();
echo "页面执行时间: ".$runtime->spent()." 毫秒";


// DEMO 1 end
//
//
// DEMO 2 start
/**---------------------------------------------------------------------------*/  
/** PHP 计算页面执行时间  
/** @版权注释  
/** 原创 张灿庭 如果您有任何疑问和想法可以发邮件()  
/** 本类允许转载、复制和修改，但转载、复制和修改的同时请保留原始的出处和作者声明，这也是对作者劳动成果的一种尊重！  
/**---------------------------------------------------------------------------*/  
class pageRunTime{   
    static $page_start_time = '';   
    //开始计时   
    static function start(){   
        self::$page_start_time = explode(' ', microtime()); //微秒   
    }   
       
    //计时结束   
    static function finish(){   
        $start  = self::$page_start_time;   
        $end    = explode(' ', microtime());   
        //计算时间   
        $time   = $end[1] - $start[1] + $end[0] - $start[0];   
        //返回    
        return round($time, 5);  //5位小数   
    }   
}      
  
//=========== 实例 ==========   
    //开始   
    pageRunTime::start();   
       
    //执行语句   
    for($i = 0; $i < 2; $i++){   
        echo $i . '<hr>';   
        sleep(1);//休眠1秒   
    }   
       
    //结束   
    echo '页面执行时间是: ' . pageRunTime::finish();   


	// DEMO 2 end
	//
	//
	//
	// DEMO 3 start
	$t1 = microtime(true);   
  
	//sql查询
	  
	$t2 = microtime(true);   
	echo (($t2-$t1)*1000).'ms';  
	// DEMO 3 end
	//
	//
	//
	//
	// DEMO 4 start
function getmicrotime(){
list($usec, $sec) = explode(" ",microtime());
return ((float)$usec + (float)$sec);
}
$time_start = getmicrotime();
for ($i=0; $i < 1000; $i++){
//do nothing, 1000 times
}
$time_end = getmicrotime();
$time = $time_end - $time_start;
echo "Did nothing in $time seconds";

	// DEMO 4 end
	

?>

