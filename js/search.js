var search_icon = document.getElementById('search_icon');
var search_bar = document.getElementById('search_bar');

search_icon.addEventListener('click', function(){
    search_bar.classList.toggle('search_bar_show');
    search_bar.focus();
});