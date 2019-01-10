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
    // $("#exerciseSelect").on("change", function(){
    //     var selectedEx = this;
    //     console.log(selectedEx);
    // });
    // $("#exerciseSelect").on("change", function(){ console.log(this.selectedIndex); });

    $("#selectExerciseBtn").on("click keydown", function(){
        var selectElement = $("#exerciseSelect");
        var selectedIndex = selectElement[0].selectedIndex;
        var selectedExercise = selectElement[0][selectedIndex].text;
        var exerciseId = $(selectElement[0][selectedIndex]).attr("data-id");
        if(exerciseId){
            $("#exerciseId").val(exerciseId);
        }else{
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
    });
});