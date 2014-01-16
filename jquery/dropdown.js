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

$(document).ready(function () {	
	$('#main_menu ul.subMenuCssDropdown').removeClass('subMenuCssDropdown'); //remove the class name for the submenu
	$('#main_menu > li').hover(mainMenuIn, mainMenuOut);
	//$('.nav .wrapper .main_menu li').hover( mainMenuIn, mainMenuOut);
	//hover for the links in the submenu
	$('ul.subMenuDropdown>li').hover(subMenuIn, subMenuOut);
	/*$('.submenu_css>li div').hover( function (){$(this).css({'background-color' : 'yellow'});}, 
		function () {$(this).css({'background-color' : 'white'});});*/
});

