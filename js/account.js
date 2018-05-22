var modal = $("#modal");

var login_form = $("#login_form");

var signup_form = $("signup_form");
var signup_bg = $("signup_bg"); // User type select

$(document).ready(function() {
    /* SET LISTENERS */
    // Login button
    $("#login_btn").click(function() {
        modal.css("display", "block");
        login_form.css("display", "block");
        $("#login_username").focus();

        // Hide modals by clicking outside
        $(window).click(hideModals);
    });
    // Sign Up button
    $("#signup_btn").click(function() {
        signup_bg.css("display", "block");
    });
    // Register button (user type select)
    $("#register_btn").click(showRegisterForm);
});

// REGISTER BUTTON
function showRegisterForm() {
    signup_bg.css("display", "none");
    modal.css("display", "block");
    signup_form.css("display", "block");
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
    if (event.target.id == modal.attr("id")) {
        // Close modal + childs
        modal.css("display", "none");
        login_form.css("display", "none");
        signup_form.css("display", "none");
    } else if (event.target.id == signup_bg.attr("id")) {
        // Close Sign-up select
        signup_bg.css("display", "none");
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
