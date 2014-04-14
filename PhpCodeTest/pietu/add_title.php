<?php
require_once("conf.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>折线图</title>
</head>
<body>
    
<?php
$pc = new C_PhpChartX(array(array(11, 9, 5, 12, 15)),'');
$pc->set_title(array('text'=>'我的第一个图表'));
$pc->set_axes(array('xaxis'=>array('min'=>0,'max'=>18,'tickInterval'=>2)));
$pc->draw(600,300);
?>

</body>
</html>