<?php namespace App;

class tasks extends Controller
{

    function index()
    {
        $this->tasks = get_all("SELECT * FROM tasks");
    }

    function view()
    {
        $task_id = $this->getId();
        $this->task = get_first("SELECT * FROM tasks WHERE task_id = '{$task_id}'");
    }

}