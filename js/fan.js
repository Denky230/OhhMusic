$(document).ready(function() {
	drawContent(document.getElementById("concert"));
});

function drawContent(title) {
	// Underline active title
    $("#frameTitle div").css("text-decoration", "none");
    title.style.textDecoration = "underline";

    ajax("ajax_fan.php?draw=" + title.getAttribute("id")).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
        }
    };
}

function vote() {
	
}