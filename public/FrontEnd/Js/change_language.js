// English to Khmer
function changeKhLang() {
    const geturl = window.location.href;
    if (geturl.slice(-1) == "/") {
        location.replace(geturl + "en");
    } else if (geturl.slice(-2) == "/#") {
        let changeToKh = geturl.slice(0, -2);
        location.replace(changeToKh + "/en");
    } else {
        location.replace(geturl + "/en");
    }
}
// Khmer to English
function changeEnLang() {
    const geturl = window.location.href;
    let changeToEn = geturl.slice(0, -3);
    location.replace(changeToEn);
}
