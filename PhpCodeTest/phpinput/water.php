<?php 

/**
 *  图片添加水印
 *  @author:weiyan <weiyan@b5m.com>
 */
class WaterMark
{

    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    // const ip = 'http://172.16.2.17:8080/';
    const ip = 'http://10.10.100.228:8080/';
    /**
     *  http请求方法
     *  @author:weiyan <weiyan@b5m.com>
     *  @param:string $uri,$type,$post_data
     */ 
    public static function httpRequest($uri, $type,$post_data= '') {
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
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
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
     *  图片添加水印
     *  @author:weiyan <weiyan@b5m.com>
     *  @param:string $type,$name,$pics
     *  @return:json $data
     */ 
    public static function waterPics($type,$name,$pics){
        switch ($type) {
            // 查询单张水印图片
            case 'single':
                $data = self::postParam($type,$name,$pics);
                return $data;
                break;
            // 多图片路径上传添加水印
            case 'multi':
                $data = self::postParam($type,$name,$pics);
                return $data;
                break;
            // 查询多张水印图片
            case 'paths':
                $data = self::postParam($type,$name,$pics);
                return $data;
                break;
            // 单张图片资源上传添加水印
            default:
                $data = self::postParam('watermark',$name,$pics);
                return $data;
                break;
        }

    }

    /**
     *  POST参数
     *  @author:weiyan <weiyan@b5m.com>
      * @param:string $type,$name,$pics
     *  @return:json $data
     */
    public static function postParam($type,$name,$pics){
        switch ($type) {
            case 'watermark':
                $url = self::ip."image/watermark.htm?";
                break;
            case 'paths':
                $url = self::ip."image/watermark/query/paths.htm?";
                break;
            default:
                $url = self::ip."image/watermark/{$type}.htm?";
                break;
        }
        $url = 'http://phpinput.php.com/phpinput.php';  //本机测试 url
        if($type=='watermark'){
            $img = array('name'=>$name,'file'=>'@'.$pics);  //二进制格式上传文件；注意 @
            $data = self::httpRequest($url,self::POST,$img);
            $status = file_put_contents('C:\Users\lscm\Desktop\zs_stream1.jpg',$data);  //把二进制流写成图片
            // $data = self::httpRequest($url,self::POST,$name.'=@'.$pics);
        }else{
            $data = self::httpRequest($url,self::POST,$name.'='.$pics);
        }
        return $data;
    }

}


// 图片加水印
$water_img = WaterMark::waterPics('single','file',"http://cdn.b5m.com/upload/web/you/file/image/dqYUJdfq.jpg");
// $water_img = WaterMark::waterPics('watermark','file',"{$_FILES['water01']['tmp_name']}");    //本机测试
// $water_img = WaterMark::waterPics('multi',$_FILES['water01']['name'],"{$_FILES['water01']['tmp_name']},{$_FILES['water02']['tmp_name']},{$_FILES['water03']['tmp_name']}");


print_r($water_img);
die;


?>
