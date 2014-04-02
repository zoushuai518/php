<?php

// PHP定时执行任务的实现



ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(0);// 通过set_time_limit(0)可以让程序无限制的执行下去
$interval=60*30;// 每隔半小时运行
do{
	//这里是你要执行的代码	
	sleep($interval);// 等待5分钟
}while(true);


/**
 *
 * PHP定时执行的三种方式实现
 * 1、windows 的计划任务 
 * 2、linux的脚本程序 
 * 3、让web浏览器定时刷新
 *
 */


// windows计划任务
// PHP很少在win服务器上跑，具体实现也不再深究，看网上实现的原理大概是写bat脚本，然后让window任务添加执行这个bat脚本

//写一个PHP程序，命名为test.php，内容如下所示：

$fp = fopen("test.txt", "a+");

fwrite($fp, date("Y-m-d H:i:s") . " 成功成功了！\n");

fclose($fp);


/*
程序大胆地写，什么include\require尽管用，都没问题
新建Bat文件，命名为test.bat,内容如下所示：

D:\php\php.exe -q D:\website\test.php
//相应目录自己改上

建立WINDOWS计划任务：
开始–>控制面板–>任务计划–>添加任务计划
浏览文件夹选择上面的bat文件
设置时间和密码（登陆WINDOWS的）
保存即可了。

over! 可以右键计划任务点“运行”试试
*/




// ==============

/*
Linux 的脚本实现

这里主要使用到crontab这个命令，

使用方式 :

crontab   filecrontab [ -u user ] [ -u user ] { -l | -r | -e }

说明 :

crontab 是用来让使用者在固定时间或固定间隔执行程式之用

使用crontab写shell脚本，然后让PHP调用shell，这个是利用linux的特性，应该还不算PHP自身语言的特性
*/



// =============

/*
使用php让浏览器刷新需要解决几个问题

1>、PHP脚本执行时间限制，默认的是30m 解决办法：set_time_limit();或者修改PHP.ini 设置max_execution_time时间（不推荐）
2>、如果客户端浏览器关闭，程序可能就被迫终止，解决办法：ignore_user_abort即使关闭页面依然正常执行
3>、如果程序一直执行很有可能会消耗大量的资源，解决办法使用sleep使用程序休眠一会，然后在执行
*/

// PHP定时执行的代码：


ignore_user_abort();//关掉浏览器，PHP脚本也可以继续执行.
set_time_limit(3000);// 通过set_time_limit(0)可以让程序无限制的执行下去
$interval=5;// 每隔5s运行
 
//方法1--死循环
do{
    echo '测试'.time().'<br/>'; 
    sleep($interval);// 等待5s    
}while(true);
 
//方法2---sleep 定时执行
    require_once './curlClass.php';//引入文件
     
    $curl = new httpCurl();//实例化
    $stime = $curl->getmicrotime();
    for($i=0;$i<=10;$i++){
         
        echo '测试'.time().'<br/>'; 
        sleep($interval);// 等待5s
         
    }
    ob_flush();
    flush();
    $etime = $curl->getmicrotime();
    echo '<hr>';
    echo round(($etime-stime),4);//程序执行时间




/*
总结：

个人感觉PHP定时执行任务的效率不是很高，建议关于定时执行任务的工作还是交给shell来做吧，比较那才是王道。

ps：那个死循环的方法好像是恶意攻击网站经常使用的方法
*/




?>