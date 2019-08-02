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
    let emailStatus = false;
    let passwordStatus = false;
    let emailInput = $("#email");
    emailStatus = validateEntries(emailInput);
    let passwordInput = $("#password");
    passwordStatus = validateEntries(passwordInput);
    if(emailStatus && passwordStatus){
        toggleSignInBtn(emailStatus, passwordStatus);
    }
    $("#email").on("keyup blur change", function () {
        let emailInput = $("#email");
        emailStatus = validateEntries(emailInput);
        toggleSignInBtn(emailStatus, passwordStatus);
    });

    $("#password").on("keyup blur change", function () {
        let passwordInput = $("#password");
        passwordStatus = validateEntries(passwordInput);
        toggleSignInBtn(emailStatus, passwordStatus);
    });
});

function validateEntries(inputElement) {
    $("#loginForm").removeClass('was-validated');
    let inputTxt = $(inputElement).val();
    let inputTxtLength = inputTxt.length;
    let status = false;
    if(inputElement[0].id == "email")//logic to determine if the inputElement is the email input
    {
        if (ValidateEmail(inputTxt)) {
            status = true;
            $("#emailInputError").text("");
        }
        else {
            status = false;
            let errorEmail = $("#errorEmail").val();
            $("#emailInputError").text(errorEmail);
        }
        return status;
    }
    else{
        if (inputTxtLength < 1) {
            let errorPassword = $("#errorPassword").val();
            $("#passwordInputError").text(errorPassword);
            status = false;
        }
        else {
            $("#passwordInputError").text("");
            status = true;
        }
        return status;
    }
}

function ValidateEmail(mail) {
    'use strict';
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
        return (true);
    }
    else {
        return (false);
    }
}

function toggleSignInBtn(emailStatus, passwordStatus)
{
    'use strict';
    if (emailStatus == true && passwordStatus == true) {
        $("#login").removeAttr("disabled");
    }
    else {
        $("#login").attr("disabled", "true");
    }
    $("#loginForm").addClass('was-validated');
}