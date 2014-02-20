/**
Author:          Paul Rodriguez
Created:         Around February-March, 2013
Last Updated:  2/20/2014

this creates an effect of a dropdown menu using
JQuery.  It does so using an Object that stores 
reference to the ul element and creates the functions
for the effects
**/

/**
constructor for Menu object.
@param mainMenuRef: takes ul element that holds the menu
**/
function Menu(mainMenuRef) {
	this.menu = mainMenuRef;
	this.complete = false;
	this.init();
}

/**
creates an effect when a user hovers over a sub-menu item
in our menu.
the effect should always finish even if user hovers out before it is supposed to finish.
@param liElement: the element that was hovered
**/
Menu.prototype.subMenuIn = function(liElement) {
	$(liElement).animate({'width': '+=20px', 'right':'+=10px', 'height':'+=20px'},{duration: 50, 
		complete: function() {
			$(this).css({"background-color":"yellow", "overflow":"visible", "display":"inner-block"});
		}
	});
}

/**
creates the effect for when the user moves out of a sub-menu item.
the effect should always finish even if user hovers out before it is supposed to finish.
@param liElement: item that user was on
**/
Menu.prototype.subMenuOut = function(liElement) {
	$(liElement).animate({'width': '-=20px', 'right':'-=10px', 'height':'-=20px'},{duration: 50, 
		complete: function() {
			this.style.backgroundColor = "white";
		}
	});
}

/**
drops sub-menu with an effect when the user hovers over one of
the main menu elements.
@param liElement: the li element hovered over.
**/
Menu.prototype.mainMenuIn = function(liElement) {
	var oThis = this;  //  reference to this Menu object

	var subMenuRef = liElement.getElementsByTagName("ul")[0];
	
	$(subMenuRef).stop(false, true).slideDown({duration: 500, easing: 'easeOutBounce', complete: function() {
		oThis.complete = true;
	}});

	
}

/**
hides the sub-menu when user hovers out of a main menu element.
@param liElement: take li element that was being hovered over
**/
Menu.prototype.mainMenuOut = function(liElement) {
	var oThis = this;  //  reference to this Menu object
	
	var subMenuRef = liElement.getElementsByTagName("ul")[0];
	$(subMenuRef).stop(false, true).slideUp({duration: 100, easing: 'easeInBounce'});
}

/**
initializes the JQuery functions for the hovering events
to add the effects and makes sure to remove the CSS version
of the drop down menu.
**/
Menu.prototype.init = function() {
	var oThis = this;  //  reference to this Menu object
	var getSubMenu = "#"+this.menu.id+" > li > ul.subMenuCssDropdown";
	
	$(getSubMenu).removeClass("subMenuCssDropdown");
	/*
	call this object's functions for hover events.
	note that we use oThis and not this as inside the hover function
	the 'this' variable becomes a reference to the object that was selected.
	*/
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