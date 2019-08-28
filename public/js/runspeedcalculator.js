/*jshint esversion: 6 */


let isMilesValid = false;
let isMinutesValid = false;
let isSecondsValid = false;

$(document).ready(function () {
    "use strict";

    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

    isMilesValid = ValidateDistance($("#distance").val());
    isMinutesValid = ValidateMinutes($("#runMinutes").val());
    isSecondsValid = ValidateSeconds($("#runSeconds").val());
    if (isMilesValid && isMinutesValid && isSecondsValid) {
        $("#btnSubmitRunSpeed").removeAttr("disabled");
    }

    $("#distance").on("keyup change", function (e) {
        if (ValidateDistance($(this).val())) {
            $("#distanceError").text("");
            $("#distance").removeClass("is-invalid");
            $("#distance").addClass("is-valid");
            isMilesValid = true;
        } else {
            let distanceInputError = $("#distanceInputError").val();
            $("#distanceError").text(distanceInputError);
            $("#distance").removeClass("is-valid");
            $("#distance").addClass("is-invalid");
            isMilesValid = false;
        }
        EnableSubmitIfValid();
    });

    $("#runMinutes").on("keyup change", function (e) {
        if (ValidateMinutes($(this).val())) {
            $("#runMinutesError").text("");
            $("#runMinutes").removeClass("is-invalid");
            $("#runMinutes").addClass("is-valid");
            isMinutesValid = true;
        } else {
            let runMinutesErrorHidden = $("#runMinutesErrorHidden").val();
            $("#runMinutesError").text(runMinutesErrorHidden);
            $("#runMinutes").removeClass("is-valid");
            $("#runMinutes").addClass("is-invalid");
            isMinutesValid = false;
        }
        EnableSubmitIfValid();
    });

    $("#runSeconds").on("keyup change", function (e) {
        if (ValidateSeconds($(this).val())) {
            $("#runSecondsError").text("");
            $("#runSeconds").removeClass("is-invalid");
            $("#runSeconds").addClass("is-valid");
            isSecondsValid = true;
        } else {
            let runSecondsErrorHidden = $("#runSecondsErrorHidden").val();
            $("#runSecondsError").text(runSecondsErrorHidden);
            $("#runSeconds").removeClass("is-valid");
            $("#runSeconds").addClass("is-invalid");
            isSecondsValid = false;
        }
        EnableSubmitIfValid();
    });

    $("#btnSubmitRunSpeed").on("keyup click", function (e) {
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
    $('#mphAlert').removeAttr('hidden').show();
    let youMustRun = $("#youMustRun").val();
    let achieveGoal = $("#achieveGoal").val();
    $("#mphAlert h2").text(youMustRun + " " + mph + " " + achieveGoal);
}


function runSpeedDistCalculator(dist, m, s) {
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

function ValidateDistance(distance) {
    "use strict";
    if (isNaN(distance)) {
        return false;
    } else {
        distance = parseFloat(distance);
        if (distance >= 1 && distance <= 24) {
            return true;
        } else {
            return false;
        }
    }
}

function ValidateMinutes(minutes) {
    "use strict";
    if (isNaN(minutes)) {
        return false;
    } else {
        minutes = parseFloat(minutes);
        if (minutes >= 1 && minutes <= 300) {
            return true;
        } else {
            return false;
        }
    }
}

function ValidateSeconds(seconds) {
    "use strict";
    if (isNaN(seconds)) {
        return false;
    } else {
        seconds = parseFloat(seconds);
        if (seconds >= 0 && seconds <= 59) {
            return true;
        } else {
            return false;
        }
    }
}

function EnableSubmitIfValid() {
    if (isMilesValid && isMinutesValid && isSecondsValid) {
        $("#btnSubmitRunSpeed").removeAttr("disabled");
    } else {
        $("#btnSubmitRunSpeed").attr("disabled", "true");
    }
}