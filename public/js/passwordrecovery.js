/*jshint esversion: 6 */
$(document).ready(function () {
    'use strict';
    $("#email").on("keyup blur change", function () {
        let email = $("#email").val();
        let emailStatus = false;

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
            let email = $("#email").val();
            if (ValidateEmail(email)) {
                $("#emailInputError").text("");
                $("#email").removeClass("is-invalid");
                $("#email").addClass("is-valid");
            }
            else {
                let invalidEmailError =$("#invalidEmailError").val();
                $("#emailInputError").text(invalidEmailError);
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
                let invalidPasswordError = $("#invalidPasswordError").val();
                $("#newPasswordInputError").text(invalidPasswordError);
                $("#newPassword").removeClass("is-valid");
                $("#newPassword").addClass("is-invalid");
                $("#submitNewPassword").attr("disabled", "disabled");
            }
        }
    });
});