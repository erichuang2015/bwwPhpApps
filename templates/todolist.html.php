<link rel="stylesheet" href="/css/todolist.css">
<div class="jumbotron fill-height">
    <div class="container fill-height">
        <h1 class="display-3">To Do List</h1>
        <!-- if not logged in display the below: -->
        <!-- <p>
      This app allows you to upload your photos and view them in a slide show.
    </p> -->
        <?php if (!$loggedIn): ?>
        <span class="alert alert-warning" role="alert">You must be logged in to be able to use this app.</span>
        <?php endif;?>
    </div>
</div>

<div id="todoContainer" class="container">
    <?php if ($loggedIn): ?>
    <form action="" method="post" name="formNewTask" class="needs-validation" autocomplete="off" novalidate>
        <button id="btnNewTask" class="btn btn-primary">+ New Task</button>
        <div id="divNevermind">
            <button id="btnCancelNewTask" class="btn btn-secondary" hidden>
                <- Nevermind</button> </div> <div id="taskInputContainer" class="container" hidden>
                    <div class="mb-3">
                        <label for="taskName">Task Title</label>
                        <span class="sr-only">Information about "Task Title"</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Task Title"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Provide a short, maximum of 45 characters, but descriptive name for your task so that you can remember what you need to accomplish.">
                        <input type="text" id="taskName" name="newtask[taskname]" class="form-control" value="" autocomplete="off" value="" maxlength="45" required autofocus>
                        <div class="invalid-feedback"><span id="taskNameInputError">Enter a valid task name.</span></div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class='col-sm-6'>
                                <label for="dueDate">Due Date</label>
                                <span class="sr-only">Information about "Due Date"</span>
                                <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Due Date"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Input the current date or a future date below to indicate the no later than date in which this task must be completed by.  The date must be formatted as MM/DD/YYYY.">
                                <div class="form-group">
                                    <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                                        <input name="newtask[date]" type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" required />
                                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="invalid-feedback"><span id="priorityLevel"></span></div>
                    </div>

                    <div class="mb-3">
                        <label for="notesInput">Notes</label>
                        <span class="sr-only">Information about "Notes"</span>
                        <img src="/css/vendor/open-iconic-master/svg/info.svg" alt='Information about "Notes"' width="12px" height="12px" data-container="body" data-toggle="popover" data-placement="right" data-content="Provide any additional details about your task.  The maximum characters allowed for this field is 255.">
                        <input type="text" id="notesInput" name="newtask[notesinput]" class="form-control" value="" autocomplete="off" maxlength="255">
                        <div class="invalid-feedback"><span id="notesInputError">Enter valid notes.</span></div>
                    </div>

                    <div class="mb-3">
                        <input id="submitNewTask" name="submitnewtask" type="submit" class="btn btn-primary">
                    </div>
        </div>
    </form>

    <form action="" method="post" name="formDelete" class="needs-validation" autocomplete="off" novalidate>
        <input type="hidden" id="deleteToDoId" name="deletetodoid">
        <input type="submit" id="confirmDelete" name="btndelete" value="Confirm Task Delete" class="btn btn-danger" hidden disabled />
    </form>

    <form action="" method="post" name="formTable" class="needs-validation" autocomplete="off" novalidate>
        <div id="divChanges">
            <input type="submit" id="saveChanges" name="btnsave" value="Save Changes" class="btn btn-primary" hidden disabled />
            <button id="btnDiscardEdits" class="btn btn-secondary" hidden disabled>Discard Changes</button>
        </div>

        <table data-toggle="table" data-search="true" class="table table-bordered table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" class="col-checkbox">
                        <input type="hidden" name="coltosort" id="colToSort">
                        <input type="hidden" name="directiontosort" id="directionToSort" data-direction="">
                        <!--ASC DESC -->
                    </th>
                    <th scope="col" class="col-due-date">
                        <button id="btnSortDate" name="sortdate" data-colname="due_date" data-direction="">Due Date</button>
                    </th>
                    <th scope="col" class="col-task-title">
                        <button name="sorttitle" data-colname="title" data-direction="">Task</button>
                    </th>
                    <th scope="col" class="col-priority">
                        <button name="sortpriority" data-colname="todo_priority" data-direction="">Priority</button>
                    </th>
                    <th scope="col" class="col-status">
                        <button name="sortstatus" data-colname="todo_status" data-direction="">Status</button>
                    </th>
                    <th scope="col" class="col-percent">
                        <button id="btnPercentComplete" name="sortcompletionpercent" data-colname="percent_complete" data-direction="">% Complete</button>
                    </th>
                    <th scope="col" class="col-notes">
                        <button name="sortnotes" data-colname="notes" data-direction="">Notes</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $value = 0;?>
                <?php foreach ($currentUserTodos as $todo): ?>

                <tr>
                    <td><input type="checkbox" data-todoid="<?=$todo['id']?>"><input type="hidden" name="editid[<?=$value?>]" id="editId<?=$value?>"></td>
                    <td>
                        <input type="text" class="form-control datetimepicker-input" id="datetimepickerNoIcon<?=$value?>" data-toggle="datetimepicker" data-target="#datetimepickerNoIcon<?=$value?>" placeholder="<?=$todo['due_date']?>" data-todoid="<?=$todo['id']?>" data-hidden="hiddenDateTimePicker<?=$value?>" />
                        <input type="hidden" name="editduedate[<?=$value?>]" id="hiddenDateTimePicker<?=$value?>">
                    </td>
                    <td>
                        <textarea form="formTable" maxlength="45" class="form-control" data-todoid="<?=$todo['id']?>"><?=$todo['title']?></textarea>
                        <input type="hidden" id="usersTaskName<?=$value?>" name="edittask[<?=$value?>]" data-todoid="<?=$todo['id']?>">
                    </td>
                    <td>
                        <select class="form-control d-block w-100" id="usersPriorityLevel<?=$value?>" name="editprioritylevel[<?=$value?>]" data-selectedIndex="<?=$todo['todo_priority'] ?? '0'?>" data-todoid="<?=$todo['id']?>">
                            <option value="">Choose...</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control d-block w-100" id="todoStatus<?=$value?>" name="edittodostatus[<?=$value?>]" data-selectedIndex="<?=$todo['todo_status'] ?? '0'?>" data-todoid="<?=$todo['id']?>">
                            <option value="">Choose...</option>
                            <option value="1">Not Started</option>
                            <option value="2">In progress</option>
                            <option value="3">Complete</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" id="percentComplete<?=$value?>" name="editpercentcomplete[<?=$value?>]" class="form-control" value="<?=$todo['percent_complete']?>" autocomplete="off" min="0" max="100" data-todoid="<?=$todo['id']?>" hidden>

                        <div class="progress" style="height: 2.25rem;">
                            <div class="progress-bar" role="progressbar" style="width: <?=$todo['percent_complete']?>%;" aria-valuenow="<?=$todo['percent_complete']?>" aria-valuemin="0" aria-valuemax="100"><?=$todo['percent_complete']?>%</div>
                        </div>

                    </td>
                    <td>
                        <textarea form="formTable" maxlength="255" class="form-control" data-todoid="<?=$todo['id']?>"><?=$todo['notes']?></textarea>
                        <input type="hidden" id="usersNotes<?=$value?>" name="editusersnotes[<?=$value?>]" data-todoid="<?=$todo['id']?>">
                    </td>
                </tr>
                <?php $value = $value + 1;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </form>




</div> <!-- /container -->

<?php endif;?>

<script type="text/javascript" src="/js/todolist.js"></script>