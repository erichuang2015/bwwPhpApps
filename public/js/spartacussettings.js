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
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

    var diffLvlStatus = false;
    var lightWeightStatus = false;
    var heavyWeightStatus = false;

    var diffLvl = $("#difficultyLvl");
    var difficultySelectedIndex = diffLvl[0].dataset.difficultylvl;
    difficultySelectedIndex = parseInt(difficultySelectedIndex, 10);
    if (difficultySelectedIndex > 0) {
        diffLvl[0].selectedIndex = difficultySelectedIndex.toString();
    }

    var lightWeight = $("#lightWeight");
    var lightSelectedIndex = lightWeight[0].dataset.lightweight;
    lightSelectedIndex = parseInt(lightSelectedIndex, 10);
    if (lightSelectedIndex > 0) {
        lightWeight[0].selectedIndex = lightSelectedIndex.toString();
    }

    var heavyWeight = $("#heavyWeight");
    var heavySelectedIndex = heavyWeight[0].dataset.heavyweight;
    heavySelectedIndex = parseInt(heavySelectedIndex, 10);
    if (heavySelectedIndex > 0) {
        heavyWeight[0].selectedIndex = heavySelectedIndex.toString();
    }

    if (difficultySelectedIndex > 0 && lightSelectedIndex > 0 && heavySelectedIndex > 0) {
        $("#submitBtn").removeAttr("disabled");
    }

    $(diffLvl).on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            // var difficultySelectedIndex = diffLvl[0].dataset.difficultylvl;
            // difficultySelectedIndex = parseInt(difficultySelectedIndex, 10);
            if (diffLvl[0].selectedIndex > 0) {
                $("#difficultyLvlError").text("");
                $(diffLvl).removeClass("is-invalid");
                $(diffLvl).addClass("is-valid");
                diffLvlStatus = true;
            }
            else {
                $("#difficultyLvlError").text("Error: Please select a difficulty level.");
                $(diffLvl).removeClass("is-valid");
                $(diffLvl).addClass("is-invalid");
                diffLvlStatus = false;
            }
        }
    });

    $(lightWeight).on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            // var lightSelectedIndex = lightWeight[0].dataset.lightweight;
            // lightSelectedIndex = parseInt(lightSelectedIndex, 10);
            if (lightWeight[0].selectedIndex > 0) {
                $("#lightWeightError").text("");
                $(lightWeight).removeClass("is-invalid");
                $(lightWeight).addClass("is-valid");
                lightWeightStatus = true;
            }
            else {
                $("#lightWeightError").text("Error: Please provide a weight selection.");
                $(lightWeight).removeClass("is-valid");
                $(lightWeight).addClass("is-invalid");
                lightWeightStatus = false;
            }
        }
    });

    $(heavyWeight).on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            // var heavySelectedIndex = heavyWeight[0].dataset.heavyweight;
            // heavySelectedIndex = parseInt(heavySelectedIndex, 10);
            if (heavyWeight[0].selectedIndex > 0) {
                $("#heavyWeightError").text("");
                $(heavyWeight).removeClass("is-invalid");
                $(heavyWeight).addClass("is-valid");
                heavyWeightStatus = true;
            }
            else {
                $("#heavyWeightError").text("Error: Please provide a weight selection.");
                $(heavyWeight).removeClass("is-valid");
                $(heavyWeight).addClass("is-invalid");
                heavyWeightStatus = false;
            }
        }
    });

    $("#difficultyLvl, #lightWeight, #heavyWeight").on("keyup blur change", function () {
        setTimeout(function () {
            if (diffLvlStatus && lightWeightStatus && heavyWeightStatus) {
                $("#submitBtn").removeAttr("disabled");
            }
            else {
                $("#submitBtn").attr("disabled", "true");
            }
        }, 250);
    });
});