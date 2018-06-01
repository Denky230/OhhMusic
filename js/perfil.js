var modal = parent.document.getElementById("modal");

var passwordOk = false;
var newPasswordOk = false;
var verifyPasswordOk = false;

$(document).ready(function() {
	updateCities();

	$("#edit_pass").click(editPass);
});

function editPass() {
	// Display background w/ alpha
	modal.style.display = "block";

    // Hide window by clicking outside
	modal.addEventListener("click", function(event) {
		if (event.target.id == "modal")
			modal.style.display = "none";
	});

	// Display edit password window
	ajax("ajax_modal.php?edit_pass").onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        modal.innerHTML = this.responseText;

	        pass = parent.document.getElementById("pass");
	        newPass = parent.document.getElementById("newPass");
	        verPass = parent.document.getElementById("verPass");

	        // Pass inputs listeners
	        pass.addEventListener("keyup", checkPassword);
	        pass.addEventListener("keyup", checkNewPassword);
	        newPass.addEventListener("keyup", checkNewPassword);
	        newPass.addEventListener("keyup", checkVerifyPassword);
	        verPass.addEventListener("keyup", checkVerifyPassword);

	        // Submit listener
	        parent.document.getElementById("edit_pass_submit").addEventListener("click", function(event) {	        	
	        	if (pass.value != "" && newPass.value != "" && verPass.value != "") {
	        		// If at least 1 check fails, prevent submit
	        		if (passwordOk) {
	        			if (newPasswordOk) {
        					if (verifyPasswordOk) {
        						alert("Tu contraseña ha sido modificada.");
        						return;
        					} else alert("Las nuevas contraseñas no coinciden.");
	        			} else alert("La nueva contraseña no puede ser igual a la anterior.");
	        		} else alert("La contraseña introducida es incorrecta.");

	        		event.preventDefault();
	        	}
	        });
	    }
	};
}

function checkPassword() {
	ajax("ajax_modal.php?check_pass=" + pass.value).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        if (this.responseText) {
	        	pass.style.border = "2px solid green";
	        	passwordOk = true;
	        } else {
	        	pass.style.border = "2px solid red";
	        	passwordOk = false;
	        }
	    }
	};
}
function checkNewPassword() {
	if (newPass.value != ""){
		if (newPass.value != pass.value) {
			newPass.style.border = "2px solid green";
			newPasswordOk = true;
		} else {
			newPass.style.border = "2px solid red";
			newPasswordOk = false;
		}	
	}	
}
function checkVerifyPassword() {
	if (verPass.value != "") {
		if (verPass.value == newPass.value) {
			verPass.style.border = "2px solid green";
			verifyPasswordOk = true;
		} else {
			verPass.style.border = "2px solid red";
			verifyPasswordOk = false;
		}	
	}	
}