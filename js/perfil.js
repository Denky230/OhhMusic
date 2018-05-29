$(document).ready(function() {
	updateCities();

	$("#edit_pass").click(editPass);
});

function editPass() {
	// Display background w/ alpha
	parent.document.getElementById("modal").style.display = "block";

	// Display edit password window
	ajax("ajax_modal.php?edit_pass").onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        parent.document.getElementById("modal").innerHTML = this.responseText;

	        pass = parent.document.getElementById("pass");
	        newPass = parent.document.getElementById("newPass");
	        verPass = parent.document.getElementById("verPass");

	        pass.addEventListener("keyup", checkPassword);
	        newPass.addEventListener("keyup", checkNewPassword);	        
	        newPass.addEventListener("keyup", checkVerifyPassword);
	        verPass.addEventListener("keyup", checkVerifyPassword);
	        parent.document.getElementById("edit_pass_submit").addEventListener("click", function(event) {
	        	// TO DO: If at least 1 check fails, prevent submit
	        });
	    }
	};
}

function checkPassword() {
	var input = $(this);
	ajax("ajax_modal.php?check_pass=" + input.val()).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        if (this.responseText) {
	        	input.css("border", "2px solid green");
	        	return true;
	        } else {
	        	input.css("border", "2px solid red");
	        	return false;
	        }
	    }
	};
}
function checkNewPassword() {
	if (newPass.value != pass.value) {
		$(this).css("border", "2px solid green");
		return true;
	} else {
		$(this).css("border", "2px solid red");
		return false;
	}
}
function checkVerifyPassword() {
	if (verPass.value == newPass.value) {
		verPass.style.border = "2px solid green";
		return true;
	} else {
		verPass.style.border = "2px solid red";
		return false;
	}
}

function verifyPassword() {
	// If at least 1 check fails, prevent submit
	if (!checkPassword || !checkNewPassword || !checkVerifyPassword)
		event.preventDefault();
}