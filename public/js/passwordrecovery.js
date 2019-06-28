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
    $("#email").on("keyup blur change", function () {
        var email = $("#email").val();
        var emailStatus = false;

        emailStatus = (ValidateEmail(email)) ? true : false;

        if (emailStatus) {
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

    $("#newPassword").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            let firstPw = $("#newPassword").val();
            if (ValidatePassword(firstPw)) {
                $("#newPasswordInputError").text("");
                $("#newPassword").removeClass("is-invalid");
                $("#newPassword").addClass("is-valid");
                $("#submitNewPassword").removeAttr("disabled");
            }
            else {
                $("#newPasswordInputError").text("Error: Enter a valid password");
                $("#newPassword").removeClass("is-valid");
                $("#newPassword").addClass("is-invalid");
                $("#submitNewPassword").attr("disabled", "disabled");
            }
        }
    });
});