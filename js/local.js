// $(document).ready(function(){
//     drawConcerts(document.getElementById("proposed"));
// });

// function drawConcerts(title){
//     // Underline active title
//     $("#frameTitle div").css("text-decoration", "none");
//     title.style.textDecoration = "underline";

//     ajax("ajax_local.php?concertState=" + title.getAttribute("id")).onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("concerts").innerHTML = this.responseText;
//         }
//     };
// }

function deleteConcert(id){
	ajax("ajax_local.php?deleteConcert=" + id).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        alert(this.responseText);
	    }
	};
}

function assignMusician(id){
	ajax("ajax_local.php?assignMusician=" + $("#musiciansApplied").val() + "&concertID=" + id).onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        alert(this.responseText);
	    }
	};
}
