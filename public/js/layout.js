$(document).ready(function () {
    "use strict";
    var date = new Date();
    $("#currentYear").text(" " + date.getFullYear());

    if(!Modernizr.es6object) {
        var options = {
            backdrop: "static",
            keyboard: false,
            focus: true,
            show: true
        };
        $('#browserSupportModal').modal(options);
    }
});