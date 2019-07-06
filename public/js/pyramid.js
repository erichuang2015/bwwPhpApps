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
    "use strict";
    var maxSelector = $("#max");
    var maxErrorSelector = $("#maxError");
    var max = 0;
    var submitLoggedIn = $("#submitLoggedIn");
    var selector = $("#maxNotLogged");
    var errorSelector = $("#maxNotLoggedError");
    var maxNotLogged = $("#maxNotLogged").val();
    var submitBtn = $("#submit");
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
        var selectElement = $("#exerciseSelect");
        var selectedIndex = selectElement[0].selectedIndex;
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
        var selectElement = $("#exerciseSelect");
        var selectedIndex = selectElement[0].selectedIndex;
        var selectedExercise = selectElement[0][selectedIndex].text;
        var exerciseId = $(selectElement[0][selectedIndex]).attr("data-id");
        var otherOption = $(selectElement[0][selectedIndex]).attr("data-other");
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
        var arrayOfInputs = $("input[type='hidden'].user-max-data");
        var exerciseMax = $(arrayOfInputs[exerciseId - 1]).attr("data-max");// -1 for zero based index
        $("#max").val(exerciseMax);
        var recordId = $(arrayOfInputs[exerciseId - 1]).attr("data-id");// -1 for zero based index
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
            var maxNotLogged = $("#maxNotLogged").val();
            validateMaxInput(selector, errorSelector, maxNotLogged, submitBtn);
        }
    });
});

function validateMaxInput(selector, errorSelector, max, submitBtn) {
    if (isNaN(max)) {
        $(selector).addClass("is-invalid");
        $(errorSelector).text("Error: Please enter a number for your 1RM.");
        $(submitBtn).attr("disabled", "true");
        return;
    }
    else {
        var maxNotLoggedNum = parseFloat(Number(max).toFixed(2));
        if (maxNotLoggedNum < 10) {
            $(selector).removeClass("is-valid");
            $(selector).addClass("is-invalid");
            $(errorSelector).text("Error: Don't be so modest. Your 1RM must be 10 Ibs or greater.");
            $(submitBtn).attr("disabled", "true");
        }
        else if (maxNotLoggedNum > 1200) {
            $(selector).removeClass("is-valid");
            $(selector).addClass("is-invalid");
            $(errorSelector).text("Error: Easy there Lou Ferrigno. Your 1RM must be 1200 Ibs or less.");
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