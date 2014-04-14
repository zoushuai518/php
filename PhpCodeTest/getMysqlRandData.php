<?php

/*
#sql demo:

SELECT t1.`type`,t1.`id`,t1.`index_image`,t1.`title`,t2.`id` as tt
        FROM `cms_post` AS t1 JOIN (SELECT ROUND(RAND() *
        ((SELECT MAX(id) FROM `cms_post`  where  status=1   and type = '2'  and
image_xy = '2' )-
        (SELECT MIN(id) FROM `cms_post`  where  status=1   and type = '2'  and
image_xy = '2' ))+
        (SELECT MIN(id) FROM `cms_post`  where  status=1   and type = '2'  and
image_xy = '2' )) AS id) AS t2
        WHERE t1.id >= t2.id and type = '2'  and image_xy = '2'  LIMIT 200
---
SELECT
t1.`type`,t1.`id`,t1.`index_image`,t1.`title` from `cms_post` as t1  where 
status=1   and type = '2'  and image_xy = '2'  and t1.id< 1549 limit 189
*/
    // mysql 随机取数据 | t2.id为分割点。取出数据 能不能满足 $num，要看t2.id的分割位置。
    // #zs 来自 b5m YII demo 2013-3-17 
    public function getRandPostBySql($cat,$num=6,$type=1,$image_xy='')
    {
        $sql1 = '';$sql2=' where  status=1 ';
        !empty($cat)&&$sql1 .=" and category_id = '$cat' ";
        !empty($type)&&$sql1.=" and type = '$type' ";
        !empty($sql1)&&$sql2.=' '.$sql1;
        !empty($image_xy) && $sql2.= " and image_xy = '$image_xy' ";
        $sql = "SELECT t1.`type`,t1.`id`,t1.`index_image`,t1.`title`,t2.`id` as tt
        FROM `cms_post` AS t1 JOIN (SELECT ROUND(RAND() *
        ((SELECT MAX(id) FROM `cms_post` $sql2)-
        (SELECT MIN(id) FROM `cms_post` $sql2))+
        (SELECT MIN(id) FROM `cms_post` $sql2)) AS id) AS t2
        WHERE t1.id >= t2.id";
        $sql = $sql.$sql1;
        !empty($image_xy) && $sql.= " and image_xy = '$image_xy' "; //图片类型
        $sql.=" LIMIT $num;";
        // 按照分割点向后取数据
        $command = Yii::app()->db->createCommand($sql);
        $data = $command->queryAll();

        // 数据不够 6条向前取；以满足，六条数据
        if(isset($data[0]) && !isset($data[$num-1])){
            $sql = "SELECT t1.`type`,t1.`id`,t1.`index_image`,t1.`title` from `cms_post` as t1 ".$sql2 ." and t1.id< {$data[0]['tt']} ";
            $limit = $num-count($data);
            $sql .= "limit $limit";
            $command = Yii::app()->db->createCommand($sql);
            $data_l = $command->queryAll();
        }
        (isset($data_l) && !empty($data_l)) && $data = array_merge($data,$data_l);
        return $data;

    }

?>