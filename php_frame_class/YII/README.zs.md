

YII 使用 & Debug


一、YII CHtml类的使用   -->| zs  20130912
=========================
二、YII yiilite.php 文件分析 -->| zs  20130912
=========================
三、YII 抛出一个异常  throw new CException   -->| zs  20130912
=========================
四、YII 引入 js/css文件：
=========================
五、在视图层（../views/..）添加CSS文件或JavaScript文件

Php代码
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/TableView.js");
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/datechooser.js");
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/datechooser.css");

批注1：在视图层引用与在控制层引用的方式一样。但在视图层中引用加载的要晚一些。
批注2：引用路径是使用baseUrl，而不是basePath。
批注3：关于参数CClientScript::POS_END，作用是延时加载，提高页面渲染效率。例如：
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jqueryui/jquery-ui.min.js", CClientScript::POS_END);
全部参数一览：
CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.
CClientScript:function tag:POS_BEGIN : the script is inserted at the beginning of the body section.
CClientScript::POS_END : the script is inserted at the end of the body section.
CClientScript::POS_LOAD : the script is inserted in the window.onload() function.
CClientScript::POS_READY : the script is inserted in the jQuery's ready function.
注：这些参数仅适用于加载js文件，不适用于加载css文件。


五-1、引入jquery核心部件
Php代码
Yii::app()->clientScript->registerCoreScript('jquery');

批注：不论在页面中的何种位置引用，最终yii会将jquery.js文件放入yii的assets文件夹下。即/projectName/assets/82qg58/jquery-1.6.1.min.js。


五-2、在控制层(../controllers/xxController.php)添加CSS文件或JavaScript文件
Php代码
public function init()
{
    //parent::init();
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/my.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/css/my.js');
}


新增：
在控制层，还可以在ActionIndex中引入，而且还可以引入别的module文件夹中的js/css文件。甚至是任意文件夹下的js/css文件
Php代码
public function actionIndex(){
        $modify,$reg = some_value;
        $js = $this->renderFile($this->getInstallViewPath(). '/asset/install.js',array('reg_mp'=>$reg), true);
        $js = $this->renderFile($this->getViewPath() . '/assets/install_params.js', array('modify' => $modify), true);

        $cs = Yii::app()->clientScript;
        $cs->registerScript('asset/install', $js, CClientScript::POS_END);
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/launch_feed.css');
        $cs->registerScript('assets/install_params',$js,CClientScript::POS_END);
        $cs->registerScriptFile(Yii::app()->baseUrl . '/resources/jquery.form.js');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/install_params.css');

        $this->render('xxx');



	// demo
    Yii::app()->clientScript->registerScript('appConfig', "
    $(function() {
    $('img[lazy-src]:visible').imglazyload({fadeIn:true});
    $( 'img[lazy-src]' ).one( 'lazyload', function(){
    $(this).imglazyload({fadeIn:true});
    });
    $().find('img').trigger('lazyload');
    });
    try {
    if (self.location != top.location) {
    top.location = self.location;
    }
    } catch (e) {
    }
    ",CClientScript::POS_END);
		



    }

public function getInstallViewPath() {
        return $this->getModule()->getBasePath().'/../operations/views';
}



五-3、在../layouts/main.php中引入
1，直接引入

Html代码
<!-- css -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
<!-- 图片 -->
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/autocomplete/indicator.gif" />
<!-- js -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>


2，yii方式引入
Html代码
<?php
<!-- （一）简单用法 -->
<!-- js -->
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/jqueryui/jquery-ui.min.js", CClientScript::POS_END);


<!-- （二）复杂用法 -->
if($this->user->id) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('/account/info', array('format' => 'js')), CClientScript::POS_END);
    }

    if($this->user->id) {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->createUrl('site/baseJs'));
    }
?>


批注：在yii运行后，第一种在head中，第二种在body最后面，显然后者效率更高。但必须加载的js和css有必要写在head中。

3，区别
批注：至于为什么会有/assets/b729ab/js/jquery.js这样的文件生成，还在继续探索中。

=========================
六、YII 验证码使用：action:actionContact | model:ContactForm | render:contact | url:http://localhost:8093/new.php?r=site/contact
=========================

七、Yii里获取当前controller和action的id：
1>、 获取控制器名
在控制器中获取控制器名:  $name = $this->getId();
在视图中获取控制器名:    $name = Yii::app()->controller->id;

2>、 获取动作名
在控制器beforeAction()回调函数中获取动作名:  $name = $action->id;
在其他地方获取动作名:      $name = $this->getAction()->getId();

3>、YII 获取 controller id / module id / action id
Yii::app()->controller->module->id
Yii::app()->controller->id
Yii::app()->controller->action->id

=========================

八、Yii中的页面跳转与传值
1>、在同一个Controller中页面跳转

      $this->render('view页面',array('参数'=>'值'));

      $this->render('news',array('result'=>'123','result1'=>'456'));

      url重定向   $this->redirect(array('action方法'));

      $this->redirect(array('getnews','id'=>1,,,,));

2>、在不同的Controller中页面跳转

      $this->redirect(array('跳转到的controller/跳转到的controller里的action','参数'=>'值',,,,));

      $this->redirect(array('user/getuser','id'=>1));

3>、Yii框架学习笔记 - $this->redirect与$this->createUrl 的路由设置
4>、$this->redirect('http://www.b5m.com/404.html');
=========================




九、YII  请求：
Yii::app()->request->getParam('dataid')  // YII GET请求
$this->request->isAjaxRequest // 判断是否 ajax请求
=========================




十、YII 缓存使用：

1>、文件缓存：
2>、memcache 等扩展缓存
3>、DB缓存
=========================


十一、YII 引入 CSS/JS代码  & 注册 CSS/JS 片段
引入 CSS/JS文件
PHP代码：
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . "/js/TableView.js");
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/css/datechooser.css");
[
全部参数一览：
CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.
CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.
CClientScript::POS_END : the script is inserted at the end of the body section.
CClientScript::POS_LOAD : the script is inserted in the window.onload() function.
CClientScript::POS_READY : the script is inserted in the jQuery's ready function.
]
注册 CSS/JS片段：
//注册JS代码
$cs->registerScript('f1','var chart;');
// b5m_demo
Yii::app()->clientScript->registerScript('cdnUrl', 'var cdnUrl="'.Yii::app()->params['cdnUrl'].'";', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCss('cdnUrl', '.class{font:14px;color:red;margin-top:20px;}', CClientScript::POS_HEAD);
引入 jQuery核心部件：
Yii::app()->clientScript->registerCoreScript('jquery');

获取客户端 js：
$cs = Yii::app()->getClientScript();

//插入meta信息
Yii::app()->clientScript->registerMetaTag('keywords','关键字');
Yii::app()->clientScript->registerMetaTag('description','一些描述');
Yii::app()->clientScript->registerMetaTag('author','作者');
=========================

十二、YII 其他常用操作：
//YII framework路径
Yii::getFrameworkPath();

//protected/runtime
Yii::app()->getRuntimePath();

//protected/venders目录
Yii::import('application.venders.*');

//在view中得到当前controller的ID方法：
Yii::app()->getController()->id;

//在view中得到当前action的ID方法
Yii::app()->getController()->getAction()->id;

//yii获取ip地址
Yii::app()->request->userHostAddress;

//yii判断提交方式
Yii::app()->request->isPostRequest;

//得到当前域名:
Yii::app()->request->hostInfo;

//得到proteced目录的物理路径
YII::app()->basePath;

//获得上一页的url以返回
Yii::app()->request->urlReferrer;

//得到当前url
Yii::app()->request->url;

//得到当前home url
Yii::app()->homeUrl;

//得到当前return url
Yii::app()->user->returnUrl

//项目路径
dirname(Yii::app()->BasePath);

//create Url
$this->createUrl('urlBoyLeeTest');

# 成功信息提示
Yii::app()->user->setFlash('success', "Thinks saved success!");

# 错误信息提示
Yii::app()->user->setFlash('error', "here has an Error, Please check that!");

# 一般消息信息提示
Yii::app()->user->setFlash('notice', "messge here");
=========================

十二：YII判断 ajax请求

Yii::app()->getRequest()->getIsAjaxRequest()  返回 true or false
Yii::app()->request->isAjaxRequest   是否ajax请求
=========================

十三：Yii-contoller里调用其他contoller & action
1、一个contoller里怎么调用另一个controller里的action，Acontoller调用SiteContoller的actionShow($id)
带参数
$control=Yii::app()->runController('site/show/id/2');
或者不带参数
$control=Yii::app()->runController('site/show');
2、
$this->redirect(array('/site/contact','id'=>12));
//http://www.localyii.com/testwebap/index.php?r=site/contact&id=12

$this->redirect(array('site/contact','id'=>'idv','name'=>'namev'));
//http://www.localyii.com/testwebap/index.php?r=site/contact&id=idv&name=namev

$this->redirect(array('site/contact','v1','v2','v3'));
//http://www.localyii.com/testwebap/index.php?r=site/contact&0=v1&1=v2&2=v3

$this->redirect(array('site/contact','v1','v2','v3','#'=>'ttt'));
//带anchor的  http://www.localyii.com/testwebap/index.php?r=site/contact&0=v1&1=v2&2=v3#ttt

=========================


十四： YII renderpartial 片段试图：

yii中的render、renderPartial、renderText区别


=========================

十五：YII 获取客户端信息之 获取客户端IP

Yii::app()->request->userHostAddress;


=========================

十六：Yii的常用URL

当前页面url  Yii::app()->request->url;
跳转前一个页面url $this->redirect(Yii::app()->request->urlReferrer);
根目录URL Yii::app()->baseUrl 或 Yii::app()->request->baseUrl;
自定义URL $this->createUrl('post/read',array('id'=>100))或Yii::app()->createUrl();

如果浏览器重定位到登录页面，而且登录成功，我们将重定位浏览器到引起验证失败的页面。我们怎么知道这个值呢？我们可以通过用户部件的returnUrl 属性获得。我们因此可以用如下执行重定向：
Yii::app()->request->redirect(Yii::app()->user->returnUrl);
当前域名  Yii::app()->request->hostInfo;
除域名外的URL  Yii::app()->request->getUrl();
除域名外的首页地址  Yii::app()->user->returnUrl;
除域名外的根目录地址  Yii::app()->homeUrl;
Yii::app()->request->baseUrl


Yii获取IP地址：Yii::app()->request->userHostAddress;
Yii判断提交方式：Yii::app()->request-isPostRequest;
proteced目录的物理路径：Yii::app()->basePath;
获取上一页的url以返回：Yii::app()->request->urlReferrer;
获取当前控制器ID：Yii::app()->getController()->getAction()->id;
项目路径：dirname(Yii::app()->BasePath);
Yii获取ip地址：Yii::app()->request->userHostAddress;
Yii获取get,post过来的数据：Yii::app()->request->getParam('id');


Yii如何设置时区：
可以在config/main.php里'timeZone'=>'Asia/Chongqing',设定时区

Yii如何将表单验证提示弄成中文：
将main.php 里的app配置加上language=>'zh_cn',系统默认的提示就是中文的。

防止重复提交：Ccontroler->refresh();


=========================

十七：YII 数据库操作

[DAL、DAO、ORM、Active Record辨析 |(ORM[对象关系映射]|AR)]  -->概念理解[数据库]

[CURD操作：]


YII 数据库查询函数 list：
[
$model = ZdmArticle::model()->findByPk($id);    //按照主键,id为主键  |查询不到数据返回 NULL
$model = ZdmArticle::model()->findByAttributes(array('id' => $id,'channel_id'=>$channel_id, 'status' => 1));    //按照指定条件查询,channel_id为表中字段  |查询不到数据返回 NULL
Member::model()->findAllByAttributes(array(),array('select' => 'login_name'));   //查询member表中指定字段,本例查询login_name字段
]


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


---
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



=========================

十八：YII SQL调试：

1>、配置文件中开启：
'log' => array(
      'class' => 'CLogRouter',
      'routes' => array(
          array(
              'class' => 'CFileLogRoute',
              'levels' => 'error, warning',
          ),
          // uncomment the following to show log messages on web pages
          // YII open mysql sql debug 
          array(
              'class' => 'CWebLogRoute',
          ),
      ),
  ),

=========================

十九：YII 创建[初始化]项目：[命令行方式|{windows平台}]

解压并更名yii后保存到D:\b5m\newb5m\目录，
系统环境变量添加以下
C:\wamp\bin\php\php5.3.13; D:\b5m\newb5m\yii\framework
一个是php.exe的目录位置，一个是yii框架的目录位置

打开D:\b5m\newb5m\yii\framework，找到yiic.bat，修改其中的php.exe为C:\wamp\bin\php\php5.3.13\php.exe

cmd进入D:\b5m\newb5m\yii\framework
运行yiic webapp ../../  [yiic webapp ./tuan3]
即可在D:\b5m\newb5m\下生成对应框架文件

注：php.exe，框架路径和项目路径请自行修改

---

zs:
打开D:\b5m\newb5m\yii\framework，找到yiic.bat，修改其中的php.exe为C:\wamp\bin\php\php5.3.13\php.exe
yiic webapp ./tuan3
{
    zs-20140213
    |
    D:\wamp\www\yii>yiic webapp ../cms/ad
    |
    {
        yiic.bat | 版本：yii-1.1.14
        @echo off

        rem -------------------------------------------------------------
        rem  Yii command line script for Windows.
        rem
        rem  This is the bootstrap script for running yiic on Windows.
        rem
        rem  @author Qiang Xue <qiang.xue@gmail.com>
        rem  @link http://www.yiiframework.com/
        rem  @copyright 2008 Yii Software LLC
        rem  @license http://www.yiiframework.com/license/
        rem  @version $Id$
        rem -------------------------------------------------------------

        @setlocal

        set YII_PATH=%~dp0

        if "%PHP_COMMAND%" == "" set PHP_COMMAND=D:\xampp\php\php.exe

        "%PHP_COMMAND%" "%YII_PATH%yiic" %*

        @endlocal
    }
}

=========================

20、YII缓存机制：
YII缓存机制.doc

=========================




=========================











