View Code 
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>瀑布流-Derek</title>
 <script type="text/javascript" language="javascript" src="jquery.js"></script>
 <link type="text/css" rel="stylesheet" href="waterfall.css" />
 <script type="text/javascript" language="javascript" src="waterfall.js"></script>
 </head>
 <body>
 
     <ul id="stage">
         <li></li>
         <li></li>
         <li></li>
         <li></li>
     </ul>
 
 </body>
 </html>
/*
 *  Javascript文件：waterfall.js
 */
$(function(){
     jsonajax();
 });
 
 //这里就要进行计算滚动条当前所在的位置了。如果滚动条离最底部还有100px的时候就要进行调用ajax加载数据
 $(window).scroll(function(){    
     //此方法是在滚动条滚动时发生的函数
     // 当滚动到最底部以上100像素时，加载新内容
     var $doc_height,$s_top,$now_height;
     $doc_height = $(document).height();        //这里是document的整个高度
     $s_top = $(this).scrollTop();            //当前滚动条离最顶上多少高度
     $now_height = $(this).height();            //这里的this 也是就是window对象
     if(($doc_height - $s_top - $now_height) < 100) jsonajax();    
 });
 
 
 //做一个ajax方法来请求data.php不断的获取数据
 var $num = 0;
 function jsonajax(){
     
     $.ajax({
         url:'data.php',
         type:'POST',
         data:"num="+$num++,
         dataType:'json',
         success:function(json){
             if(typeof json == 'object'){
                 var neirou,$row,iheight,temp_h;
                 for(var i=0,l=json.length;i<l;i++){
                     neirou = json[i];    //当前层数据
                     //找了高度最少的列做添加新内容
                     iheight  =  -1;
                     $("#stage li").each(function(){
                         //得到当前li的高度
                         temp_h = Number($(this).height());
                         if(iheight == -1 || iheight >temp_h){
                             iheight = temp_h;
                             $row = $(this); //此时$row是li对象了
                         }
                     });
                     $item = $('<div><img src="'+neirou.img+'" border="0" ><br/>'+neirou.title+'</div>').hide();
                     $row.append($item);
                     $item.fadeIn();
                 }
             }
         }
     });
 }

/*
 *  CSS文件：waterfall.css
 */

body{text-align:center;}
/*Download by http://www.codefans.net*/
#stage{ margin:0 auto; padding:0; width:880px; }
#stage li{ margin:0; padding:0; list-style:none;float:left; width:220px;}
#stage li div{ font-size:12px; padding:10px; color:#999999; text-align:left; }


/*
 *  php文件：data.php
 */
<?php
 $link = mysql_connect("localhost","root","");
 $sql = "use waterfall";
 mysql_query($sql,$link);
 $sql = "set names utf8";
 mysql_query($sql,$link);
 $num = $_POST['num'] *10;
 if($_POST['num'] != 0) $num +1;
 $sql = "select img,title from content limit ".$num.",10";
 $result = mysql_query($sql,$link);
 $temp_arr = array();
 while($row = mysql_fetch_assoc($result)){
     $temp_arr[] = $row;
 }
 $json_arr = array();
 foreach($temp_arr as $k=>$v){
     $json_arr[]  = (object)$v;
 }
 //print_r($json_arr);
 echo json_encode( $json_arr );