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

    $("#taskName, #datePicker, #priorityLevel").on("keyup blur change", function () {
        var date = $("#datePicker").val();
        var priorityLevel = $("#priorityLevel").val();
        var taskName = $("#taskName").val();
        taskName = taskName.trim();
        date = date.toString().trim();
        priorityLevel = priorityLevel.toString().trim();

        var datePickerStatus = false;
        var priorityLevelStatus = false;
        var taskNameStatus = false;

        datePickerStatus = (validateDate(date)) ? true : false;
        priorityLevelStatus = (validatePriorityLevel(priorityLevel)) ? true : false;
        taskNameStatus = (validateTaskName(taskName)) ? true : false;
        if (taskNameStatus && datePickerStatus && priorityLevelStatus) {
            $("#submitNewTask").removeAttr("disabled");
        }
        else {
            $("#submitNewTask").attr("disabled", "true");
        }
    });

    $("#taskName").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var taskName = $("#taskName").val();
            taskName = taskName.trim();
            if (validateTaskName(taskName)) {
                $("#taskNameInputError").text("");
                $("#taskName").removeClass("is-invalid");
                $("#taskName").addClass("is-valid");
            }
            else {
                $("#taskNameInputError").text("Error: Enter a valid task name");
                $("#taskName").removeClass("is-valid");
                $("#taskName").addClass("is-invalid");
            }
        }
    });

    $("#datePicker").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var date = $("#datePicker").val();
            date = date.trim();
            if (validateDate(date)) {
                $("#datePickerInputError").text("");
                $("#datePickerInputError").parent().css("display", "none");
                $("#datePicker").removeClass("is-invalid");
                $("#datePicker").addClass("is-valid");
            }
            else {
                $("#datePickerInputError").text("Error: Enter a valid date");
                $("#datePickerInputError").parent().css("display", "block");
                $("#datePicker").removeClass("is-valid");
                $("#datePicker").addClass("is-invalid");
            }
        }
    });

    $("#priorityLevel").on("keyup blur change", function (e) {
        if (e.keycode != 9 && e.which != 9 && e.type != "tab") {
            var priorityLevel = $("#priorityLevel").val();
            priorityLevel = priorityLevel.trim();
            if (validatePriorityLevel(priorityLevel)) {
                $("#priorityLevelInputError").text("");
                $("#priorityLevel").removeClass("is-invalid");
                $("#priorityLevel").addClass("is-valid");
            }
            else {
                $("#priorityLevelInputError").text("Error: Select a priority level from the dropdown list");
                $("#priorityLevel").removeClass("is-valid");
                $("#priorityLevel").addClass("is-invalid");
            }
        }
    });

    $(function () {
        $('[data-toggle="popover"]').popover({
            trigger: "hover click",
            html: true,
            title: ""
        });
    });

    $(function () {
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#datePicker').datepicker({
            format: 'm/d/yy',
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            icons: {
                rightIcon: '<i class="fas fa-calendar"></i>'
            },
            minDate: today
        });
        var dtPickersNoIcon = [];
        dtPickersNoIcon = $("input[id^='datetimepickerNoIcon']");
        for (var picker = 0; picker < dtPickersNoIcon.length; picker++) {
            $(dtPickersNoIcon[picker]).datepicker({
                format: 'm/d/yy',
                uiLibrary: 'bootstrap4',
                showOnFocus: true,
                showRightIcon: false,
                minDate: today
            });
        }
    });

    if (window.matchMedia("(max-width: 415px)").matches) {
        /* The viewport is less than, or equal to, 415 pixels wide */
        $("#dueDateHeader").text("Date");
        $("#percentCompleteHeader").text("%");
    } else {
        /* The viewport is greater than 415 pixels wide */
        $("#dueDateHeader").text("Due Date");
        $("#percentCompleteHeader").text("% Complete");
    }

    var prioritySelectInputs = [];
    prioritySelectInputs = $("select[id^='usersPriorityLevel']");
    setSelectedIndexes(prioritySelectInputs);

    var statusSelectInputs = [];
    statusSelectInputs = $("select[id^='todoStatus']");
    setSelectedIndexes(statusSelectInputs);

    $("#btnNewTask").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            $(".bootstrap-table").hide();
            $(this).hide();
            $("#btnCancelNewTask").removeAttr("hidden");
            $("#divNevermind").addClass("mb-3");
            $("#taskInputContainer").removeAttr("hidden");
            $("#btnCancelNewTask").show();
            $("#taskInputContainer").show();
        }
    });

    $("#btnCancelNewTask").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            $(this).hide();
            $("#divNevermind").removeClass("mb-3");
            $("#taskInputContainer").hide();
            $(".bootstrap-table").show();
            $("#btnNewTask").show();
        }
    });

    $("input[type='checkbox']").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            var checked = e.currentTarget.checked;
            var checkbox = this;
            var hiddenInput = $("#deleteToDoId");
            var todoIdToDelete = $(checkbox).attr("data-todoid");
            var row = $(checkbox).closest("tr");
            var textAreas = [];
            textAreas = $(row).find("textarea");
            var datePicker = $(row).find(".datetimepicker-input");
            var selects = [];
            selects = $(row).find("select");
            if (checked) {
                $(hiddenInput).val(todoIdToDelete);
                $("#btnNewTask").attr("disabled", "true");
                $("#btnNewTask").hide();
                $("#confirmDelete").removeAttr("hidden");
                $("#confirmDelete").show();
                $("#confirmDelete").removeAttr("disabled");
                $(row).addClass("deleted text-muted");
                $(textAreas).addClass("deleted text-muted");
                $(datePicker).addClass("deleted text-muted");
                $(selects).addClass("deleted text-muted");
            }
            else {
                $(hiddenInput).val("");
                $("#btnNewTask").removeAttr("disabled");
                $("#btnNewTask").show();
                $("#confirmDelete").hide();
                $("#confirmDelete").attr("disabled", "true");
                $(row).removeClass("deleted text-muted");
                $(textAreas).removeClass("deleted text-muted");
                $(datePicker).removeClass("deleted text-muted");
                $(selects).removeClass("deleted text-muted");
            }
        }
    });

    $("input[id^='usersTaskName'], select[id^=usersPriorityLevel], select[id^='todoStatus'], input[id^='percentComplete'], input[id^='usersNotes'], textarea").on("change", function (e) {
        var input = this;
        toggleEditBtns();
        var todoId = $(input).attr("data-todoid");
        var currentRow = $(input).closest("tr");
        var hiddenInput = $(currentRow).find("input[type=hidden]:first");
        hiddenInput.val(todoId);
    });

    $("input[id^='datetimepickerNoIcon']").on("change", function (e) {
        var hiddenInput = "#" + $(this).attr("data-hidden");
        var input = this;
        var newDate = $(this).val();
        if (newDate) {
            $(hiddenInput).val(newDate);
            toggleEditBtns();
            var todoId = $(input).attr("data-todoid");
            var currentRow = $(input).closest("tr");
            var hiddenIdInput = $(currentRow).find("input[type=hidden]:first");
            hiddenIdInput.val(todoId);
        }
    });

    $(".progress").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            var progressDiv = this;
            var numInput = $(progressDiv).prev("input[type=number]");
            $(progressDiv).hide();
            $(numInput).removeAttr("hidden");
            $(numInput).show();
        }
    });

    var progressBars = [];
    progressBars = $(".progress-bar");
    setProgressBarColors(progressBars);

    $(".form-control").on("blur change keyup", function () {
        var progressBars = [];
        progressBars = $(".progress-bar");
        setProgressBarColors(progressBars);
    });

    var textAreas = [];

    textAreas = $("textarea");
    for (var tArea = 0; tArea < textAreas.length; tArea++) {
        if ($(textAreas[tArea]).text().toString().trim() == "empty") {
            $(textAreas[tArea]).text("");
        }
        textAreas[tArea].style.height = textAreas[tArea].scrollHeight + "px";
    }

    $("textarea").on("change", function () {
        var textArea = $(this);
        var notesInputControl = $(textArea).next("input[type=hidden]");
        var userInput = $(textArea).val();
        if (userInput.toString().trim() != "") {
            notesInputControl.val(userInput);
        } else {
            notesInputControl.val("empty");
        }

    });

    $("thead button").on("click keyup", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.stopPropagation();
            //get value of the attr data-colname
            var colToSort = $(this).attr("data-colname");
            // store it in hidden input #colToSort
            $("#colToSort").val(colToSort);
            // call click on #saveChanges to submit the changes for processing in the controller
            $("#saveChanges").click();
        }
    });

    $("#btnDiscardEdits").on("keyup click", function (e) {
        if (e.keycode == 13 || e.which == 13 || e.keycode == 32 || e.which == 32 || e.type == "click") {
            e.preventDefault();
            e.stopPropagation();
            window.location.reload(false);
        }
    });

    var dateInputs = [];
    dateInputs = $("input[id^='datetimepickerNoIcon']");
    var overDue = false;
    for (var dateInput = 0; dateInput < dateInputs.length; dateInput++) {
        var datePlaceholder = $(dateInputs[dateInput]).attr("placeholder");
        overDue = compareDates(datePlaceholder);
        if (overDue) {
            $(dateInputs[dateInput]).addClass("over-due");
        }
    }
});
/**
 * Name: setSelectedIndexes
 * Purpose: On document ready it sets the front end select index to match what is in the DB as the user's prior selection
 * @param  {} selectInputs: These are the select inputs from within the todo list table
 * Return: none
 */
function setSelectedIndexes(selectInputs) {
    "use strict";
    var selectedIndex = 0;
    for (var sInput = 0; sInput < selectInputs.length; sInput++) {
        selectedIndex = $(selectInputs[sInput]).attr("data-selectedIndex");
        selectedIndex = parseInt(selectedIndex, 10);
        if (selectedIndex > 0) {
            selectInputs[sInput].selectedIndex = selectedIndex.toString();
        }
    }
}
/**
 * Name: toggleEditBtns
 * Purpose: Toggles the buttons that allow updating, deleting, and saving of table data
 * @param  none
 * Return: none
 */
function toggleEditBtns() {
    "use strict";
    $("#saveChanges").removeAttr("hidden");
    $("#btnDiscardEdits").removeAttr("hidden");
    $("#saveChanges").show();
    $("#btnDiscardEdits").show();
    $("#saveChanges").removeAttr("disabled");
    $("#btnDiscardEdits").removeAttr("disabled");
    $("#btnNewTask").attr("disabled", "true");
    $("#btnNewTask").hide();
}
/**
 * Name: setProgressBarColors
 * Purpose: set the color of text in the progress bars to indicate their status. (Greed, Amber, Red)
 * @param  {} progressBars: these are the progress bars from within the todo list table.
 * Return: none
 */
function setProgressBarColors(progressBars) {
    "use strict";
    for (var bar = 0; bar < progressBars.length; bar++) {
        var progressValue = $(progressBars[bar]).attr("aria-valuenow");
        if (progressValue >= 0 && progressValue <= 24) {
            $(progressBars[bar]).addClass("bg-danger text-dark");
        }
        else if (progressValue >= 25 && progressValue <= 74) {
            $(progressBars[bar]).addClass("bg-warning text-dark");
        }
        else if (progressValue >= 75 && progressValue <= 100) {
            $(progressBars[bar]).addClass("bg-success text-white");
        }
    }
}
/**
 * Name compareDates
 * Purpose: Used to determine if a task is overdue or not
 * @param  {} date:
 * Return: true if the date param is in the past or false if it is the current date or a future date
 */
function compareDates(date) {
    "use strict";
    var today = new Date();
    date = new Date(date);
    return (today > date) ? true : false;
}

/**
 * Name validateTaskName
 * Purpose: Accept input as long as there is input that contains text other than whitespace
 * @param  {} taskName
 * Return: True if valid or false if invalid input
 */
function validateTaskName(taskName) {
    'use strict';
    if (taskName.length > 0) {
        return true;
    }
    else {
        return false;
    }
}
/**
 * Name: validateDate
 * Purpose: Determine if the date input was in correct format MM/DD/YY and that it is a current or future date
 * @param  {} date: this is the date input from the user
 * Return: True if a valid date or false if invalid
 */
function validateDate(date) {
    "use strict";
    // Did the user not provide any input?
    if (!date) {
        return false;
    }
    date = new Date(date);
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var qtyDaysInMonth = daysInMonth(month, year);
    var day = date.getDate();
    var today = new Date();
    var thisYear = today.getFullYear();
    var thisMonth = today.getMonth() + 1;
    var thisDay = today.getDate();

    // Is the day within the proper range of the specified month?
    if (day < 1 || day > qtyDaysInMonth) {
        return false;
    }
    else if (month < 1 || month > 12) {
        return false;
    }
    // Is the input year a year from the past?
    else if (year < thisYear) {
        return false;
    }
    // Is the year current, but the month in the past?
    else if (year == thisYear && month < thisMonth ) {
        return false;
    }
    // Is the year and month current, but the day is in the past?
    else if (year == thisYear && month == thisMonth && day < thisDay) {
        return false;
    }
    else {
        return true;
    }
}
/**
 * Name: daysInMonth
 * Purpose: Use the paramerters to determine how many days are in the provided month.
 * @param  {} month
 * @param  {} year
 * Return: The number of days in the month
 */
function daysInMonth(month, year) {
    "use strict";
    return new Date(year, month, 0).getDate();
}
/**
 * Name: validatePriorityLevel
 * Purpose: Verify that either low (1), medium (2) or high (3) priority was selected by the user.
 * @param  {} priorityLevel:
 */
function validatePriorityLevel(priorityLevel) {
    "use strict";
    if (!priorityLevel) {
        return false;
    }
    priorityLevel = parseInt(priorityLevel, 10);
    if (priorityLevel > 0 && priorityLevel < 4) {
        return true;
    }
}