var search_icon = document.getElementById('search_icon');
var search_bar = document.getElementById('search_bar');

search_icon.addEventListener('click', function(){
    search_bar.classList.toggle('search_bar_show');
    
    if (search_bar.className == 'search_bar_show'){
        search_bar.value = "";
        search_bar.focus();
    }    
});

function fill(value) {
    $('#search_bar').val(value);
    $('#display').hide();
}

$(document).ready(function () {
    $("#search_bar").keyup(function () {
        var name = $('#search_bar').val();
        if(name == ""){
            $("#display").html("");
        }else{
            $.ajax({
                type: "POST",
                url: "ajax_search.php",
                data: {
                    search: name
                },
                success: function (html) {
                    $("#display").html(html).show();
                }
            });
        }
    });
});