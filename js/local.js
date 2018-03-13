//local.js

$('#header img').on('click',function(){
    if ( $(this).hasClass('view-list') ) {
        $('#frame').removeClass('grid').addClass('list');
    } else if ( $(this).hasClass('view-grid') ) {
        $('#frame').removeClass('list').addClass('grid');
    }
});

$('.frame').each(function(){
    var images = ['random.jpg','https://goo.gl/b93Zu','https://goo.gl/y4kdu',
        'https://goo.gl/eh4OX','https://goo.gl/aR2Y0','https://goo.gl/L16VF'];
    $(this).find('.image')
        .css({ 'background-image': 'url('+images[Math.floor(Math.random()*images.length)]+')' });
    var like = 100,
        likes = Math.floor(Math.random() * like) + 1;
    $(this).find('.likes').text(likes);
    var comment = 50,
        comments = Math.floor(Math.random() * comment) + 1;
    $(this).find('.comments').text(comments);
});
