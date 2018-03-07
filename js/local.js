$('button').click(function(){
    if($(this).hasClass('list')){
        $('#main #concert_box').removeClass('grid').addClass('list');
    }else if($(this).hasClass('grid')){
        $('#main #concert_box').removeClass('list').addClass('grid');
    }
});