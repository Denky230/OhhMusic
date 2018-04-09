//local.js

$('#view_icons img').on('click',function(){
    if ( $(this).hasClass('view-list') ) {
        $('#frame').removeClass('grid').addClass('list');
        $('.concert_box').css('height', '120px').css('width', '100%');
    } else if ( $(this).hasClass('view-grid') ) {
        $('#frame').removeClass('list').addClass('grid');
        $('.concert_box').css('height', '300px').css('width', '32%');
    }
});
