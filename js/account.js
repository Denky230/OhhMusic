var login = document.getElementById('login');
var signup = document.getElementById('signup');
var modal = document.getElementById('modal');

login.addEventListener('click', function(){
    "use strict";
    modal.style.display = "block";
    document.getElementById('login_username').focus();
});

signup.addEventListener('click', function(){
    "use strict";    
    modal.style.display = "block";
});

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}