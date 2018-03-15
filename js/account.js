var modal = document.getElementById('modal');

var login_btn = document.getElementById('login_btn');
var login_form = document.getElementById('login_form');

var signup_btn = document.getElementById('signup_btn');
var signup_form = document.getElementById('signup_form');
// User type select
var signup_bg = document.getElementById('signup_bg');
var signup_select_btn = document.getElementById('signup_select_btn');

var province_select = document.getElementById('sel_province');
var city_select = document.getElementById('sel_city');

// LOGIN BUTTON
login_btn.addEventListener('click', function(){
    modal.style.display = "block";
    login_form.style.display = "block";
    document.getElementById('login_username').focus();
});

// SIGNUP BUTTON
signup_btn.addEventListener('click', function(){
    signup_bg.style.display = "block";
});

// REGISTER BUTTON
signup_select_btn.addEventListener('click', function(){
    signup_bg.style.display = "none";
    modal.style.display = "block";
    signup_form.style.display = "block";
    document.getElementById('signup_username').focus();
        
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    // Ajax to print register form based on user type
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("nonUserSpecFields").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "ajax_register.php?t=" + document.getElementById("userType_select").value, true);
    xmlhttp.send();
    
    updateCities();
});

// Hide modals by clicking outside
window.onclick = function(event) {
    if (event.target == modal){
        // Close modal + childs
        modal.style.display = "none";
        login_form.style.display = "none";
        signup_form.style.display = "none";    
    } else if (event.target == signup_bg){
        // Close Sign-up select
        signup_bg.style.display = "none";
    }
};

// Change cities select based on province select selection
function updateCities(){    
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("citySelect").innerHTML = this.responseText;
        }
    };    
    
    xmlhttp.open("GET", "ajax_citySelect.php?p=" + province_select.value, true);
    xmlhttp.send();
};