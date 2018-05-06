<?php namespace App;

class showprojects extends Controller
{
    public $template = 'admins';


    function index()
    {
        $this->showprojects = get_all("SELECT * FROM showprojects");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");
        $this->employees = get_all("SELECT * FROM employee");
    }

    function view()
    {
        $showproject_id = $this->getId();
        $this->showproject = get_first("SELECT * FROM showprojects WHERE showproject_id = '{$showproject_id}'");
    }

}