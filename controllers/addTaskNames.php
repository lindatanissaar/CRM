<?php namespace App;

class addtasknames extends Controller
{
    public $template = 'admins';

    function index()
    {
        $this->addtasknames = get_all("SELECT * FROM addtasknames");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
        $this->employees = get_all("SELECT * FROM employee");
    }

    function view()
    {
        $addtaskname_id = $this->getId();
        $this->addtaskname = get_first("SELECT * FROM addtasknames WHERE addtaskname_id = '{$addtaskname_id}'");
    }

}