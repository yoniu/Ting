<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
<div id="hitokoto" class="mdui-p-y-2 mdui-m-x-1 mdui-text-center">
</div>
	<div class="article">
		<h2 class="mdui-text-center">
			<a class="mdui-text-color-theme" href="<?php echo Url::log($logid);?>"><?php echo $log_title; ?></a>
		</h2>
		<div class="articleicon mdui-text-center mdui-m-t-1">
			<div class="articletime"><?php echo gmdate('Y-n-j', $date); ?></div>
		</div>
		<div class="articletext mdui-typo"><?php echo $log_content; ?></div>
		<div style="clear:both;"></div>
		<div class="articlebloginfo mdui-valign mdui-m-y-2 mdui-p-y-1 mdui-p-x-1">
			<div class="articleblogauthor mdui-m-r-1"><?php blog_author2($author); ?></div>
			<div class="articleblogtag"><?php blog_tag($logid,$author); ?></div>
		</div>
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