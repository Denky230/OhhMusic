$(document).ready(function() {
	drawContent(document.getElementById("concert"));
});

function drawContent(title, orderByField, order) {
    // Set default values
    orderByField = orderByField == undefined ? 1 : ++orderByField;
    if (order == undefined) order = "ASC";

	// Underline active title
    $("#frameTitle div").css("text-decoration", "none");
    title.style.textDecoration = "underline";

    ajax("ajax_fan.php?draw=" + title.getAttribute("id") + "&orderByField=" + orderByField + "&order=" + order).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
            $(".header").click(orderContent);
        }
    };
}

function voteMusician(musician, value) {
    console.log("musician");
    ajax("ajax_fan.php?voteMusician=" + musician +"&value="+ value).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            drawContent(document.getElementById("musician"));
        }
    };
}

function voteConcert(concert, value) {
    console.log("concert");
    ajax("ajax_fan.php?voteConcert=" + concert +"&value="+ value).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {            
            drawContent(document.getElementById("concert"));
        }
    };
}

function orderContent() {
    var order = $(this).children("img").attr("id");
    if (order == "DESC")
        drawContent(document.getElementById("musician"), $(this).attr("id"), "ASC");
    else drawContent(document.getElementById("musician"), $(this).attr("id"), "DESC");
}