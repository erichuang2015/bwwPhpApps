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