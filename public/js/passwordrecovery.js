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
    'use strict';
    $("#email, #firstAnswer, #secondAnswer, #thirdAnswer").on("keyup blur change", function () {
        var email = $("#email").val();
        var firstAnswer = $("#firstAnswer").val();
        var secondAnswer = $("#secondAnswer").val();
        var thirdAnswer = $("#thirdAnswer").val();
        var emailStatus = false;
        var firstAnswerStatus = false;
        var secondAnswerStatus = false;
        var thirdAnswerStatus = false;
        var firstAnswerLength = firstAnswer.length;
        var secondAnswerLength = secondAnswer.length;
        var thirdAnswerLength = thirdAnswer.length;

        emailStatus = (ValidateEmail(email)) ? true : false;
        firstAnswerStatus = (ValidatePasswordRecoveryAnswers(firstAnswerLength, firstAnswer)) ? true : false;
        secondAnswerStatus = (ValidatePasswordRecoveryAnswers(secondAnswerLength, secondAnswer)) ? true : false;
        thirdAnswerStatus = (ValidatePasswordRecoveryAnswers(thirdAnswerLength, thirdAnswer)) ? true : false;

        if (emailStatus && firstAnswerStatus && secondAnswerStatus && thirdAnswerStatus) {
            $("#submitBtn").removeAttr("disabled");
        }
        else {
            $("#submitBtn").attr("disabled", "true");
        }
    });

    $("#email").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var email = $("#email").val();
            if (ValidateEmail(email)) {
                $("#emailInputError").text("");
                $("#email").removeClass("is-invalid");
                $("#email").addClass("is-valid");
            }
            else {
                $("#emailInputError").text("Error: Enter a valid email address");
                $("#email").removeClass("is-valid");
                $("#email").addClass("is-invalid");
            }
        }
    });

    $("#firstAnswer").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var firstAnswer = $("#firstAnswer").val();
            var firstAnswerLength = firstAnswer.length;
            if (ValidatePasswordRecoveryAnswers(firstAnswerLength, firstAnswer)) {
                $("#firstAnswerInputError").text("");
                $("#firstAnswer").removeClass("is-invalid");
                $("#firstAnswer").addClass("is-valid");
            }
            else {
                $("#firstAnswerInputError").text("Error: Enter an answer to this question.");
                $("#firstAnswer").removeClass("is-valid");
                $("#firstAnswer").addClass("is-invalid");
            }
        }
    });

    $("#secondAnswer").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var secondAnswer = $("#secondAnswer").val();
            var secondAnswerLength = secondAnswer.length;
            if (ValidatePasswordRecoveryAnswers(secondAnswerLength, secondAnswer)) {
                $("#secondAnswerInputError").text("");
                $("#secondAnswer").removeClass("is-invalid");
                $("#secondAnswer").addClass("is-valid");
            }
            else {
                $("#secondAnswerInputError").text("Error: Enter an answer to this question.");
                $("#secondAnswer").removeClass("is-valid");
                $("#secondAnswer").addClass("is-invalid");
            }
        }

    });

    $("#thirdAnswer").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var thirdAnswer = $("#thirdAnswer").val();
            var thirdAnswerLength = thirdAnswer.length;
            if (ValidatePasswordRecoveryAnswers(thirdAnswerLength, thirdAnswer)) {
                $("#thirdAnswerInputError").text("");
                $("#thirdAnswer").removeClass("is-invalid");
                $("#thirdAnswer").addClass("is-valid");
            }
            else {
                $("#thirdAnswerInputError").text("Error: Enter an answer to this question.");
                $("#thirdAnswer").removeClass("is-valid");
                $("#thirdAnswer").addClass("is-invalid");
            }
        }
    });
});


function ValidateEmail(mail) {
    'use strict';
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
        return true;
    }
    else {
        return false;
    }
}

//Accept input as long as there is input and the first char is not whitespace
function ValidatePasswordRecoveryAnswers(answerLength, answer) {
    'use strict';
    if (answerLength > 0 && answer.charAt(0) != " ") {
        return true;
    }
    else {
        return false;
    }
}