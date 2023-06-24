function arCuGetCookie(t){
	return document.cookie.length>0&&(c_start=document.cookie.indexOf(t+"="),
	-1!=c_start)?(c_start=c_start+t.length+1,
	c_end=document.cookie.indexOf(";",
	c_start),
	-1==c_end&&(c_end=document.cookie.length),
	unescape(document.cookie.substring(c_start,
	c_end))):0
}function arCuCreateCookie(t,
e,
s){
	var n;if(s){
		var i=new Date;i.setTime(i.getTime()+24*s*60*60*1e3),
		n="; expires="+i.toGMTString()
	}else n="";document.cookie=t+"="+e+n+"; path=/"
}function arCuShowMessage(t){
	if(arCuPromptClosed)return!1;void 0!==arCuMessages[
		t
	]?(jQuery("#arcontactus").contactUs("showPromptTyping"),
	_arCuTimeOut=setTimeout(function(){
		if(arCuPromptClosed)return!1;jQuery("#arcontactus").contactUs("showPrompt",
		{
			content:arCuMessages[
				t
			]
		}),
		t++,
		_arCuTimeOut=setTimeout(function(){
			if(arCuPromptClosed)return!1;arCuShowMessage(t)
		},
		arCuMessageTime)
	},
	arCuTypingTime)):(arCuCloseLastMessage&&jQuery("#arcontactus").contactUs("hidePrompt"),
	arCuLoop&&arCuShowMessage(0))
}function arCuShowMessages(){
	setTimeout(function(){
		clearTimeout(_arCuTimeOut),
		arCuShowMessage(0)
	},
	arCuDelayFirst)
}!function(t){
	function e(s,
	n){
		this._initialized=!1,
		this.settings=null,
		this.options=t.extend({},
		e.Defaults,
		n),
		this.$element=t(s),
		this.init(),
		this.x=0,
		this.y=0,
		this._interval,
		this._menuOpened=!1,
		this._callbackOpened=!1,
		this.countdown=null
	}e.Defaults={
		align:"right",
		countdown:0,
		drag:!1,
		buttonText:"Liên hệ",
		buttonSize:"large",
		menuSize:"normal",
		items:[],
		iconsAnimationSpeed:1200,
		buttonIcon:'<svg width="20" height="20" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-825 -308)"><g id="Vector"><use xlink:href="#path0_fill0123" transform="translate(825 308)" fill="#FFFFFF"/></g></g><defs><path id="path0_fill0123" d="M 19 4L 17 4L 17 13L 4 13L 4 15C 4 15.55 4.45 16 5 16L 16 16L 20 20L 20 5C 20 4.45 19.55 4 19 4ZM 15 10L 15 1C 15 0.45 14.55 0 14 0L 1 0C 0.45 0 0 0.45 0 1L 0 15L 4 11L 14 11C 14.55 11 15 10.55 15 10Z"/></defs></svg>',
		closeIcon:'<svg width="12" height="13" viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Canvas" transform="translate(-4087 108)"><g id="Vector"><use xlink:href="#path0_fill" transform="translate(4087 -108)" fill="currentColor"></use></g></g><defs><path id="path0_fill" d="M 14 1.41L 12.59 0L 7 5.59L 1.41 0L 0 1.41L 5.59 7L 0 12.59L 1.41 14L 7 8.41L 12.59 14L 14 12.59L 8.41 7L 14 1.41Z"></path></defs></svg>'
	},
	e.prototype.init=function(){
		this.destroy(),
		this.settings=t.extend({},
		this.options),
		this.$element.addClass("arcontactus-widget").addClass("arcontactus-message"),
		"left"===this.settings.align?this.$element.addClass("left"):this.$element.addClass("right"),
		this.settings.items.length?(this._initCallbackBlock(),
		this._initMessengersBlock(),
		this._initMessageButton(),
		this._initPrompt(),
		this._initEvents(),
		this.startAnimation(),
		this.$element.addClass("active")):console.info("jquery.contactus:no items"),
		this._initialized=!0,
		this.$element.trigger("arcontactus.init")
	},
	e.prototype.destroy=function(){
		if(!this._initialized)return!1;this.$element.html(""),
		this._initialized=!1,
		this.$element.trigger("arcontactus.destroy")
	},
	e.prototype._initCallbackBlock=function(){},
	e.prototype._initMessengersBlock=function(){
		var e=t("<div>",
		{
			class:"messangers-block"
		});"normal"!==this.settings.menuSize&&"large"!==this.settings.menuSize||e.addClass("lg"),
		"small"===this.settings.menuSize&&e.addClass("sm"),
		this._appendMessengerIcons(e),
		this.$element.append(e)
	},
	e.prototype._appendMessengerIcons=function(e){
		t.each(this.settings.items,
		function(s){
			if("callback"==this.href)var n=t("<div>",
			{
				class:"messanger call-back "+(this.class?this.class:"")
			});else if(n=t("<a>",
			{
				class:"messanger "+(this.class?this.class:""),
				id:this.id?this.id:null,
				href:this.href,
				target:this.target?this.target:"_blank"
			}),
			this.onClick){
				var i=this;n.on("click",
				function(t){
					i.onClick(t)
				})
			}var a=t("<span>",
			{
				style:this.color?"background-color:"+this.color:null
			});a.append(this.icon),
			n.append(a),
			n.append("<p>"+this.title+"</p>"),
			e.append(n)
		})
	},
	e.prototype._initMessageButton=function(){
		var e=this,
		s=t("<div>",
		{
			class:"arcontactus-message-button",
			style:this._backgroundStyle()
		});"large"===this.settings.buttonSize&&this.$element.addClass("lg"),
		"medium"===this.settings.buttonSize&&this.$element.addClass("md"),
		"small"===this.settings.buttonSize&&this.$element.addClass("sm");var n=t("<div>",
		{
			class:"static"
		});n.append(this.settings.buttonIcon),
		!1!==this.settings.buttonText?n.append("<p>"+this.settings.buttonText+"</p>"):s.addClass("no-text");var i=t("<div>",
		{
			class:"callback-state",
			style:e._colorStyle()
		});i.append(this.settings.callbackStateIcon);var a=t("<div>",
		{
			class:"icons hide"
		}),
		o=t("<div>",
		{
			class:"icons-line"
		});t.each(this.settings.items,
		function(s){
			var n=t("<span>",
			{
				style:e._colorStyle()
			});n.append(this.icon),
			o.append(n)
		}),
		a.append(o);var r=t("<div>",
		{
			class:"arcontactus-close"
		});r.append(this.settings.closeIcon);var c=t("<div>",
		{
			class:"pulsation",
			style:e._backgroundStyle()
		}),
		l=t("<div>",
		{
			class:"pulsation",
			style:e._backgroundStyle()
		});s.append(n).append(i).append(a).append(r).append(c).append(l),
		this.$element.append(s)
	},
	e.prototype._initPrompt=function(){
		var e=t("<div>",
		{
			class:"arcontactus-prompt"
		}),
		s=t("<div>",
		{
			class:"arcontactus-prompt-close",
			style:this._colorStyle()
		});s.append(this.settings.closeIcon);var n=t("<div>",
		{
			class:"arcontactus-prompt-inner"
		});e.append(s).append(n),
		this.$element.append(e)
	},
	e.prototype._initEvents=function(){
		var e=this.$element,
		s=this;e.find(".arcontactus-message-button").on("mousedown",
		function(t){
			s.x=t.pageX,
			s.y=t.pageY
		}).on("mouseup",
		function(t){
			t.pageX===s.x&&t.pageY===s.y&&(s.toggleMenu(),
			t.preventDefault())
		}),
		this.settings.drag&&(e.draggable(),
		e.get(0).addEventListener("touchmove",
		function(t){
			var s=t.targetTouches[
				0
			];e.get(0).style.left=s.pageX-25+"px",
			e.get(0).style.top=s.pageY-25+"px",
			t.preventDefault()
		},
		!1)),
		t(document).on("click",
		function(t){
			s.closeMenu()
		}),
		e.on("click",
		function(t){
			t.stopPropagation()
		}),
		e.find(".call-back").on("click",
		function(){
			s.openCallbackPopup()
		}),
		e.find(".callback-countdown-block-close").on("click",
		function(){
			null!=s.countdown&&(clearInterval(s.countdown),
			s.countdown=null),
			s.closeCallbackPopup()
		}),
		e.find(".arcontactus-prompt-close").on("click",
		function(){
			s.hidePrompt()
		})
	},
	e.prototype.show=function(){
		this.$element.addClass("active"),
		this.$element.trigger("arcontactus.show")
	},
	e.prototype.hide=function(){
		this.$element.removeClass("active"),
		this.$element.trigger("arcontactus.hide")
	},
	e.prototype.openMenu=function(){
		var t=this.$element;t.find(".messangers-block").hasClass("show-messageners-block")||(this.stopAnimation(),
		t.find(".messangers-block, .arcontactus-close").addClass("show-messageners-block"),
		t.find(".icons, .static").addClass("hide"),
		t.find(".pulsation").addClass("stop"),
		this._menuOpened=!0,
		this.$element.trigger("arcontactus.openMenu"))
	},
	e.prototype.closeMenu=function(){
		var t=this.$element;t.find(".messangers-block").hasClass("show-messageners-block")&&(t.find(".messangers-block, .arcontactus-close").removeClass("show-messageners-block"),
		t.find(".icons, .static").removeClass("hide"),
		t.find(".pulsation").removeClass("stop"),
		this.startAnimation(),
		this._menuOpened=!1,
		this.$element.trigger("arcontactus.closeMenu"))
	},
	e.prototype.toggleMenu=function(){
		var t=this.$element;if(this.hidePrompt(),
		t.find(".callback-countdown-block").hasClass("display-flex"))return!1;t.find(".messangers-block").hasClass("show-messageners-block")?this.closeMenu():this.openMenu(),
		this.$element.trigger("arcontactus.toggleMenu")
	},
	e.prototype.openCallbackPopup=function(){
		var t=this.$element;t.addClass("opened"),
		this.closeMenu(),
		this.stopAnimation(),
		t.find(".icons, .static").addClass("hide"),
		t.find(".pulsation").addClass("stop"),
		t.find(".callback-countdown-block").addClass("display-flex"),
		this._callbackOpened=!0,
		this.$element.trigger("arcontactus.openCallbackPopup")
	},
	e.prototype.closeCallbackPopup=function(){
		var t=this.$element;t.removeClass("opened"),
		t.find(".messangers-block").removeClass("show-messageners-block"),
		t.find(".arcontactus-close").removeClass("show-messageners-block"),
		t.find(".icons, .static").removeClass("hide"),
		this.startAnimation(),
		this._callbackOpened=!1,
		this.$element.trigger("arcontactus.closeCallbackPopup")
	},
	e.prototype.startAnimation=function(){
		var t=this.$element,
		e=t.find(".icons-line"),
		s=t.find(".static"),
		n=t.find(".icons-line>span:first-child").width()+40;if("large"===this.settings.buttonSize)var i=2,
		a=0;"medium"===this.settings.buttonSize&&(i=4,
		a=-2),
		"small"===this.settings.buttonSize&&(i=4,
		a=-2);var o=t.find(".icons-line>span").length,
		r=0;if(this.stopAnimation(),
		0===this.settings.iconsAnimationSpeed)return!1;this._interval=setInterval(function(){
			0===r&&(e.parent().removeClass("hide"),
			s.addClass("hide"));var t="translate("+-(n*r+i)+"px, "+a+"px)";e.css({
				"-webkit-transform":t,
				"-ms-transform":t,
				transform:t
			}),
			++r>o&&(r>o+1&&(r=0),
			e.parent().addClass("hide"),
			s.removeClass("hide"),
			t="translate("+-i+"px, "+a+"px)",
			e.css({
				"-webkit-transform":t,
				"-ms-transform":t,
				transform:t
			}))
		},
		this.settings.iconsAnimationSpeed)
	},
	e.prototype.stopAnimation=function(){
		clearInterval(this._interval);var t=this.$element,
		e=t.find(".icons-line"),
		s=t.find(".static");e.parent().addClass("hide"),
		s.removeClass("hide");var n="translate(-2px, 0px)";e.css({
			"-webkit-transform":n,
			"-ms-transform":n,
			transform:n
		})
	},
	e.prototype.showPrompt=function(t){
		var e=this.$element.find(".arcontactus-prompt");t&&t.content&&e.find(".arcontactus-prompt-inner").html(t.content),
		e.addClass("active"),
		this.$element.trigger("arcontactus.showPrompt")
	},
	e.prototype.hidePrompt=function(){
		this.$element.find(".arcontactus-prompt").removeClass("active"),
		this.$element.trigger("arcontactus.hidePrompt")
	},
	e.prototype.showPromptTyping=function(){
		this.$element.find(".arcontactus-prompt").find(".arcontactus-prompt-inner").html(""),
		this._insertPromptTyping(),
		this.showPrompt({}),
		this.$element.trigger("arcontactus.showPromptTyping")
	},
	e.prototype._insertPromptTyping=function(){
		var e=this.$element.find(".arcontactus-prompt-inner"),
		s=t("<div>",
		{
			class:"arcontactus-prompt-typing"
		}),
		n=t("<div>");s.append(n),
		s.append(n.clone()),
		s.append(n.clone()),
		e.append(s)
	},
	e.prototype.hidePromptTyping=function(){
		this.$element.find(".arcontactus-prompt").removeClass("active"),
		this.$element.trigger("arcontactus.hidePromptTyping")
	},
	e.prototype._backgroundStyle=function(){
		return"background-color: "+this.settings.theme
	},
	e.prototype._colorStyle=function(){
		return"color: "+this.settings.theme
	},
	t.fn.contactUs=function(s){
		var n=Array.prototype.slice.call(arguments,
		1);return this.each(function(){
			var i=t(this),
			a=i.data("ar.contactus");a||(a=new e(this,
			"object"==typeof s&&s),
			i.data("ar.contactus",
			a)),
			"string"==typeof s&&"_"!==s.charAt(0)&&a[
				s
			].apply(a,
			n)
		})
	},
	t.fn.contactUs.Constructor=e
}(jQuery);

var arCuMessages = [
	"Xin chào"
];
var arCuLoop = false;
var arCuCloseLastMessage = false;
var arCuPromptClosed = false;
var _arCuTimeOut = null;
var arCuDelayFirst = 2000;
var arCuTypingTime = 2000;
var arCuMessageTime = 4000;
var arCuClosedCookie = 0;
var arcItems = [];
window.addEventListener('load',
function() {
	arCuClosedCookie = arCuGetCookie('arcu-closed');
jQuery('#arcontactus').on('arcontactus.init',
	function() {
		if (arCuClosedCookie) {
			return false;
		}arCuShowMessages();
	});
jQuery('#arcontactus').on('arcontactus.openMenu',
	function() {
		clearTimeout(_arCuTimeOut);
arCuPromptClosed = true;
jQuery('#contact').contactUs('hidePrompt');
arCuCreateCookie('arcu-closed',
		1,
		30);
	});
jQuery('#arcontactus').on('arcontactus.hidePrompt',
	function() {
		clearTimeout(_arCuTimeOut);
arCuPromptClosed = true;
arCuCreateCookie('arcu-closed',
		1,
		30);
	});
var tempp = 1;
if($('#arcontactus').attr("data-messenger") != ""){
    var arcItem = {};
    arcItem.id = 'msg-item-' + tempp;
    tempp++;
    arcItem.class = 'msg-item-facebook-messenger';
    arcItem.title = 'Messenger';
    arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M224 32C15.9 32-77.5 278 84.6 400.6V480l75.7-42c142.2 39.8 285.4-59.9 285.4-198.7C445.8 124.8 346.5 32 224 32zm23.4 278.1L190 250.5 79.6 311.6l121.1-128.5 57.4 59.6 110.4-61.1-121.1 128.5z"></path></svg>';
    arcItem.href = $('#arcontactus').attr("data-messenger");
    arcItem.color = '#567AFF';
    arcItems.push(arcItem);  
    
}

if($('#arcontactus').attr("data-zalo") != ""){
    var arcItem = {};
    arcItem.id = 'msg-item-' + tempp;
    tempp++;
    arcItem.class = 'msg-item-zalo';
    arcItem.title = 'Zalo Shop';
    arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 460.1 436.6"><path fill="currentColor" class="st0" d="M82.6 380.9c-1.8-.8-3.1-1.7-1-3.5 1.3-1 2.7-1.9 4.1-2.8 13.1-8.5 25.4-17.8 33.5-31.5 6.8-11.4 5.7-18.1-2.8-26.5C69 269.2 48.2 212.5 58.6 145.5 64.5 107.7 81.8 75 107 46.6c15.2-17.2 33.3-31.1 53.1-42.7 1.2-.7 2.9-.9 3.1-2.7-.4-1-1.1-.7-1.7-.7-33.7 0-67.4-.7-101 .2C28.3 1.7.5 26.6.6 62.3c.2 104.3 0 208.6 0 313 0 32.4 24.7 59.5 57 60.7 27.3 1.1 54.6.2 82 .1 2 .1 4 .2 6 .2H290c36 0 72 .2 108 0 33.4 0 60.5-27 60.5-60.3v-.6-58.5c0-1.4.5-2.9-.4-4.4-1.8.1-2.5 1.6-3.5 2.6-19.4 19.5-42.3 35.2-67.4 46.3-61.5 27.1-124.1 29-187.6 7.2-5.5-2-11.5-2.2-17.2-.8-8.4 2.1-16.7 4.6-25 7.1-24.4 7.6-49.3 11-74.8 6zm72.5-168.5c1.7-2.2 2.6-3.5 3.6-4.8 13.1-16.6 26.2-33.2 39.3-49.9 3.8-4.8 7.6-9.7 10-15.5 2.8-6.6-.2-12.8-7-15.2-3-.9-6.2-1.3-9.4-1.1-17.8-.1-35.7-.1-53.5 0-2.5 0-5 .3-7.4.9-5.6 1.4-9 7.1-7.6 12.8 1 3.8 4 6.8 7.8 7.7 2.4.6 4.9.9 7.4.8 10.8.1 21.7 0 32.5.1 1.2 0 2.7-.8 3.6 1-.9 1.2-1.8 2.4-2.7 3.5-15.5 19.6-30.9 39.3-46.4 58.9-3.8 4.9-5.8 10.3-3 16.3s8.5 7.1 14.3 7.5c4.6.3 9.3.1 14 .1 16.2 0 32.3.1 48.5-.1 8.6-.1 13.2-5.3 12.3-13.3-.7-6.3-5-9.6-13-9.7-14.1-.1-28.2 0-43.3 0zm116-52.6c-12.5-10.9-26.3-11.6-39.8-3.6-16.4 9.6-22.4 25.3-20.4 43.5 1.9 17 9.3 30.9 27.1 36.6 11.1 3.6 21.4 2.3 30.5-5.1 2.4-1.9 3.1-1.5 4.8.6 3.3 4.2 9 5.8 14 3.9 5-1.5 8.3-6.1 8.3-11.3.1-20 .2-40 0-60-.1-8-7.6-13.1-15.4-11.5-4.3.9-6.7 3.8-9.1 6.9zm69.3 37.1c-.4 25 20.3 43.9 46.3 41.3 23.9-2.4 39.4-20.3 38.6-45.6-.8-25-19.4-42.1-44.9-41.3-23.9.7-40.8 19.9-40 45.6zm-8.8-19.9c0-15.7.1-31.3 0-47 0-8-5.1-13-12.7-12.9-7.4.1-12.3 5.1-12.4 12.8-.1 4.7 0 9.3 0 14v79.5c0 6.2 3.8 11.6 8.8 12.9 6.9 1.9 14-2.2 15.8-9.1.3-1.2.5-2.4.4-3.7.2-15.5.1-31 .1-46.5z"></path></svg>';
    arcItem.href = $('#arcontactus').attr("data-zalo");
    arcItem.color = '#2EA8FF';
    arcItems.push(arcItem);
    
}
if($('#arcontactus').attr("data-phone") != ""){
    var arcItem = {};
    arcItem.id = 'msg-item-' + tempp;
    tempp++;
    arcItem.class = 'msg-item-sms';
    arcItem.title = 'SMS';
    arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M128 216c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zm128 0c-13.3 0-24 10.7-24 24s10.7 24 24 24 24-10.7 24-24-10.7-24-24-24zM256 32C114.6 32 0 125.1 0 240c0 47.6 19.9 91.2 52.9 126.3C38 405.7 7 439.1 6.5 439.5c-6.6 7-8.4 17.2-4.6 26S14.4 480 24 480c61.5 0 110-25.7 139.1-46.3C192 442.8 223.2 448 256 448c141.4 0 256-93.1 256-208S397.4 32 256 32zm0 384c-28.3 0-56.3-4.3-83.2-12.8l-15.2-4.8-13 9.2c-23 16.3-58.5 35.3-102.6 39.6 12-15.1 29.8-40.4 40.8-69.6l7.1-18.7-13.7-14.6C47.3 313.7 32 277.6 32 240c0-97 100.5-176 224-176s224 79 224 176-100.5 176-224 176z"></path></svg>';
    // arcItem.icon = "<img src='https://hahuunam.unitopcv.com/public/images/icons/bottom-bar/map-icon.png' style='width: 25px;'></img>"
    arcItem.href = 'sms:' + $('#arcontactus').attr("data-phone");
    arcItem.color = '#1C9CC5';
    arcItems.push(arcItem);
    
}
if($('#arcontactus').attr("data-viber") != ""){
    var arcItem = {};
    arcItem.id = 'msg-item-' + tempp;
    tempp++;
    arcItem.class = 'msg-item-sms';
    arcItem.title = 'Viber';
    arcItem.icon = "<svg xmlns='http://www.w3.org/2000/svg' enable-background='new 0 0 24 24' height='512' viewBox='0 0 24 24' width='512'><g fill='#8e24aa'><path d='m23.155 13.893c.716-6.027-.344-9.832-2.256-11.553l.001-.001c-3.086-2.939-13.508-3.374-17.2.132-1.658 1.715-2.242 4.232-2.306 7.348-.064 3.117-.14 8.956 5.301 10.54h.005l-.005 2.419s-.037.98.589 1.177c.716.232 1.04-.223 3.267-2.883 3.724.323 6.584-.417 6.909-.525.752-.252 5.007-.815 5.695-6.654zm-12.237 5.477s-2.357 2.939-3.09 3.702c-.24.248-.503.225-.499-.267 0-.323.018-4.016.018-4.016-4.613-1.322-4.341-6.294-4.291-8.895.05-2.602.526-4.733 1.93-6.168 3.239-3.037 12.376-2.358 14.704-.17 2.846 2.523 1.833 9.651 1.839 9.894-.585 4.874-4.033 5.183-4.667 5.394-.271.09-2.786.737-5.944.526z'/><path d='m12.222 4.297c-.385 0-.385.6 0 .605 2.987.023 5.447 2.105 5.474 5.924 0 .403.59.398.585-.005h-.001c-.032-4.115-2.718-6.501-6.058-6.524z'/><path d='m16.151 10.193c-.009.398.58.417.585.014.049-2.269-1.35-4.138-3.979-4.335-.385-.028-.425.577-.041.605 2.28.173 3.481 1.729 3.435 3.716z'/><path d='m15.521 12.774c-.494-.286-.997-.108-1.205.173l-.435.563c-.221.286-.634.248-.634.248-3.014-.797-3.82-3.951-3.82-3.951s-.037-.427.239-.656l.544-.45c.272-.216.444-.736.167-1.247-.74-1.337-1.237-1.798-1.49-2.152-.266-.333-.666-.408-1.082-.183h-.009c-.865.506-1.812 1.453-1.509 2.428.517 1.028 1.467 4.305 4.495 6.781 1.423 1.171 3.675 2.371 4.631 2.648l.009.014c.942.314 1.858-.67 2.347-1.561v-.007c.217-.431.145-.839-.172-1.106-.562-.548-1.41-1.153-2.076-1.542z'/><path d='m13.169 8.104c.961.056 1.427.558 1.477 1.589.018.403.603.375.585-.028-.064-1.346-.766-2.096-2.03-2.166-.385-.023-.421.582-.032.605z'/></g></svg>";
    // arcItem.icon  = "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'><circle style='fill:#6F3FAA;' cx='256' cy='256' r='256'/><path style='fill:#512D84;' d='M367.061,140.443c-62.312-15.05-124.735-32.654-188.637-10.288  c-41.374,15.515-41.374,60.337-39.65,98.263c0,10.343-12.067,24.135-6.896,36.202c10.343,34.478,18.963,68.956,55.165,86.195  c5.172,3.448,0,10.343,3.448,15.515c-1.724,0-5.172,1.724-5.172,3.448c0,8.263,3.708,20.902,1.245,29.05L296.57,508.788  c113.09-18.01,201.478-110.068,213.914-224.921L367.061,140.443z'/><g><path style='fill:#FFFFFF;' d='M391.427,179.924l-0.084-0.338c-6.84-27.653-37.678-57.325-65.998-63.498l-0.319-0.066   c-45.806-8.738-92.251-8.738-138.047,0l-0.329,0.066c-28.31,6.173-59.149,35.847-65.998,63.498l-0.076,0.338   c-8.456,38.617-8.456,77.781,0,116.398l0.076,0.338c6.558,26.472,35.099,54.782,62.362,62.567v30.868   c0,11.173,13.615,16.66,21.357,8.597l31.275-32.509c6.784,0.379,13.571,0.591,20.356,0.591c23.057,0,46.125-2.181,69.023-6.549   l0.319-0.066c28.32-6.173,59.158-35.847,65.998-63.498l0.084-0.338C399.882,257.705,399.882,218.543,391.427,179.924z    M366.676,290.723c-4.567,18.041-27.981,40.469-46.585,44.613c-24.355,4.632-48.904,6.611-73.428,5.932   c-0.488-0.014-0.957,0.176-1.296,0.526c-3.481,3.572-22.835,23.442-22.835,23.442l-24.288,24.928   c-1.776,1.852-4.896,0.591-4.896-1.964v-51.136c0-0.845-0.603-1.562-1.433-1.726c-0.005-0.002-0.009-0.002-0.014-0.003   c-18.604-4.144-42.01-26.572-46.585-44.613c-7.611-34.906-7.611-70.292,0-105.198c4.575-18.041,27.981-40.469,46.585-44.613   c42.536-8.09,85.664-8.09,128.191,0c18.613,4.144,42.018,26.572,46.585,44.613C374.296,220.431,374.296,255.817,366.676,290.723z'/><path style='fill:#FFFFFF;' d='M296.47,314.327c-2.86-0.869-5.585-1.452-8.118-2.501c-26.231-10.883-50.371-24.923-69.492-46.444   c-10.874-12.238-19.385-26.055-26.579-40.677c-3.412-6.934-6.287-14.139-9.218-21.299c-2.672-6.528,1.264-13.272,5.408-18.192   c3.889-4.617,8.894-8.149,14.314-10.754c4.23-2.032,8.402-0.86,11.492,2.725c6.678,7.752,12.814,15.9,17.78,24.886   c3.055,5.527,2.217,12.283-3.32,16.044c-1.346,0.914-2.572,1.988-3.825,3.02c-1.1,0.905-2.134,1.819-2.888,3.044   c-1.377,2.241-1.443,4.886-0.557,7.323c6.827,18.761,18.334,33.351,37.219,41.21c3.022,1.257,6.056,2.72,9.538,2.315   c5.83-0.681,7.718-7.077,11.804-10.418c3.993-3.265,9.097-3.308,13.398-0.586c4.303,2.724,8.473,5.646,12.619,8.601   c4.07,2.9,8.121,5.735,11.874,9.042c3.61,3.179,4.853,7.349,2.82,11.662c-3.72,7.901-9.135,14.472-16.944,18.668   C301.59,313.178,298.956,313.561,296.47,314.327C293.61,313.458,298.956,313.561,296.47,314.327z'/><path style='fill:#FFFFFF;' d='M256.071,165.426c34.309,0.962,62.49,23.731,68.529,57.651c1.029,5.78,1.395,11.688,1.853,17.555   c0.193,2.467-1.205,4.811-3.867,4.844c-2.75,0.033-3.987-2.269-4.167-4.734c-0.353-4.882-0.598-9.787-1.271-14.627   c-3.551-25.559-23.931-46.704-49.371-51.241c-3.829-0.683-7.745-0.862-11.624-1.269c-2.451-0.257-5.661-0.405-6.204-3.453   c-0.455-2.555,1.701-4.589,4.134-4.72C254.742,165.393,255.407,165.424,256.071,165.426   C290.382,166.388,255.407,165.424,256.071,165.426z'/><path style='fill:#FFFFFF;' d='M308.212,233.019c-0.057,0.429-0.086,1.436-0.338,2.384c-0.91,3.444-6.134,3.875-7.335,0.4   c-0.357-1.031-0.41-2.205-0.412-3.315c-0.012-7.266-1.591-14.526-5.256-20.849c-3.767-6.499-9.523-11.96-16.272-15.267   c-4.082-1.998-8.495-3.241-12.969-3.98c-1.955-0.324-3.931-0.519-5.896-0.793c-2.381-0.331-3.653-1.848-3.539-4.194   c0.105-2.198,1.712-3.781,4.108-3.644c7.873,0.446,15.479,2.15,22.48,5.856c14.234,7.539,22.366,19.437,24.74,35.326   c0.107,0.721,0.279,1.433,0.334,2.155C307.991,228.88,308.076,230.665,308.212,233.019   C308.155,233.446,308.076,230.665,308.212,233.019z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c-2.87,0.052-4.406-1.538-4.703-4.168c-0.205-1.834-0.369-3.694-0.807-5.48   c-0.862-3.517-2.731-6.775-5.689-8.93c-1.396-1.017-2.979-1.758-4.636-2.238c-2.105-0.609-4.293-0.441-6.392-0.955   c-2.281-0.559-3.543-2.407-3.184-4.546c0.326-1.948,2.22-3.468,4.349-3.313c13.302,0.96,22.809,7.837,24.166,23.497   c0.097,1.105,0.209,2.272-0.036,3.331C289.518,231.193,288.178,232.1,286.872,232.188   C284.001,232.239,288.178,232.1,286.872,232.188z'/></g><path style='fill:#D1D1D1;' d='M391.427,179.924l-0.084-0.338c-3.834-15.501-15.212-31.635-29.458-43.911l-19.259,17.068  c11.452,9.125,21.264,21.766,24.052,32.78c7.62,34.907,7.62,70.292,0,105.2c-4.567,18.041-27.982,40.469-46.585,44.613  c-24.355,4.632-48.904,6.611-73.428,5.932c-0.488-0.014-0.957,0.176-1.296,0.526c-3.481,3.572-22.835,23.442-22.835,23.442  l-24.288,24.928c-1.776,1.852-4.896,0.593-4.896-1.964v-51.136c0-0.845-0.603-1.562-1.433-1.726c-0.005,0-0.009-0.002-0.014-0.002  c-10.573-2.355-22.692-10.618-32.028-20.621l-19.03,16.863c11.885,12.929,27.214,23.381,42.168,27.651v30.868  c0,11.173,13.615,16.66,21.357,8.597l31.275-32.509c6.784,0.379,13.569,0.591,20.356,0.591c23.057,0,46.125-2.181,69.023-6.549  l0.319-0.065c28.32-6.173,59.158-35.845,65.998-63.498l0.084-0.338C399.882,257.705,399.882,218.543,391.427,179.924z'/><path style='fill:#FFFFFF;' d='M296.47,314.327C298.956,313.561,293.61,313.458,296.47,314.327L296.47,314.327z'/><path style='fill:#D1D1D1;' d='M317.921,281.664c-3.753-3.305-7.806-6.142-11.874-9.042c-4.146-2.955-8.316-5.877-12.619-8.601  c-4.301-2.722-9.404-2.679-13.398,0.586c-4.086,3.341-5.973,9.737-11.804,10.418c-3.481,0.405-6.516-1.059-9.538-2.315  c-11.619-4.834-20.435-12.226-27.098-21.559l-14.16,12.55c0.481,0.557,0.94,1.129,1.429,1.679  c19.122,21.521,43.263,35.561,69.492,46.444c2.531,1.05,5.258,1.634,8.118,2.501c-2.86-0.869,2.488-0.765,0,0  c2.488-0.765,5.12-1.15,7.327-2.332c7.811-4.196,13.224-10.768,16.944-18.668C322.774,289.013,321.531,284.843,317.921,281.664z'/><g><path style='fill:#FFFFFF;' d='M256.159,165.431c-0.029,0-0.057-0.003-0.086-0.003   C256.045,165.426,256.081,165.428,256.159,165.431z'/><path style='fill:#FFFFFF;' d='M256.072,165.426c0.029,0,0.057,0.003,0.086,0.003C258.062,165.497,289.03,166.35,256.072,165.426z'/></g><g><path style='fill:#D1D1D1;' d='M305.285,185.837l-6.037,5.351c9.487,9.23,16.029,21.463,17.899,34.925   c0.672,4.842,0.919,9.745,1.272,14.627c0.179,2.467,1.415,4.768,4.167,4.736c2.663-0.033,4.06-2.376,3.867-4.844   c-0.459-5.866-0.824-11.776-1.853-17.555C321.957,208.229,315.07,195.518,305.285,185.837z'/><path style='fill:#D1D1D1;' d='M307.521,224.939c-1.729-11.578-6.532-21.026-14.51-28.224l-6.02,5.335   c3.113,2.763,5.806,6.008,7.88,9.587c3.665,6.323,5.244,13.583,5.256,20.849c0.002,1.11,0.055,2.284,0.412,3.317   c1.203,3.477,6.425,3.046,7.335-0.4c0.252-0.95,0.281-1.957,0.338-2.384c-0.057,0.429-0.138-2.353,0,0   c-0.138-2.353-0.222-4.139-0.357-5.923C307.802,226.371,307.629,225.659,307.521,224.939z'/></g><g><path style='fill:#FFFFFF;' d='M308.212,233.019C308.076,230.665,308.155,233.446,308.212,233.019L308.212,233.019z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c0.045-0.003,0.088-0.026,0.131-0.031c-0.121,0-0.307,0.003-0.498,0.01   C286.629,232.17,286.742,232.189,286.872,232.188z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c-0.129,0.002-0.243-0.017-0.367-0.021   C285.884,232.184,285.243,232.217,286.872,232.188z'/><path style='fill:#FFFFFF;' d='M287.003,232.157c-0.045,0.005-0.088,0.028-0.131,0.031   C287.208,232.165,287.179,232.157,287.003,232.157z'/></g><path style='fill:#D1D1D1;' d='M280.814,207.525l-6.128,5.432c0.338,0.205,0.669,0.419,0.99,0.652  c2.958,2.155,4.827,5.413,5.689,8.93c0.438,1.786,0.6,3.644,0.807,5.48c0.283,2.513,1.71,4.058,4.336,4.148  c0.191-0.005,0.379-0.009,0.498-0.01c1.264-0.14,2.531-1.026,2.936-2.774c0.245-1.057,0.133-2.226,0.036-3.331  C289.216,217.297,285.906,211.29,280.814,207.525z'/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>";
    // var arcItem.icon = "<svg xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'><circle style='fill:#6F3FAA;' cx='256' cy='256' r='256'/><path style='fill:#512D84;' d='M367.061,140.443c-62.312-15.05-124.735-32.654-188.637-10.288  c-41.374,15.515-41.374,60.337-39.65,98.263c0,10.343-12.067,24.135-6.896,36.202c10.343,34.478,18.963,68.956,55.165,86.195  c5.172,3.448,0,10.343,3.448,15.515c-1.724,0-5.172,1.724-5.172,3.448c0,8.263,3.708,20.902,1.245,29.05L296.57,508.788  c113.09-18.01,201.478-110.068,213.914-224.921L367.061,140.443z'/><g><path style='fill:#FFFFFF;' d='M391.427,179.924l-0.084-0.338c-6.84-27.653-37.678-57.325-65.998-63.498l-0.319-0.066   c-45.806-8.738-92.251-8.738-138.047,0l-0.329,0.066c-28.31,6.173-59.149,35.847-65.998,63.498l-0.076,0.338   c-8.456,38.617-8.456,77.781,0,116.398l0.076,0.338c6.558,26.472,35.099,54.782,62.362,62.567v30.868   c0,11.173,13.615,16.66,21.357,8.597l31.275-32.509c6.784,0.379,13.571,0.591,20.356,0.591c23.057,0,46.125-2.181,69.023-6.549   l0.319-0.066c28.32-6.173,59.158-35.847,65.998-63.498l0.084-0.338C399.882,257.705,399.882,218.543,391.427,179.924z    M366.676,290.723c-4.567,18.041-27.981,40.469-46.585,44.613c-24.355,4.632-48.904,6.611-73.428,5.932   c-0.488-0.014-0.957,0.176-1.296,0.526c-3.481,3.572-22.835,23.442-22.835,23.442l-24.288,24.928   c-1.776,1.852-4.896,0.591-4.896-1.964v-51.136c0-0.845-0.603-1.562-1.433-1.726c-0.005-0.002-0.009-0.002-0.014-0.003   c-18.604-4.144-42.01-26.572-46.585-44.613c-7.611-34.906-7.611-70.292,0-105.198c4.575-18.041,27.981-40.469,46.585-44.613   c42.536-8.09,85.664-8.09,128.191,0c18.613,4.144,42.018,26.572,46.585,44.613C374.296,220.431,374.296,255.817,366.676,290.723z'/><path style='fill:#FFFFFF;' d='M296.47,314.327c-2.86-0.869-5.585-1.452-8.118-2.501c-26.231-10.883-50.371-24.923-69.492-46.444   c-10.874-12.238-19.385-26.055-26.579-40.677c-3.412-6.934-6.287-14.139-9.218-21.299c-2.672-6.528,1.264-13.272,5.408-18.192   c3.889-4.617,8.894-8.149,14.314-10.754c4.23-2.032,8.402-0.86,11.492,2.725c6.678,7.752,12.814,15.9,17.78,24.886   c3.055,5.527,2.217,12.283-3.32,16.044c-1.346,0.914-2.572,1.988-3.825,3.02c-1.1,0.905-2.134,1.819-2.888,3.044   c-1.377,2.241-1.443,4.886-0.557,7.323c6.827,18.761,18.334,33.351,37.219,41.21c3.022,1.257,6.056,2.72,9.538,2.315   c5.83-0.681,7.718-7.077,11.804-10.418c3.993-3.265,9.097-3.308,13.398-0.586c4.303,2.724,8.473,5.646,12.619,8.601   c4.07,2.9,8.121,5.735,11.874,9.042c3.61,3.179,4.853,7.349,2.82,11.662c-3.72,7.901-9.135,14.472-16.944,18.668   C301.59,313.178,298.956,313.561,296.47,314.327C293.61,313.458,298.956,313.561,296.47,314.327z'/><path style='fill:#FFFFFF;' d='M256.071,165.426c34.309,0.962,62.49,23.731,68.529,57.651c1.029,5.78,1.395,11.688,1.853,17.555   c0.193,2.467-1.205,4.811-3.867,4.844c-2.75,0.033-3.987-2.269-4.167-4.734c-0.353-4.882-0.598-9.787-1.271-14.627   c-3.551-25.559-23.931-46.704-49.371-51.241c-3.829-0.683-7.745-0.862-11.624-1.269c-2.451-0.257-5.661-0.405-6.204-3.453   c-0.455-2.555,1.701-4.589,4.134-4.72C254.742,165.393,255.407,165.424,256.071,165.426   C290.382,166.388,255.407,165.424,256.071,165.426z'/><path style='fill:#FFFFFF;' d='M308.212,233.019c-0.057,0.429-0.086,1.436-0.338,2.384c-0.91,3.444-6.134,3.875-7.335,0.4   c-0.357-1.031-0.41-2.205-0.412-3.315c-0.012-7.266-1.591-14.526-5.256-20.849c-3.767-6.499-9.523-11.96-16.272-15.267   c-4.082-1.998-8.495-3.241-12.969-3.98c-1.955-0.324-3.931-0.519-5.896-0.793c-2.381-0.331-3.653-1.848-3.539-4.194   c0.105-2.198,1.712-3.781,4.108-3.644c7.873,0.446,15.479,2.15,22.48,5.856c14.234,7.539,22.366,19.437,24.74,35.326   c0.107,0.721,0.279,1.433,0.334,2.155C307.991,228.88,308.076,230.665,308.212,233.019   C308.155,233.446,308.076,230.665,308.212,233.019z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c-2.87,0.052-4.406-1.538-4.703-4.168c-0.205-1.834-0.369-3.694-0.807-5.48   c-0.862-3.517-2.731-6.775-5.689-8.93c-1.396-1.017-2.979-1.758-4.636-2.238c-2.105-0.609-4.293-0.441-6.392-0.955   c-2.281-0.559-3.543-2.407-3.184-4.546c0.326-1.948,2.22-3.468,4.349-3.313c13.302,0.96,22.809,7.837,24.166,23.497   c0.097,1.105,0.209,2.272-0.036,3.331C289.518,231.193,288.178,232.1,286.872,232.188   C284.001,232.239,288.178,232.1,286.872,232.188z'/></g><path style='fill:#D1D1D1;' d='M391.427,179.924l-0.084-0.338c-3.834-15.501-15.212-31.635-29.458-43.911l-19.259,17.068  c11.452,9.125,21.264,21.766,24.052,32.78c7.62,34.907,7.62,70.292,0,105.2c-4.567,18.041-27.982,40.469-46.585,44.613  c-24.355,4.632-48.904,6.611-73.428,5.932c-0.488-0.014-0.957,0.176-1.296,0.526c-3.481,3.572-22.835,23.442-22.835,23.442  l-24.288,24.928c-1.776,1.852-4.896,0.593-4.896-1.964v-51.136c0-0.845-0.603-1.562-1.433-1.726c-0.005,0-0.009-0.002-0.014-0.002  c-10.573-2.355-22.692-10.618-32.028-20.621l-19.03,16.863c11.885,12.929,27.214,23.381,42.168,27.651v30.868  c0,11.173,13.615,16.66,21.357,8.597l31.275-32.509c6.784,0.379,13.569,0.591,20.356,0.591c23.057,0,46.125-2.181,69.023-6.549  l0.319-0.065c28.32-6.173,59.158-35.845,65.998-63.498l0.084-0.338C399.882,257.705,399.882,218.543,391.427,179.924z'/><path style='fill:#FFFFFF;' d='M296.47,314.327C298.956,313.561,293.61,313.458,296.47,314.327L296.47,314.327z'/><path style='fill:#D1D1D1;' d='M317.921,281.664c-3.753-3.305-7.806-6.142-11.874-9.042c-4.146-2.955-8.316-5.877-12.619-8.601  c-4.301-2.722-9.404-2.679-13.398,0.586c-4.086,3.341-5.973,9.737-11.804,10.418c-3.481,0.405-6.516-1.059-9.538-2.315  c-11.619-4.834-20.435-12.226-27.098-21.559l-14.16,12.55c0.481,0.557,0.94,1.129,1.429,1.679  c19.122,21.521,43.263,35.561,69.492,46.444c2.531,1.05,5.258,1.634,8.118,2.501c-2.86-0.869,2.488-0.765,0,0  c2.488-0.765,5.12-1.15,7.327-2.332c7.811-4.196,13.224-10.768,16.944-18.668C322.774,289.013,321.531,284.843,317.921,281.664z'/><g><path style='fill:#FFFFFF;' d='M256.159,165.431c-0.029,0-0.057-0.003-0.086-0.003   C256.045,165.426,256.081,165.428,256.159,165.431z'/><path style='fill:#FFFFFF;' d='M256.072,165.426c0.029,0,0.057,0.003,0.086,0.003C258.062,165.497,289.03,166.35,256.072,165.426z'/></g><g><path style='fill:#D1D1D1;' d='M305.285,185.837l-6.037,5.351c9.487,9.23,16.029,21.463,17.899,34.925   c0.672,4.842,0.919,9.745,1.272,14.627c0.179,2.467,1.415,4.768,4.167,4.736c2.663-0.033,4.06-2.376,3.867-4.844   c-0.459-5.866-0.824-11.776-1.853-17.555C321.957,208.229,315.07,195.518,305.285,185.837z'/><path style='fill:#D1D1D1;' d='M307.521,224.939c-1.729-11.578-6.532-21.026-14.51-28.224l-6.02,5.335   c3.113,2.763,5.806,6.008,7.88,9.587c3.665,6.323,5.244,13.583,5.256,20.849c0.002,1.11,0.055,2.284,0.412,3.317   c1.203,3.477,6.425,3.046,7.335-0.4c0.252-0.95,0.281-1.957,0.338-2.384c-0.057,0.429-0.138-2.353,0,0   c-0.138-2.353-0.222-4.139-0.357-5.923C307.802,226.371,307.629,225.659,307.521,224.939z'/></g><g><path style='fill:#FFFFFF;' d='M308.212,233.019C308.076,230.665,308.155,233.446,308.212,233.019L308.212,233.019z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c0.045-0.003,0.088-0.026,0.131-0.031c-0.121,0-0.307,0.003-0.498,0.01   C286.629,232.17,286.742,232.189,286.872,232.188z'/><path style='fill:#FFFFFF;' d='M286.872,232.188c-0.129,0.002-0.243-0.017-0.367-0.021   C285.884,232.184,285.243,232.217,286.872,232.188z'/><path style='fill:#FFFFFF;' d='M287.003,232.157c-0.045,0.005-0.088,0.028-0.131,0.031   C287.208,232.165,287.179,232.157,287.003,232.157z'/></g><path style='fill:#D1D1D1;' d='M280.814,207.525l-6.128,5.432c0.338,0.205,0.669,0.419,0.99,0.652  c2.958,2.155,4.827,5.413,5.689,8.93c0.438,1.786,0.6,3.644,0.807,5.48c0.283,2.513,1.71,4.058,4.336,4.148  c0.191-0.005,0.379-0.009,0.498-0.01c1.264-0.14,2.531-1.026,2.936-2.774c0.245-1.057,0.133-2.226,0.036-3.331  C289.216,217.297,285.906,211.29,280.814,207.525z'/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>";
    // arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 52.511 52.511" style="enable-background:new 0 0 52.511 52.511;" xml:space="preserve"><g><g><path d="M31.256,0H21.254C10.778,0,2.255,8.521,2.255,18.995v9.01c0,7.8,4.793,14.81,12,17.665v5.841    c0,0.396,0.233,0.754,0.595,0.914c0.13,0.058,0.268,0.086,0.405,0.086c0.243,0,0.484-0.089,0.671-0.259L21.725,47h9.531    c10.476,0,18.999-8.521,18.999-18.995v-9.01C50.255,8.521,41.732,0,31.256,0z M48.255,28.005C48.255,37.376,40.63,45,31.256,45    h-9.917c-0.248,0-0.487,0.092-0.671,0.259l-4.413,3.997v-4.279c0-0.424-0.267-0.802-0.667-0.942    C8.81,41.638,4.255,35.196,4.255,28.005v-9.01C4.255,9.624,11.881,2,21.254,2h10.002c9.374,0,16.999,7.624,16.999,16.995V28.005z"/><path d="M39.471,30.493l-6.146-3.992c-0.672-0.437-1.472-0.585-2.255-0.423c-0.784,0.165-1.458,0.628-1.895,1.303l-0.289,0.444    c-2.66-0.879-5.593-2.002-7.349-7.085l0.727-0.632h0c1.248-1.085,1.379-2.983,0.294-4.233l-4.808-5.531    c-0.362-0.417-0.994-0.46-1.411-0.099l-3.019,2.624c-2.648,2.302-1.411,5.707-1.004,6.826c0.018,0.05,0.04,0.098,0.066,0.145    c0.105,0.188,2.612,4.662,6.661,8.786c4.065,4.141,11.404,7.965,11.629,8.076c0.838,0.544,1.781,0.805,2.714,0.805    c1.638,0,3.244-0.803,4.202-2.275l2.178-3.354C40.066,31.413,39.934,30.794,39.471,30.493z M35.91,34.142    c-0.901,1.388-2.763,1.782-4.233,0.834c-0.073-0.038-7.364-3.835-11.207-7.75c-3.592-3.659-5.977-7.724-6.302-8.291    c-0.792-2.221-0.652-3.586,0.464-4.556l2.265-1.968l4.152,4.776c0.369,0.424,0.326,1.044-0.096,1.411l-1.227,1.066    c-0.299,0.26-0.417,0.671-0.3,1.049c2.092,6.798,6.16,8.133,9.13,9.108l0.433,0.143c0.433,0.146,0.907-0.021,1.155-0.403    l0.709-1.092c0.146-0.226,0.37-0.379,0.63-0.434c0.261-0.056,0.527-0.004,0.753,0.143l5.308,3.447L35.91,34.142z"/><path d="M28.538,16.247c-0.532-0.153-1.085,0.156-1.236,0.688c-0.151,0.531,0.157,1.084,0.688,1.235    c1.49,0.424,2.677,1.613,3.097,3.104c0.124,0.44,0.525,0.729,0.962,0.729c0.09,0,0.181-0.012,0.272-0.037    c0.531-0.15,0.841-0.702,0.691-1.234C32.405,18.578,30.69,16.859,28.538,16.247z"/><path d="M36.148,22.219c0.09,0,0.181-0.012,0.272-0.037c0.532-0.15,0.841-0.703,0.691-1.234c-1.18-4.183-4.509-7.519-8.689-8.709    c-0.531-0.153-1.084,0.158-1.235,0.689c-0.151,0.531,0.157,1.084,0.688,1.235c3.517,1,6.318,3.809,7.311,7.328    C35.311,21.931,35.711,22.219,36.148,22.219z"/><path d="M27.991,7.582c-0.532-0.153-1.085,0.156-1.236,0.689c-0.151,0.531,0.157,1.084,0.688,1.235    c5.959,1.695,10.706,6.453,12.388,12.416c0.124,0.44,0.525,0.729,0.962,0.729c0.09,0,0.181-0.012,0.272-0.037    c0.531-0.15,0.841-0.703,0.691-1.234C39.887,14.753,34.613,9.467,27.991,7.582z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>';
    // arcItem.icon = "<img src='https://hahuunam.unitopcv.com/public/images/icons/bottom-bar/viber-icon.png' style='width: 25px;'></img>"
    arcItem.href = $('#arcontactus').attr("data-viber");
    arcItem.color = '#1C9CC5';
    arcItems.push(arcItem);
}
// var arcItem = {};
// arcItem.id = 'msg-item-7';
// arcItem.class = 'msg-item-envelope';
// arcItem.title = 'Gửi Email';
// arcItem.icon = '<svg  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M464 64H48C21.5 64 0 85.5 0 112v288c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zM48 96h416c8.8 0 16 7.2 16 16v41.4c-21.9 18.5-53.2 44-150.6 121.3-16.9 13.4-50.2 45.7-73.4 45.3-23.2.4-56.6-31.9-73.4-45.3C85.2 197.4 53.9 171.9 32 153.4V112c0-8.8 7.2-16 16-16zm416 320H48c-8.8 0-16-7.2-16-16V195c22.8 18.7 58.8 47.6 130.7 104.7 20.5 16.4 56.7 52.5 93.3 52.3 36.4.3 72.3-35.5 93.3-52.3 71.9-57.1 107.9-86 130.7-104.7v205c0 8.8-7.2 16-16 16z"></path></svg>';
// arcItem.href = 'mailto:mannguyenroii@gmail.com';
// arcItem.color = '#FF643A';
// arcItems.push(arcItem);
if($('#arcontactus').attr("data-phone") != ""){
    var arcItem = {};
    arcItem.id = 'msg-item-' + tempp;
    tempp++;
    arcItem.class = 'msg-item-phone';
    arcItem.title = 'Gọi Ngay';
    arcItem.icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z"></path></svg>';
    arcItem.href = 'tel:' + $('#arcontactus').attr("data-phone");
    arcItem.color = '#4EB625';
    arcItems.push(arcItem);
}
jQuery('#arcontactus').contactUs({
		items: arcItems
	});
});