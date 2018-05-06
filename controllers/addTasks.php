<?php namespace App;

class addtasks extends Controller
{

    public $template = 'admins';


    function index()
    {
        $this->addtasks = get_all("SELECT * FROM addtasks");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");
        $this->employees = get_all("SELECT * FROM employee");
    }

    function view()
    {
        $addtask_id = $this->getId();
        $this->addtask = get_first("SELECT * FROM addtasks WHERE addtask_id = '{$addtask_id}'");
    }

}