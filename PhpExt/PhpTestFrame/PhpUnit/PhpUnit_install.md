
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
    zs注：一下命令的执行 都是在 php安装根目录
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

        删除     ./pear uninstall phpunit/PHPUnit
        pear clear-cache
        
        if install successed
        phpunit --version
        HPUnit 3.7.22 by Sebastian Bergmann.
        
        {
            安装是否的一种错误情况：
            PHPUnit安装：
            pear channel-discover pear.phpunit.de
            pear install phpunit/PHPUnit
            如果出现错误如下：
              No releases available for package "pear.phpunit.de/PHPUnit" install failed。
            解决方式如下：
            pear clear-cache(清除错误记录信息缓存)
            pear install -a -f phpunit/PHPUnit(重新安装)

        }

        {
            使用时候的一种出错的情况：
            zs注：测试可用
            My problem was that I have wrong installation of PEAR (don’t know how and have no intention on finding it out). When I ran > phpunit, got following error:
            PHP Fatal error: Call to undefined method PHP_CodeCoverage_Filter::getInstance() in /usr/bin/phpunit on line 39

            {
                This is because you have wrong PEAR installation. My friend on the other hand, also has Ubuntu 12.04 and installed PHPUnit almost as easy as with click of a button (unlike me, of course).
                So, I asked him to do in terminal:
            }

            解决方法：
            $pear config-show
            Which showed this (unlike my config-show):
            Configuration (channel pear.php.net):
            =====================================
            Auto-discover new Channels auto_discover 
            Default Channel default_channel pear.php.net
            HTTP Proxy Server Address http_proxy 
            PEAR server [DEPRECATED] master_server pear.php.net
            Default Channel Mirror preferred_mirror pear.php.net
            Remote Configuration File remote_config 
            PEAR executables directory bin_dir /usr/bin
            PEAR documentation directory doc_dir /usr/share/php/doc
            PHP extension directory ext_dir /usr/lib/php5/20090626+lfs
            PEAR directory php_dir /usr/share/php
            PEAR Installer cache directory cache_dir /tmp/pear/cache
            PEAR configuration file cfg_dir /usr/share/php/cfg
            directory
            PEAR data directory data_dir /usr/share/php/data
            PEAR Installer download download_dir /build/buildd/php5-5.3.10/pear-build-download
            directory
            PHP CLI/CGI binary php_bin /usr/bin/php
            php.ini location php_ini 
            --program-prefix passed to php_prefix 
            PHP’s ./configure
            --program-suffix passed to php_suffix 
            PHP’s ./configure
            PEAR Installer temp directory temp_dir /tmp/pear/temp
            PEAR test directory test_dir /usr/share/php/test
            PEAR www files directory www_dir /usr/share/php/htdocs
            Cache TimeToLive cache_ttl 3600
            Preferred Package State preferred_state stable
            Unix file mask umask 2
            Debug Log Level verbose 1
            PEAR password (for password maintainers)
            Signature Handling Program sig_bin /usr/bin/gpg
            Signature Key Directory sig_keydir /etc/pear/pearkeys
            Signature Key Id sig_keyid 
            Package Signature Type sig_type gpg
            PEAR username (for username 
            maintainers)
            User Configuration File Filename /home/username/.pearrc
            System Configuration File Filename /etc/pear/pear.conf

            You need to set following configurations:

            sudo pear config-set bin_dir /usr/bin
            sudo pear config-set doc_dir /usr/share/php/doc
            sudo pear config-set php_dir /usr/share/php
            sudo pear config-set cfg_dir /usr/share/php/cfg (make (sudo mkdir cfg) directory here)
            sudo pear config-set data_dir /usr/share/php/data
            sudo pear config-set test_dir /usr/share/php/test
            Then run:
            $sudo pear uninstall phpunit/PHPUnit
            $sudo pear install phpunit/PHPUnit

            And this worked for me! If you have any issues, feel free to ask below!

            #url demo
            http://markojakic.net/configure-phpunit-and-pear-in-ubuntu-12-04
            
        }

        {
            使用时候的一种出错的情况：
            zs注：测试可用
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

        {
            使用时候的一种出错的情况：
            $:/usr/bin$ phpunit
            PHP Warning:  require_once(PHP/CodeCoverage/Filter.php): failed to open stream: No such file or directory in /usr/bin/phpunit on line 38
            PHP Fatal error:  require_once(): Failed opening required 'PHP/CodeCoverage/Filter.php' (include_path='.:/usr/share/php:/usr/share/pear') in /usr/bin/phpunit on line 38

            解决办法：
            在网上查了下，是phpunit的一个bug，然后有人提供了一个workaround：

            sudo apt-get remove phpunit
            sudo pear channel-discover pear.phpunit.de
            sudo pear channel-discover pear.symfony-project.com
            sudo pear channel-discover components.ez.no
            sudo pear update-channels
            sudo pear upgrade-all
            sudo pear force --alldeps phpunit/PHPUnit

            #url demo
            http://blog.csdn.net/casilin/article/details/9836283
        }

    }
}



