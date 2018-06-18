<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
</div><!--end #content-->
<div style="clear:both;"></div>
<div class="mdui-container-fluid">
	<div id="footerbar" class="mdui-row" style="position:relative">
		<div class="mdui-col-xs-12 mdui-col-sm-6 mdui-p-y-2 mdui-p-x-4 mdui-color-theme-accent mdui-text-center">
			<?php widget_link(); ?>
		</div>
		<div class="mdui-col-xs-12 mdui-col-sm-6 mdui-p-y-2 mdui-p-x-4 mdui-color-theme mdui-text-center">
			<div class="mdui-typo"><h5 class="mdui-m-t-0 mdui-m-b-1 mdui-text-center">关于本站</h5></div>
			<a class="mdui-btn mdui-ripple mdui-btn-dense" href="http://www.emlog.net" title="采用emlog系统" target="_blank">emlog</a>
			<a class="mdui-btn mdui-ripple mdui-btn-dense" href="http://www.yoniu.xyz" title="本站主题" target="_blank">Ting</a>
			<?php if($icp): ?>
			<a class="mdui-btn mdui-ripple mdui-btn-dense" href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
			<?php endif; ?>
			<?php echo $footer_info; ?>
		</div>
		<div class="mdui-color-theme-accent mdui-col-xs-12 mdui-col-sm-6" style="position: absolute;top:0px;bottom: 0px;z-index:-1"></div>
		<div class="mdui-color-theme mdui-col-xs-12 mdui-col-sm-6 mdui-col-offset-sm-6" style="position: absolute;top:0px;bottom: 0px;z-index:-1"></div>
	</div><!--end #footerbar-->
</div>
</div><!--end #wrap-->
<button class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-theme-accent" id="fab"><i class="mdui-icon material-icons">&#xe316;</i></button>
<script src="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.js" type="text/javascript"></script>
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/mdui.min.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery-migrate.min.js" type="text/javascript"></script>
<script>var ajaxhome='<?php echo BLOG_URL; ?>';prettyPrint();</script>
<script src="<?php echo TEMPLATE_URL; ?>js/player.js?v1.56x" type="text/javascript"></script>
<div style="display:none;"><script src="https://s22.cnzz.com/z_stat.php?id=1273974061&web_id=1273974061" language="JavaScript"></script></div>
<?php doAction('index_footer'); ?>
</body>
</html>