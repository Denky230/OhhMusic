var modal = document.getElementById('modal');

var login = document.getElementById('login');
var login_form = document.getElementById('login_form');

var signup = document.getElementById('signup');
var signup_form = document.getElementById('signup_form');
var signup_bg = document.getElementById('signup_bg');
var signup_select_btn = document.getElementById('signup_select_btn');

// LOGIN BUTTON
login.addEventListener('click', function(){
    modal.style.display = "block";
    login_form.style.display = "block";
    document.getElementById('login_username').focus();
});

// SIGNUP BUTTON
signup.addEventListener('click', function(){
    signup_bg.style.display = "block";
});

// REGISTER BUTTON
signup_select_btn.addEventListener('click', function(){
    signup_bg.style.display = "none";
    modal.style.display = "block";
    signup_form.style.display = "block";
    document.getElementById('signup_username').focus();
    
    // Ajax to print register form based on user type
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("nonUserSpecFields").innerHTML = this.responseText;
            }
        };
    
    xmlhttp.open("GET", "ajax_register.php?t=" + document.getElementById("userType_select").value, true);
    xmlhttp.send();
});

// Hide modals by clicking out
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