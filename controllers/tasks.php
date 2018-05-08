<?php namespace App;

use App\Task as Task_Model;


class tasks extends Controller
{

    function index()
    {
        if(isset($_COOKIE["dateStartTasks"]) && isset($_COOKIE["dateEndTasks"])) {
            $dateStart = $_COOKIE["dateStartTasks"];
            $dateEnd = $_COOKIE["dateEndTasks"];
            $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' AND COMPLETED = 0");
            $this->employees = get_all("SELECT * FROM employee");
            $this->activity_descriptions = get_all("SELECT * FROM activity_description");
            $this->activities = get_all("SELECT * FROM transaction, supervisor, employee, activity_description, activity WHERE activity.TRANSACTION_ID = transaction.ID AND activity.DESCRIPTION_ID = activity_description.ID AND supervisor.EMPLOYEE_ID = employee.ID AND supervisor.ACTIVITY_ID = activity.ID AND activity.DEL_DATETIME_ACTIVITY IS NULL  AND activity.DEADLINE_DATE >= '{$dateStart}' AND activity.DEADLINE_DATE <= '{$dateEnd}'");
        } else {
            $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' AND COMPLETED = 0");
            $this->employees = get_all("SELECT * FROM employee");
            $this->activity_descriptions = get_all("SELECT * FROM activity_description");
            $this->activities = get_all("SELECT * FROM transaction, supervisor, employee, activity_description, activity WHERE activity.TRANSACTION_ID = transaction.ID AND activity.DESCRIPTION_ID = activity_description.ID AND supervisor.EMPLOYEE_ID = employee.ID AND supervisor.ACTIVITY_ID = activity.ID AND activity.DEL_DATETIME_ACTIVITY IS NULL  AND activity.DEADLINE_DATE >= NOW() - INTERVAL 46 DAY AND activity.DEADLINE_DATE <= NOW() + INTERVAL 46 DAY");
        }
    }

    function view()
    {
        $task_id = $this->getId();
        $this->task = get_first("SELECT * FROM tasks WHERE task_id = '{$task_id}'");
    }

    function AJAX_addTask()
    {
        // controls transaction parameters
        if (empty($_POST["activityDescription"]) && empty($_POST["deadlineDate"]) && empty($_POST["transactionName"])&& empty($_POST["employeeName"])) {
            exit("tyhi");

        }else {
            Task_Model::addTask($_POST["activityDescription"], $_POST["deadlineDate"], $_POST["transactionName"], $_POST["employeeName"]);
            exit("success");
        }
    }

    function AJAX_deleteTableRow(){
        if(isset($_POST["activity_id"])){

            $activity_id = $_POST["activity_id"];

            q("DELETE FROM supervisor WHERE ACTIVITY_ID = '{$activity_id}'");
            q("DELETE FROM activity WHERE ID = '{$activity_id}'");


            exit("success");
        }
    }

    function AJAX_updateTaskTable(){
        if(isset($_POST['data']['activityDescription'])) {
            $activityDescription = $_POST['data']['activityDescription'];
            $activityDescription = json_decode($activityDescription);
             foreach ($activityDescription as $key => $value) {
                 $value = ucfirst($value);
                 $activityDescription = get_first("SELECT ID FROM activity_description WHERE DESCRIPTION = '{$value}'");
                 if(empty($activityDescription)){
                     exit("empty");
                 }
                 $activityDescription  = json_encode($activityDescription);
                 $activityDescription = json_decode($activityDescription, true);
                 $activityDescription = $activityDescription['ID'];

                 q("UPDATE activity SET DESCRIPTION_ID = '{$activityDescription}' WHERE ID = '{$key}'");
             }
        }

        if(isset($_POST['data']['taskTransactionName'])) {
            $taskTransactionName = $_POST['data']['taskTransactionName'];
            $taskTransactionName = json_decode($taskTransactionName);
            foreach ($taskTransactionName as $key => $value) {
                $value = ucfirst($value);
                $taskTransactionName = get_first("SELECT ID FROM transaction WHERE NAME = '{$value}'");
                if(empty($taskTransactionName)){
                    exit("empty");
                }
                $taskTransactionName  = json_encode($taskTransactionName);
                $taskTransactionName = json_decode($taskTransactionName, true);
                $taskTransactionName = $taskTransactionName['ID'];
                q("UPDATE activity SET TRANSACTION_ID = '{$taskTransactionName}' WHERE ID = '{$key}'");
            }
        }

        if(isset($_POST['data']['date'])) {
            $date = $_POST['data']['date'];
            $date = json_decode($date);
            foreach ($date as $key => $value) {
                $date = str_replace('/', '-', $value);
                $date =  date('Y-m-d', strtotime($date));
                q("UPDATE activity SET DEADLINE_DATE = '{$date}' WHERE ID = '{$key}'");
            }
        }

        if(isset($_POST['data']['employeeName'])) {
            $employeeName = $_POST['data']['employeeName'];
            $employeeName = json_decode($employeeName);
            foreach ($employeeName as $key => $value) {
                $parts = explode(" ", $value);
                $lastname = array_pop($parts);
                $lastname = ucfirst($lastname);
                $firstname = implode(" ", $parts);
                $firstname = ucfirst($firstname);
                $employee_id = get_first("SELECT ID FROM employee WHERE LAST_NAME = '{$lastname}' AND FIRST_NAME = '{$firstname}'");
                if(empty($employee_id)){
                    exit("empty");
                }
                $employee_id  = json_encode($employee_id);
                $json = json_decode($employee_id, true);
                $employee_id = $json['ID'];

                q("UPDATE supervisor SET EMPLOYEE_ID = '{$employee_id}' WHERE ACTIVITY_ID = '{$key}'");
            }
        }

        exit("success");
    }

    function AJAX_changeTable(){

        if (isset($_POST["dateStart"]) && isset($_POST["dateEnd"])) {
            $dateStart = $_POST["dateStart"];
            $dateEnd = $_POST["dateEnd"];

            setcookie("dateStartTasks", $dateStart);
            setcookie("dateEndTasks", $dateEnd);

            exit("success");

        }
    }
}






