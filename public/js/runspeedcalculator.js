/*jshint esversion: 6 */

(function () {
    'use strict';
    window.addEventListener('load', function () {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
            }, false);
        });
    }, false);
})();

$(document).ready(function () {
    "use strict";
    $("#btnSubmitRunSpeed").on("keyup click", function(e){
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            getMilesPerHour();
        }
    });
});

function getMilesPerHour() {
    "use strict";
    var distanceVal = $("#distance").val();
    var minutesVal = $("#runMinutes").val();
    var secondsVal = $("#runSeconds").val();
    var mph = runSpeedDistCalculator(distanceVal, minutesVal, secondsVal);
    $('#mphParagraph').removeAttr('hidden').show();
    $("#mphParagraph").text("You must run " + mph + " mph to acheive your goal.");
}


function runSpeedDistCalculator(dist, m, s)
{
    "use strict";
    dist = parseFloat(dist);
    m = parseFloat(m);
    s = parseFloat(s);
    let secondsPerMinute = 60.0;
    let minuteFraction = s / secondsPerMinute;
    let miles = dist; // 6
    let minutes = m + minuteFraction;
    let hour = 60;
    let mpm = minutes / miles;
    let milesPerHour = hour / mpm;
    milesPerHour = milesPerHour.toFixed(2);
    return milesPerHour;
}