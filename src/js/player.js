//编写 by 油油
var audio = document.getElementById('ting');
var progress = document.getElementById('progress');
var playpause = document.getElementById("play-pause");
var volume = document.getElementById("volume");
audio.controls = false;
function togglePlayPause() {
   if (audio.paused || audio.ended) {
      playpause.innerHTML = '<i class="mdui-icon material-icons">&#xe034;</i>';
      audio.play();
   } else {
      playpause.innerHTML = '<i class="mdui-icon material-icons">&#xe037;</i>';
      audio.pause();
   }
}
function setVolume() {
   audio.volume = volume.value;
}
function resetPlayer() {
	  audio.currentTime = 0; context.clearRect(0,0,canvas.width,canvas.height);
  playpause.title = "Play";
	  playpause.innerHTML = '<i class="mdui-icon material-icons">&#xe037;</i>';
}
function completeload() {
  $(".vcode>input").addClass("mdui-textfield-input");
  $(".vcode>input").attr('placeholder','验证码');
  $('img[src*="checkcode.php"]')
  .attr('title', '单击刷新验证码')
  .click(function(){
  	this.src = this.src.replace(/\?.*$/, "") +'?'+ new Date().getTime();
  });
}
/*$(document).pjax('#body a', '#content', {fragment:'#content', timeout:6000}); 
$(document).on('submit', 'form', function (event) {$.pjax.submit(event, '.articlecomment', {fragment:'.articlecomment', timeout:6000});}); 
$(document).on('pjax:send', function(){
    $("#content").slideUp();
});
$(document).on('pjax:complete', function() {
  var xhr = new XMLHttpRequest();
  xhr.open('get', 'https://v1.hitokoto.cn');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      var data = JSON.parse(xhr.responseText);
      var hitokoto = document.getElementById('hitokoto');
      hitokoto.innerText = data.hitokoto;
    }
  }
  xhr.send();
  $("#content").slideDown();
  $("#forlog").hide();
  completeload();
});*/ //开启pjax的话去掉这段注释就行
completeload();
var inst = new mdui.Fab('#fab');
inst.hide();
$(window).scroll(function() {
	if ($(this).scrollTop() > 0) {
		inst.show();
	} else {
		inst.hide();
	}
});
$('#fab').click(function() {
	$('body,html').animate({
		scrollTop: 0
	}, 500);
		return false
})