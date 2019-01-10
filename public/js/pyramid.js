$(document).ready(function () {
    "use strict";
    $("#maxInputForm").hide();
    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

    $("#exerciseSelect").on("change", function(){
        var selectElement = $("#exerciseSelect");
        var selectedIndex = selectElement[0].selectedIndex;
        if(selectedIndex > 0){
            $("#selectExerciseBtn").removeAttr("disabled");
        }else{
            $("#selectExerciseBtn").attr("disabled", "true");
        }
    });

    $("#newExerciseTxtInput").on("keyup	", function(){
        if($(this).val().length > 0){
            $("#newExerciseSubmitBtn").removeAttr("disabled");
        }else{
            $("#newExerciseSubmitBtn").attr("disabled", "true");
        }
    });

    $("#selectExerciseBtn").on("click keydown", function(){
        var selectElement = $("#exerciseSelect");
        var selectedIndex = selectElement[0].selectedIndex;
        var selectedExercise = selectElement[0][selectedIndex].text;
        var exerciseId = $(selectElement[0][selectedIndex]).attr("data-id");
        var otherOption = $(selectElement[0][selectedIndex]).attr("data-other");
        if(otherOption){
            $("#chooseExercisePanel").hide();
            $("#newExerciseForm").show();
            return;
        }
        if(exerciseId){
            $("#exerciseId").val(exerciseId);
        }else{
            $("#exerciseId").val("-1");
        }
        // console.log(exerciseId);
        $("#exerciseTxt").text(selectedExercise.toLowerCase());
        $("#chooseExercisePanel").hide();
        $("#maxInputForm").show();
        var arrayOfInputs = $("input[type='hidden'].user-max-data");
        var exerciseMax = $(arrayOfInputs[exerciseId - 1]).attr("data-max");// -1 for zero based index
        $("#max").val(exerciseMax);
        var recordId = $(arrayOfInputs[exerciseId - 1]).attr("data-id");// -1 for zero based index
        $("#recordId").val(recordId);
    });
});