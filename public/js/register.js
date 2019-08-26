/*jshint esversion: 6 */

$(document).ready(function () {
    'use strict';
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });
    $("#firstName, #lastName, #email, #password").on("keyup blur change", function () {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var firstNameStatus = false;
        var lastNameStatus = false;
        var emailStatus = false;
        var passwordStatus = false;

        firstNameStatus = (ValidateName(firstName)) ? true : false;
        lastNameStatus = (ValidateName(lastName)) ? true : false;
        emailStatus = (ValidateEmail(email)) ? true : false;
        passwordStatus = (ValidatePassword(password)) ? true : false;

        if (firstNameStatus && lastNameStatus && emailStatus && passwordStatus) {
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
                let errorFirstNameInput = $("#errorFirstNameInput").val();
                $("#firstNameInputError").text(errorFirstNameInput);
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
                let errorLastNameInput = $("#errorLastNameInput").val();
                $("#lastNameInputError").text(errorLastNameInput);
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
                let errorEmailInput = $("#errorEmailInput").val();
                $("#emailInputError").text(errorEmailInput);
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
                let errorPasswordInput = $("#errorPasswordInput").val();
                $("#passwordInputError").text(errorPasswordInput);
                $("#password").removeClass("is-valid");
                $("#password").addClass("is-invalid");
            }
        }
    });
});

function ValidateName(name) {
    'use strict';
    if (/^(?=.{1,45}$)[a-z]+(?:['_.\s][a-z]+)*$/i.test(name)) {
        return true;
    }
    else {
        return false;
    }
}