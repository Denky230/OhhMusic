var slide_index = 1;

displaySlides(slide_index);

function nextSlide(n){
    displaySlides(slide_index += n);
}
function currentSlide(n){
    displaySlides(slide_index = n);
}
function displaySlides(n){
    var slides = document.getElementsByClassName("showSlide");
    if (n > slides.length){
        slide_index = 1;
    }
    if (n < 1){
        slide_index = slides.length;
    }
    for (var i = 0; i < slides.length; i++){
        slides[i].style.display = "none";
    }
    slides([slide_index - 1]).setAttribute("style", "display:block");
}