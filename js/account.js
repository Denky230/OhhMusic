var modal = document.getElementById('modal');

var login = document.getElementById('login');

var signup = document.getElementById('signup');
var signup_bg = document.getElementById('signup_bg');
var signup_select_btn = document.getElementById('signup_select_btn');

login.addEventListener('click', function(){
    "use strict";
    modal.style.display = "block";
    document.getElementById('login_username').focus();
});

signup.addEventListener('click', function(){
    "use strict";    
    signup_bg.style.display = "block";
});

signup_select_btn.addEventListener('click', function(){
    "use strict";
    modal.style.display = "block";
    signup_bg.style.display = "none";
});

// Hide modals by clicking out
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    } else if (event.target == signup_bg){
        signup_bg.style.display = "none";
    }
}