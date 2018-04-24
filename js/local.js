$(document).ready(function(){
    var today = new Date();
    // Restrict minimum input date to tomorrow
    var dateString = today.getFullYear() + "-"
        + ('0' + (today.getMonth()+1)).slice(-2) + "-"
        + ('0' + (today.getDate()+1)).slice(-2);
    document.getElementById("concert_date").min = dateString;

    drawConcerts(document.getElementById("proposed"));
});

function drawConcerts(title){
    // Underline active title
    $("#frameTitle div").css("text-decoration", "none");
    title.style.textDecoration = "underline";

    ajax("ajax_local.php?concertState=" + title.getAttribute("id")).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
        }
    };
}

function deleteConcert(id){
	ajax("ajax_local.php?deleteConcert=" + id).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        alert(this.responseText);
	    }
    	drawConcerts(document.getElementById("proposed"));
	};
}

function assignMusician(id){
	ajax("ajax_local.php?assignMusician=" + $("#musiciansApplied").val() + "&concertID=" + id).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        alert(this.responseText);
	    }
    	drawConcerts(document.getElementById("proposed"));
	};
}
