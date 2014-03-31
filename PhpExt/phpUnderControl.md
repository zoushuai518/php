phpUnderControl:
CruiseControl插件 phpUnderControl]
phpUnderControl 是持续构建工具CruiseControl的一个插件。提供一个代码浏览器用于浏览经过着色的PHP源代码和查看由PHPUnit、PHP_CodeSniffer、CPD、Padawan等质量保证工具发现并经着色的错误源代码

#====
安装/使用：[仅供参考]

一.phpUnderControl介绍

    phpUnderControl 是持续构建工具CruiseControl的一个插件。提供了统一的界面管理查看由PHPUnit、PHP_CodeSniffer、CPD、Padawan等质量保证工具发现并经着色的错误源代码。
    
    CruiseControl简介 ：
    简称 CC ，持续集成工具，主要提供了基于版本管理工具 ( 如 CVS、VSS、SVN) 感知变化或每天定时的持续集成，并提供持续集成报告、 Email 、 Jabber 等等方式通知相关负责人，其要求是需要进行日构建的项目已编写好全自动的项目编译脚本 ( 可基于 Maven 或 Ant) 。

二、phpundercontol下工具集合:

1.PHPDocumentor
文档工具phpdoc

2.PHPUnit pear
单元测试 phpunit

3.PHP_CodeSniffer
代码风格测试工具

4.phpcpd 
扫描重复的代码 

5.pdepend 
用来检查你的PHP项目中的代码规模和复杂程度 

6.phpmd 
是基于pdepend的结果进行分析，分析出一旦你的PHP项目超过了pdepend中各具体指标值的规定，从而发出警告提示信息


三、phpdoc

phpDocumentor是PEAR下面的一个非常优秀的模块，它的目标是实现类似javadoc的功能，可以为你的代码快速生成具有相互参照,索引等功能的API文档。

1.phpdoc安装
# tar xzvf PhpDocumentor-1.4.3.tgz
# mv PhpDocumentor-1.4.3 /usr/local/php-5.3.5/lib/php/PhpDocumentor
# ln -s /usr/local/php-5.3.5/lib/php/PhpDocumentor/phpdoc /usr/local/bin/

在php.ini加入include_path
/usr/local/php-5.3.5/lib/php/PhpDocumentor

2.使用方法
# phpdoc -h

-f 要分析的目录，多个目录用逗号分割,可以包含目录和* ?通配符
-d 要分析的目录，多个目录用逗号分割
-t 生成的文档的存放路径
-o 输出的文档格式

example:

<?php
function getUser($id) {
    return array();
}

?>

# phpdoc -f 1.php -t /home/www/phpdoc/

http://localhost/phpdoc/

# phpdoc -d /home/www/phptest -t /home/www/phpdoc/


输出格式:
HTML:frames:default ,html默认格式
HTML:Smarth:default ,Smarty模板格式
CHM:default:default ,Windows帮助文件格式
PDF:default:default ,PDF格式

example:
# phpdoc -d /home/www/phptest -t /home/www/phpdoc/ -o HTML:frames:phpedit

# phpdoc -d /home/www/v2/app-aifang-core,/home/www/v2/app-aifang-web -t /home/www/phpdoc/

中文乱码问题处理:
将所有模板编码iso-8859-1改为UTF-8

# sed -i 's/iso-8859-1/UTF-8/g' `grep iso-8859-1 -rl /usr/local/php-5.3.5/lib/php/PhpDocumentor/phpDocumentor/Converters`

为防止check代码过多的解决:
设置运行时间 index.php
set_time_limit(0);

修改内存大小:
php.ini中把memory_limit = 128M

3.常用标签:
http://manual.phpdoc.org/HTMLSmartyConverter/HandS/phpDocumentor/tutorial_inlinetags.pkg.html

@access 描述了访问级别,在phpdoc中,用它可以略去私有成员的文档生成
@author 作者信息
@copyright 版权所有者
@const 由define定义的常量
@deprecate 不建议使用的API
@example 引用一个例子
@filesource 希望让文件源出现在文档中
@global 全局变量
@ignore  通知解析器忽略这个元素,并不将它包含在文档中
@internal 隐藏特定的信息,使之不出现在公共文档中
@license  授权信息的url
@link     在文档中包含链接
@package 包信息
@param 函数参数
@return 返回的数据类型
@see 参考函数
@since 引入时间
@static 静态变量
@source 部分源代码内容
@todo 待完成的工作信息
@var 类成员变量
@version 当前版本

四、PHP_CodeSniffer
代码风格

1.安装

# wget http://download.pear.php.net/package/PHP_CodeSniffer-1.3.0.tgz

解压
修改php.ini将PHP_CodeSnoffer目录加入include_path

2.使用:
# phpcs --report=checkstyle --report-file=${basedir}/build/logs/checkstyle.xml --standard=PEAR /home/www/v2


五、phpcpd
重复代码探测器

1.安装
# git clone https://github.com/sebastianbergmann/phpcpd .

phpcpd目录加入到php.ini的include_path

2.使用:
# phpcpd --log-pmd pmd.xml v2/app-aifang-core/classes/

六、pdepend
检查PHP项目中的代码规模和复杂程度。

1.安装
# git clone git://github.com/manuelpichler/pdepend.git
# sudo ln -s /home/alan/tmp/pdepend/src/bin/pdepend.php /usr/local/bin/pdepend

2.使用方式

# pdepend --summary-xml=pdepend/summary.xml --jdepend-chart=pdepend/jdepend.svg --overview-pyramid=pdepend/pyramid.svg v2/app-aifang-core/

--jdepend-chart 分析包图
--overview-pyramid  概述与金字塔图表分析项目
--summary-xml 生成一个与所有指标XML日志
--configuration PHP_Depend 配置文件
--exclude       不包含的目录

overview-pyramid 金字塔图:
概述金字塔 类继承，耦合，尺寸和复杂性衡量标准

1)、Size and Complexity:
NOP -Number Of Pachages 包数量
NOC -Number Of Classes  类数量
NOM -Number Of Methods  方法数量
LOC -Lines Of Code (all non whitespace lines and all non comment lines) 代码行数
CYCLO -圈复杂度

CYCLO/LOC 从下往上除,放到金字塔两边

圈复杂度大说明程序代码可能质量低且难于测试和维护，根据经验，程序的可能错误和高的圈复杂度有着很大关系
也即每个ELSEIF语句，以及每个CASE语句，都应该算为一个判定节点

2)、耦合
CALLS -函数和方法调用
FANOUT -提供了关于类和接口引用类型的信息

3)、继承
ANDC -Average Number of Derived Classes 
      平均每个类,派生类的数量
AHH -平均层次高 指标是一个继承层次结构的平均深度

4).抽象/不稳定图表

OO设计质量度量 - 一种依赖关系分析

I - Instability 不稳定 Y
A - Abstractness 抽象  X

它显示了你的设计的可扩展性，可重用性和可维护性方面的质量。所有这些事实都受到跨包的依赖关系和包抽象PHP_Depend在抽象/不稳定图表的形式形象化。

传入: 
这个包中的类依赖其他包的数量,这个值是很好的指标如何在这个包中的类的变化将影响该软件的其他部分。

传出:
其他的包，从这个包中的类取决于数量,这个值表示这个包的敏感程度对其他包的变化。


I
传出耦合（CE）和总包耦合（CE+Ca），这是基于以下公式（CE/（CE+ CA）），
并产生结果的范围比[0,1]。 
A值I =0表示包，最大限度地稳定在任何依赖和I =1表示总不稳定的包依赖关系，但没有传入呼吁其他软件包依赖。


A
之间的抽象类（AC）和所有类（AC+ CC），由这个公式计算出总的比例（AC/（AC+ CC）），在一个范围值的结果[0,1]。 A =0意味着在这个包中的所有类的非抽象,而A=1显示了一个包，只有抽象类和接口组成。


D - Distance: ((A + I) - 1) 越大越好

A=1最优 I = 1 最优


参考值:
Metric      Low   Average High
CYCLO/LOC   0.16  0.20    0.24
LOC/NOM     7       10      13
NOM/NOC     4       7       10
NOC/NOP     6       17      26
CALLS/NOM   2.01    2.62    3.2
FANOUT/CALLS 0.56   0.62    0.68
ANDC        0.25    0.41    0.57
AHH         0.09    0.21    0.32

七、phpmd

PHP MESS DECTOR(简称PMD,项目地址http://phpmd.org/)，是基于pdepend的结果进行分析，分析出一旦你的PHP项目超过了pdepend中各具体指标值的规定，从而发出警告提示信息

1.安装
# git clone git://github.com/phpmd/phpmd.git
# sudo ln -s /home/alan/tmp/phpmd/src/bin/phpmd.php /usr/local/bin/phpmd

修改phpmd 
set_include_path  指向pdepend目录
dirname(__FILE__) . '/../../../pdepend/src/main/php' .

修改php.ini的include_path
/home/alan/tmp/phpmd/src/main/php

2.使用方式
使用pdepend中的4个规则codesize,unusedcode,naming,desgin去检查项目的代码

# phpmd [filename|directory] [report format] [ruleset file]

# phpmd /path/to/source text codesize,/my/rules.xml

--reportfile  输出文件
--exclude     不包含的目录

# phpmd phptest/ xml codesize,design,naming,unusedcode --reportfile phpmd/pmd.xml

# phpmd /path/to/source text codesize,/my/rules.xml

在 /src/main/resources/rulesets 里面写规则


规则写法:
require_once 'PHP/PMD/AbstractRule.php';
require_once 'PHP/PMD/Rule/IFunctionAware.php';

class Com_Example_Rule_NoFunctions
       extends PHP_PMD_AbstractRule
    implements PHP_PMD_Rule_IFunctionAware
{
    public function apply(PHP_PMD_AbstractNode $node)
    {
        $this->addViolation($node);
    }
}

八、phpunit

PHPUnit是一个轻量级的PHP测试框架。它是在PHP5下面对JUnit3系列版本的完整移植，是xUnit测试框架家族的一员(它们都基于模式先锋Kent Beck的设计)。
　　单元测试是几个现代敏捷开发方法的基础，使得PHPUnit成为许多大型PHP项目的关键工具。这个工具也可以被Xdebug扩展用来生成代码覆盖率报告 ，并且可以与phing集成来自动测试，最后它还可以和Selenium整合来完成大型的自动化集成测试。

1.安装
pear安装
install PEAR Version: 1.9.3:

# pear upgrade --force PEAR
# pear channel-discover pear.phpunit.de
# pear channel-discover components.ez.no
# pear channel-discover pear.symfony-project.com
# pear install phpunit/PHPUnit

2.使用
Demo.php
<?php
class Demo{

public function sum($a,$b){
    return $a+$b;
}

public function subtract($a,$b){
    return $a-$b;
}

}

?>

DemoTest.php
<?php
include("PHPUnit/Framework.php");
include(dirname(__FILE__)."/../code/Demo.php");

class DemoTest extends PHPUnit_Framework_TestCase{

public function testSum(){
$demo = new Demo();
$this->assertEquals(4,$demo->sum(2,2),'not eq');
//$this->assertNotEquals(2,$demo->sum(1,1));

}
}

?>

# phpunit DemoTest.php


--log-junit 生成测试报告
--coverage-html 生成HTML格式的代码覆盖率报告
--coverage-clover 生成XML格式的代码覆盖率报告
需要Xdebug 代码覆盖率报告

3.通过配置文件测试

<?xml version="1.0" encoding="UTF-8" ?>
<phpunit>
  <testsuites>
    <testsuite name="Object_Freezer">
      <directory suffix="Test.php">codetest</directory>              //目录
      <exclude>codetest/exclude</exclude>           //排除目录
      <file>codetest/DemoTest.php</file>        //文件
    </testsuite>
  </testsuites>
</phpunit>

目录下文件全部用*Test.php 文件

执行
# phpunit --configuration phpunit.xml /home/www/phpunit/

数据库连接方式:
<?xml version="1.0" encoding="UTF-8" ?>
<phpunit>
    <php>
        <var name="DB_DSN" value="mysql:dbname=myguestbook;host=localhost" />
        <var name="DB_USER" value="user" />
        <var name="DB_PASSWD" value="passwd" />
        <var name="DB_DBNAME" value="myguestbook" />
    </php>
</phpunit>

abstract class Generic_Tests_DatabaseTestCase extends PHPUnit_Framework_TestCase
{
    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    final public fucntion getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }
}

4.用到Xdebug
如何测试你的测试用例设计，答案是代码覆盖率。代码覆盖率即当你的一套测试用例执行完毕时，有多少比例的代码分支被覆盖到

xdebug安装:
# svn co svn://svn.xdebug.org/svn/xdebug/xdebug/trunk xdebug
# /usr/local/php-5.3.5/bin/phpize
# ./configure --with-php-config=/usr/local/php-5.3.5/bin/php-config --enable-xdebug
# make
# make install


九、phpUnderControl

CruiseControl
http://cruisecontrol.sourceforge.net/

phpUnderControl
http://phpundercontrol.org/index.html

1.安装:
CruiseControl源码直接解压 cruisecontrol-bin-2.8.4/

# tar xzvf cruisecontrol-bin-2.8.4.tar.gz
# git clone git://github.com/phpundercontrol/phpUnderControl.git
# phpUnderControl/bin/phpuc.php install cruisecontrol-bin-2.8.4/

# ln -s /home/alan/phpupdercontrol/phpUnderControl/bin/phpuc.php /usr/local/bin/phpuc


2.创建项目
# make projects/v2

projects/v2项目根目录下创建项目配置文件 build.xml:

#更新svn
<target name="checkout">
 <exec executable="svn" dir="${basedir}/source">
  <arg line="update" />
 </exec>
</target>

#创建日志目录
<target name="clean">
  <delete dir="build"/>
  <mkdir dir="${basedir}/build/api"/>
  <mkdir dir="${basedir}/build/coverage"/>
  <mkdir dir="${basedir}/build/logs"/>
  <mkdir dir="${basedir}/build/pdepend"/>
 </target>
 
 #设置phpdoc
 <target name="phpdoc">
  <exec executable="phpdoc">
   <arg line="-d /home/www -t ${basedir}/build/api" />
  </exec>
 </target>
 
 #设置phpcpd
<target name="phpcpd">
  <exec executable="phpcpd">
   <arg line="--log-pmd ${basedir}/build/logs/pmd-cpd.xml /home/www/v2" />
  </exec>
</target>

#设置pdepend
<target name="pdepend">
  <exec executable="pdepend">
   <arg line="--jdepend-xml=${basedir}/build/logs/jdepend.xml
              --jdepend-chart=${basedir}/build/pdepend/dependencies.svg
              --overview-pyramid=${basedir}/build/pdepend/overview-pyramid.svg
              /home/www/" />
  </exec>
 </target>
 
#设置phpmd
 <target name="phpmd">
  <exec executable="phpmd">
   <arg line="/home/www xml codesize,design,naming,unusedcode --reportfile ${basedir}/build/logs/pmd.xml" />
  </exec>
 </target>

#设置phpcs
<target name="phpcs">
  <exec executable="phpcs">
   <arg line="--report=checkstyle
              --report-file=${basedir}/build/logs/checkstyle.xml
              --standard=PEAR
              /home/www " />
  </exec>
 </target>

#设置phpunit
<target name="phpunit">
    <exec executable="phpunit" dir="${basedir}/source" >
      <arg line="--configuration ${basedir}/configuration.xml 
                 --log-junit ${basedir}/build/logs/junit.xml
                 --coverage-clover  ${basedir}/build/logs/phpunit.coverage.xml
                 --coverage-html ${basedir}/build/coverage " />
    </exec>
</target>


build.xml最终结果:

<?xml version="1.0" encoding="UTF-8"?>
<project name="v2" default="build" basedir=".">

<target name="checkout">
 <exec executable="svn" dir="${basedir}/source">
  <arg line="update" />
 </exec>
</target>
 
<target name="clean">
  <delete dir="build"/>

  <mkdir dir="${basedir}/build/api"/>
  <mkdir dir="${basedir}/build/coverage"/>
  <mkdir dir="${basedir}/build/logs"/>
  <mkdir dir="${basedir}/build/pdepend"/>
 </target>
 
 <target name="parallelTasks">
  <parallel>
   <antcall target="pdepend"/>
   <antcall target="phpmd"/>
   <antcall target="phpcpd"/>
   <antcall target="phpcs"/>
   <antcall target="phpdoc"/>
  </parallel>
 </target>

<target name="phpdoc">
  <exec executable="phpdoc">
   <arg line="-d /home/www -t ${basedir}/build/api" />
  </exec>
 </target>
 
<target name="phpcpd">
  <exec executable="phpcpd">
   <arg line="--log-pmd ${basedir}/build/logs/pmd-cpd.xml /home/www" />
  </exec>
</target>

<target name="pdepend">
  <exec executable="pdepend">
   <arg line="--jdepend-xml=${basedir}/build/logs/jdepend.xml
              --jdepend-chart=${basedir}/build/pdepend/dependencies.svg
              --overview-pyramid=${basedir}/build/pdepend/overview-pyramid.svg
              /home/www" />
  </exec>
 </target>
 
 <target name="phpmd">
  <exec executable="phpmd">
   <arg line="/home/www xml codesize,design,naming,unusedcode --reportfile ${basedir}/build/logs/pmd.xml" />
  </exec>
 </target>

<target name="phpcs">
  <exec executable="phpcs">
   <arg line="--report=checkstyle
              --report-file=${basedir}/build/logs/checkstyle.xml
              --standard=PEAR
              /home/www/v2/app-aifang-core " />
  </exec>
 </target>

<target name="phpunit">
    <exec executable="phpunit" dir="${basedir}/source" >
      <arg line="--configuration ${basedir}/configuration.xml 
                 --log-junit ${basedir}/build/logs/junit.xml
                 --coverage-clover  ${basedir}/build/logs/phpunit.coverage.xml
                 --coverage-html ${basedir}/build/coverage " />
    </exec>
</target>

<target name="build" depends="clean,parallelTasks,phpunit" />
</project>

测试导出:
#../../apache-ant-1.7.0/bin/ant phpcs

phpunit配置文件
configuration.xml:

<?xml version="1.0" encoding="UTF-8" ?>
<phpunit backupGlobals="true"
         backupStaticAttributes="false"
         colors="false"
         convertErrorsToExceptions="true"
         convertNoticesToExceptions="true"
         convertWarningsToExceptions="true"
         forceCoversAnnotation="false"
         mapTestClassNameToCoveredClassName="false"
         stopOnFailure="false"
         syntaxCheck="false"
         testSuiteLoaderClass="PHPUnit_Runner_StandardTestSuiteLoader"
         strict="false"
         verbose="false">
         
<testsuites>
    <testsuite name="Object_V2">
      <directory suffix="Test.php">./source</directory>
    </testsuite>
</testsuites>

</phpunit>

phpundercontrol配置文件

到cruisecontrol-bin-2.8.4/跟目录下

修改config.xml文件,加入新创建的v2项目:

<cruisecontrol>
    
<project name="v2" buildafterfailed="false">

<modificationset quietperiod="30">
         <filesystem folder="projects/${project.name}"/>
</modificationset>
 
  <listeners>
  <currentbuildstatuslistener file="logs/${project.name}/status.txt"/>
  </listeners>
  
<schedule interval="3000">
           <ant anthome="apache-ant-1.7.0" buildfile="projects/${project.name}/build.xml"/>
</schedule>
 
  <log dir="logs/${project.name}">
  <merge dir="projects/${project.name}/build/logs/"/>
  </log>
 
  <publishers>
    <onsuccess>
      <artifactspublisher dir="projects/${project.name}/build/api"
           dest="artifacts/${project.name}"
           subdirectory="api"/>
      <artifactspublisher dir="projects/${project.name}/build/coverage"
           dest="artifacts/${project.name}"
           subdirectory="coverage"/>
       <artifactspublisher dir="projects/${project.name}/build/pdepend"
           dest="artifacts/${project.name}"
           subdirectory="pdepend"/>
      <execute command="phpuc graph --max-number 50 logs/${project.name}
           artifacts/${project.name}"/>
   </onsuccess>
  </publishers>
 </project>
    
</cruisecontrol>

启动:
$ ./cruisecontrol.sh

关闭:
$ kill `cat cc.pid`

访问: 
http://localhost:8983
开始构建项目

