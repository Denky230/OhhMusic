var x = $(document);
x.ready(startEvents);

function startEvents(){
    onLoad();
    
    // Assign event listeners
    var x = $("#frameTitle div");
    x.click(ajaxConcerts);
}

function onLoad(){
    // Underline default title
    $("#proposed").css("text-decoration", "underline");
    
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // Ajax to print register form based on user type
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
        }
    };
    // Pass user user type to ajax_register.php
    xmlhttp.open("GET", "ajax_musico.php?concertType=proposed", true);
    xmlhttp.send();
}

function ajaxConcerts(){
    // Get title clicked on
    var x = $(this);
    
    // Underline active title
    $("#frameTitle div").css("text-decoration", "none");
    x.css("text-decoration", "underline");
    
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // Ajax to print register form based on user type
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
        }
    };
    // Pass user user type to ajax_register.php
    xmlhttp.open("GET", "ajax_musico.php?concertType=" + x.attr("id"), true);
    xmlhttp.send();
}

function signUpConcert(){
    // Get concert id
    var x = $("#id_concert");
    
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    // Ajax to print register form based on user type
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.response == "Ok")
                alert("Te has registrado correctamente a " + x);
        }
    };
    // Pass user user type to ajax_register.php
    xmlhttp.open("GET", "ajax_musico.php?concertID=" + x, true);
    xmlhttp.send();
}