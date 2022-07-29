function onlyString(str) {
    let regExp = /[^a-zA-Z ]/g;
    let letters = str.replace(regExp, '');
    return letters;
}

function onlyNum(str) {
    let regExp = /[^0-9]/g;
    let letters = str.replace(regExp, '');
    return letters;
}

$(document).ready(function() {
    $(".only-string").on("keypress", function(e) {
        e.target.value = onlyString(e.target.value);
    })
    $(".only-string").on("change", function(e) {
        e.target.value = onlyString(e.target.value);
    })
    $(".only-string").on("keyup", function(e) {
        e.target.value = onlyString(e.target.value);
    })

    $(".only-num").on("keypress", function(e) {
        e.target.value = onlyNum(e.target.value);
    })
    $(".only-num").on("change", function(e) {
        e.target.value = onlyNum(e.target.value);
    })
    $(".only-num").on("keyup", function(e) {
        e.target.value = onlyNum(e.target.value);
    })
});