Yii::log()和Yii::trace()，日志的使用

1.系统自带调试:
index.php开启调试模式
// remove the following lines when in production mode  
defined('YII_DEBUG') or define('YII_DEBUG',true);  
// specify how many levels of call stack should be shown in each log message  
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);  
//app use time  
//defined('YII_BEGIN_TIME') or define('YII_BEGIN_TIME',microtime(true));  
 main.php
Java代码  收藏代码
'errorHandler'=>array(  
    // use 'site/error' action to display errors  
    'errorAction'=>'site/error',  
),  
'log'=>array(  
    'class'=>'CLogRouter',  
    'routes'=>array(  
        array(  
            'class'=>'CFileLogRoute',  
            'levels'=>'error, warning',  
        ),  
        // 下面显示页面日志  
        array(  
            'class'=>'CWebLogRoute',  
            'levels'=>'trace',     //级别为trace  
            'categories'=>'system.db.*' //只显示关于数据库信息,包括数据库连接,数据库执行语句  
        ),        
    ),  
),  
YII_TRACE_LEVEL的数字越大，信息越清楚
 
Yii 提供了一个灵活可扩展的日志功能。记录的日志可以通过日志级别和信息分类进行归类。通过使用级别和分类过滤器，所选的信息还可以进一步路由到不同的目的地，例如一个文件，Email，浏览器窗口等。
 在Yii 中有下列几种日志路由可用： 
CDbLogRoute: 将信息保存到数据库的表中。 
CEmailLogRoute: 发送信息到指定的 Email 地址。 
CFileLogRoute: 保存信息到应用程序 runtime 目录中的一个文件中。 
CWebLogRoute: 将 信息 显示在当前页面的底部。 
CProfileLogRoute: 在页面的底部显示概述（profiling）信息。
 
YII中日志的基本使用：
可以通过YII提供的Yii::log和Yii::trace进行日志信息的输出，两者的区别看看定义就知道了。
函数定义
Java代码  收藏代码
Yii::log($message, $level, $category);  
Yii::trace($message, $category);  
$msg:你要输出的日志信息
$category:日志信息所属分类
$level:日志信息的级别：
Java代码  收藏代码
const LEVEL_TRACE='trace';用于调试环境，追踪程序执行流程  
const LEVEL_WARNING='warning';警告信息  
const LEVEL_ERROR='error';致命错误信息  
const LEVEL_INFO='info';普通提示信息  
const LEVEL_PROFILE='profile';性能调试信息  
YII::log基本使用例子
<?php  
 class DefaultController extends Controller  
 {  
     public function actionCache ()  
     {  
         $category='system.testmod.defaultController';  
         $level=CLogger::LEVEL_INFO;  
         $msg='action begin ';  
         Yii::log($msg,$level,$category);  
根据不同功能模块定制log日志
Java代码  收藏代码
array(  
    'components' => array(  
        'log' => array(  
            'class' => 'CLogRouter',  
            'routes' => array(  
                array( //数据库日志记录到db.log中  
                    'class' => 'CFileLogRoute',  
                    'categories' => 'db.*',  
                    'logFile' => 'db.log',  
                ),  
                array( //所有错误日志记录到error.log中  
                    'class' => 'CFileLogRoute',  
                    'levels' => 'error',  
                    'logFile' => 'error.log',  
                ),  
                array( //所有用户中心错误日志发邮件  
                    'class' => 'CEmailLogRoute',  
                    'categories' => 'uc.*',  
                    'levels' => 'error',  
                    'emails' => 'admin@example.com',  
                ),  
                array( //开发过程中所有日志直接页面打印，这样不需要登录服务器看日志了  
                    'class' => 'CWebLogRoute',  
                    'levels' => 'trace,info,profile,warning,error',  
                ),  
            ),  
        ),  
    ),  
),  

2.调试插件
debugtoolbar http://www.yiiframework.com/extension/yiidebugtb
