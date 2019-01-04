function addCommas(nStr) {
    nStr += '';
    var x = nStr.split('.');
    var x1 = x[0];
    var x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function removeCommas(nStr) {
    return nStr.replace(/,/g, "");
}

function roundTwoDecimals(num) {
    return Math.round(num * 100) / 100
}

function convertFeetToInches(feet) {
    return feet * 12;
}

//Function to the css rule
function checkSize(){
    var smallScreen = "small";
    var largeScreen = "large";
    if ($(".resolutionSizeCheck").css("float") == "none" ){
        return smallScreen;
    }else{
        return largeScreen;
    }
}