
export function ajax(urlData) {
    // XMLHTTP object for new and old browsers
    if (window.XMLHttpRequest) {
        var xmlhttp = new XMLHttpRequest();
    } else {
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.open("GET", urlData, true);
    xmlhttp.send();

    return xmlhttp;
}
