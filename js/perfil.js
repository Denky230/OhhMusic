$(document).ready(function() {
	updateCities();

	$("#edit_pass").click(function() {
		parent.document.getElementById("modal").style.display = "block";
	});
});