
$('#view_icons img').click(function(){
    if ($(this).is('#list_ico')) {
        $('.concert_box').addClass("list_item");
    } else if ($(this).is('#grid_ico')) {
        $('.concert_box').removeClass("list_item");
    }
});
