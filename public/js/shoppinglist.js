/*jshint esversion: 6 */
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
            if (btnDisabled == "true") {
                return;
            }
            for (var button = 0; button < newItemBtns.length; button++) {
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
            for (var button = 0; button < newItemBtns.length; button++) {
                $(newItemBtns[button]).attr("data-disabled", "false");
            }
            $("#btnNewCategoryBack").hide();
            $("#newCategory").addClass("no-display");
            $("#newCategory").val("");
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
            var shoppingItemLabel = null;
            var li = $(checkbox).closest("li");
            var shoppingItemsLabel = null;
            var categoryParentLi = null;
            var shoppingItems = null;
            var shoppingCheckboxesInCategory = null;
            var shoppingItemParentLi = null;
            if ($(checkbox).hasClass("checkbox-category")) {
                // The checkbox is a category item
                categoryParentLi = $(checkbox).parents("li");
                shoppingItems = $(categoryParentLi).find("ul.shopping-items li");
                shoppingItemsLabel = $(shoppingItems).find("label");//getting the shoppingItemsLabel so we it can be toggled with the deleted text-muted classes when the item's respective parent category has be selected for deletion.
                shoppingCheckboxesInCategory = $(shoppingItems).find("input[type='checkbox']");
                if (checked) {
                    $(confirmBtn).removeClass("no-display");
                    if (shoppingCheckboxesInCategory) {
                        $(shoppingCheckboxesInCategory).click();
                        $(shoppingCheckboxesInCategory).attr("disabled", "true");
                        $("input[id^='confirmDeleteItem']").addClass("no-display");
                    }
                } else {
                    $(confirmBtn).addClass("no-display");
                    if (shoppingCheckboxesInCategory) {
                        $(shoppingCheckboxesInCategory).removeAttr("disabled");
                        $(shoppingCheckboxesInCategory).click();
                    }
                }
            } else {
                // the checkbox is a shopping list item
                shoppingItemLabel = $(checkbox).next("label");
                var parentCategoryLiDataId = $(checkbox).closest("ul").attr("data-categoryid");
                var categoryli = $("#categoryli" + parentCategoryLiDataId);
                var parentCategoryCheckbox = $(categoryli).find("input[type='checkbox']").first();

                if (checked) {
                    if (parentCategoryCheckbox[0].checked == false) {
                        $(parentCategoryCheckbox).attr("disabled", "true");
                    }
                    $(shoppingItemParentLi).attr("disabled", "true");
                    $("button").attr("disabled", "true");
                    e.currentTarget.value = "true";
                    $(li).addClass("deleted text-muted");
                    $(shoppingItemLabel).addClass("deleted text-muted");
                    if (shoppingItemsLabel) {
                        $(shoppingItemsLabel).addClass("deleted text-muted");
                    }
                    $(confirmBtn).removeClass("no-display");
                    if ($(checkbox).hasClass("shop-item")) {
                        $(checkbox).prev("input").val($(checkbox).attr("data-id").toString());
                    }
                } else {
                    // the shoppinglist item checkbox is not checked
                    var shoppingItemCheckboxes = [];
                    shoppingItemCheckboxes = $("#shoppingItemsList" + parentCategoryLiDataId).find("input[type='checkbox']");
                    var allItemBoxesUnchecked = true;
                    for (var itemCheckbox = 0; itemCheckbox < shoppingItemCheckboxes.length; itemCheckbox++) {
                        if (shoppingItemCheckboxes[itemCheckbox].checked == true) {
                            allItemBoxesUnchecked = false;
                            break;
                        }
                    }

                    if (allItemBoxesUnchecked) {
                        $(parentCategoryCheckbox).removeAttr("disabled"); //add logic so this does not get removed unless all shopping items in this category are not checked
                    }
                    $(shoppingItemParentLi).removeAttr("disabled");
                    $("button").removeAttr("disabled");
                    e.currentTarget.value = "true";
                    $(li).removeClass("deleted text-muted");
                    $(shoppingItemLabel).removeClass("deleted text-muted");
                    if (shoppingItemsLabel) {
                        $(shoppingItemsLabel).removeClass("deleted text-muted");
                    }
                    $(confirmBtn).addClass("no-display");
                    if ($(checkbox).hasClass("shop-item")) {
                        $(checkbox).prev("input").val("");
                    }
                }
            }
        }
    });

    $("button[id^='btnNewItem']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            var btnDisabled = $(this).attr("data-disabled");
            if (btnDisabled == "true") {
                return;
            }
            for (var button = 0; button < newItemBtns.length; button++) {
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

    $("input[id^='newItem']").on("keyup change", function (e) {
        var itemSubmitBtn = $(this).next();
        if (e.keycode == 13 || e.which == 13) {
            $(itemSubmitBtn).click();
        }
    });

    $("button[id^='btnNewItemBack']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            for (var button = 0; button < newItemBtns.length; button++) {
                $(newItemBtns[button]).attr("data-disabled", "false");
            }
            $("#btnNewCategory").attr("data-disabled", "false");
            var thisBtnID = $(this).attr("id");
            $("#" + thisBtnID).addClass("no-display");
            var idNum = $(this).attr("data-catid");
            var btnIdNumRemoved = thisBtnID.substr(0, thisBtnID.length - idNum.length);
            $("#btnNewItem" + idNum).show();
            $("#newItem" + idNum).addClass("no-display");
            $("#newItem" + idNum).val("");
            $("#newItem" + idNum).prev("input").val("");
            $("#btnSaveNewItem" + idNum).addClass("no-display");
            $("#" + btnIdNumRemoved + idNum).show();
            $("input").removeAttr("disabled");
        }
    });

    $("input[type='text']").on("keyup change", function (e) {
        if ($(this).hasClass("new-category")) {
            if (ValidateCategory($(this).val())) {
                $("#categoryInputError").text("");
                $("#newCategory").removeClass("is-invalid");
                $("#newCategory").addClass("is-valid");
            } else {
                let hiddenCategoryInputError = $("#hiddenCategoryInputError").val();
                $("#categoryInputError").text(hiddenCategoryInputError);
                $("#newCategory").removeClass("is-valid");
                $("#newCategory").addClass("is-invalid");
            }
        }
        else if ($(this).hasClass("new-item")) {
            if (ValidateItem($(this).val())) {
                $("#itemInputError").text("");
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            } else {
                let itemInputError = $("#itemInputError").val();
                $("#itemInputError").text(itemInputError);
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
            }
        }
    });

    sanitizeNameAttributes();
});

function ValidateCategory(category) {
    'use strict';
    if (category.length >= 1 && category.length <= 45 && category.indexOf(" ") != 0) {
        return true;
    }
    else {
        return false;
    }
}

function ValidateItem(item) {
    'use strict';
    if (item.length >= 1 && item.length <= 120 && item.indexOf(" ") != 0) {
        return true;
    }
    else {
        return false;
    }
}
/**
 * * Name: sanitizeNameAttributes
 * Purpose: In scenarios where the shopping item's text contained a quotation mark the name attribute would break because it didn't properly escape the quotation marks.  This function cleans that problem up.
 * @param  none
 * Return: none
 */
function sanitizeNameAttributes() {
    var labels = $("label[for^=shopitem]");
    for (var label = 0; label < labels.length; label++) {
        var labelTxt = $(labels[label]).text();
        var cbInput = $(labels[label]).prev();
        $(cbInput).attr("name", "");
        $(cbInput).attr("name", "shopitem[" + labelTxt + "]");
    }
}