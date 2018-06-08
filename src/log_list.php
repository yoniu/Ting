<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
<?php doAction('index_loglist_top'); ?>
<div id="hitokoto" class="mdui-p-y-2 mdui-m-x-1 mdui-text-center">
</div>
<?php 
if (!empty($logs)):
foreach($logs as $value): 
$article_type=getPosttype($value['content']);
$article_content=subPost($value['log_description']);
?>
	<div class="article">
	<?php if($article_type=="1"){ ?>
		<div class="twauthor mdui-valign">
			<?php blog_author2($value['author']); ?>
			<?php blog_author($value['author']); ?> 
			说：
		</div>
		<div class="twbody">
			<div class="articletext mdui-clearfix mdui-m-t-1">
				<div class="mdui-typo mdui-clearfix"><a class="mdui-text-color-theme" href="<?php echo $value['log_url']; ?>"><?php echo breakLog2($article_content, $value['gid']); ?></a></div>
				<div class="twinfoicon mdui-float-right mdui-m-t-1">
					
					<?php echo gmdate('Y-n-j', $value['date']); ?>
				</div>
			</div>
		</div>
	<?php }else{ ?>
		<h2 class="mdui-text-center">
			<a class="mdui-text-color-theme" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a>
		</h2>
		<div class="articleicon mdui-text-center mdui-m-t-1">
			<div class="articlesort"><?php blog_sort($value['logid']); ?></div>
			·
			<div class="articletime"><?php echo gmdate('Y-n-j', $value['date']); ?></div>
		</div>
		<div class="articletext mdui-typo"><?php echo breakLog2($article_content, $value['gid']); ?></div>
		<div style="clear:both;"></div>
	<?php } ?>
	</div>
<?php 
endforeach;
else:
?>
	<div class="mdui-typo">
		<h2 class="mdui-text-center">
			<a class="mdui-text-color-theme" href="javascript:;">未找到</a>
		</h2>
		<div class="articletext mdui-typo">抱歉，没有符合您查询条件的结果。</div>
		<div style="clear:both;"></div>
	</div>
<?php endif;?>

<div id="pagenavi" class="mdui-text-center mdui-p-y-2 mdui-clearfix">
<?php  
$page_loglist = my_page($lognum, $index_lognum, $page, $pageurl); 
echo $page_loglist; 
?>
</div>

</div><!-- end #contentleft-->
<?php
 include View::getView('footer');
?>