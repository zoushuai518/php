<?php 

// error_reporting(0);
// http://php.net/manual/en/class.curlfile.php
// http://blog.csdn.net/cyuyan112233/article/details/21007163

/**
 *  图片添加水印
 *  @author:weiyan <weiyan@b5m.com>
 */
class ImageStream
{

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    // const ip = 'http://172.16.2.17:8080/';

    /**
     *  http请求方法
     *  @author:weiyan <weiyan@b5m.com>
     *  @param:string $uri,$type,$post_data
     */ 
    public static function httpRequest($uri, $type,$post_data= '', $image) {
        $user_agent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; CIBA)";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uri);
        //post
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }
        switch ($type) {
            case "GET":
                curl_setopt($ch, CURLOPT_HTTPGET, 1);
                break;
            case "POST":
                // $cfile = curl_file_create('zs.jpg','image/jpeg','test_name');
                // Assign POST data
                // $data = array('test_file' => $cfile);
                // curl_setopt($ch, CURLOPT_POST,1);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $c_image = curl_file_create($image);
                $image_data = array('image' => $c_image);
                // $data = array($post_data, $image_data);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $image_data);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_INFILESIZE, filesize($image)); //这句非常重要，告诉远程服务器，文件大小，查到的是前辈的文章
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                break;
            default:
                curl_setopt($ch, CURLOPT_HTTPGET, 1);
                break;
        }
        //默认ipv4
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    /**
     *  POST参数
     *  @author:weiyan <weiyan@b5m.com>
      * @param:string $name,$pics,$isImageString
     *  @return:json $data
     */
    public static function postImageString($post_data, $pics, $isImageString = 1){
        $url = 'http://phpcode.weimob.com/phpinput/createImage.php';  //本机测试 url
        if($isImageString===1){
            // $img = array('name'=>$name,'file'=>'@'.$pics);  //二进制格式上传文件；注意 @
            $data = self::httpRequest($url,self::POST,$post_data,$pics);

            // $status = file_put_contents('/tmp/phpinput/',$data);  //把二进制流写成图片
        }else{
            $data = self::httpRequest($url,self::POST,$name.'='.$pics);
        }
        return $data;
    }

}

// echo '<pre>';
// print_r($_FILES['imageStream']);
// die;
$image_tmp = $_FILES['imageStream']['tmp_name'];
$post_data = array(111,222,333);
$image = ImageStream::postImageString($post_data,$image_tmp);
// Deprecated: curl_setopt(): The usage of the @filename API for file uploading is deprecated. Please use the CURLFile class instead in /var/www/html/zsdemosite/phpcode/phpinput/imageStream.php on line 39


echo '<pre>';
print_r($image);
die;


?>
