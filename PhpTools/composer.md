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



