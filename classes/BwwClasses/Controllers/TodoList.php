<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;

class TodoList
{
    private $authentication;
    private $todoPriorityTable;
    private $todoStatusTable;
    private $todoSortTable;
    private $todoTable;
    private $buildingLevelsTable;
    private $buildingUnitsAllowedTable;
    private $mainUnitsTable;
    public function __construct(DatabaseTable $todoPriorityTable, DatabaseTable $todoStatusTable, DatabaseTable $todoSortTable, DatabaseTable $todoTable, Authentication $authentication, DatabaseTable $buildingLevelsTable, DatabaseTable $buildingUnitsAllowedTable, DatabaseTable $mainUnitsTable)
    {
        $this->todoPriorityTable = $todoPriorityTable;
        $this->todoStatusTable = $todoStatusTable;
        $this->todoSortTable = $todoSortTable;
        $this->todoTable = $todoTable;
        $this->authentication = $authentication;
        $this->buildingLevelsTable = $buildingLevelsTable;
        $this->buildingUnitsAllowedTable = $buildingUnitsAllowedTable;
        $this->mainUnitsTable = $mainUnitsTable;
    }

    public function render()
    {
        $loggedIn = $this->authentication->isLoggedIn();
        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $currentUserTodos = [];
            $errors = null;
            $args = func_get_args();
            $todos = null;
            if (func_num_args() == 1) {
                $errors = $args[0];
            }
            if (func_num_args() == 2) { // if the sort method has been called these args will exist
                $todos = $this->todoTable->findAllSorted($args[0], $args[1]);
            } else {
                //if the user has sorted in the past then their last preference is saved - use it
                $userIdCol = "user_id_num";
                $userIdNum = (int)$user['id'];
                $userSort = $this->todoSortTable->find($userIdCol, $userIdNum);
                if (!empty($userSort)) {
                    $sortColumn = $userSort[0]['column'];
                    $sortDirection = (string)$userSort[0]['direction'];
                    $todos = $this->todoTable->findAllSorted($sortColumn, $sortDirection);
                } else {
                    $todos = $this->todoTable->findAll();
                }
            }
            foreach ($todos as $todo) {
                if ($todo['user_id'] != $user['id']) {
                    continue;
                }
                $dueDate = date_create($todo['due_date']);
                $stringDueDate = date_format($dueDate, "n/j/y");
                $currentUserTodos[] = [
                    'id' => (int)$todo['id'],
                    'due_date' => (string)$stringDueDate,
                    'title' => (string)$todo['title'],
                    'todo_priority' => (int)$todo['todo_priority'],
                    'todo_status' => (int)$todo['todo_status'],
                    'percent_complete' => (int)$todo['percent_complete'],
                    'notes' => (string)$todo['notes'],
                ];
            }
            return [
                'template' => 'todolist.html.php',
                'title' => 'To Do List',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'currentUserTodos' => $currentUserTodos ?? null,
                    'errors' => $errors
                ],
            ];
        }
        return [
            'template' => 'todolist.html.php',
            'title' => 'To Do List',
            'variables' => [
                'loggedIn' => $loggedIn,
            ],
        ];
    }

    public function processUserRequest()
    {
        $user = $this->authentication->getUser();

        if (isset($_POST['newtask'])) { // Add new task
            $pageWithNewTasks = $this->saveNewTask($_POST['newtask'], $user);
            return $pageWithNewTasks;
        } elseif (isset($_POST['coltosort']) && !empty($_POST['coltosort'])) { // Sort task
            // $this->updateBuildingUnitsAllowed();
            $sortedPage = $this->sort($_POST['coltosort'], $user);
            return $sortedPage;
        } elseif (isset($_POST['editid']) && !empty($_POST['editid'])) { // Edit task
            $pageWithEdits = $this->editTask($_POST['editid'], $_POST['editduedate'], $_POST['edittask'], $_POST['editprioritylevel'], $_POST['edittodostatus'], $_POST['editpercentcomplete'], $_POST['editusersnotes']);
            return $pageWithEdits;
        } elseif (isset($_POST['deletetodoid']) && !empty($_POST['deletetodoid'])) { // Delete task
            $this->deleteTask($_POST['deletetodoid']);
        } else {
            // The user submitted the form without manipulating it
            header('location: /todolist');
        }
    }

    public function saveNewTask($inputData, $user)
    {
        $errors = [];
        $format = "m/d/Y";
        $validDate = $this->processDate($inputData['date']);
        $validTaskName = $this->validateTaskName((string)$inputData['taskname']);
        $validPriorityLevel = $this->validatePriorityLevel($inputData['prioritylevel']);
        if (!$validDate) {
            $errors[] = 'Enter a valid date';
        }
        if (!$validTaskName) {
            $errors[] = 'Enter a valid task title';
        }
        if (!$validPriorityLevel) {
            $errors[] = 'Select a priority level';
        }
        if ($errors) {
            $errors[] = 'new task';  // find this 'new task' string in the errors on the front end to tell the app that the new task form should be displayed
            $pageWithErrors = $this->render($errors);
            return $pageWithErrors;
        } else {
            $newTaskData['due_date'] = date_create_from_format($format, $inputData['date']);
            $newTaskData['title'] = (string)$inputData['taskname'];
            $newTaskData['todo_priority'] = (int)$inputData['prioritylevel'];
            $newTaskData['todo_status'] = 1;
            $newTaskData['percent_complete'] = 0;
            $newTaskData['notes'] = (string)$inputData['notesinput'];
            $newTaskData['user_id'] = (int)$user['id'];
            $this->todoTable->save($newTaskData);
            header('location: /todolist');
        }
    }

    public function deleteTask($deleteTodoId)
    {
        $this->todoTable->delete($deleteTodoId);
        header('location: /todolist');
    }

    public function editTask($editIds, $editduedates, $edittasks, $editprioritylevels, $edittodostatuses, $editpercentcompletes, $editusersnotes)
    {
        $errors = [];
        for ($index = 0; $index < sizeOf($editIds); $index++) {
            $editTodo = null;
            //If the editIds array isn't empty then edits have been submitted
            if (!empty($editIds[$index])) {
                $editTodo = [];
                $editTodo['id'] = (int)$editIds[$index];
                $editedTodo = $this->todoTable->findById($editIds[$index]); // retrieve this todo from the DB so we can compare the data to user input
                if (!empty($editduedates[$index])) {
                    $validDate = $this->processDate($editduedates[$index]);
                    if ($validDate) {
                        $editTodo['due_date'] = date_create($editduedates[$index]);
                    } else {
                        $editTodo['due_date'] = date_create($editedTodo['due_date']);
                        $errors[] = 'Enter a valid date';
                    }
                }
                if (!empty($edittasks[$index])) {
                    $validTaskName = $this->validateTaskName((string)$edittasks[$index]);
                    if ($validTaskName) {
                        $editTodo['title'] = (string)$edittasks[$index];
                    } else {
                        $errors[] = 'Task title cannot be left blank';
                    }
                }
                //Todo: if you don't check if the editprioritylevels var is empty before you run the below validation it will always prove false even if it wasn't edited
                $validPriorityLevel = $this->validatePriorityLevel($editprioritylevels[$index]);

                if ($validPriorityLevel) {
                    $editTodo['todo_priority'] = (int)$editprioritylevels[$index];
                } else {
                    $errors[] = 'Select a priority level';
                }

                if (!empty($edittodostatuses[$index])) {
                    $editTodo['todo_status'] = (int)$edittodostatuses[$index];
                }
                if (!empty($editpercentcompletes[$index]) || (int)$editpercentcompletes[$index] == 0) {
                    $editTodo['percent_complete'] = (int)$editpercentcompletes[$index];
                }
                if (!empty($editusersnotes[$index])) {
                    $editTodo['notes'] = (string)$editusersnotes[$index];
                }
                $this->todoTable->save($editTodo);
            }
        }
        if ($errors) {
            $pageWithErrors = $this->render($errors);
            return $pageWithErrors;
        } else {
            header('location: /todolist');
        }
    }

    public function sort($colToSort, $user)
    {
        $colToSort = (string)$colToSort;
        $userIdCol = "user_id_num";
        $userIdNum = (int)$user['id'];
        $userSort = $this->todoSortTable->find($userIdCol, $userIdNum);
        $sortData = [];
        //If the user has sorted before we will get their sort state and toggle based on it
        if (!empty($userSort)) {
            $sortData['id'] = (int)$userSort[0]['id'];
            $sortData['column'] = $colToSort;
            $sortData['direction'] = ((string)$userSort[0]['direction'] == 'ASC' && $userSort[0]['column'] == $colToSort) ? 'DESC' : 'ASC'; //if the col to sort is already sorted as 'ASC' then toggle else set
            $sortData['user_id_num'] = $userIdNum;
            $this->todoSortTable->save($sortData);
        } else {
            $sortData['column'] = $colToSort;
            $sortData['direction'] = 'DESC';
            $sortData['user_id_num'] = $userIdNum;
            $this->todoSortTable->save($sortData);
        }

        $sorted = $this->render($colToSort, $sortData['direction']);

        return $sorted;
    }

    public function updateBuildingUnitsAllowed()
    {
        // print_r($buildingUnitsAllowedData);die;
        $buildingLevels = $this->buildingLevelsTable->findAll();
        $mainUnitsData = $this->mainUnitsTable->findAll();
        $id = 780529;
        for ($level = 0; $level < sizeOf($buildingLevels); $level++) {
            $buildingUnitsAllowedData = [];
            foreach ($mainUnitsData as $mainUnit) {
                $buildingUnitsAllowedData['id'] = $id;
                $buildingUnitsAllowedData['building'] = $buildingLevels[$level]['LevelName'];
                $buildingUnitsAllowedData['unit'] = $mainUnit['Unit_Key'];
                $buildingUnitsAllowedData['xp'] = (int)$buildingLevels[$level]['Level'];
                $buildingUnitsAllowedData['conditions'] = '';
                $buildingUnitsAllowedData['faction'] = '';
                $buildingUnitsAllowedData['enabled'] = 'false';
                $this->buildingUnitsAllowedTable->save($buildingUnitsAllowedData);
                $id++;
            }
        }
        return;
    }

    private function processDate($date)
    {
        $inputDateArray = [];
        //extract the month, day, and year from user input to check the values int he checkdate method below
        $inputDate = strtok($date, '/');
        while ($inputDate !== false) {
            $inputDateArray[] = $inputDate;
            $inputDate = strtok("/");
        }
        if (isset($inputDateArray[0]) && isset($inputDateArray[1]) && isset($inputDateArray[2]) && is_numeric($inputDateArray[0]) && is_numeric($inputDateArray[1]) && is_numeric($inputDateArray[2])) {
            $isValidDate = checkdate($inputDateArray[0], $inputDateArray[1], $inputDateArray[2]);
        } else {
            $isValidDate = 0;
        }
        return $isValidDate;
    }

    private function validateTaskName($taskName)
    {
        if (!empty($taskName) && strlen($taskName) > 0 && strtolower($taskName) != "empty") {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * Name: validatePriorityLevel
     * Purpose: Verify that either low (1), medium (2) or high (3) priority was selected by the user.
     * @param  {} priorityLevel:
     */
    private function validatePriorityLevel($priorityLevel)
    {
        if (!$priorityLevel) {
            return false;
        }
        $priorityLevel = (int)$priorityLevel;
        if ($priorityLevel > 0 && $priorityLevel < 4) {
            return true;
        } else {
            return false;
        }
    }
}