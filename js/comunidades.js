Array.prototype.unique = function() {
    return this.filter(function (value, index, self) {
        return self.indexOf(value) === index;
    });
}

var createOption = function (text) {
    var option = document.createElement("option");
    option.value = text;
    option.innerHTML = text;
    return option;
}

var queryMunicipality = function (text, callback) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if(r.readyState != 4 || r.status != 200) return;
        callback(r.responseText);
    };
    r.open("POST", "bbdd.php", true);
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send('query=municipio='+text);
}

var queryProvince = function (text, callback) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if(r.readyState != 4 || r.status != 200) return;
        callback(r.responseText);
    };
    r.open("POST", "bbdd.php", true);
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send('query=provincia&provin='+text);
}

//Calls query for the php function
var queryCouncil = function (callback) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if(r.readyState != 4 || r.status != 200) return;
        callback(r.responseText);
    };
    r.open("POST", "bbdd.php", true);
    r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    r.send('query=comunidad');
}

//Loads the page from the beginning
window.onload = function () {
    var councilSelect = document.getElementById("council-select");
    var provincesContainer = document.getElementsByClassName("provinces")[0];
    var provincesSelect = document.getElementById("provinces-select");
    var municipalityContainer = document.getElementsByClassName("municipalities")[0];
    var municipalitySelect = document.getElementById("municipality-select");

    councilSelect.onchange = function (ev) {
        var searchedCouncil = ev.target.value;
        provincesContainer.classList.add('hidden_01');

        queryProvince(searchedCouncil, function (result) {
            var provinces = [];
            result.split("/").slice(0, -1).forEach(function (province) {
                provinces.push(province);
            });
            provinces.unique().forEach(function (elem) {
                provincesSelect.appendChild(createOption(elem));
            });
            if (provinces.length !== 0) {
                provincesContainer.classList.remove('hidden_01');
            }
        });
    }
    provincesSelect.onchange = function (ev) {
        var searchedProvince = ev.target.value;
        municipalityContainer.classList.add('hidden_02');

        queryMunicipality(searchedProvince, function (result) {
            var municipalities = [];
            result.split("/").slice(0, -1).forEach(function (municipality) {
                municipalities.push(municipality);
            });
            municipalities.unique().forEach(function (elem) {
                municipalitySelect.appendChild(createOption(elem));
            });
            if(municipalities.length !== 0){
                municipalityContainer.classList.remove('hidden_02');
            }
        });
    }
    queryCouncil(function (result) {
        result.split("/").slice(0, -1).forEach(function(elem){
            councilSelect.appendChild(createOption(elem));
        });
    });
}