1、Yii CDbCriteria的常用方法：

$criteria = new CDbCriteria;      

$criteria->addCondition("id=1"); //查询条件，即where id = 1  

$criteria->addInCondition('id', array(1,2,3,4,5)); //代表where id IN (1,23,,4,5,);  

$criteria->addNotInCondition('id', array(1,2,3,4,5));//与上面正好相法，是NOT IN  

$criteria->addCondition('id=1','OR');//这是OR条件，多个条件的时候，该条件是OR而非AND  

$criteria->addSearchCondition('name', '分类');//搜索条件，其实代表了。。where name like '%分类%'  

$criteria->addBetweenCondition('id', 1, 4);//between 1 and 4   

$criteria->compare('id', 1);    //这个方法比较特殊，他会根据你的参数自动处理成addCondition或者addInCondition，  

                                //即如果第二个参数是数组就会调用addInCondition  

/** 
 * 传递变量 
 */  

$criteria->addCondition("id = :id");  

$criteria->params[':id']=1;  

/** 
 * 一些public vars 
 */  

$criteria->select = 'id,parentid,name'; //代表了要查询的字段，默认select='*';  

$criteria->join = 'xxx'; //连接表  

$criteria->with = 'xxx'; //调用relations   

$criteria->limit = 10;    //取1条数据，如果小于0，则不作处理  

$criteria->offset = 1;   //两条合并起来，则表示 limit 10 offset 1,或者代表了。limit 1,10  

$criteria->order = 'xxx DESC,XXX ASC' ;//排序条件  

$criteria->group = 'group 条件';  

$criteria->having = 'having 条件 ';  

$criteria->distinct = FALSE; //是否唯一查询

[
$criteria  // 参数 为 sql的 where(条件)
$data = ZdmArticle::model()->findAll($criteria);
$count = ZdmArticle::model()->count($criteria);
]


---

2、多表查询
$criteria=new CDbCriteria;
$criteria->alias = 'Invoice';
$criteria->join='LEFT JOIN Client ON Client.id=Invoice.clientId';    // zs used
$criteria->condition='Client.businessId='. Yii::app()->userInfo->business;
--
[
Yii框架中ActiveRecord使用Relations:
前提条件：
在组织数据库时，需要使用主键与外键约束才能使用ActiveReocrd的关系操作；
场景：
申明关系
两张表之间的关系无非三种：一对多；一对一；多对多； 在AR中，定义了四种关系：
关系                定义                                                                    例子
BELONGS_TO      A和B的关系是一对多，那么B属于A                                            Post属于User
HAS_MANY        A和B之间的关系是一对多，那么A有多个B                                      User有多个Post
HAS_ONE         这是HAS_MANY的一种特殊情况，A至多有一个B                                  User至多有一个Profile
MANY_MANY       这个对应多对多的情况，在AR里会将多对多以BELONGS_TO和HAS_MANY的组合来解释  Post和Category

在AR中通过重写CActiveRecord类的relations()方法来申明关系；这个方法返回一个关系配置的数组；一个数组无素代表一个单独的关系，格式如下：
'VarName'=>array('RelationType','ClassName','ForeignKey', ...additional options)
 
Var Name          关系名
Relation Type     四种关系：self::BELONGS_TO, self::HAS_ONE, self::HAS_MANY, self::MANY_MANY
Class Name        代表当前AR类要关联的那个AR类名
Foreign Key       实现关系的外键， 有可能有多个，即列名

--->|
执行关系查询
 
懒惰导入查询方法
最简单的方法就是为AR对象添加一个关联属性，
例:
// 获取PK为10的POST对象 $post=Post::model()->findByPk(10); // 获取这个POST的作者 $author=$post->author;
如果没有关联的对象，那么将返回NULL或者一个空数组；BELONGS_TO和HAS_ONE结果为NULL，而HAS_MANY和MANY_MANY返回一个空数组。
上面的这种“懒惰导入”方法使用起来非常方便，但是在一些场景下不是非常的效率，比如，如果我们想访问N个POST的作者的信息，使用这种懒惰导入的方法将会执行N个join查询；
 
急切导入查询方法
下面介绍是一种“急切导入”方法：在使用find和findAll时，使用with()方法，例：
 
$posts=Post::model()->with('author')->findAll()

这样就可以在一次查询时连同查询其他信息了；with方法可以接受多个关系：
 
$posts=Post::model()->with('author','categories')->findAll();

这样就可以将作者和类别的信息一并进行查询；同样，with还支持多重急切导入
 
$posts=Post::model()->with( 'author.profile', 'author.posts', 'categories')->findAll();
上面的代码不仅会返回autho和categories信息，还会返回作者的profile和posts信息
这种“急切导入”方法也支持CDbCriteria::with，下面这两种实现方式效果一样：
$criteria=new CDbCriteria; $criteria->with=array( 'author.profile', 'author.posts', 'categories', ); $posts=Post::model()->findAll($criteria); or $posts=Post::model()->findAll(array( 'with'=>array( 'author.profile', 'author.posts', 'categories', ) );

|<---
关系查询选项
前面提过，在申明关系时可以添加额外的选项，这些选项都是一些key-value对，是用来定制关系查询的，总结如下：
select
定义从AR类中被select的列集合，如果定义为*，则表示查询所有列
condition
定义where语句，默认为空。
params
生成SQL语句的参数，这个需要用一个key-value对的数组来表示；
on
ON语句，这个条件用来通过AND添加一个joining condintion语句
order
ORDER语句
with
和当前对象一起导出的相关对象列表，要注意如果使用不正确，有可能导致无限死循环；
joinType
定义join的类别，默认为LEFT OUTER JOIN
alias
定义别名，当多个表中有相同的column name时，需要为表格定义alias，然后使用tablename.columnname来指定不同的column
together
这个只在HAS_MANY, MANY_MANY时有用，在实现跨表查询时，可以用这个参数来控制性能。正常用不到，不详细讲述；
join
JOIN语句
group
GROUP语句
having
HAVING语句
index
这个值用来设定返回的结果数组以哪个column做为index值，如果不设定这个值的话，将从0开始组织结果数组。
除此之外还包含下面几个选项，在“懒惰导出”的特定关系时可用
 
limit
返回结果数量的限制，不适用于BELONG_TO关系
offset
offset结果数量的值，不适用于BELONG_TO关系
下面代码，显示上面选项的一些使用：
class User extends CActiveRecord { public function relations() { return array( 'posts'=>array(self::HAS_MANY, 'Post', 'author_id', 'order'=>'posts.create_time DESC', 'with'=>'categories'), 'profile'=>array(self::HAS_ONE, 'Profile', 'owner_id'), ); } }
此时，我们使用$author->posts时，会返回固定ORDER的POST信息

]

--
yii relations 关联表时 重置 on：

yii的relations里self::BELONGS_TO默认是用当前指定的键跟关联表的主键进行join，例如：

return array(
  'reply' => array(self::BELONGS_TO, 'BookPostReply', 'postid'),
);
默认生成的sql是 on id = postid，id是BookPostReply的主键。
但今天我遇到的需求却是需要生成 on BookPostReply.postid = t.postid，不去关联主键，而且关联其中一个字段的值，怎么搞都搞不定，论坛也翻了个遍，不得不说，yii的论坛搜索功能真的很烂，每次用都要从一 堆的内容里过滤信息，还不见的能找到自己想要的，而且手册也比较简单，对这些东西没有做比较深入的解答。

后来无意中看到有个on的属性，刚好跟sql里的on一样，于是抱着试试的想法，在配置里加了上去

return array(
  'reply' => array(self::BELONGS_TO, 'BookPostReply', 'postid', 'on' => 't.postid=reply.postid'),
);
看调试信息里的SQL语句，发现yii生成了一条 on id = postid and t.postid=reply.postid 这样的语句，看到这就已经明白这个东西的作用了，于是将postid清空，改成如下：

return array(
  'reply' => array(self::BELONGS_TO, 'BookPostReply', '', 'on' => 't.postid=reply.postid'),
);
终于将默认的on重置掉了^_^，yii确实很灵活！


