<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
$article_type=getPosttype($log_content);
$article_content=subPost($log_content);
?>
<div id="contentleft">
<div id="hitokoto" class="mdui-p-y-2 mdui-m-x-1 mdui-text-center">
</div>
	<div class="article">
	<?php if($article_type=="1"){ ?>
		<div class="twauthor mdui-valign">
			<?php blog_author2($author); ?>
			<?php blog_author($author); ?> 
			说：
		</div>
		<div class="twbody">
			<div class="articletext mdui-clearfix mdui-m-t-1">
				<div class="mdui-typo mdui-clearfix"><?php echo $article_content; ?></div>
				<div class="twinfoicon mdui-float-right mdui-m-t-1"><?php echo gmdate('Y-n-j', $date); ?></div>
			</div>
		</div>
	<?php }else{ ?>
		<h2 class="mdui-text-center">
			<a class="mdui-text-color-theme" href="<?php echo Url::log($logid);?>"><?php echo $log_title; ?></a>
		</h2>
		<div class="articleicon mdui-text-center mdui-m-t-1">
			<div class="articlesort"><?php blog_sort($logid); ?></div>
			·
			<div class="articletime"><?php echo gmdate('Y-n-j', $date); ?></div>
		</div>
		<div class="articletext mdui-typo"><?php echo $article_content; ?></div>
		<div style="clear:both;"></div>
		<div class="articlebloginfo mdui-valign mdui-m-y-2 mdui-p-y-1 mdui-p-x-1">
			<div class="articleblogauthor mdui-m-r-1"><?php blog_author2($author); ?></div>
			<div class="articleblogtag"><?php blog_tag($logid,$author); ?></div>
		</div>
	<?php } ?>
	<?php doAction('log_related', $logData); ?>
	<?php if($allow_remark == 'y'):?>
	<div class="articlecomment">
		<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
		<div class="list-title mdui-text-center"><span>已有 <?php echo $comnum;?> 条评论</span></div>
		<?php blog_comments($comments); ?>
	</div>
	<?php endif;?>
	<div style="clear:both;"></div>
	</div>
</div><!--end #contentleft-->
<?php
 include View::getView('footer');
?>