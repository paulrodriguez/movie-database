function Menu(mainMenuRef) {
	this.menu = mainMenuRef;
	this.complete = false;
	this.init();
}

Menu.prototype.subMenuIn = function(liElement) {
//if(!this.complete) return;
//	if(this.complete == false) return;
//	var liClassName = liElement.className;
	
	//console.log(liElement);
	//console.log("visibility:"+$(liElement).css("visbility"));
	var oWidth = $(liElement).width();//style.width;
	var currWidth = 0;
	//console.log("oWith: "+oWidth);
	//console.log("in before animation: " + $(liElement).width());
	//console.log("right: "+parseInt($(liElement).css("right")));
	$(liElement).animate({'width': '+=20px', 'right':'+=10px', 'height':'+=20px'},{duration: 50, 
	progress: function() {
		currWidth = $(this).width()-oWidth;
		//console.log("current width cange:"+currWidth);
		//console.
	},
	complete: function() {
		$(this).css({"background-color":"yellow", "overflow":"visible", "display":"inner-block"});
		//this.style.position = "relative";
		//console.log("completed animation: "+$(this).width());
	}
	});
	//console.log("in: " + $(liElement).css("width"));
	//$(liElement).css({'background-color' : 'yellow', 'position':'relative', 'width':'+=20px'});
}
Menu.prototype.subMenuOut = function(liElement) {
//if(!this.complete) return;
//	if(this.complete == false) return;
	//console.log("submenuout element width: "+$(liElement).width());

	//console.log("width on hover out: "+$(liElement).width());
	$(liElement).animate({'width': '-=20px', 'right':'-=10px', 'height':'-=20px'},{duration: 50, 
		progress: function() {
			//console.log("submenuout current width: "+$(this).width());
		},
		complete: function() {
			this.style.backgroundColor = "white";
			//console.log("submenuout finished function: "+$(this).width());//console.log(liElement);
	
		}
	});
	
	//$(liElement).css({'background-color' : 'white', 'position':'relative','overflow':'visible'});
}

Menu.prototype.mainMenuIn = function(liElement) {
	var oThis = this;
	//console.log(liElement);
	var subMenuRef = liElement.getElementsByTagName("ul")[0];
	//var subMenuRef = document.querySelectorAll(liElement.nodeName+">ul");
	//console.log("query in mainMenuIn: "+liElement.nodeName+">ul");
	//console.log(subMenuRef);
	$(subMenuRef).stop(false, true).slideDown({duration: 500, easing: 'easeOutBounce', complete: function() {
		oThis.complete = true;
	}});

	
}

Menu.prototype.mainMenuOut = function(liElement) {
	var oThis = this;
	var subMenuRef = liElement.getElementsByTagName("ul")[0];
	$(subMenuRef).stop(false, true).slideUp({duration: 100, easing: 'easeInBounce'});
}

Menu.prototype.init = function() {
	var oThis = this;
	var getSubMenu = "#"+this.menu.id+" > li > ul.subMenuCssDropdown";
	//console.log("submenu query:"+getSubMenu);
	$(getSubMenu).removeClass("subMenuCssDropdown");
	$("#"+this.menu.id+">li").hover(function() {oThis.mainMenuIn(this);}, function() {oThis.mainMenuOut(this);});
	$("#"+this.menu.id+">li>ul>li").hover(function() {oThis.subMenuIn(this);}, function() {oThis.subMenuOut(this);});
}

/*
function mainMenuIn() {
	//$(this).find('ul').css('background-color', 'white');
	//console.log(this);
	$(this).find("ul").stop(true).slideDown({duration : 500, easing : 'easeOutBounce'});
	//$('ul', this).stop(true).slideDown({duration : 500, easing : 'easeOutBounce'});
}

function mainMenuOut() {
	$('ul', this).stop(true).slideUp({duration : 100, easing : 'easeInBounce'});	
}

function subMenuIn() {
	//the positions of the divs called in this function must be relative
	//increase div width and height and move it to the right by some amount
	//this.style.position = "relative";

	$(this).animate({'width': '+=20px', 'right':'+=10px','height': '+=20px'},50);
	$(this).css({'background-color' : 'yellow'});
}

function subMenuOut() {
	//reverse everything we did in function : subMenuIn()
	//this.style.position = "relative";

	$(this).animate({'width': '-=20px', 'right':'-=10px', 'height': '-=20px'},50);
	$(this).css({'background-color' : 'white'});
}
window.onload = function() {
//$(document).ready(function () {	
	$('#main_menu ul.subMenuCssDropdown').removeClass('subMenuCssDropdown'); //remove the class name for the submenu
	$('#main_menu > li').hover(mainMenuIn, mainMenuOut);
	//$('.nav .wrapper .main_menu li').hover( mainMenuIn, mainMenuOut);
	//hover for the links in the submenu
	$('ul.subMenuDropdown>li').hover(subMenuIn, subMenuOut);
	/*$('.submenu_css>li div').hover( function (){$(this).css({'background-color' : 'yellow'});}, 
		function () {$(this).css({'background-color' : 'white'});});*/
//});
/*};
*/



/*******************

submenuin animate fail function

,
	fail: function() {
		var setTotalAnimationWidth = $(this).width()-currWidth+20;
		var setTotalAnimationWidth=setTotalAnimationWidth+"px";
		//console.log("set total animation width: "+setTotalAnimationWidth);
		$(this).css({"width":setTotalAnimationWidth,"right":"10px"});
		//$(this).css({"width": currWidth});
		//console.log("animation failed");
		//console.log("width in submenuin failed function: "+$(this).width());
	}

	
	
submenu out animate fail function
fail: function() {

			$(this).css({"right":"0px"});
		}




************************/