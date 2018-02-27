<?php namespace App;

use App\Task as Task_Model;


class tasks extends Controller
{

    function index()
    {
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->activities = get_all("SELECT * FROM transaction, supervisor, employee, activity_description, activity WHERE activity.TRANSACTION_ID = transaction.ID AND activity.DESCRIPTION_ID = activity_description.ID AND supervisor.EMPLOYEE_ID = employee.ID AND supervisor.ACTIVITY_ID = activity.ID AND activity.DEL_DATETIME_ACTIVITY IS NULL");

    }

    function view()
    {
        $task_id = $this->getId();
        $this->task = get_first("SELECT * FROM tasks WHERE task_id = '{$task_id}'");
    }

    function AJAX_addTask()
    {
        // controls transaction parameters
        if (isset($_POST["activityDescription"]) && isset($_POST["deadlineDate"]) && isset($_POST["transactionName"])&& isset($_POST["employeeName"])) {

            // uses Transaction class
            Task_Model::addTask($_POST["activityDescription"], $_POST["deadlineDate"], $_POST["transactionName"], $_POST["employeeName"]);
            exit("success");
        }
    }

    function AJAX_deleteTableRow(){
        if(isset($_POST["activity_id"])){

            $activity_id = $_POST["activity_id"];

            q("UPDATE activity SET DEL_DATETIME_ACTIVITY = NOW() WHERE ID = '{$activity_id}'");

            exit("success");

        }
    }
}

