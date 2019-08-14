/*jshint esversion: 6 */

$(document).ready(function () {
    "use strict";
    let maxSelector = $("#max");
    let maxErrorSelector = $("#maxError");
    let max = 0;
    let submitLoggedIn = $("#submitLoggedIn");
    let selector = $("#maxNotLogged");
    let errorSelector = $("#maxNotLoggedError");
    let maxNotLogged = $("#maxNotLogged").val();
    let submitBtn = $("#submit");
    if(!isNaN($(maxSelector).val())){
        $(submitLoggedIn).removeAttr("disabled");
    }
    validateMaxInput(selector, errorSelector, maxNotLogged, submitBtn);

    $("#maxInputForm").hide();
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

    $("#exerciseSelect").on("change", function () {
        let selectElement = $("#exerciseSelect");
        let selectedIndex = selectElement[0].selectedIndex;
        if (selectedIndex > 0) {
            $("#selectExerciseBtn").removeAttr("disabled");
        } else {
            $("#selectExerciseBtn").attr("disabled", "true");
        }
    });

    $("#newExerciseTxtInput").on("keyup	", function () {
        if ($(this).val().length > 0) {
            $("#newExerciseSubmitBtn").removeAttr("disabled");
        } else {
            $("#newExerciseSubmitBtn").attr("disabled", "true");
        }
    });

    $("#selectExerciseBtn").on("click keydown", function () {
        let selectElement = $("#exerciseSelect");
        let selectedIndex = selectElement[0].selectedIndex;
        let selectedExercise = selectElement[0][selectedIndex].text;
        let exerciseId = $(selectElement[0][selectedIndex]).attr("data-id");
        let otherOption = $(selectElement[0][selectedIndex]).attr("data-other");
        if (otherOption) {
            $("#chooseExercisePanel").hide();
            $("#newExerciseForm").show();
            return;
        }
        if (exerciseId) {
            $("#exerciseId").val(exerciseId);
        } else {
            $("#exerciseId").val("-1");
        }
        $("#exerciseTxt").text(selectedExercise.toLowerCase());
        $("#chooseExercisePanel").hide();
        $("#maxInputForm").show();
        let arrayOfInputs = $("input[type='hidden'].user-max-data");
        let exerciseMax = $(arrayOfInputs[exerciseId - 1]).attr("data-max");// -1 for zero based index
        $("#max").val(exerciseMax);
        let recordId = $(arrayOfInputs[exerciseId - 1]).attr("data-id");// -1 for zero based index
        $("#recordId").val(recordId);
        max = $("#max").val();
    });

    $("#max").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            max = $("#max").val();
            validateMaxInput(maxSelector, maxErrorSelector, max, submitLoggedIn);
        }
    });

    $("#maxNotLogged").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            let maxNotLogged = $("#maxNotLogged").val();
            validateMaxInput(selector, errorSelector, maxNotLogged, submitBtn);
        }
    });
});

function validateMaxInput(selector, errorSelector, max, submitBtn) {
    if (isNaN(max)) {
        $(selector).addClass("is-invalid");
        let errorEnter1Rm = $("#errorEnter1Rm").val();
        $(errorSelector).text(errorEnter1Rm);
        $(submitBtn).attr("disabled", "true");
        return;
    }
    else {
        let maxNotLoggedNum = parseFloat(Number(max).toFixed(2));
        if (maxNotLoggedNum < 10) {
            $(selector).removeClass("is-valid");
            $(selector).addClass("is-invalid");
            let errorMoreThanTen = $("#errorMoreThanTen").val();
            $(errorSelector).text(errorMoreThanTen);
            $(submitBtn).attr("disabled", "true");
        }
        else if (maxNotLoggedNum > 1200) {
            $(selector).removeClass("is-valid");
            $(selector).addClass("is-invalid");
            let errorLouFerringo = $("#errorLouFerringo").val();
            $(errorSelector).text(errorLouFerringo);
            $(submitBtn).attr("disabled", "true");
        }
        else {
            $(selector).removeClass("is-invalid");
            $(selector).addClass("is-valid");
            $(errorSelector).text("");
            $(submitBtn).removeAttr("disabled");
        }
    }
}