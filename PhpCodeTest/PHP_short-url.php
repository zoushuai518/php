<?php

/*
location of file to store URLS
*/
$file = 'urls.txt';

/* 
use mod_rewrite: 0 - no or 1 - yes
*/
$use_rewrite = 1;

/*
language/style/output variables
*/

$l_url			= 'URL';
$l_nourl		= '<strong>没有输入URL地址</strong>';
$l_yoururl		= '<strong>你的短网址:</strong>';
$l_invalidurl	= '<strong>无效的URL.</strong>';
$l_createurl	= '生成短网址';

//////////////////// NO NEED TO EDIT BELOW ////////////////////

if(!is_writable($file) || !is_readable($file))
{
	die('Cannot write or read from file. Please CHMOD the url file (urls.txt) by default to 777 and make sure it is uploaded.');
}

$action = trim($_GET['id']);
$action = (empty($action) || $action == '') ? 'create' : 'redirect';

$valid = "^(https?|ftp)\:\/\/([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*(\:[0-9]{2,5})?(\/([a-z0-9+\$_-]\.?)+)*\/?(\?[a-z+&\$_.-][a-z0-9;:@/&%=+\$_.-]*)?(#[a-z_.-][a-z0-9+\$_.-]*)?\$";

$output = '';

if($action == 'create')
{
	if(isset($_POST['create']))
	{
		$url = trim($_POST['url']);
		
		if($url == '')
		{
			$output = $l_nourl;
		}
		else
		{
			if(eregi($valid, $url))
			{
				$fp = fopen($file, 'a');
				fwrite($fp, "{$url}\r\n");
				fclose($fp);
				
				$id			= count(file($file));
				$dir		= dirname($_SERVER['PHP_SELF']);
				$filename	= explode('/', $_SERVER['PHP_SELF']);
				$filename   = $filename[(count($filename) - 1)];
				
				$shorturl = ($use_rewrite == 1) ? "http://{$_SERVER['HTTP_HOST']}{$dir}{$id}" : "http://{$_SERVER['HTTP_HOST']}{$dir}{$filename}?id={$id}";
				
				$output = "{$l_yoururl} <a href='{$shorturl}' target='_blank'>{$shorturl}</a>";
			}
			else
			{
				$output = $l_invalidurl;
			}
		}
	}
}

if($action == 'redirect')
{
	$urls = file($file);
	$id   = trim($_GET['id']) - 1;
	if(isset($urls[$id]))
	{
		header("Location: {$urls[$id]}");
		exit;
	}
	else
	{
		die('Script error');
	}
}

//////////////////// FEEL FREE TO EDIT BELOW ////////////////////
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>php生成短网址</title>
</head>
<body>

<p>短网址服务可以帮助你把一个长网址缩短，方便你在社交网络和微博上分享链接。</p>
<!-- start html output -->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
<p class="response"><?=$output?></p>
<p>
	<label for="s-url">请输入URL地址:</label>
	<input name="url" type="text" id="s-url" size="60" />
</p>
<p>
	<input type="submit" class="button" name="create" value="<?=$l_createurl?>" />
</p>
</form>

<!-- end html output -->

</body>
</html>
<?php
ob_end_flush();
?>