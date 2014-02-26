
Linux平台:
{
	wget https://phar.phpunit.de/phpunit.phar
	chmod +x phpunit.phar
	mv phpunit.phar /usr/local/bin/phpunit

	{
		php phpunit.phar -v | phpunit -v
	}
	#zs: phar是可以在命令行运行的PHP文件
}


Windows平台:
{
	windows下安装 pear 和 PHPUnit
	{
		install pear:
		1.进入php安装目录下点击 go-pear.bat开始安装
		2.若没有go-pear.bat，需要访问http://pear.php.net/go-pear，保存成go-pear.php放在php安装目录
		3.D:\PHP\php go-pear.php
		4.按照提示访问http://pear.php.net/go-pear.phar 下载该文件。
		5.执行D:\PHP>php go-pear.phar，按照提示可安装成功3.安装PHPUNIT，有了pear就不用手动安装了。
		6.pear -V

		{
			pear 命令： pear list | pear -help
		}

	}

	{
		install phpunit
		依次执行下面命令
		1.pear channel-discover pear.phpunit.de
		2.pear channel-discover components.ez.no
		3.pear channel-discover pear.symfony-project.com
		4.pear update-channels
		5.pear upgrade-all
		6.pear channel-discover pear.symfony.com
		7.pear install pear.symfony.com/Yaml

		pear install phpunit/PHPUnit或者pear install --alldeps phpunit/PHPUnit
		或者
		pear config-set auto_discover 1 
		pear install pear.phpunit.de/PHPUnit

		删除     ./pear uninstall  PHPUnit
		pear clear-cache
		
		if install successed
		phpunit --version
		HPUnit 3.7.22 by Sebastian Bergmann.
		
		{
			还有一种出错的情况：
			[root@mylocalhost bin]# ./pear install  /usr/local/php/lib/php/PHPUnit-3.7.22.tgz
			Did not download optional dependencies: phpunit/PHP_Invoker, use --alldeps to download automatically
			phpunit/PHPUnit can optionally use package "phpunit/PHP_Invoker" (version >= 1.1.0, version <= 1.1.99)
			install ok: channel://pear.phpunit.de/PHPUnit-3.7.22
			[root@mylocalhost bin]# ./phpunit
			PHP Warning:  require_once(PHPUnit/Framework/MockObject/Autoload.php): failed to open stream: No such file or directory in /usr/local/php/lib/php/PHPUnit/Autoload.php on line 67

			Warning: require_once(PHPUnit/Framework/MockObject/Autoload.php): failed to open stream: No such file or directory in /usr/local/php/lib/php/PHPUnit/Autoload.php on line 67
			PHP Fatal error:  require_once(): Failed opening required 'PHPUnit/Framework/MockObject/Autoload.php' (include_path='.:/php/includes:/usr/local/php/lib/php:/usr/local/php/lib/php/PHPUnit') in /usr/local/php/lib/php/PHPUnit/Autoload.php on line 67

			Fatal error: require_once(): Failed opening required 'PHPUnit/Framework/MockObject/Autoload.php' (include_path='.:/php/includes:/usr/local/php/lib/php:/usr/local/php/lib/php/PHPUnit') in /usr/local/php/lib/php/PHPUnit/Autoload.php on line 67

			解决方法：
			sudo pear install --force phpunit/PHPUnit_MockObject

			#url demo
			http://blog.lixiphp.com/windows-install-pear-phpunit/#axzz2uOT61fZV
			http://blog.sina.com.cn/s/blog_7550abf30101bq17.html
			http://www.cnblogs.com/xiaoyaoxia/archive/2012/10/30/2746449.html
		}
	}
}



