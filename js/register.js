var province_select = document.getElementById('sel_province');
var city_select = document.getElementById('sel_city');

if (window.XMLHttpRequest) {
    var xmlhttp = new XMLHttpRequest();
 } else {
    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

window.addEventListener('load', updateCities, false);

function updateCities(){
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("citySelect").innerHTML = this.responseText;
            }
        };
    
    xmlhttp.open("GET", "citySelect.php?p=" + province_select.value, true);
    xmlhttp.send();
};