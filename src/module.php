<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//Ting：随机文章
function forlog_random_log(){
	$db = MySql::getInstance();
	$sql = "SELECT * FROM ".DB_PREFIX."blog WHERE hide='n' and checked='y' and type='blog' ORDER BY RAND() LIMIT 4";
	$list = $db->query($sql);
	while($row = $db->fetch_array($list)){
		$content_img = GetThumFromContent($row['content']);
		$gid=$row['sortid'];
		$sortsql = "SELECT * FROM ".DB_PREFIX."sort WHERE sid='$gid'";
		$sortlist = $db->query($sortsql);
		$sortrow = $db->fetch_array($sortlist);
		$date = gmdate('Y-m-d', $row['date']);
	?> 	
		<div class="forlogtopdiv mdui-col-xs-6 mdui-col-sm-3">
			<a class="forlogpic" href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" /><div style="background-image: url(<?php echo $content_img; ?>);background-size: cover;background-repeat: no-repeat;background-position: center;"><img class="logimg" src="<?php echo TEMPLATE_URL; ?>images/box.png" width="100%"/></div></a>
			<div class="forloginfo">
				<div class="forlogtitle">
					<a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></a>
				</div>
				<div class="forlogicon">
					<?php if(trim($sortrow['sortname'])==""):?>
						<a class="sorticon mdui-color-theme mdui-img-rounded" href="javascript:;" />未分类</a>
					<?php else: ?>
						<a class="sorticon mdui-color-theme mdui-img-rounded" href="<?php echo Url::sort($sortrow['sid']);?>" title="<?php echo $sortrow['sortname'];?>" /><?php echo $sortrow['sortname'];?></a>
					<?php endif; ?>
					·
					<div class="dateicon"><?php echo $date; ?></div>
				</div>
			</div>
		</div>
	<?php }
}
?>
<?php 
//Ting：取文本中间
function getSubstr($str, $leftStr, $rightStr, $yueguo = 1)
{
	$left = mb_strpos($str,$leftStr)+$yueguo;
	$right = mb_strpos($str,$rightStr);
    if($left < 0 or $right < $left) return '';
    return mb_substr($str,$left,$right-$left);
}
//Ting：取文章类型
function getPosttype($content){
	if(empty($content)){
		$ret='0';
	}else{
		$ret=getSubstr($content,"{type","}",5);
		if(empty($ret)){
			$ret='0';
		}
	}
	return $ret;
}
//Ting：文章分割
function breakLog2($content) {
	$ret = explode('[break]', $content, 2);
	if (!empty($ret[1])) {
        return $ret[0];
    } else {
        return $content;
    }
}
//Ting：格式化文章内容
function subPost($content){
	$ret=getSubstr($content,"{type","}");
	return str_replace('{'.$ret.'}', '', $content);
}
//Ting：自定义分页函数 
function my_page($count, $perlogs, $page, $url, $anchor = '') { 
 $pnums = @ceil($count / $perlogs); 
 $re = ''; 
 $urlHome = preg_replace("|[?&/][^./?&=]*page[=/-]|", "", $url); 
 if($page > 1) { 
  $i = $page - 1; 
  $re = ' <a class="mdui-btn mdui-color-theme mdui-btn-dense mdui-float-left" href="'.$url.$i.'">上一页</a> ' . $re; 
 } 
 if($page < $pnums) { 
  $i = $page + 1; 
  $re .= ' <a class="mdui-btn mdui-color-theme mdui-btn-dense mdui-float-right" href="'.$url.$i.'">下一页</a> '; 
 } 
 return $re; 
} 
?>
<?php
//Ting：取文章首图
function GetThumFromContent($content){
	preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
	if($imgsrc = !empty($img[1])){
		 $imgsrc = $img[1][0];}else{ 
			preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content ,$img);
			if($imgsrc = !empty($img[1])){ $imgsrc = $img[1][0];  }else{
				$imgsrc = TEMPLATE_URL."images/random/".rand(1,10).".png";	
			}
	}
	return $imgsrc;
}
?>
<?php
//Ting：分类
function list_sort(){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div id="listsort" class="mdui-text-center">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	</li>
	<?php if (!empty($value['children'])): ?>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php endforeach; ?>
	</div>
<?php }?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</li>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="blogsort">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="logsearch">
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	</form>
	</ul>
	</li>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php } ?>
<?php
//widget：链接
function widget_link(){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<div id="link">
		<div class="mdui-typo"><h5 class="mdui-m-t-0 mdui-m-b-1 mdui-text-center">友情链接</h5></div>
	<?php foreach($link_cache as $value): ?>
	<a class="mdui-btn mdui-btn-dense" href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a>
	<?php endforeach; ?>
	</div>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="mdui-divider"></li>
			<li class="mdui-menu-item"><a class="mdui-ripple" href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="mdui-menu-item"><a class="mdui-ripple" href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		?>
		<li class="mdui-menu-item">
			<a class="mdui-ripple" href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
		</li>
		<?php if (!empty($value['children'])) :?>
			<?php foreach ($value['children'] as $row){
				echo '<li class="mdui-menu-item"><a class="mdui-ripple" href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
			}?>
		<?php endif;?>
		<?php if (!empty($value['childnavi'])) :?>
			<?php foreach ($value['childnavi'] as $row){
				$newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
				echo '<li class="mdui-menu-item"><a class="mdui-ripple" href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
			}?>
		<?php endif;?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid,$uid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	$user_cache = $CACHE->readCache('user');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '·';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "<a class=\"mdui-color-theme mdui-m-l-1 mdui-img-rounded\" href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}else{
		echo "·<span class=\"mdui-m-l-1\">".$user_cache[$uid]['des'].'</span>';
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a class="mdui-m-y-1 mdui-m-x-1 mdui-text-color-theme" href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：文章作者
function blog_author2($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
?>
	<a href="<?php echo Url::author($uid)?>"><img class="mdui-img-circle" src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="32px" height="32px" alt="author" /></a>
<?php
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
	<a name="comments"></a>
	<?php endif; ?>
	<div id="comment-list">
		<ol class="comment-list">
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<div class="mdui-clearfix">
			<a name="<?php echo $comment['cid']; ?>"></a>
			<div class="mdui-float-left"><img class="mdui-img-circle" src="<?php echo getGravatar($comment['mail']); ?>"></div>
			<div class="comment-list-body">
				<div class="comment-author-box"><?php echo $comment['poster']; ?></div>
				<div class="comment-content-main">
					<div class="comment-content"><p><?php echo $comment['content']; ?></p></div>
					<div class="comment-down-list mdui-clearfix">
						<div class="comment-time mdui-float-left"><?php echo $comment['date']; ?></div>
						<div class="comment-reply mdui-float-left"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
					</div>
				</div>
			</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php endforeach; ?>
		</ol>
			<div class="page-navigator mdui-m-y-1 mdui-m-t-2 mdui-text-center mdui-color-theme mdui-text-color-theme">
				<?php echo $commentPageUrl;?>
			</div>
	</div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
<ol class="comment-list">
	<div class="comment comment-children comment-level-odd" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="mdui-clearfix">
			<div class="mdui-float-left"><img class="mdui-img-circle" src="<?php echo getGravatar($comment['mail']); ?>"></div>
			<div class="comment-list-body">
				<div class="comment-author-box"><?php echo $comment['poster']; ?></div>
				<div class="comment-content-main">
					<div class="comment-content"><p><?php echo $comment['content']; ?></p></div>
					<div class="comment-down-list mdui-clearfix">
						<div class="comment-time mdui-float-left"><?php echo $comment['date']; ?></div>
						<?php if($comment['level'] < 4): ?><div class="comment-reply mdui-float-left"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
</ol>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<div id="comment-place" class="mdui-p-x-1">
	<div class="comment-post mdui-row" id="comment-post">
		<a name="respond"></a>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<div class="mdui-col-xs-12 mdui-col-sm-6 commentinput mdui-textfield">
				<input class="mdui-textfield-input" placeholder="昵称" type="text" name="comname" value="<?php echo $ckname; ?>" size="22" tabindex="1">
			</div>
			<div class="mdui-col-xs-12 mdui-col-sm-6 commentinput mdui-textfield">
				<input class="mdui-textfield-input" placeholder="邮件地址" type="text" name="commail" value="<?php echo $ckmail; ?>" size="22" tabindex="2">
			</div>
			<div class="mdui-col-xs-12 mdui-col-sm-<?php if($verifyCode): ?>6<?php else: ?>12<?php endif; ?> commentinput mdui-textfield">
				<input class="mdui-textfield-input" placeholder="个人主页" type="text" name="comurl" value="<?php echo $ckurl; ?>" size="22" tabindex="3">
			</div>
			<?php if($verifyCode): ?>
				<div class="vcode mdui-col-xs-12 mdui-col-sm-6 commentinput mdui-textfield">
					<?php echo $verifyCode; ?>
				</div>
			<?php endif; ?>
			<?php endif; ?>
			<div class="commenttextarea mdui-col-xs-12 mdui-textfield">
				<textarea class="textarea mdui-textfield-input" name="comment" id="comment" rows="4" tabindex="4"></textarea>
				<div class="cancel-reply" id="cancel-reply" style="display:none"><a class="mdui-btn mdui-btn-dense mdui-color-theme mdui-ripple" href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
				<div class="commentbtn"><input class="mdui-btn mdui-btn-dense mdui-color-theme-accent mdui-ripple" type="submit" id="comment_submit" value="发表评论" tabindex="6" /></div>
			</div>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</div>
	<?php endif; ?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
