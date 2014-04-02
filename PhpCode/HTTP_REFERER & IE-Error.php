<?php


// PHP中的$_SERVER["HTTP_REFERER"]用法浅谈 -- 防盗链



/*大家知道$_SESSION['HTTP_REFERER']可以获取当前链接的上一个连接的来源地址，即链接到当前页面的前一页面的 URL 地址，可以做到防盗链作用，只有点击超链接（即<A href=...>） 打开的页面才有HTTP_REFERER环境变量， 其它如 window.open()、 window.location=...、window.showModelessDialog()等打开的窗口都没有HTTP_REFERER 环境变量。
写个函数吧 简单的可以、起到防盗链作用*/

  function   checkurl(){   
  //如果直接从浏览器连接到页面，就连接到登陆窗口   
  //echo   "referer:".$_SESSION['HTTP_REFERER'];   
  if(!isset($_SESSION['HTTP_REFERER']))   {   
  header("location:   login");   
  exit;   
  }   
  $urlar   =   parse_url($_SESSION['HTTP_REFERER']);   
  //如果页面的域名不是服务器域名,就连接到登陆窗口   
  if($_SERVER['HTTP_HOST']   !=   $urlar["host"]   &&   $urlar["host"]   !=   "202.102.110.204"   &&   $urlar["host"]   !=   "http://blog.163.com/fantasy_lxh/")   {   
  header("location:   login.php");   
  exit;   
  }     
  }   
checkurl()




?>



[zs:

php如何准确的获取前一页地址 $_SERVER['HTTP_REFERER']这玩意不好使。


    1.PHP 获取上一页的URL
      在php中可以通过内置的变量的属性来获取上一页的URL： $_SERVER['HTTP_REFERER'].
      但是在IE中如果跳转是通过js函数如: window.location.href 或者 window.open的话，  $_SERVER['HTTP_REFERER'] 返回的是空的。通过连接或者表单提交的则工作正常。FF工作正常。
      另外$_SERVER[PHP_SELF]获取当前页面的url;
     
    2. JS 获取上一页的URL
      在js中也有document本身属性可以或许上一页的URL：document.referrer
      但是这个跟php的 $_SERVER['HTTP_REFERER']一样，在IE中当是利用js函数跳转的话，得到的也是空值
      但如果你仅仅想利用js来实现跳转到上一页或者是上上几页的话：
返回到前第几个页面: window.history.go(返回第几页,也可以使用访问过的URL);
返回前一个页面: history.go(-1), 返回两个页面: history.go(-2);
返回前一页面: history.back();
      使用方法<a href="javascript:history.back();">向上一页</a>


    3. ag: <a href="http://www.baiducsd.com/?addg" click="showurl()">
    这种情况下 : PHP $_SERVER['HTTP_REFERER']  在 IE下面  获取不到前一个页面的url值



    ========


HTTP_REFERER有效的情况
1、以iframe 形式调用地址
2、以window.open调用，打开新页面window.open(url);
3、使用window.location.replace在Firefox 和Chrome下可以获取HTTP_REFERER
window.location.replace(url);
4、使用window.location.href在Firefox 和Chrome下可以获取HTTP_REFERER
window.location.href = url;
5、使用A标签跳转可以获取HTTP_REFERER

HTTP_REFERER无效的情况
1、使用函数 file_get_contents或file等函数调用URL地址，这个地址所在的文件无法获取HTTP_REFERER
2、使用window.location.replace在IE6、IE7、IE8下无法获取HTTP_REFERER
window.location.replace(url);
3、使用window.location.href在IE6、IE7、IE8下无法获取HTTP_REFERER
window.location.href = url;


]