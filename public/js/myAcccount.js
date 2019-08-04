/*jshint esversion: 6 */

$(document).ready(function () {
    'use strict';
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click focus manual",
            html: true,
            title: ""
        });
    });
    let newpassword1Status = false;
    let newpassword2Status = false;
    let oldPasswordProperFormat = false;
    let newpassword1ProperFormat = false;
    let newpassword2ProperFormat = false;
    let oldPassword;
    let newpassword1;
    let newpassword2;
    let newPasswordsMatch = false;
    let errorPw = $("#errorPw").val();
    let errorPwNewAndOldMustDiffer = $("#errorPwNewAndOldMustDiffer").val();
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

                $("#oldpasswordInputError").text(errorPw);
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
                $("#newpassword1InputError").text(errorPw);
                $("#newpassword1").removeClass("is-valid");
                $("#newpassword1").addClass("is-invalid");
                newpassword1ProperFormat = false;
            }

            if (newpassword1 && newpassword2) {
                if(newpassword1ProperFormat && newpassword2ProperFormat){
                    newPasswordsMatch = verifyNewPasswordsInputsMatch(newpassword1, newpassword2);
                }
                if(newPasswordsMatch){
                    let trulyNewPw = verifyOldNotSameAsNew(oldPassword, newpassword1);
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
                        $("#newpassword1InputError").text(errorPwNewAndOldMustDiffer);
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
                $("#newpassword2InputError").text(errorPw);
                $("#newpassword2").removeClass("is-valid");
                $("#newpassword2").addClass("is-invalid");
                newpassword2ProperFormat = false;
            }

            if (newpassword1 && newpassword2) {
                if(newpassword1ProperFormat && newpassword2ProperFormat){
                    newPasswordsMatch = verifyNewPasswordsInputsMatch(newpassword1, newpassword2);
                }
                if(newPasswordsMatch){
                    let trulyNewPw = verifyOldNotSameAsNew(oldPassword, newpassword2);
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
                        $("#newpassword2InputError").text(errorPwNewAndOldMustDiffer);
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
    let match = false;
    let errorPwEntriesMustMatch = $("#errorPwEntriesMustMatch").val();
    if (newpassword1 != newpassword2) {
        $("#newpassword1InputError").text(errorPwEntriesMustMatch);
        $("#newpassword1").removeClass("is-valid");
        $("#newpassword1").addClass("is-invalid");
        $("#newpassword2InputError").text(errorPwEntriesMustMatch);
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
    let trulyNewPw = false;
    if(oldPassword){
        trulyNewPw = (oldPassword != newPassword) ? true : false;
    }
    return trulyNewPw;
}