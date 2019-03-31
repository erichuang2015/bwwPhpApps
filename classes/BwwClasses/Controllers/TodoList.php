<?php
namespace BwwClasses\Controllers;

use \utilityClasses\Authentication;
use \utilityClasses\DatabaseTable;
use \BwwClasses\Data\Todo;

class TodoList
{
    private $authentication;
    private $todoPriorityTable;
    private $todoStatusTable;
    private $todoTable;
    public function __construct(DatabaseTable $todoPriorityTable, DatabaseTable $todoStatusTable, DatabaseTable $todoTable, Authentication $authentication)
    {
        $this->todoPriorityTable = $todoPriorityTable;
        $this->todoStatusTable = $todoStatusTable;
        $this->todoTable = $todoTable;
        $this->authentication = $authentication;
    }

    public function render()
    {
        $loggedIn = $this->authentication->isLoggedIn();

        if ($loggedIn) {
            $user = $this->authentication->getUser();
            $currentUserTodos = [];
            $todos = $this->todoTable->findAll();
            foreach ($todos as $todo) {
                if ($todo['user_id'] != $user['id']) {
                    continue;
                }
                $dueDate = date_create($todo['due_date']);
                $stringDueDate = date_format($dueDate,"m/d/Y");
                // print_r($stringDueDate);die;
                $currentUserTodos[] = [
                    'id' => (int) $todo['id'],
                    'due_date' => (string)$stringDueDate,
                    'title' => (string) $todo['title'],
                    'todo_priority' => (int) $todo['todo_priority'],
                    'todo_status' => (int) $todo['todo_status'],
                    'percent_complete' => (int) $todo['percent_complete'],
                    'notes' => (string) $todo['notes']
                ];
            }

            return [
                'template' => 'todolist.html.php',
                'title' => 'To Do List',
                'variables' => [
                    'loggedIn' => $loggedIn,
                    'currentUserTodos' => $currentUserTodos ?? null
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
        // print_r($_POST);die;
        if (isset($_POST['newtask'])) // Add new task
        {
            $this->saveNewTask($_POST['newtask'], $user);
        }
        else if(isset($_POST['editid'])){// Edit task
            // print_r($_POST['editduedate']);die;
            $this->editTask($_POST['editid'], $_POST['editduedate'], $_POST['edittask'], $_POST['editprioritylevel'], $_POST['edittodostatus'], $_POST['editpercentcomplete'], $_POST['editusersnotes']);
        }
        else if (isset($_POST['deletetodoid']) && !empty($_POST['deletetodoid'])){// Delete task
            $this->deleteTask($_POST['deletetodoid']);

        }
        else{
            print_r("No methods have been called");die;
            header('location: /todolist');
        }

    }

    public function saveNewTask($inputData, $user)
    {
        $newTaskData['due_date'] = date_create($inputData['date']);
        $newTaskData['title'] = (string)$inputData['taskname'];
        $newTaskData['todo_priority'] = (int)$inputData['prioritylevel'];
        $newTaskData['todo_status'] = 1;
        $newTaskData['percent_complete'] = 0;
        $newTaskData['notes'] = (string)$inputData['notesinput'];
        $newTaskData['user_id'] = (int)$user['id'];
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
       // print_r("editTask has been called");die;
        for($id=0; $id < sizeOf($editIds); $id++){
            $editTodo = null;
            if(!empty($editIds[$id])){
                $editTodo = [];
                $editTodo['id'] = (int)$editIds[$id];
                if(!empty($editduedates[$id])){
                    // print_r($editduedates[$id]);die;
                    $editTodo['due_date'] = date_create($editduedates[$id]);
                }
                if(!empty($edittasks[$id])){
                    $editTodo['title'] = (string)$edittasks[$id];
                }
                if(!empty($editprioritylevels[$id])){
                    $editTodo['todo_priority'] = (int)$editprioritylevels[$id];
                }
                if(!empty($edittodostatuses[$id])){
                    $editTodo['todo_status'] = (int)$edittodostatuses[$id];
                }
                if(!empty($editpercentcompletes[$id]) || (int)$editpercentcompletes[$id] == 0){
                    $editTodo['percent_complete'] = (int)$editpercentcompletes[$id];
                }
                if(!empty($editusersnotes[$id])){
                    $editTodo['notes'] = (string)$editusersnotes[$id];
                }
                $this->todoTable->save($editTodo);
            }
        }
        header('location: /todolist');
    }

}
