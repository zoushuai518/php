

YII 使用 & Debug


一、YII CHtml类的使用   -->| zs  20130912
=========================
二、YII yiilite.php 文件分析 -->| zs  20130912
=========================
三、YII 抛出一个异常  throw new CException   -->| zs  20130912
=========================
四、在视图层（../views/..）注册CSS文件或JavaScript文件 | [YII 引入 js/css文件]
{

	{
		全部参数一览：
			CClientScript::POS_HEAD : the script is inserted in the head section right before the title element.
			CClientScript::POS_BEGIN : the script is inserted at the beginning of the body section.
			CClientScript::POS_END : the script is inserted at the end of the body section.
			CClientScript::POS_LOAD : the script is inserted in the window.onload() function.
			CClientScript::POS_READY : the script is inserted in the jQuery's ready function.
	}
	{
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
	}

	{
		// b5m_demo
		Yii::app()->clientScript->registerScript('cdnUrl', 'var cdnUrl="'.Yii::app()->params['cdnUrl'].'";', CClientScript::POS_HEAD);
		Yii::app()->clientScript->registerCss('cdnUrl', '.class{font:14px;color:red;margin-top:20px;}', CClientScript::POS_HEAD);
		//获取客户端 js：
		$cs = Yii::app()->getClientScript();
		//插入meta信息
		Yii::app()->clientScript->registerMetaTag('keywords','关键字');
		Yii::app()->clientScript->registerMetaTag('description','一些描述');
		Yii::app()->clientScript->registerMetaTag('author','作者');
	}

	{
		4-1、引入jquery核心部件
			Php代码
			Yii::app()->clientScript->registerCoreScript('jquery');
		批注：不论在页面中的何种位置引用，最终yii会将jquery.js文件放入yii的assets文件夹下。即/projectName/assets/82qg58/jquery-1.6.1.min.js。
	}

	{
		4-2、在控制层(../controllers/xxController.php)添加CSS文件或JavaScript文件
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
						",CClientScript::POS_END
						);


			}

		public function getInstallViewPath() {
			return $this->getModule()->getBasePath().'/../operations/views';
		}
	}

}

五、YII 验证码使用：action:actionContact | model:ContactForm | render:contact | url:http://localhost:8093/new.php?r=site/contact
=========================

六、Yii里获取当前controller和action的id：
{
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
}

=========================

七、Yii中的页面跳转与传值
{
	1>、在同一个Controller中页面跳转

		$data = array();
	$data['nav']= $nav;
	$data['footer']= $footer;
	$this->render('view页面',$data));

	$this->render('news',array('result'=>'123','result1'=>'456'));

	url重定向   $this->redirect(array('action方法'));

	$this->redirect(array('getnews','id'=>1,,,,));

	2>、在不同的Controller中页面跳转

		$this->redirect(array('跳转到的controller/跳转到的controller里的action','参数'=>'值',,,,));

	$this->redirect(array('user/getuser','id'=>1));

	3>、Yii框架学习笔记 - $this->redirect与$this->createUrl 的路由设置
		4>、$this->redirect('http://www.b5m.com/404.html');
}
=========================


八、YII  请求：
{
	Yii::app()->request->getParam('dataid',NULL)  // YII GET请求
	$this->request->isAjaxRequest // 判断是否 ajax请求
}
=========================


九、YII 缓存使用：
{
	1>、文件缓存：
	2>、memcache 等扩展缓存
	3>、DB缓存
}
=========================

十、YII 其他常用操作：
{
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

	//得到当前return url
	Yii::app()->user->returnUrl

	//项目路径
	dirname(Yii::app()->BasePath);

	//create Url
	$this->createUrl('urlBoyLeeTest');

	//成功信息提示
	Yii::app()->user->setFlash('success', "Thinks saved success!");

	//错误信息提示
	Yii::app()->user->setFlash('error', "here has an Error, Please check that!");

	//一般消息信息提示
	Yii::app()->user->setFlash('notice', "messge here");

	//YII判断 ajax请求
	Yii::app()->getRequest()->getIsAjaxRequest()  返回 true or false
	Yii::app()->request->isAjaxRequest   是否ajax请求

	//Yii的常用URL
	跳转前一个页面url $this->redirect(Yii::app()->request->urlReferrer);
	根目录URL Yii::app()->baseUrl 或 Yii::app()->request->baseUrl;
	如果浏览器重定位到登录页面，而且登录成功，我们将重定位浏览器到引起验证失败的页面。我们怎么知道这个值呢？我们可以通过用户部件的returnUrl 属性获得。我们因此可以用如下执行重定向：
	Yii::app()->request->redirect(Yii::app()->user->returnUrl);
	当前域名  Yii::app()->request->hostInfo;
	除域名外的URL  Yii::app()->request->getUrl();
	除域名外的首页地址  Yii::app()->user->returnUrl;
	除域名外的根目录地址  Yii::app()->homeUrl;

	Yii如何设置时区：
	可以在config/main.php里'timeZone'=>'Asia/Chongqing',设定时区

	Yii如何将表单验证提示弄成中文：
	将main.php 里的app配置加上language=>'zh_cn',系统默认的提示就是中文的。

	防止重复提交：Ccontroler->refresh();
}
=========================

十一：Yii-contoller里调用其他contoller & action
{
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
}
=========================


十二： YII renderpartial 片段试图：
{
	yii中的render、renderPartial、renderText区别
}

=========================

十三：YII 数据库操作
{
	#zs 2014-02-19 查看 ./DB
	[DAL、DAO、ORM、Active Record辨析 |(ORM[对象关系映射]|AR)]  -->概念理解[数据库]

	[CURD操作：]

	YII 数据库查询函数 list：
	持续更新......
}

=========================

十四：YII 配置：

1>、开启SQL联调：
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

十五：YII 创建[初始化]项目：[命令行方式|{windows平台}]

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

#zs:
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

十六、YII缓存机制：
{
	#zs 2014-02-19 查看 ./Cache
}

=========================



=========================











