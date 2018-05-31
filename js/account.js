var modal = $("#modal");

var login_form = $("#login_form");
var signup_form = $("#signup_form");
var signup_select_modal = $("#signup_select_modal"); // User type select

$(document).ready(function() {
    // Login button
    $("#login_btn").add("#register_btn").click(showModal);

    // Sign Up button (user type select)
    $("#signup_btn").click(function() {
        signup_select_modal.css("display", "block");

        // Hide select window by clicking outside
        $(window).click(function(event) {
            if (event.target.id == signup_select_modal.attr("id"))
                signup_select_modal.css("display", "none");
        });
    });
});

function showModal() {
    // Display background w/ alpha
    modal.css("display", "block");

    ajax("ajax_modal.php?" + $(this).attr("id")).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("modal").innerHTML = this.responseText;

            // Display sign up form
            showRegisterForm();

            $("#modal input").first().focus();

            // Validate login form
            $("#login_submit").click(function(event) {
                // Check if there's any empty field
                var submit = false;
                $("#modal input").each(function() {
                    if ($(this).val() == "") submit = true;
                });

                if (!submit) {
                    event.preventDefault();

                    $.ajax({
                        url: "ajax_modal.php?check_login=" + $("#login_username").val() + "&pass=" + $("#login_pass").val(),
                        success: function(data) {
                            if (data == "Ok") {
                                $("#login_submit").trigger("event");
                            }
                        }
                    });
                }
            });
        }
    };

    // Hide modal by clicking outside
    $(window).click(function(event) {
        if (event.target.id == modal.attr("id")) {
            modal.children().addBack().css("display", "none");
        }
    });
}

// Register button
function showRegisterForm() {
    signup_select_modal.css("display", "none");

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