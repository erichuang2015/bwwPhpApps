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
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

$(document).ready(function () {
    'use strict';
    $("#firstName, #lastName, #email, #password, #firstAnswer, #secondAnswer, #thirdAnswer").on("keyup blur change", function () {
        $("#registerForm").removeClass('was-validated');
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
        // var firstNameLength = firstName.length;
        // var lastNameLength = lastName.length;
        // var emailLength = email.length;
        // var passwordLength = password.length;
        var firstAnswerLength = firstAnswer.length;
        var secondAnswerLength = secondAnswer.length;
        var thirdAnswerLength = thirdAnswer.length;

        if (ValidateName(firstName)) {
            firstNameStatus = true;
            $("#firstNameInputError").text("");
        }
        else {
            firstNameStatus = false;
            $("#firstNameInputError").text("Error: Enter a valid first name");
        }

        if (ValidateName(lastName)) {
            lastNameStatus = true;
            $("#lastNameInputError").text("");
        }
        else {
            lastNameStatus = false;
            $("#lastNameInputError").text("Error: Enter a valid last name");
        }

        if (ValidateEmail(email)) {
            emailStatus = true;
            $("#emailInputError").text("");
        }
        else {
            emailStatus = false;
            $("#emailInputError").text("Error: Enter a valid email address");
        }

        if (ValidatePassword(password)) {
            passwordStatus = true;
            $("#passwordInputError").text("");
        }
        else {
            passwordStatus = false;
            $("#passwordInputError").text("Error: Enter a valid password");
        }

        if (ValidatePasswordRecoveryAnswers(firstAnswerLength, firstAnswer)) {
            firstAnswerStatus = true;
            $("#firstAnswerInputError").text("");
        }
        else {
            firstAnswerStatus = false;
            $("#firstAnswerInputError").text("Error: Enter an answer to this question.");
        }

        if (ValidatePasswordRecoveryAnswers(secondAnswerLength, secondAnswer)) {
            secondAnswerStatus = true;
            $("#secondAnswerInputError").text("");
        }
        else {
            secondAnswerStatus = false;
            $("#secondAnswerInputError").text("Error: Enter an answer to this question.");
        }

        if (ValidatePasswordRecoveryAnswers(thirdAnswerLength, thirdAnswer)) {
            thirdAnswerStatus = true;
            $("#thirdAnswerInputError").text("");
        }
        else {
            thirdAnswerStatus = false;
            $("#thirdAnswerInputError").text("Error: Enter an answer to this question.");
        }

        if(firstNameStatus && lastNameStatus && emailStatus && passwordStatus && firstAnswerStatus && secondAnswerStatus && thirdAnswerStatus){
            $("#submitBtn").removeAttr("disabled");
        }
        else{
            $("#submitBtn").attr("disabled", "true");
        }

        $("#registerForm").addClass('was-validated');
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

function ValidateName(name){
    'use strict';
    if (/^(?=.{1,45}$)[a-z]+(?:['_.\s][a-z]+)*$/i.test(name)) {
        return true;
    }
    else {
        return false;
    }
}

//Must be at least one uppercase one lowercase and one number or symbol between 8-24 chars
function ValidatePassword(password){
    'use strict';
    if (/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/.test(password)) {
        return true;
    }
    else {
        return false;
    }
}

//Accept input as long as there is input and the first char is not whitespace
function ValidatePasswordRecoveryAnswers(answerLength, answer){
    'use strict';
    if (answerLength > 0 && answer.charAt(0) != " ") {
        return true;
    }
    else {
        return false;
    }
}



