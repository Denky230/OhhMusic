$(document).ready(function(){
	$("input[type=submit]").hover(highlight, lowlight);
	$("#changeimage").click(changeImage());
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
function changeImage(){
	var image = document.getElementById('changeimage');
    if(image.src.match("icons8-corazones-40.png")){
        image.src="icons8-corazones-40(1).png";
    }else{
        image.src="icons8-corazones-40.png";
    }
}