<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div id="contentleft">
<div id="hitokoto" class="mdui-p-y-2 mdui-p-x-2 mdui-text-center">
</div>
    <?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?> 
	<div class="article">
		<div class="twauthor mdui-valign">
			<img class="mdui-img-circle" src="<?php echo $avatar; ?>" width="32px" height="32px" />
			<a class="mdui-m-y-1 mdui-m-x-1 mdui-text-color-theme" href="javascript:;"><?php echo $author; ?></a>
			说：
		</div>
		<div class="twbody">
			<div class="articletext mdui-clearfix mdui-m-t-1">
				<div class="mdui-typo mdui-clearfix"><?php echo $val['t'].'<br/>'.$img;?></div>
				<div class="twinfoicon mdui-float-right mdui-m-t-1"><?php echo $val['date'];?></div>
			</div>
		</div>
	</div>
    <?php endforeach;?>
<div id="pagenavi" class="mdui-text-center mdui-p-y-2 mdui-clearfix">
<?php $page_t =  my_page($twnum, Option::get('index_twnum'), $page, BLOG_URL.'t/?page='); echo $page_t; ?>
</div>
</div><!--end #contentleft-->
<?php
 include View::getView('footer');
?>