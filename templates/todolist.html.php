<link rel="stylesheet" href="/css/vendor/gijgo.min.css">
<link rel="stylesheet" href="/css/todolist.css">

<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">To Do List</h1>
        <!-- if not logged in display the below: -->
        <?php if (!$loggedIn) : ?>
        <span class="alert alert-warning" role="alert">You must be logged in to be able to use this app.</span>
        <?php endif; ?>

        <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <!-- Todo: Replace this css errors class with bootstrap version -->
            <p>There was a problem with your task input. Please check the following:</p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                <?php if ($error != 'new task') : ?>
                <li>
                    <h2><?= $error ?></h2>
                </li>
                <?php else : ?>
                <script type="text/javascript">
                $(document).ready(function() {
                    setTimeout(function() {
                        $("#btnNewTask").click();
                    }, 50);
                });
                </script>
                <?php endif ?>

                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>

<div id="todoContainer" class="container">
    <?php if ($loggedIn) : ?>
    <form action="" method="post" name="formNewTask" class="needs-validation" autocomplete="off" novalidate>
        <button id="btnNewTask" class="btn btn-primary">+ New Task</button>
        <div id="divNevermind">
            <button id="btnCancelNewTask" class="btn btn-secondary d-none">
                <- Nevermind</button> </div> <div id="taskInputContainer" class="container d-none">
                    <div class="mb-3">
                        <label for="taskName">Task Title</label>
                        <span class="sr-only">Information about "Task Title"</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Task Title"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Provide a short, maximum of 45 characters, but descriptive name for your task so that you can remember what you need to accomplish.">
                        <input type="text" id="taskName" name="newtask[taskname]" class="form-control" value="" autocomplete="off" value="" maxlength="45" required autofocus>
                        <div class="invalid-feedback"><span id="taskNameInputError"></span></div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class='col-sm-6'>
                                <label for="datePicker">Due Date</label>
                                <span class="sr-only">Information about "Due Date"</span>
                                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Due Date"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Input the current date or a future date below to indicate the no later than date in which this task must be completed by.  The date must be formatted as MM/DD/YY.">
                                <input name="newtask[date]" id="datePicker" class="datetimepicker-input" required />
                                <div class="invalid-feedback"><span id="datePickerInputError"></span></div>
                            </div>
                            <div class='col-sm-3 cb-recurring-col'>
                                <div class="custom-control custom-checkbox">
                                    <input id="cbRecurringTask" type="checkbox" class="custom-control-input" />
                                    <label class="custom-control-label" for="cbRecurringTask">Make this a recurring task</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="panelFrequency" class="mb-3">
                        <label for="frequency">Frequency</label>
                        <span class="sr-only">Information about Frequency options</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about Frequency options" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Choose how often you wish to complete this task.  Options include daily, weekly, bi-weekly, monthly, semi-annually, or annually">
                        <select class="form-control d-block w-100" id="frequency" name="newtask[frequency]" required>
                            <option value="">Choose...</option>
                            <option value="1">Daily</option>
                            <option value="2">Weekly</option>
                            <option value="3">Bi-weekly</option>
                            <option value="4">Monthly</option>
                            <option value="5">Semi-annually</option>
                            <option value="6">Annually</option>
                        </select>
                    </div>

                    <div id="panelEndDate" class="mb-3">
                        <div class="row">
                            <div class='col-sm-6'>
                                <label for="endDatePicker">End Date</label>
                                <span class="sr-only">Information about "End Date"</span>
                                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "End Date"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Input the future date in which you would like for this task to end.  This is an optional input.  The date must be formatted as MM/DD/YY.">
                                <input name="newtask[enddate]" id="endDatePicker" class="datetimepicker-input" />
                                <div class="invalid-feedback"><span id="endDatePickerInputError"></span></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="priorityLevel">Priority</label>
                        <span class="sr-only">Information about priority level options</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt="Information about priority level options" width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Chose from the options of low, medium or high to sort the priority of your tasks.">
                        <select class="form-control d-block w-100" id="priorityLevel" name="newtask[prioritylevel]" required>
                            <option value="">Choose...</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                        </select>
                        <div class="invalid-feedback"><span id="priorityLevelInputError"></span></div>
                    </div>

                    <div class="mb-3">
                        <label for="notesInput">Notes</label>
                        <span class="sr-only">Information about "Notes"</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Notes"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Provide any additional details about your task.  The maximum characters allowed for this field is 255.">
                        <input type="text" id="notesInput" name="newtask[notesinput]" class="form-control" value="" autocomplete="off" maxlength="255">
                    </div>

                    <div class="mb-3">
                        <input id="submitNewTask" name="submitnewtask" type="submit" class="btn btn-primary" value="Submit" disabled>
                    </div>
        </div>
    </form>

    <form action="" method="post" name="formDelete" class="needs-validation" autocomplete="off" novalidate>
        <input type="hidden" id="deleteToDoId" name="deletetodoid">
        <input type="submit" id="confirmDelete" name="btndelete" value="Confirm Task Delete" class="btn btn-danger d-none" disabled />
    </form>

    <form action="" method="post" name="formTable" class="needs-validation" autocomplete="off" novalidate>
        <div id="divChanges">
            <input type="submit" id="saveChanges" name="btnsave" value="Save Changes" class="btn btn-primary d-none" disabled />
            <button id="btnDiscardEdits" class="btn btn-secondary d-none" disabled>Discard Changes</button>
        </div>
        <table data-toggle="table" data-search="true" class="table table-bordered table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="col-checkbox">
                        <input type="hidden" name="coltosort" id="colToSort">
                    </th>
                    <th scope="col" class="col-due-date">
                        <button id="btnSortDate" name="sortdate" data-colname="due_date">
                            <img src="/css/vendor/open-iconic-master/svg/elevator.svg" alt="Click to sort this column" width="12rem" height="12rem" fill="#fff">
                            <span id="dueDateHeader">Due Date</span>
                        </button>
                    </th>
                    <th scope="col" class="col-task-title">
                        <button name="sorttitle" data-colname="title">
                            <img src="/css/vendor/open-iconic-master/svg/elevator.svg" alt="Click to sort this column" width="12rem" height="12rem" fill="#fff">
                            Task
                        </button>
                    </th>
                    <th scope="col" class="col-priority">
                        <button name="sortpriority" data-colname="todo_priority">
                            <img src="/css/vendor/open-iconic-master/svg/elevator.svg" alt="Click to sort this column" width="12rem" height="12rem" fill="#fff">
                            Priority
                        </button>
                    </th>
                    <th scope="col" class="col-percent">
                        <button id="btnPercentComplete" name="sortcompletionpercent" data-colname="percent_complete">
                            <img src="/css/vendor/open-iconic-master/svg/elevator.svg" alt="Click to sort this column" width="12rem" height="12rem" fill="#fff">
                            <span id="percentCompleteHeader">% Complete</span>
                        </button>
                    </th>
                    <th scope="col" class="col-notes">
                        <button name="sortnotes" data-colname="notes">
                            <img src="/css/vendor/open-iconic-master/svg/elevator.svg" alt="Click to sort this column" width="12rem" height="12rem" fill="#fff">
                            Notes
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $value = 0; ?>
                <?php $numBtns = 0; ?>
                <?php foreach ($currentUserTodos as $todo) : ?>

                <?php if ($value > 9) : ?>
                <tr class="d-none">
                    <?php else : ?>
                <tr>
                    <?php endif ?>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input id="cb<?= $value ?>" type="checkbox" data-todoid="<?= $todo['id'] ?>" class="custom-control-input cb-delete" />
                            <label class="custom-control-label text-hide" for="cb<?= $value ?>">Toggle me</label>
                            <input type="hidden" name="editid[<?= $value ?>]" id="editId<?= $value ?>" />
                        </div>
                    </td>
                    <td>
                        <input type="text" class="form-control datetimepicker-input" id="datetimepickerNoIcon<?= $value ?>" placeholder="<?= $todo['due_date'] ?>" data-todoid="<?= $todo['id'] ?>" data-hidden="hiddenDateTimePicker<?= $value ?>" />
                        <input type="hidden" name="editduedate[<?= $value ?>]" id="hiddenDateTimePicker<?= $value ?>">
                    </td>
                    <td>
                        <textarea form="formTable" maxlength="45" class="form-control" data-todoid="<?= $todo['id'] ?>"><?= $todo['title'] ?></textarea>
                        <input type="hidden" id="usersTaskName<?= $value ?>" name="edittask[<?= $value ?>]" data-todoid="<?= $todo['id'] ?>">
                    </td>
                    <td>
                        <select class="form-control d-block w-100" id="usersPriorityLevel<?= $value ?>" name="editprioritylevel[<?= $value ?>]" data-selectedIndex="<?= $todo['todo_priority'] ?? '0' ?>" data-todoid="<?= $todo['id'] ?>">
                            <option value="">Choose...</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" id="percentComplete<?= $value ?>" name="editpercentcomplete[<?= $value ?>]" class="form-control d-none" value="<?= $todo['percent_complete'] ?>" autocomplete="off" min="0" max="100" data-todoid="<?= $todo['id'] ?>">

                        <div class="progress" style="height: 2.25rem;">
                            <div class="progress-bar" role="progressbar" style="width: <?= $todo['percent_complete'] ?>%;" aria-valuenow="<?= $todo['percent_complete'] ?>" aria-valuemin="0" aria-valuemax="100"><?= $todo['percent_complete'] ?>%</div>
                        </div>

                    </td>
                    <td>
                        <textarea form="formTable" maxlength="255" class="form-control" data-todoid="<?= $todo['id'] ?>"><?= $todo['notes'] ?></textarea>
                        <input type="hidden" id="usersNotes<?= $value ?>" name="editusersnotes[<?= $value ?>]" data-todoid="<?= $todo['id'] ?>">
                    </td>
                </tr>
                <?php $value = $value + 1; ?>
                <?php $numBtns = $value / 10; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($value > 9) : ?>
        <nav id="navPagination" aria-label="Todo List navigation">
            <ul class="pagination justify-content-end">
                <?php if ($numBtns > 1) : ?>
                <li class="page-item disabled">
                    <button class="page-link" aria-disabled="true" data-stub="first">Previous</button>
                </li>
                <?php for ($button = 0; $button < $numBtns; $button++) : ?>
                <?php if ($button == 0) : ?>
                <li class="page-item active"><button class="page-link">
                        <?php echo ($button + 1) ?> </button><span class="sr-only"> current</span></li>
                <?php else : ?>
                <li class="page-item"><button class="page-link">
                        <?php echo ($button + 1) ?> </button></li>
                <?php endif ?>
                <?php endfor; ?>
                <li class="page-item">
                    <button class="page-link" data-stub="last">Next</button>
                </li>
                <?php endif ?>
            </ul>
        </nav>
        <?php endif ?>
    </form>

</div> <!-- /container -->

<?php endif; ?>

<script type="text/javascript" src="/js/vendor/gijgo/gijgo.min.js"></script>
<script type="text/javascript" src="/js/todolist.js"></script>