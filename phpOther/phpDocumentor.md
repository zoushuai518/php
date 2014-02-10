phpDocumentor: [文档自动生成工具]

PHPDocumentor是一个用PHP写的工具，对于有规范注释的php程序，它能够快速生成具有相互参照，索引等功能的API文档。老的版本是phpdoc，从1.3.0开始，更名为phpDocumentor，新的版本加上了对php5语法的支持，同时，可以通过在客户端浏览器上操作生成文档，文档可以转换为PDF,HTML,CHM几种形式，非常的方便

#====
download url
http://www.phpdoc.org/
#====

安装 phpDocumentor:
和其他pear下的模块一样，phpDocumentor的安装也分为自动安装和手动安装两种方式，两种方式都非常方便：
a.通过pear 自动安装
在命令行下输入
pear install PhpDocumentor
b.手动安装
在http://manual.phpdoc.org/下载最新版本的PhpDocumentor（现在是1.4.0），把内容解压即可。

#====
使用 phpDocumentor生成文档：
命令行方式：
在phpDocumentor所在目录下，输入
phpdoc ?h
会得到一个详细的参数表，其中几个重要的参数如下：
-f 要进行分析的文件名，多个文件用逗号隔开
-d 要分析的目录，多个目录用逗号分割
-t 生成的文档的存放路径
-o 输出的文档格式，结构为输出格式：转换器名：模板目录。
例如：phpdoc -o HTML:frames:earthli -f test.php -t docs
Web界面生成
在新的phpdoc中，除了在命令行下生成文档外，还可以在客户端浏览器上操作生成文档，具体方法是先把PhpDocumentor的内容放在apache目录下使得通过浏览器可以访问到，访问后显示如下的界面：
点击files按钮，选择要处理的php文件或文件夹，还可以通过该指定该界面下的Files to ignore来忽略对某些文件的处理。
然后点击output按钮来选择生成文档的存放路径和格式.
最后点击create，phpdocumentor就会自动开始生成文档了，最下方会显示生成的进度及状态，如果成功，会显示
Total Documentation Time: 1 seconds
done
Operation Completed!!
然后，我们就可以通过查看生成的文档了，如果是pdf格式的，名字默认为documentation.pdf。


#====
文档标记的使用范围是指该标记可以用来修饰的关键字，或其他文档标记。
所有的文档标记都是在每一行的 * 后面以@开头。如果在一段话的中间出来@的标记，这个标记将会被当做普通内容而被忽略掉。
@access
使用范围：class,function,var,define,module
该标记用于指明关键字的存取权限：private、public或proteced
@author
指明作者
@copyright
使用范围：class，function，var，define，module，use
指明版权信息
@deprecated
使用范围：class，function，var，define，module，constent，global，include
指明不用或者废弃的关键字
@example
该标记用于解析一段文件内容，并将他们高亮显示。Phpdoc会试图从该标记给的文件路径中读取文件内容
@const
使用范围：define
用来指明php中define的常量
@final
使用范围：class,function,var
指明关键字是一个最终的类、方法、属性，禁止派生、修改。
@filesource
和example类似，只不过该标记将直接读取当前解析的php文件的内容并显示。
@global
指明在此函数中引用的全局变量
@ingore
用于在文档中忽略指定的关键字
@license
相当于html标签中的<a>,首先是URL，接着是要显示的内容
例如<a href=”http://www.baidu.com”>百度</a>
可以写作 @license http://www.baidu.com 百度
@link
类似于license
但还可以通过link指到文档中的任何一个关键字
@name
为关键字指定一个别名。
@package
使用范围：页面级别的-> define，function，include
类级别的->class，var，methods
用于逻辑上将一个或几个关键字分到一组。
@abstrcut
说明当前类是一个抽象类
@param
指明一个函数的参数
@return
指明一个方法或函数的返回值
@static
指明关建字是静态的。
@var
指明变量类型
@version
指明版本信息
@todo
指明应该改进或没有实现的地方
@throws
指明此函数可能抛出的错误异常,极其发生的情况
上面提到过，普通的文档标记标记必须在每行的开头以@标记，除此之外，还有一种标记叫做inline tag,用{@}表示，具体包括以下几种：
{@link}
用法同@link
{@source}
显示一段函数或方法的内容
