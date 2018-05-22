var modal = $("#modal");

var login_form = $("#login_form");
var signup_form = $("#signup_form");
var signup_select_modal = $("#signup_select_modal"); // User type select

$(document).ready(function() {
    // Login button
    $("#login_btn").click(function() {
        modal.css("display", "block");
        login_form.css("display", "block");
        $("#login_username").focus();

        // Hide modal by clicking outside
        $(window).click(function(event) {
            if (event.target.id == modal.attr("id")) {
                modal.css("display", "none");
                login_form.css("display", "none");    
            }            
        });
    });

    // Sign Up button
    $("#signup_btn").click(function() {
        signup_select_modal.css("display", "block");

        // Hide modal by clicking outside
        $(window).click(function(event) {
            if (event.target.id == signup_select_modal.attr("id"))
                signup_select_modal.css("display", "none");
        });
    });

    // Register button (user type select)
    $("#register_btn").click(showRegisterForm);
});

// Register button
function showRegisterForm() {
    signup_select_modal.css("display", "none");
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

// Change cities select based on community select selection
function updateCities() {
    ajax("ajax_citySelect.php?p=" + $("#community_select").val()).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("citySelect").innerHTML = this.responseText;
        }
    };
}
