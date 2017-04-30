<?php

namespace Controller;

use Model\Tasks as ModelTasks;

class Tasks
{

    private $taskModel = null;

    /**
     * Tasks constructor.
     */
    public function __construct()
    {
        $this->taskModel = new ModelTasks();
    }

    function checkLogin()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            header('Location: http://devserv.app/todolist/');
            exit;
        }
    }


    function index(): array
    {
        $this->checkLogin();
        $tasks = $this->taskModel->getTasks($_SESSION['user']->id);
        $view = 'views/tasksindex.php';
        //var_dump($tasks);
        return compact('view', 'tasks');
    }

    function create()
    {
        $this->checkLogin();
        $description = $_POST['description'];
        $this->taskModel->createTasks($_SESSION['user']->id, $description);
        header('Location: http://devserv.app/todolist/index.php?a=index&r=tasks');
        exit;
        //die();
    }

    function postUpdate(){
        $this->checkLogin();
        $description = isset($_POST['description'])?$_POST['description']:false;
        $is_done = $_POST['is_done'];
        $this->taskModel->postUpdate($_POST['id'], $description, $is_done);
        header('Location: http://devserv.app/todolist/index.php?a=index&r=tasks');
        exit;
    }

    function getUpdate(){
        $this->checkLogin();
        $tasks = $this->taskModel->getTasks($_SESSION['user']->id);
        foreach ($tasks as $task){
            $task->editable = 0;
            if($task->task_id === $_GET['id']){
                $task->editable = 1;
            }
        }
        $this->taskModel->postUpdate($_GET['id'],'',$task->is_done);
        $view = 'views/tasksindex.php';
        return compact('view', 'tasks');
    }

    function postDelete(){
        $this->checkLogin();
        $this->taskModel->deleteTask($_POST['id']);
        //var_dump($tasks);
        header('Location: http://devserv.app/todolist/index.php?a=index&r=tasks');
        exit;
    }
}