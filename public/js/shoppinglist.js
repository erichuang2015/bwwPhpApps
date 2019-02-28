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

    $("#btnNewCategory").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            $("#btnNewCategory").hide();
            $("#btnNewCategoryBack").show();
            $("#newCategory").removeClass("no-display");
        }
    });

    $("#btnNewCategoryBack").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            $("#btnNewCategoryBack").hide();
            $("#newCategory").addClass("no-display");
            $("#btnNewCategory").show();
        }
    });

    $("input[type='checkbox']").on("keyup click", function(e){
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            var checked = e.currentTarget.checked;
            var checkbox = e.currentTarget;
            var confirmBtn = $(checkbox).next("input[type='submit']");
            var li = $(checkbox).closest("li");
            if(checked){
                e.currentTarget.value = "true";
                $(li).addClass("deleted text-muted");
                $(confirmBtn).removeClass("no-display");
                if($(checkbox).hasClass("shop-item")){
                    $(checkbox).prev("input").val($(checkbox).attr("data-id").toString());
                }
            }else{
                e.currentTarget.value = "true";
                $(li).removeClass("deleted text-muted");
                $(confirmBtn).addClass("no-display");
                if($(checkbox).hasClass("shop-item")){
                    $(checkbox).prev("input").val("");
                }
            }
        }
    });

    $("button[id^='btnNewItem']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            var thisBtnID = $(this).attr("id");
            $("#" + thisBtnID).hide();
            var idNum = $(this).attr("data-catid");
            var btnIdNumRemoved = thisBtnID.substr(0, thisBtnID.length-idNum.length);
            $("#" + btnIdNumRemoved + "Back" + idNum).show();
            $("#" + btnIdNumRemoved + "Back" + idNum).removeClass("no-display");
            $("#newItem" + idNum).removeClass("no-display");
            $("#newItem" + idNum).prev("input").val(idNum);
        }
    });

    $("button[id^='btnNewItemBack']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            var thisBtnID = $(this).attr("id");
            $("#" + thisBtnID).addClass("no-display");
            var idNum = $(this).attr("data-catid");
            var btnIdNumRemoved = thisBtnID.substr(0, thisBtnID.length-idNum.length);
            $("#btnNewItem" + idNum).show();
            $("#newItem" + idNum).addClass("no-display");
            $("#newItem" + idNum).prev("input").val("");
            $("#" + btnIdNumRemoved + idNum).show();
        }
    });
});