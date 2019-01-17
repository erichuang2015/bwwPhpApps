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
    $("#email").on("keyup blur change", function () {
        var emailInput = $("#email");
        validateEntries(emailInput);
    });

    $("#password").on("keyup blur change", function () {
        var passwordInput = $("#password");
        validateEntries(passwordInput);
    });
});

function validateEntries(inputElement) {
    $("#loginForm").removeClass('was-validated');
    var emailStatus = false;
    var passwordStatus = false;
    var inputTxt = $(inputElement).val();
    var inputTxtLength = inputTxt.length;
    // console.log(inputElement);
    if(inputElement[0].id == "email")//logic to determine if the inputElement is the email input
    {
        if (ValidateEmail(inputTxt)) {
            status = true;
            $("#emailInputError").text("");
            emailStatus = true;
        }
        else {
            status = false;
            $("#emailInputError").text("Error: Enter a valid email address");
        }
    }
    else{
        if (inputTxtLength < 1) {
            $("#passwordInputError").text("Error: Enter a password");
        }
        else {
            $("#passwordInputError").text("");
            passwordStatus = true;
        }
    }

    if (emailStatus && passwordStatus) {
        $("#login").removeAttr("disabled");
    }
    else {
        $("#login").attr("disabled", "true");
    }
    $("#loginForm").addClass('was-validated');

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