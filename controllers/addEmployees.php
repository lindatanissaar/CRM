<?php namespace App;

class addemployees extends Controller
{
    public $template = 'admins';

    function index()
    {
        $this->addemployees = get_all("SELECT * FROM addemployees");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");
        $this->employees = get_all("SELECT * FROM employee");
    }

    function view()
    {
        $addemployee_id = $this->getId();
        $this->addemployee = get_first("SELECT * FROM addemployees WHERE addemployee_id = '{$addemployee_id}'");
    }

}