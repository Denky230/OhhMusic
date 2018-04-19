$(document).ready(function(){
    drawConcerts(document.getElementById("proposed"));
});

function drawConcerts(title){
    // Underline active title
    $("#frameTitle div").css("text-decoration", "none");
    title.style.textDecoration = "underline";

    ajax("ajax_concerts.php?concertState=" + title.getAttribute("id")).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("concerts").innerHTML = this.responseText;
        }
    };
}

function subConcert(id){
    ajax("ajax_concerts.php?subConcert=" + id).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            drawConcerts(document.getElementById("proposed"));
        }
    };
}

function unsubConcert(id) {
    ajax("ajax_concerts.php?unsubConcert=" + id).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            drawConcerts(document.getElementById("pending"));
        }
    };
}

function deleteConcert(id){
    ajax("ajax_concerts.php?deleteConcert=" + id).onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);            
        }
    };
}