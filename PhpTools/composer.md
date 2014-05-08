Composer PHP依赖管理器:Composer是一个管理PHP包依赖关系的工具。我们可以使用Composer方便地管理项目中一些第三方库和自己的库
#===

Composer Install
官方URL:
http//getcomposer.org
zs:参考 https://github.com/zoushuai518/linux/blob/master/ubuntu/php-composer.me

PHP依赖管理器：Composer 入门

原文： http://getcomposer.org/doc/00-intro.md
简介
composer是PHP中的一个依赖关系管理工具。只要（按指定格式）声明项目所依赖的库，composer就可以为我们安装这些库。
依赖关系管理
composer不是包管理器。不错，它处理“包”或库，但他的管理基于单个项目，它把库安装到项目中的一个目录中（例如：vendor）。缺省情况下，composer从不在全局范围安装任何东西。因此，composer是一个依赖关系管理器。
这并不是种全新的思想，composer受到node的npm和ruby的bundler的启发。但对PHP来说，还没有这样的工具。

composer要解决的问题是：
	我们有一个项目，依赖好几个库。
	这些库中某些又依赖于别的库。
	我们声明我们依赖的库
	composer找到需要安装哪个包的哪个版本，并安装（这意味着composer把他们下载到我们的项目中）。

声明依赖关系
假定我们创建了一个项目，需要一个库做日志记录。我们决定使用monolog。为了把monolog加到项目中，我们只需要创建一个描述项目依赖关系的文件composer.json。
{
    "require": {
        "monolog/monolog": "1.0.*"
   }
}
这里只需简单地说明我们的项目需要某个monolog/monolog包，以1.0开始的任何版本都可以。

安装
本地下载
要获取composer，我们需要做两件事。第一件是安装composer（再说一遍，把它下载到我们的项目目录中）：
$ curl -s https://getcomposer.org/installer | php
这个命令会检查PHP的几个设置然后把composer.phar下载到我们的工作目录。这个文件是composer程序。它是一个PHAR（PHP archive），PHAR是PHP的一种文档格式，可以在命令行运行。
通过--install-dir选项，可以把composer安装到指定目录中（可以是绝对路径，也可以是相对路径）：
$curl -s https://getcomposer.org/installer | php -- --install-dir=bin
|
全局下载
这个文件可以放在任何地方。如果把它放在PATH指定的路径中，就可以全局访问了。在unix类的系统中上，可以把它变成可执行文件，运行时可以不指定php。
$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
然后，运行composer时只需运行composer。
使用composer


下一步，运行install命令来解析和下载依赖库：
php composer.phar install
这个命令会把monolog下载到vendor/monolog/monolog目录中。
自动加载
除了下载库之外，composer还准备了一个自动加载文件，可以自动加载它下载的库中的所有类。要使用自动加载，只要在代码的引导过程中加上：
require 'vendor/autoload.php';
好了，开始使用monolog吧！要学习composer的更多知识，请阅读“基本用法”一章。

#===

Composer Use

{
	#zs:
	可以通过 composer查看是否安装成功;composer --help使用帮助

}

Use Demo:
Composer的基本使用:{http://php-xx.diandian.com/post/2013-01-21/40047224779}

在项目中使用composer.json

在项目中使用composer，你需要有一个composer.json文件，此文件的作用主要用来声明包之间的相互关系和其他的一些元素标签。

require 关键字
第一件事情在composer.json就是使用require关键字了，你将告诉composer哪些包是你项目所需要的
{
    "require": {
        "monolog/monolog": "1.0.*"
    }
}

如你所见，require的对象将会映射包的名称（ monolog/monolog）和包的版本是1.0.*

包的命名
基本上包的命名是 主名/项目名称（ monolog/monolog），主名必须唯一，但是项目也就是我们的包的名称可以有相同的，例如: igorw/json,和seldaek/json

包的版本
我们需要使用monolog的版本是1.0.*，他的意思是只要版本是1.0分支即可，例如1.0.0，1.0.2或者1.0.99
版本定义的两种方式：
标准的版本：定义保准的版本包文件，如：1.0.2
一定范围的版本：使用比较符号来定义有效的版本的范围，有效的符号有>, >=, <, <=, !=
通配符：特别的匹配符号*，例如1.0.*就相当于>=1.0,<1.1版本的即可
下一个重要的版本：~符号最好的解释就是，~1.2就相当于>1.2,<2.0，但~1.2.3就相当于>=1.2.3,<1.3版本。

安装包
在项目文件路径下运行
$ composer install
这样子他会自动下载monolog/monolog文件到你的vendor目录下面。

接下来需要说明一件事情就是
composer.lock - 锁定文件

在安装完所有需要的包之后，composer会生成一张标准的包版本的文件在composer.lock文件中。这将锁定所有包的版本。
使用composer.lock（当然是和composer.json一起）来控制你的项目的版本
这一点非常的重要，我们使用install命令来处理的时候，它首先会判断composer.lock文件是否存在，如果存在，将会下载相对应的版本(不会在于composer.json里面的配置)，这意味着任何下载项目的人都将会得到一样的版本。
如果不存在composer.lock，composer将会通过composer.json来读取需要的包和相对的版本，然后创建composer.lock文件
这样子就可以在你的包有新的版本之后，你不会自动更新了，升级到新的版本，使用update命令即可，这样子就能获取最新版本的包并且也更新了你的composer.lock文件。

$ php composer.phar update
或者
$ composer update

Packagist（这应该就是composer，感觉有点像python的包，虽然没那么强大，呵呵，有了这种标准以后，以后大家开发网站绝对会很轻松，可以借鉴很多人的代码了，并且更加方便了！）

Packagist是composer的主要仓库，大家可以去看看，composer仓库的基础是包的源码，你可以随意的获取，Packagist的目的建成一个任何人都可以使用的仓库，这就意味着在你的文件中任意的require包了。

关于自动加载
为了方便的加载包文件，Composer自动生成了一个文件 vendor/autoload.php，你可以方便只有的使用它在任何你需要使用的地方
require 'vendor/autoload.php';
这意味着你可以非常非常方便的使用第三方代码了，假设你的项目需要使用monlog，你直接使用吧，他们都已经自动加载了的!
$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('app.log', Monolog\Logger::WARNING));

$log->addWarning('Foo');
当然你也可以在composer.json中加载自己的代码：
{
    "autoload": {
        "psr-0": {"Acme": "src/"}
    }
}
composer将会把psr-0注册为Acme的命名空间
你可以定义一个映射通过命名空间到文件目录，src目录是你的根目录，vendor是同一级别的目录，例如一个文件为：src/Acme/Foo.php就包含了Acme\Foo类
当你在增加autoload之后，你必须要重新install来生成vendor/autoload.php文件
在我们引用此文件的时候，将会返回一个autoloader类的实力，所以你可以把返回的值放入一个变量，然后在增加更多的命名空间，如果在开发环境下这是非常方便的，例如：
$loader = require 'vendor/autoload.php';
$loader->add('Acme\Test', __DIR__);

