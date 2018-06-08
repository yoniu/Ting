基于`Mdui`的原创EMLOG模板，帅哥`油油`2018年中全新力作单栏主题.

# Ting

扁平化清新设计，简约而不简单，打倒一切**华而不实**的非主流模板

# 主题特性

* 顶部四方格显示随机文章（仅显示在首页）
* 导航栏自带音乐播放器 （header.php文件修改音乐外链和图片）
* 文章及列表顶部显示一言 （[？](https://hitokoto.cn/ "一言了解一下")）
* 支持两种文章的输出方式 （默认输出文章列表格式）
* 支持pjax （自行修改`js/player.js`文件）
* 全站自适应设计，完美支持手机端用户
* 评论验证码支持点击刷新

## 关于音乐播放器

修改外链及文件请在header.php文件中找到以下代码修改

    <audio id="ting" src="//miem.coding.me/eii/fc43ac269252c20393f96f317fda57e0.mp3">
    <a id="play-pause" href="javascript:togglePlayPause();" class="mdui-btn mdui-btn-icon" style="background-image: url(//p2.music.126.net/6WLKxUKDfLAiEgmsNcRIZA==/528865128217451.jpg);background-size: cover;background-repeat: no-repeat;background-position: center;">

以上的`//miem.coding.me/eii/fc43ac269252c20393f96f317fda57e0.mp3`和`//p2.music.126.net/6WLKxUKDfLAiEgmsNcRIZA==/528865128217451.jpg`为外链mp3地址及图片地址，如需修改只需修改这两个值

## 关于文章输出方式

在文章开头加入`{type1}`即文章以微语形式输出，加入`{type0}`即文章以列表输出，默认输出文章列表

## 关于pjax

目前pjax的适应还有问题，如果需要开启的请查看`js/player.js`文件自行修改

# 安装方式

下载后上传`src`文件夹到网站的`content\templates`目录

# 主题演示

![pc主页演示](https://img.yoniu.xyz/20180608132158.png "pc主页演示")
![pc评论演示](https://img.yoniu.xyz/20180608140447.png "pc评论演示")
![手机主页演示](https://img.yoniu.xyz/20180608140542.png "手机主页演示")
![手机内页演示1](https://img.yoniu.xyz/20180608140745.png "手机内页演示1")
![手机内页演示2](https://img.yoniu.xyz/20180608140807.png "手机内页演示2")
