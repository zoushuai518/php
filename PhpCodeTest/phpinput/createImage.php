<?php

// 接受php文件,并且以二进制流的形式返回

// zs
//file_get_contents('php://input', 'r');

// $image_data = file_get_contents('php://input') ? file_get_contents('php://input') : gzuncompress($GLOBALS ['HTTP_RAW_POST_DATA']);
// $image_data = file_get_contents('php://input') ? file_get_contents('php://input') : $_FILES;
// header('Content-Type: image/jpg');
// echo $image_data;
// die;

// echo '<pre>';
// print_r($_POST);
// print_r($_FILES);
// print_r($_FILES['file']['tmp_name']);
// print_r($_FILES['file']['name']);
// print_r($_FILES['file']['type']);
// print_r(file_get_contents('php://input'));
// print_r($_GET);
// return array($_POST, $_FILES);
// echo $_FILES['image']["tmp_name"];die;
if (@move_uploaded_file($_FILES['image']["tmp_name"], '/tmp/phpinput/zs.jpg')) {
    echo 'success';
} else {
    echo 'failed';
}
// die;


//二进制流图片返回客户端 | 测试可用
// echo file_get_contents($_FILES['file']['tmp_name']);

//zs注：以二进制流形式读入图片，并且输出成新图片 | 测试可用
// file_put_contents('C:\Users\lscm\Desktop\zs_stream.jpg',file_get_contents($_FILES['file']['tmp_name']));

?>
