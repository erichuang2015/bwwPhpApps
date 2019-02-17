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
    var newpassword1Status = false;
    var newpassword2Status = false;
    var oldPasswordProperFormat = false;
    var newpassword1ProperFormat = false;
    var newpassword2ProperFormat = false;
    var oldPassword;
    var newpassword1;
    var newpassword2;
    var newPasswordsMatch = false;
    $("#oldpassword, #newpassword1, #newpassword2").on("keyup blur change", function () {
        if (oldPasswordProperFormat && newpassword1Status && newpassword2Status) {
            $("#submitPasswordChange").removeAttr("disabled");
        }
        else {
            $("#submitPasswordChange").attr("disabled", "true");
        }
    });

    $("#oldpassword").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            oldPassword = $("#oldpassword").val();
            if (ValidatePasswordFormat(oldPassword)) {
                $("#oldpasswordError").text("");
                $("#oldpassword").removeClass("is-invalid");
                $("#oldpassword").addClass("is-valid");
                oldPasswordProperFormat = true;
            }
            else {
                $("#oldpasswordInputError").text("Error: Enter a valid password");
                $("#oldpassword").removeClass("is-valid");
                $("#oldpassword").addClass("is-invalid");
                oldPasswordProperFormat = false;
            }
        }
    });

    $("#newpassword1").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            newpassword1 = $("#newpassword1").val();
            if (ValidatePasswordFormat(newpassword1)) {
                $("#newpassword1InputError").text("");
                $("#newpassword1").removeClass("is-invalid");
                $("#newpassword1").addClass("is-valid");
                newpassword1ProperFormat = true;
            }
            else {
                $("#newpassword1InputError").text("Error: Enter a valid password");
                $("#newpassword1").removeClass("is-valid");
                $("#newpassword1").addClass("is-invalid");
                newpassword1ProperFormat = false;
            }

            if (newpassword1 && newpassword2) {
                if(newpassword1ProperFormat && newpassword2ProperFormat){
                    newPasswordsMatch = verifyNewPasswordsInputsMatch(newpassword1, newpassword2);
                }
                if(newPasswordsMatch){
                    var trulyNewPw = verifyOldNotSameAsNew(oldPassword, newpassword1);
                    if(trulyNewPw){
                        newpassword1Status = true;
                        newpassword2Status = true;
                        $("#newpassword1InputError").text("");
                        $("#newpassword1").removeClass("is-invalid");
                        $("#newpassword1").addClass("is-valid");
                    }
                    else{
                        newpassword1Status = false;
                        newpassword2Status = false;
                        $("#newpassword1InputError").text("Error: Your new password cannot be the same as your old password.");
                        $("#newpassword1").removeClass("is-valid");
                        $("#newpassword1").addClass("is-invalid");
                    }
                }
            }
        }
    });

    $("#newpassword2").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            newpassword2 = $("#newpassword2").val();
            if (ValidatePasswordFormat(newpassword2)) {
                $("#newpassword2InputError").text("");
                $("#newpassword2").removeClass("is-invalid");
                $("#newpassword2").addClass("is-valid");
                newpassword2ProperFormat = true;
            }
            else {
                $("#newpassword2InputError").text("Error: Enter a valid password");
                $("#newpassword2").removeClass("is-valid");
                $("#newpassword2").addClass("is-invalid");
                newpassword2ProperFormat = false;
            }

            if (newpassword1 && newpassword2) {
                if(newpassword1ProperFormat && newpassword2ProperFormat){
                    newPasswordsMatch = verifyNewPasswordsInputsMatch(newpassword1, newpassword2);
                }
                if(newPasswordsMatch){
                    var trulyNewPw = verifyOldNotSameAsNew(oldPassword, newpassword2);
                    if(trulyNewPw){
                        newpassword1Status = true;
                        newpassword2Status = true;
                        $("#newpassword2InputError").text("");
                        $("#newpassword2").removeClass("is-invalid");
                        $("#newpassword2").addClass("is-valid");
                    }
                    else{
                        newpassword1Status = false;
                        newpassword2Status = false;
                        $("#newpassword2InputError").text("Error: Your new password cannot be the same as your old password.");
                        $("#newpassword2").removeClass("is-valid");
                        $("#newpassword2").addClass("is-invalid");
                    }
                }
            }
        }
    });
});

//Must be at least one uppercase one lowercase and one number or symbol between 8-24 chars
function ValidatePasswordFormat(password) {
    'use strict';
    if (/^(?=.*[\d\W])(?=.*[a-z])(?=.*[A-Z]).{8,24}$/.test(password)) {
        return true;
    }
    else {
        return false;
    }
}

function verifyNewPasswordsInputsMatch(newpassword1, newpassword2) {
    var match = false;
    if (newpassword1 != newpassword2) {
        $("#newpassword1InputError").text("Error: Your new password enrtries must match.");
        $("#newpassword1").removeClass("is-valid");
        $("#newpassword1").addClass("is-invalid");
        $("#newpassword2InputError").text("Error: Your new password enrtries must match.");
        $("#newpassword2").removeClass("is-valid");
        $("#newpassword2").addClass("is-invalid");
    }
    else {
        $("#newpassword1InputError").text("");
        $("#newpassword1").removeClass("is-invalid");
        $("#newpassword1").addClass("is-valid");
        $("#newpassword2InputError").text("");
        $("#newpassword2").removeClass("is-invalid");
        $("#newpassword2").addClass("is-valid");
        match = true;
    }
    return match;
}

function verifyOldNotSameAsNew(oldPassword, newPassword){
    var trulyNewPw = false;
    if(oldPassword){
        trulyNewPw = (oldPassword != newPassword) ? true : false;
    }
    return trulyNewPw;
}