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
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });
    $("#firstName, #lastName, #email, #password, #firstAnswer, #secondAnswer, #thirdAnswer").on("keyup blur change", function () {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var firstAnswer = $("#firstAnswer").val();
        var secondAnswer = $("#secondAnswer").val();
        var thirdAnswer = $("#thirdAnswer").val();
        var firstNameStatus = false;
        var lastNameStatus = false;
        var emailStatus = false;
        var passwordStatus = false;
        var firstAnswerStatus = false;
        var secondAnswerStatus = false;
        var thirdAnswerStatus = false;
        var firstAnswerLength = firstAnswer.length;
        var secondAnswerLength = secondAnswer.length;
        var thirdAnswerLength = thirdAnswer.length;

        firstNameStatus = (ValidateName(firstName)) ? true : false;
        lastNameStatus = (ValidateName(lastName)) ? true : false;
        emailStatus = (ValidateEmail(email)) ? true : false;
        passwordStatus = (ValidatePassword(password)) ? true : false;
        firstAnswerStatus = (ValidatePasswordRecoveryAnswers(firstAnswerLength, firstAnswer)) ? true : false;
        secondAnswerStatus = (ValidatePasswordRecoveryAnswers(secondAnswerLength, secondAnswer)) ? true : false;
        thirdAnswerStatus = (ValidatePasswordRecoveryAnswers(thirdAnswerLength, thirdAnswer)) ? true : false;

        if (firstNameStatus && lastNameStatus && emailStatus && passwordStatus && firstAnswerStatus && secondAnswerStatus && thirdAnswerStatus) {
            $("#submitBtn").removeAttr("disabled");
        }
        else {
            $("#submitBtn").attr("disabled", "true");
        }
    });

    $("#firstName").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var firstName = $("#firstName").val();
            if (ValidateName(firstName)) {
                $("#firstNameInputError").text("");
                $("#firstName").removeClass("is-invalid");
                $("#firstName").addClass("is-valid");
            }
            else {
                $("#firstNameInputError").text("Error: Enter a valid first name");
                $("#firstName").removeClass("is-valid");
                $("#firstName").addClass("is-invalid");
            }
        }
    });

    $("#lastName").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var lastName = $("#lastName").val();
            if (ValidateName(lastName)) {
                $("#lastNameInputError").text("");
                $("#lastName").removeClass("is-invalid");
                $("#lastName").addClass("is-valid");
            }
            else {
                $("#lastNameInputError").text("Error: Enter a valid last name");
                $("#lastName").removeClass("is-valid");
                $("#lastName").addClass("is-invalid");
            }
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

    $("#password").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var password = $("#password").val();
            if (ValidatePassword(password)) {
                $("#passwordInputError").text("");
                $("#password").removeClass("is-invalid");
                $("#password").addClass("is-valid");
            }
            else {
                $("#passwordInputError").text("Error: Enter a valid password");
                $("#password").removeClass("is-valid");
                $("#password").addClass("is-invalid");
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

function ValidateName(name) {
    'use strict';
    if (/^(?=.{1,45}$)[a-z]+(?:['_.\s][a-z]+)*$/i.test(name)) {
        return true;
    }
    else {
        return false;
    }
}

//Must be at least one uppercase one lowercase and one number or symbol between 8-24 chars
function ValidatePassword(password) {
    'use strict';
    if (/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/.test(password)) {
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



