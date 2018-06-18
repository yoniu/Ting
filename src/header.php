<?php
/*
Template Name:听
Description:【原创】基于mdui，简洁优雅
Version:1.5x
Author:油油
Author Url:https://www.200011.net
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="renderer" content="webkit">
	<meta http-equiv="Cache-Control" content="no-siteapp"/>
	<title><?php echo $site_title; ?></title>
	<meta name="keywords" content="<?php echo $site_key; ?>" />
	<meta name="description" content="<?php echo $site_description; ?>" />
	<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
	<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
	<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
	<link href="<?php echo TEMPLATE_URL; ?>css/mdui.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo TEMPLATE_URL; ?>main.css?v1.52x" rel="stylesheet" type="text/css" />
	<link href="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.css" rel="stylesheet" type="text/css" />
	<script src="https://v1.hitokoto.cn/?encode=js&select=%23hitokoto" defer></script>
	<?php doAction('index_head'); ?>
</head>
<body class="mdui-loaded mdui-theme-primary-indigo mdui-theme-accent-pink" style="background-image:url(https://www.yoniu.tk/api/GetBingimg2.php);background-repeat: no-repeat;background-attachment: fixed;background-position: center center;background-size: cover;">
<div id="body" class="mdui-container-fluid mdui-shadow-4">
  <div class="mdui-appbar mdui-shadow-0">
	<div class="mdui-toolbar mdui-color-theme">
		<a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>-<?php echo $bloginfo; ?>" class="mdui-typo-headline"><img src="<?php echo TEMPLATE_URL; ?>images/logo.png" /></a>
		<div class="mdui-toolbar-spacer"></div>
		<audio id="ting" src="//img.yoniu.xyz/9b651c158baa22b5576a1236d4a2740a.mp3">
		</audio>
		<button  mdui-tooltip="{content: '萧煌奇 - 偷走'}" id="play-pause" onclick="togglePlayPause()" class="mdui-btn mdui-btn-icon" style="background-image: url(//p1.music.126.net/XnVjKN4-Isoo-pYFz2qFvw==/16658700673109477.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;"><i class="mdui-icon material-icons">&#xe037;</i></button>
		<button class="mdui-btn mdui-btn-icon" mdui-menu="{target: '#ting-menu'}"><i class="mdui-icon material-icons">&#xe5d2;</i></button>
		<ul class="mdui-menu" id="ting-menu">
			<?php blog_navi();?>
		</ul>
	</div>
  </div>
<div id="content">
<?php if ($pageurl == Url::logPage()): ?>
  <div class="mdui-container-fluid">
	<div id="forlog" class="mdui-row mdui-row-gapless">
		<?php forlog_random_log(); ?>
	</div>
  </div>
 <?php endif; ?>