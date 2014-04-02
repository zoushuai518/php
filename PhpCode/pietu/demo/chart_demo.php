<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>标准的chart显示</title>
</head>
    <body>

<?php
    $s1 = array(array(1, 2),array(2, 3),array(3,5.12),array(5,13.1),array(7,33.6),array(9,85.9),array(11,219.9));
    $s2 = array(array(0, 6.29), array(0.1, 8.21), array(0.2, 8.92), array(0.3, 7.33), array(0.4, 7.91), array(0.5, 3.6), array(0.6, 6.88),
      array(0.7, 1.5), array(0.8, 0.08), array(0.9, 6.36), array(1, 0.5), array(1.1, 9.14), array(1.2, 6.23), array(1.3, 2.66),
      array(1.4, 9.9), array(1.5, 7.44), array(1.6, 7.82), array(1.7, 8.57), array(1.8, 3.99), array(1.9, 3.83), array(2, 6.78),
      array(2.1, 7.63), array(2.2, 6.94), array(2.3, 1.24), array(2.4, 2.25), array(2.5, 0.67), array(2.6, 6.73), array(2.7, 2.25),
      array(2.8, 7.72), array(2.9, 9.36), array(3, 8.49));

    /**
     * 定义一个点的数组
     */
    $pc = new C_PhpChartX(array($s2));
    /**
    出现方式是否为动画显示
    **/
    //$pc->set_animate(true);
    /**
     * 设置标题
     */
    $pc->set_title(array('text'=>'标准折线图'));
    
    /**
     * 设置横坐标的最小值和最大值(x)
     **/
    $pc->set_axes(array('xaxis'=> array('min'=>-0.5,'max'=>4)));
    /**
     * 设置纵坐标的最小值和最大值(y)
     */
    $pc->set_axes(array('yaxis'=> array('min'=>-10,'max'=>15)));
    
    
    /**
     * 设置默认线条方式
     * linePattern=>dashed:设置线条为虚线，''不设置为实线.也可以为数组，数组中的参数表示将折线按照要求的数字值进行显示和隐藏，形成规则/不规则的折线
     * showMarker=>true:设置显示折点加亮;false：设置节点隐藏.
     * shadow=>false:设置线条没有有阴影，true：表示线条有阴影.
     * lineWidth：表示折现的粗细程度。
     * rendererOptions:线条操作，smooth：true：表示两点直间连接圆滑，false：表示两点之间直接连接。
     */
    //$pc->set_series_default(array('linePattern'=>array(2,2),'showMarker'=>true,'shadow'=>true,'lineWidth'=>3,'rendererOptions'=>array('smooth'=>true)));
    $pc->set_series_default(array('linePattern'=>'','showMarker'=>true,'shadow'=>true,'lineWidth'=>3,'rendererOptions'=>array('smooth'=>false)));
    /**
     * 设置线条的坐标面板的显示和颜色
     */
   
    $pc->add_series(array('label'=>'one','color'=>'red'));
    
    /**
     * 设置折线图
     **/
    $pc->add_plugins(array('cursor'));
    /**
    showVerticalLine:表示设置是否有纵向比较线
    showTooltip：表示设置是否显示纵向比较线的当前位置坐标（显示在图的右下角处）
    followMouse:表示纵向比较线当前坐标是否跟随鼠标。
    showTooltipDataPosition:是否让纵向比较线“鼠标跟随坐标”只显示在临近折点处的坐标。
    tooltipFormatString:设置坐标提示格式
    **/
    $pc->set_cursor(array('showVerticalLine'=>true,'showTooltip'=>true,'followMouse'=>true,'showTooltipDataPosition'=>true,'zoom'=>false,'tooltipFormatString'=>'%s x:%s, y:%s'));
    
    
    
    /**
    *设置图形显示的大小，即：长度和宽度。第一个参数是长度，第二个是高度
    **/
    $pc->draw(800,600);

   
?>

    </body>
</html>