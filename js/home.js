$(document).ready(function(){
	$("input[type=submit]").hover(highlight, lowlight);
});

var xDiff = 30;
var hDiff = 10;
var highlighted = false;
function highlight(){
	if (!$(this).is(":animated")){
		$(this).animate({
			top: "-=" + hDiff/2 + "px",
			left: "-=" + xDiff + "px",
			height: "+=" + hDiff + "px"
			}, "fast");
		$(this).css("z-index", "1");
		highlighted = true;
	}
}
function lowlight(){
	if (highlighted)
		$(this).animate({
		top: "+=" + hDiff/2 + "px",
		left: "+=" + xDiff + "px",
		height: "-=" + hDiff + "px"
		}, "fast");
	$(this).css("z-index", "0");
	highlighted = false;
}