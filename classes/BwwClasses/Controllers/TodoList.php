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
    public function __construct(DatabaseTable $todoPriorityTable, DatabaseTable $todoStatusTable, DatabaseTable $todoSortTable, DatabaseTable $todoTable, Authentication $authentication)
    {
        $this->todoPriorityTable = $todoPriorityTable;
        $this->todoStatusTable = $todoStatusTable;
        $this->todoSortTable = $todoSortTable;
        $this->todoTable = $todoTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $loggedIn = $this->authentication->isLoggedIn();

        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $currentUserTodos = [];
            $args = func_get_args();
            $todos = null;
            if (func_num_args() == 2) {
                $todos = $this->todoTable->findAllSorted($args[0], $args[1]);
            } else {
                $todos = $this->todoTable->findAll();
            }
            foreach ($todos as $todo) {
                if ($todo['user_id'] != $user['id']) {
                    continue;
                }
                $dueDate = date_create($todo['due_date']);
                $stringDueDate = date_format($dueDate, "n/j/y");
                $currentUserTodos[] = [
                    'id' => (int) $todo['id'],
                    'due_date' => (string) $stringDueDate,
                    'title' => (string) $todo['title'],
                    'todo_priority' => (int) $todo['todo_priority'],
                    'todo_status' => (int) $todo['todo_status'],
                    'percent_complete' => (int) $todo['percent_complete'],
                    'notes' => (string) $todo['notes'],
                ];
            }

            return [
                'template' => 'todolist.html.php',
                'title' => 'To Do List',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'currentUserTodos' => $currentUserTodos ?? null,
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
        if (isset($_POST['newtask'])) // Add new task
        {
            // print_r("new task");die;
            $this->saveNewTask($_POST['newtask'], $user);
        } else if (isset($_POST['coltosort']) && !empty($_POST['coltosort']) && isset($_POST['directiontosort']) && !empty($_POST['directiontosort'])) { // Sort task
            // print_r("sorting");die;
            $sortedPage = $this->sort($_POST['coltosort'], $user);
            return $sortedPage;
        } else if (isset($_POST['editid']) && !empty($_POST['editid'])) { // Edit task
            // print_r("editing");die;
            $this->editTask($_POST['editid'], $_POST['editduedate'], $_POST['edittask'], $_POST['editprioritylevel'], $_POST['edittodostatus'], $_POST['editpercentcomplete'], $_POST['editusersnotes']);
        } else if (isset($_POST['deletetodoid']) && !empty($_POST['deletetodoid'])) { // Delete task
            // print_r("deleting");die;
            $this->deleteTask($_POST['deletetodoid']);
        } else {
            // print_r("No methods have been called");die;
            header('location: /todolist');
        }

    }

    public function saveNewTask($inputData, $user)
    {
        $format = "n/j/y";
        $newTaskData['due_date'] = date_create_from_format($format, $inputData['date']);
        $newTaskData['title'] = (string) $inputData['taskname'];
        $newTaskData['todo_priority'] = (int) $inputData['prioritylevel'];
        $newTaskData['todo_status'] = 1;
        $newTaskData['percent_complete'] = 0;
        $newTaskData['notes'] = (string) $inputData['notesinput'];
        $newTaskData['user_id'] = (int) $user['id'];
        $this->todoTable->save($newTaskData);
        header('location: /todolist');
    }

    public function deleteTask($deleteTodoId)
    {
        $this->todoTable->delete($deleteTodoId);
        header('location: /todolist');
    }

    public function editTask($editIds, $editduedates, $edittasks, $editprioritylevels, $edittodostatuses, $editpercentcompletes, $editusersnotes)
    {
        for ($id = 0; $id < sizeOf($editIds); $id++) {
            $editTodo = null;
            if (!empty($editIds[$id])) {
                $editTodo = [];
                $editTodo['id'] = (int) $editIds[$id];
                if (!empty($editduedates[$id])) {
                    $editTodo['due_date'] = date_create($editduedates[$id]);
                }
                if (!empty($edittasks[$id])) {
                    $editTodo['title'] = (string) $edittasks[$id];
                }
                if (!empty($editprioritylevels[$id])) {
                    $editTodo['todo_priority'] = (int) $editprioritylevels[$id];
                }
                if (!empty($edittodostatuses[$id])) {
                    $editTodo['todo_status'] = (int) $edittodostatuses[$id];
                }
                if (!empty($editpercentcompletes[$id]) || (int) $editpercentcompletes[$id] == 0) {
                    $editTodo['percent_complete'] = (int) $editpercentcompletes[$id];
                }
                if (!empty($editusersnotes[$id])) {
                    $editTodo['notes'] = (string) $editusersnotes[$id];
                }
                $this->todoTable->save($editTodo);
            }
        }
        header('location: /todolist');
    }

    public function sort($colToSort, $user)
    {
        $colToSort = (string) $colToSort;
        $userIdCol = "user_id_num";
        $userIdNum = (int) $user['id'];
        $userSort = $this->todoSortTable->find($userIdCol, $userIdNum);
        $sortData = [];
        //If the user has sorted before we will get their sort state and toggle based on it
        if (!empty($userSort)) {
            $sortData['id'] = (int) $userSort[0]['id'];
            $sortData['column'] = $colToSort;
            $sortData['direction'] = ((string) $userSort[0]['direction'] == 'ASC' && $userSort[0]['column'] == $colToSort) ? 'DESC' : 'ASC'; //if the col to sort is already sorted as 'ASC' then toggle else set
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

}
