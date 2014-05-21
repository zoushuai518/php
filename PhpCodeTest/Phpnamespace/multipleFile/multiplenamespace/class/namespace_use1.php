<?php


#http://www.php.net/manual/zh/language.namespaces.importing.php
#使用命名空间：别名/导入

#允许通过别名引用或导入外部的完全限定名称，是命名空间的一个重要特征。这有点类似于在类 unix 文件系统中可以创建对其它的文件或目录的符号连接。

#PHP 命名空间支持 有两种使用别名或导入方式：为类名称使用别名，或为命名空间名称使用别名。注意PHP不支持导入函数或常量。


#在PHP中，别名是通过操作符 use 来实现的. 下面是一个使用所有可能的三种导入方式的例子：


#Example #1 使用use操作符导入/使用别名

namespace foo;
use My\Full\Classname as Another;

// 下面的例子与 use My\Full\NSname as NSname 相同
use My\Full\NSname;

// 导入一个全局类
use \ArrayObject;

$obj = new namespace\Another; // 实例化 foo\Another 对象
$obj = new Another; // 实例化 My\Full\Classname　对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func
$a = new ArrayObject(array(1)); // 实例化 ArrayObject 对象
// 如果不使用 "use \ArrayObject" ，则实例化一个 foo\ArrayObject 对象

#注意对命名空间中的名称（包含命名空间分隔符的完全限定名称如 Foo\Bar以及相对的不包含命名空间分隔符的全局名称如 FooBar）来说，前导的反斜杠是不必要的也不允许有反斜杠，因为导入的名称必须是完全限定的，不会根据当前的命名空间作相对解析。 Note that for namespaced names (fully qualified namespace names containing namespace separator, such as Foo\Bar as opposed to global names that do not, such as FooBar), the leading backslash is unnecessary and not allowed, as import names must be fully qualified, and are not processed relative to the current namespace.
为了简化操作，PHP还支持在一行中使用多个use语句




#Example #2 通过use操作符导入/使用别名，一行中包含多个use语句

use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化 My\Full\Classname 对象
NSname\subns\func(); // 调用函数 My\Full\NSname\subns\func

#导入操作是在编译执行的，但动态的类名称、函数名称或常量名称则不是。 Importing is performed at compile-time, and so does not affect dynamic class, function or constant names.





#Example #3 导入和动态名称

use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // 实例化一个 My\Full\Classname 对象
$a = 'Another';
$obj = new $a;      // 实际化一个 Another 对象

#另外，导入操作只影响非限定名称和限定名称。完全限定名称由于是确定的，故不受导入的影响。





#Example #4 导入和完全限定名称

use My\Full\Classname as Another, My\Full\NSname;

$obj = new Another; // instantiates object of class My\Full\Classname
$obj = new \Another; // instantiates object of class Another
$obj = new Another\thing; // instantiates object of class My\Full\Classname\thing
$obj = new \Another\thing; // instantiates object of class Another\thing


?>
