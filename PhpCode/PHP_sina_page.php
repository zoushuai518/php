<?php


/*
* 参数说明
* $url 为分页url
* $total 总页数
* $p 当前页码
* $num 总记录数
*/

// zs 尚未测试！仅供参考

function showPage($url,$total,$pg,$num)
{
  $pre = $pg>1 ? $pg-1 : $pg;
         
  $nex = $pg<$total ? $pg+1 : $total;
                 
  $differ = 4;         //差页码值
  $showpage = 9;       //显示页码数
                 
  $page = '<div style="float:left;">共有'.$num.'条记录</div>';
  $page.= '<div style="float:right;">';
  $page.= '<div class="pages">';
  $page.= '<a href="'.$url.'?pg='.$pre.'">上一页</a>';
         
  if($total<($showpage+$differ))
  {
      $s = 1;
      $e = $total;
  }
  else
  {
     if($pg >= $showpage )
     {
        if(($pg+4)<$total)
        {
            $s = ($pg-4);
            $e = ($pg+4);
            $snew = '<a href="'.$url.'?pg=1">1</a><a href="">...</a>';
            $enew = '...<a href="'.$url.'?pg='.$total.'/" >'.$total.'</a>';
         }
         else
         {
            $s = ($pg-$showpage)+2;
            $e = ($pg+$differ) < $total ? ($p+$differ) : $total;
            $snew = '<a href="'.$url.'?pg='.$total.'">1</a>....';
          }
      }
      else
      {
          $s = 1;
          $e = $showpage;
          $enew = '...<a href="'.$url.'?pg='.$total.'">'.$total.'</a>';
      }
 }
 $page .= $snew;
 for($i=$s;$i<=$e;$i++)
 {
   if($pg == $i)
   {
     $page .= '<span class="this">'.$i.'</span>';
   }
   else
   {
   $page .= '<a href="'.$url.'?pg='.$i.'" class="bor">'.$i.'</a>';
   }
 }
                 
$page .= $enew;
         
$page.= '<a class="nextprev" href="'.$url.'?pg='.$nex.'">下一页</a>';
$page.= '</div><div style="clear:both;"></div></div>';
         
return $num>=15 ? $page : '';
}
}

?>