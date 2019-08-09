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
    let date = new Date();
    $("#currentYear").text(" " + date.getFullYear());

    if (!Modernizr.es6object) {
        var options = {
            backdrop: "static",
            keyboard: false,
            focus: true,
            show: true
        };
        $('#browserSupportModal').modal(options);
    }

    let language = $("#language").val();
    if (language == "spanish") {
        $("#lblEnglish").removeClass("active");
        $("#rbEnglish").removeAttr("checked");
        $("#lblSpanish").addClass("active");
        $("#rbSpanish").attr("checked", "checked");
    } else {
        $("#lblEnglish").addClass("active");
        $("#rbEnglish").attr("checked", "checked");
        $("#lblSpanish").removeClass("active");
        $("#rbSpanish").removeAttr("checked");
    }

    $(".rb-language").on("click keyup", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            changeLanguage(e.currentTarget);
        }

    });
    $("header .btn-secondary").on("click keyup", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            let radioBtn = $(e.currentTarget).find("input[type='radio']");
            changeLanguage(radioBtn[0]);
        }
    });
});

function changeLanguage(target) {
    //call a POST to the page we are on while passing the target name
    let url = window.location.href;
    let language = target.name; // either 'spanish' or 'english'
    let loaded = 0;
    $.post(url, language, function (data, status, xhr) {
        location.reload();
        loaded = 1;
    });
    if (loaded == 0) {
        location.reload();
    }
}