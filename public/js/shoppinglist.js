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
    var newItemBtns = [];
    newItemBtns = $("button[id^='btnNewItem']");

    if ($("span[id^='addNewCatTxt']")) {
        var addNewCategorySpanArray = $("span[id^='addNewCatTxt']");
        $(addNewCategorySpanArray).each(function () {
            var text = $(this).text().toLowerCase();
            $(this).text(text);
        });
    }

    $("#btnNewCategory").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            var btnDisabled = $("#btnNewCategory").attr("data-disabled");
            if(btnDisabled == "true"){
                return;
            }
            for(var button = 0; button < newItemBtns.length; button++){
                $(newItemBtns[button]).attr("data-disabled", "true");
            }
            $("#btnNewCategory").hide();
            $("#btnNewCategoryBack").show();
            $("#newCategory").removeClass("no-display");
            $("#btnSaveNewCategory").removeClass("no-display");
            $("input").attr("disabled", "true");
            $("#newCategory").removeAttr("disabled");
            $("#btnSaveNewCategory").removeAttr("disabled");
        }
    });

    $("#btnNewCategoryBack").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            for(var button = 0; button < newItemBtns.length; button++){
                $(newItemBtns[button]).attr("data-disabled", "false");
            }
            $("#btnNewCategoryBack").hide();
            $("#newCategory").addClass("no-display");
            $("#btnSaveNewCategory").addClass("no-display");
            $("#btnNewCategory").show();
            $("input").removeAttr("disabled");
        }
    });

    $("input[type='checkbox']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            var checked = e.currentTarget.checked;
            var checkbox = e.currentTarget;
            var confirmBtn = $(checkbox).nextAll("input[type='submit']");
            var categoryH2 = $(checkbox).next("label");
            var li = $(checkbox).closest("li");
            var shoppingItemsLabel = null;
            var parentCategory = null;
            var shoppingItems = null;
            var shoppingCheckboxesInCategory = null;
            if ($(checkbox).hasClass("checkbox-category")) {// the whole purpose of this if clause is to get the shoppingItemsLabel
                parentCategory = $(checkbox).parents("li");
                shoppingItems = $(parentCategory).find("ul.shopping-items li");
                shoppingItemsLabel = $(shoppingItems).find("label");//getting the shoppingItemsLabel so we it can be toggled with the deleted text-muted classes when the item's respective parent category has be selected for deletion.
            }
            if (checked) {
                if ($(checkbox).hasClass("checkbox-category")) {
                    shoppingCheckboxesInCategory = $(shoppingItems).find("input[type='checkbox']");
                    if(shoppingCheckboxesInCategory){
                        // $(shoppingCheckboxesInCategory).attr("checked", "true");
                        $(shoppingCheckboxesInCategory).click();
                    }
                }

                $("button").attr("disabled", "true");
                e.currentTarget.value = "true";
                $(li).addClass("deleted text-muted");
                $(categoryH2).addClass("deleted text-muted");
                if(shoppingItemsLabel){
                    $(shoppingItemsLabel).addClass("deleted text-muted");
                }
                $(confirmBtn).removeClass("no-display");
                if ($(checkbox).hasClass("shop-item")) {
                    $(checkbox).prev("input").val($(checkbox).attr("data-id").toString());
                }
            } else {
                $("button").removeAttr("disabled");
                e.currentTarget.value = "true";
                $(li).removeClass("deleted text-muted");
                $(categoryH2).removeClass("deleted text-muted");
                if(shoppingItemsLabel){
                    $(shoppingItemsLabel).removeClass("deleted text-muted");
                }
                $(confirmBtn).addClass("no-display");
                if ($(checkbox).hasClass("shop-item")) {
                    $(checkbox).prev("input").val("");
                }
            }

        }
    });

    $("button[id^='btnNewItem']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            var btnDisabled = $(this).attr("data-disabled");
            if(btnDisabled == "true"){
                return;
            }
            for(var button = 0; button < newItemBtns.length; button++){
                $(newItemBtns[button]).attr("data-disabled", "true");
            }
            $("#btnNewCategory").attr("data-disabled", "true");
            $(this).attr("data-disabled", "false");
            var thisBtnID = $(this).attr("id");
            $("#" + thisBtnID).hide();
            var idNum = $(this).attr("data-catid");
            var btnIdNumRemoved = thisBtnID.substr(0, thisBtnID.length - idNum.length);
            $("#" + btnIdNumRemoved + "Back" + idNum).show();
            $("#" + btnIdNumRemoved + "Back" + idNum).removeClass("no-display");
            $("#newItem" + idNum).removeClass("no-display");
            $("#newItem" + idNum).prev("input").val(idNum);
            $("#btnSaveNewItem" + idNum).removeClass("no-display");
            $("input").attr("disabled", "true");
            var newItemCategoryId = $(this).attr("data-catid");
            var newItemTextInputId = "#newItem" + newItemCategoryId;
            $(newItemTextInputId).removeAttr("disabled");
            var newItemSubmitInputId = "#btnSaveNewItem" + newItemCategoryId;
            $(newItemSubmitInputId).removeAttr("disabled");
            $("input[type=hidden]").removeAttr("disabled");
        }
    });

    $("button[id^='btnNewItemBack']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            for(var button = 0; button < newItemBtns.length; button++){
                $(newItemBtns[button]).attr("data-disabled", "false");
            }
            $("#btnNewCategory").attr("data-disabled", "false");
            var thisBtnID = $(this).attr("id");
            $("#" + thisBtnID).addClass("no-display");
            var idNum = $(this).attr("data-catid");
            var btnIdNumRemoved = thisBtnID.substr(0, thisBtnID.length - idNum.length);
            $("#btnNewItem" + idNum).show();
            $("#newItem" + idNum).addClass("no-display");
            $("#newItem" + idNum).prev("input").val("");
            $("#btnSaveNewItem" + idNum).addClass("no-display");
            $("#" + btnIdNumRemoved + idNum).show();
            $("input").removeAttr("disabled");
        }
    });
});