<?php

#Example #2 动态访问命名空间的元素

namespace Namespacename;
class NamespaceClassname
{
	function __construct()
	{
		echo __METHOD__,"<br />";
	}
}
function namespaceFuncname()
{
	    echo __FUNCTION__,"<br />";
}

const constname = "namespaced";

include 'dynamic_language_feature_1.php';

echo '<br />^_^ no namespace ^_^ <br />';
$a = 'classname';
$obj = new $a; // prints classname::__construct
$b = 'funcname';
$b(); // prints funcname
echo constant('constname'), "\n"; // prints global

echo '<br />^_^ no namespace ^_^ <br />';


echo '<br />^_^ namespace ^_^ <br />';
/* note that if using double quotes, "\\namespacename\\classname" must be used */
$a = '\Namespacename\NamespaceClassname';
$obj = new $a; // prints namespacename\classname::__construct
$a = 'Namespacename\NamespaceClassname';
$obj = new $a; // also prints namespacename\classname::__construct
$b = 'Namespacename\namespaceFuncname';
$b(); // prints namespacename\funcname
$b = '\Namespacename\namespaceFuncname';
$b(); // also prints namespacename\funcname
echo constant('\namespacename\constname'), "<br />"; // prints namespaced
echo constant('namespacename\constname'), "<br />"; // also prints namespaced
echo '^_^ namespace ^_^ <br />';


?>
