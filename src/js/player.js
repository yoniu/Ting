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
	$("#comment_submit").on("click",function(){
		var his_tip=$("#ajax-tip").html();
		$("#ajax-tip").html('正在提交评论');
		$.ajax({
			url: $("#commentform").attr("action"),
			type: 'post',
			data: $("#commentform").serialize(),
			success:function(d){
				var reg = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
				if(reg.test(d)){
					$("#ajax-tip").html(his_tip);
				}else{
					var pid = $('.comment').length ? $('.comment').attr('id').split('-') : 0;
					$(".articlecomment").html($(d).find(".articlecomment").html());
					if (pid != 0){
						$("html,body").animate(function (){scrollTop:$("#comment-"+pid[1]).offset().top - 260},1000);
					}
				}
			}
		})	
		return false;
	});
}
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

var ajaxcontent = 'content';
var ajaxsearch_class = '';
var ajaxignore_string = new String('/admin, #comment-, uploadfile'); 
var ajaxignore = ajaxignore_string.split(', ');
var ajaxloading_code = '';
var ajaxloading_error_code = 'error';

var ajaxreloadDocumentReady = false;
var ajaxtrack_analytics = false
var ajaxscroll_top = true
var ajaxisLoad = false;
var ajaxstarted = false;
var ajaxsearchPath = null;
var ajaxua = jQuery.browser;

jQuery(document).ready(function() {	
	ajaxloadPageInit("");
});

window.onpopstate = function(event) {
	if (ajaxstarted === true && ajaxcheck_ignore(document.location.toString()) == true) {	
		ajaxloadPage(document.location.toString(),1);
	}
};

function ajaxloadPageInit(scope){
	jQuery(scope + "a").click(function(event){
		if (this.href.indexOf(ajaxhome) >= 0 && ajaxcheck_ignore(this.href) == true){
			event.preventDefault();
			this.blur();
			var caption = this.title || this.name || "";
			var group = this.rel || false;
			try {
				ajaxclick_code(this);
			} catch(err) {
			}
			ajaxloadPage(this.href);
		}
	});
	
	jQuery('#' + ajaxsearch_class).each(function(index) {
		if (jQuery(this).attr("action")) {
			ajaxsearchPath = jQuery(this).attr("action");;
			jQuery(this).submit(function() {
				submitSearch(jQuery(this).serialize());
				return false;
			});
		}
	});
	
	if (jQuery('#' + ajaxsearch_class).attr("action")) {} else {
	}
}

function ajaxloadPage(url, push, getData){
	if (!ajaxisLoad){
		if (ajaxscroll_top == true) {
			jQuery('html,body').animate({scrollTop: 0}, 1500);
		}
		ajaxisLoad = true;
		ajaxstarted = true;
		nohttp = url.replace("http://","").replace("https://","");
		firstsla = nohttp.indexOf("/");
		pathpos = url.indexOf(nohttp);
		path = url.substring(pathpos + firstsla);
		
		if (push != 1) {
			if (typeof window.history.pushState == "function") {
				var stateObj = { foo: 1000 + Math.random()*1001 };
				history.pushState(stateObj, "", path);
			} else {
			}
		}
		if (!jQuery('#' + ajaxcontent)) {
		}
		var referer_url = window.location.href;
		jQuery('#' + ajaxcontent).append(ajaxloading_code);
		jQuery('#' + ajaxcontent).fadeTo("slow", 0.4,function() {
			jQuery('#' + ajaxcontent).fadeIn("slow", function() {
				jQuery.ajax({
					type: "GET",
					url: url,
					data: getData,
					cache: false,
					dataType: "html",
					success: function(data) {
						ajaxisLoad = false;
						datax = data.split('<title>');
						titlesx = data.split('</title>');
						if (datax.length == 2 || titlesx.length == 2) {
							data = data.split('<title>')[1];
							titles = data.split('</title>')[0];
							jQuery(document).attr('title', (jQuery("<div/>").html(titles).text()));
						} else {
							
						}
						if (ajaxtrack_analytics == true) {
							if(typeof _gaq != "undefined") {
								if (typeof getData == "undefined") {
									getData = "";
								} else {
									getData = "?" + getData;
								}
								_gaq.push(['_trackPageview', path + getData]);
							}
						}
						data = data.split('id="' + ajaxcontent + '"')[1];
						data = data.substring(data.indexOf('>') + 1);
						var depth = 1;
						var output = '';
						
						while(depth > 0) {
							temp = data.split('</div>')[0];
							i = 0;
							pos = temp.indexOf("<div");
							while (pos != -1) {
								i++;
								pos = temp.indexOf("<div", pos + 1);
							}
							depth=depth+i-1;
							output=output+data.split('</div>')[0] + '</div>';
							data = data.substring(data.indexOf('</div>') + 6);
						}
						document.getElementById(ajaxcontent).innerHTML = output;
						jQuery('#' + ajaxcontent).css("position", "absolute");
						jQuery('#' + ajaxcontent).css("left", "20000px");
						jQuery('#' + ajaxcontent).show();
						ajaxloadPageInit("#" + ajaxcontent + " ");
						
						if (ajaxreloadDocumentReady == true) {
							jQuery(document).trigger("ready");
						}
						try {
							ajaxreload_code();
						} catch(err) {
						}
						jQuery('#' + ajaxcontent).hide();
						jQuery('#' + ajaxcontent).css("position", "");
						jQuery('#' + ajaxcontent).css("left", "");
						jQuery('#' + ajaxcontent).fadeTo("slow", 1, function() {});
						var content_url = window.location.pathname;
						_czc.push([ "_trackPageview",content_url,referer_url]);
						completeload();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						ajaxisLoad = false;
						document.title = "Error loading requested page!";
						document.getElementById(ajaxcontent).innerHTML = ajaxloading_error_code;
					}
				});
			});
		});
	}
}
function submitSearch(param){
	if (!ajaxisLoad){
		ajaxloadPage(ajaxsearchPath, 0, param);
	}
}
function ajaxcheck_ignore(url) {
	for (var i in ajaxignore) {
		if (url.indexOf(ajaxignore[i]) >= 0) {
			return false;
		}
	}
	return true;
}
function ajaxreload_code() {
}
function ajaxclick_code(thiss) {
}