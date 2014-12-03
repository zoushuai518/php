YII CRUD[增/查/更/删] 例子：
url:http://www.cnblogs.com/likwo/archive/2011/08/29/2158302.html

<?php 
class PostTest extends CDbTestCase{ 
    public $fixtures = array ( 
        'posts' = > 'Post' , 
        'tags' = > 'Tag' , 
    ) ; 
    
    public function testFindPost() { 
        //调用 find 时，我们使用 $condition 和 $params 指定查询条件。 
        //此处 $condition 可以是 SQL 语句中的 WHERE 字符串，$params 则是一个参数数组， 
        //其中的值应绑定到 $condation 中的占位符。 
        $post = $this -> posts( 'post1' ) ; 
        $fPost = Post: : model() -> find( 'id = :id' , array ( ':id' = > $post -> id) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE `t`.`id`=1 LIMIT 1 
        
        $fPost = Post: : model() -> find( '?' , array ( $post -> id) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE '1' LIMIT 1 
        
        //find返回符合条件的第一条记录，而findAll会返回符合条件的所有行。 
        $fAllPost = Post: : model() -> findAll( 'id = :id' , array ( ':id' = > $post -> id) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE id = '1' 
        
        $fAllPost = Post: : model() -> findAll( '?' , array ( $post -> id) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE '1' 
        
        $criteria = new CDbCriteria() ; 
        $criteria -> condition = 'id = :id AND title = :title' ; 
        $criteria -> params = array ( ':id' = > $post -> id, ':title' = > $post -> title) ; 
        $fPost = Post: : model() -> find( $criteria ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE id = '1' AND title = 'post1' LIMIT 1 
        
        $fAllPost = Post: : model() -> findAll( $criteria ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE id = '1' AND title = 'post1' 
        
        $fPost = Post: : model() -> findByPk( $post -> id, 'title = :title' , array ( ':title' = > $post -> title) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE `t`.`id`=1 AND (title = 'post1') LIMIT 1 
        
        $fPost = Post: : model() -> findByAttributes( array ( 'id' = > $post -> id, 'title' = > $post -> title) ) ; 
        //SELECT * FROM `tbl_post` `t` WHERE `t`.`id`='1' AND `t`.`title`='post1' LIMIT 1 
        
        $sql = 'SELECT id, title from {{post}} WHERE id = ? AND title = ?' ; //必须设置表前缀 
        $fPost = Post: : model() -> findBySql( $sql , array ( $post -> id, $post -> title) ) ; 
        
        $sql = 'SELECT id, title from {{post}} WHERE id = :id AND title = :title' ; 
        $fPost = Post: : model() -> findBySql( $sql , array ( ':id' = > $post -> id, ':title' = > $post -> title) ) ; 
        
        //如果没有找到符合条件的行，find返回null，findAll 返回 array()。 
        
    } 
    
    public function testCountPost() { 
        $post = $this -> posts( 'post1' ) ; 
        
        $cPost = Post: : model() -> count ( '?' , array ( $post -> title) ) ; 
        //SELECT COUNT(*) FROM `tbl_post` `t` WHERE 'post1' 无意义 
        
        $cPost = Post: : model() -> countByAttributes( array ( 'title' = > $post -> title, 'content' = > $post ->content) ) ; 
        //SELECT COUNT(*) FROM `tbl_post` `t` WHERE `t`.`title`='post1' AND `t`.`content`='content1' 
        
        $sql = "SELECT title from {{post}} WHERE title LIKE '%" . $post -> title . "%'" ; 
        $cPost = Post: : model() -> countBySql( $sql ) ; 
        //至少有一条记录符合查询条件 
        $ePost = Post: : model() -> exists( 'id = ?     AND    title = ?' , array ( $post -> id, $post -> title) ) ; 
        //SELECT 1 FROM `tbl_post` `t` WHERE id = '1'     AND    title = 'post1' LIMIT 1 
    } 
    
    public function testUpdatePost() { 
        $post = $this -> posts( 'post1' ) ; 
        $post -> title = 'update post 1' ; 
        
        if ( $post -> isNewRecord) { 
            $post -> create_time = $post -> update_time = new CDbExpression( 'NOW()' ) ; 
            //UPDATE `tbl_post` SET `id`=1, `title`='update post 1', `content`='content1', `tags`=NULL, `status`=1, `create_time`=NULL, `update_time`=1302161123, `author_id`=1 WHERE `tbl_post`.`id`=1 
        } else { 
            $post -> update_time = time () ; 
        } 
        
        $post -> save() ; 
        
        
        //updateAll 
        $sql = "SELECT * FROM {{post}} WHERE title LIKE '%" . "post" . "%'" ; 
        //SELECT * FROM tbl_post WHERE title LIKE '%post%' 
        
        $post = Post: : model() -> findBySql( $sql ) ; 
        $post -> updateAll( array ( 'update_time' = > time () ) , 'id <= ?' , array ( '2' ) ) ; 
        //UPDATE `tbl_post` SET `update_time`=1302161123 WHERE id <= '2' 
        
        $post -> updateByPk( $post -> id + 2, array ( 'title' = > 'update post 3' ) ) ; 
        $post -> updateByPk( $post -> id, array ( 'title' = > 'update post 3' ) , 'id = ?' , array ( '3' ) ) ; 
        
        //updateCounter 更新某个字段的数值，一般是计数器(+/-)。 
        $tag = $this -> tags( 'tag1' ) ; 
        $uTag = Tag: : model() -> updateCounters( array ( 'frequency' = > '3' ) , 'id = ?' , array ( '1' ) ) ; 
    } 
    
    public function testDeletePost() { 
        $post = $this -> posts( 'post1' ) ; 
        $post -> delete () ; 
        
        
        $this -> assertEquals( 1, $post -> id) ; //删除数据库表中的记录，但是post的这个实例还在。 
        $post2 = Post: : model() -> findByPk( $post -> id) ; 
        $this -> assertEquals( null , $post2 ) ; 
        
        //多条记录 
        $delete = Post: : model() -> deleteAll( '(id = ? AND title = ?) || (id = \'4\') ' , array ( 1, 'post 1' ) ) ; 
        $this -> assertEquals( 0, $delete ) ; 
        
        $delete = Post: : model() -> deleteAllByAttributes( array ( 'id' = > '2' ) , 'content = ?' , array ( 'content2') ) ; 
        //DELETE FROM `tbl_post` WHERE `tbl_post`.`id`='2' AND (content = 'content2') 
        $this -> assertEquals( 1, $delete ) ; 
    } 
} 
?>
