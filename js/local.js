
$('#header button').on('click', function(){
    if($(this).hasClass('view-list')){
        $('#frame').removeClass('grid').addClass('list');
    }else if($(this).hasClass('view-grid')){
        $('#frame').removeClass('list').addClass('grid');
    }
});

$('.frame').each(function(){
    var images = ['https://goo.gl/CbesS','https://goo.gl/b93Zu'];
    $(this).find('.image').css({'background-image': 'url(' +images[Math.floor(Math.random()*images.length)]+')'});
    var like = 100,
    likes = Math.floor(Math.random()*like)+1;
    $(this).find('.likes').text(likes);
    var comment = 50,
    comments =  Math.floor(Math.random() * comment)+1;
    $(this).find('.comments').text(comments);
});

$('.description').text('dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.');