<?php namespace App;

use App\Admin as Admin_Model;


class admins extends Controller
{
    public $template = 'admins';

    function index()
    {
        $this->admins = get_all("SELECT * FROM admins");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");
        $this->employees = get_all("SELECT * FROM employee");


    }

    function view()
    {
        $admin_id = $this->getId();
        $this->admin = get_first("SELECT * FROM admins WHERE admin_id = '{$admin_id}'");
    }

    function AJAX_addTaskName() {
        if (isset($_POST["activityDescription"])) {

            // uses Transaction class
            Admin_Model::addTaskName($_POST["activityDescription"]);
            exit("success");
        }
    }

    function AJAX_deleteTaskDesc() {
        if(isset($_POST["taskDescId"])){
            q("DELETE FROM activity_description WHERE ID = '" . $_POST["taskDescId"] . "'");

            exit("success");

        }
    }

    function AJAX_addNewEmployee() {
        if(isset($_POST["firstName"]) && isset($_POST["lastName"])) {

            Admin_Model::addNewEmployee($_POST["firstName"],$_POST["lastName"]);
            exit("success");

        }
    }

    function AJAX_deleteEmployee() {
        if(isset($_POST["employeeId"])){
            q("DELETE FROM employee WHERE ID = '" . $_POST["employeeId"] . "'");

            exit("success");

        }

    }
}