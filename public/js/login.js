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
    $("#email, #password").on("keyup blur change", function () {
        $("#loginForm").removeClass('was-validated');
        var emailStatus = false;
        var email = $("#email").val();
        var password = $("#password").val();
        var emailLength = email.length;
        var passwordLength = password.length;

        if (ValidateEmail(email)) {
            emailStatus = true;
            $("#emailInputError").text("");
        }
        else {
            emailStatus = false;
            $("#emailInputError").text("Error: Enter a valid email address");
        }

        if (passwordLength < 1) {
            $("#passwordInputError").text("Error: Enter a password");
        }
        else {
            $("#passwordInputError").text("");
        }
        if (emailStatus && passwordLength > 0) {
            $("#login").removeAttr("disabled");
        }
        else {
            $("#login").attr("disabled", "true");
        }
        $("#loginForm").addClass('was-validated');
    });
});


function ValidateEmail(mail) {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)) {
        return (true);
    }
    else {
        return (false);
    }
}