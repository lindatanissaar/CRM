<?php namespace App;

class addprojects extends Controller
{
    public $template = 'admins';


    function index()
    {
        $this->addprojects = get_all("SELECT * FROM addprojects");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
        $this->employees = get_all("SELECT * FROM employee");
    }

    function view()
    {
        $addproject_id = $this->getId();
        $this->addproject = get_first("SELECT * FROM addprojects WHERE addproject_id = '{$addproject_id}'");
    }

}