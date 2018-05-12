var modal = document.getElementById('modal');

var signup_form = document.getElementById('signup_form');
var signup_bg = document.getElementById('signup_bg'); // User type select

$(document).ready(function() {
    /* SET TRIGGER LISTENERS */
    // Login button
    $("#login_btn").click(function() {            
        modal.style.display = "block";
        login_form.style.display = "block";
        $("#login_username").focus();
    });
    // Sign Up button
    $("#signup_btn").click(function() {
        signup_bg.style.display = "block";
    });
    // Register button (user type select)
    $("#register_btn").click(showRegisterForm);

    // Hide modals by clicking outside
    $(window).click(hideModals);
});

// REGISTER BUTTON
function showRegisterForm(){
    signup_bg.style.display = "none";
    modal.style.display = "block";
    signup_form.style.display = "block";
    $("#signup_username").focus();
    
    // Add the text from the user type select to the register title
    $("#signup_title").text("REGISTRO " + userType_select.options[userType_select.selectedIndex].text.toUpperCase());

    // Show user type specific fields
    ajax("ajax_register.php?t=" + $("#userType_select").val()).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("nonUserSpecFields").innerHTML = this.responseText;
        }
    };
    
    updateCities();
};

// Hide modals by clicking outside
function hideModals(event) {
    if (event.target == modal){
        // Close modal + childs
        modal.style.display = "none";
        login_form.style.display = "none";
        signup_form.style.display = "none";
    } else if (event.target == signup_bg){
        // Close Sign-up select
        signup_bg.style.display = "none";
    }
}

// Change cities select based on community select selection
function updateCities() {
    ajax("ajax_citySelect.php?p=" + $("#community_select").val()).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("citySelect").innerHTML = this.responseText;
        }
    };
}

function verifyPass(){
    
}

function verifySignup(){
    
}