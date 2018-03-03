<?php namespace App;

class admins extends Controller
{

    function index()
    {
        $this->admins = get_all("SELECT * FROM admins");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->employees = get_all("SELECT * FROM employee");
        $this->activity_descriptions = get_all("SELECT * FROM activity_description");
        $this->transactions = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON'");

    }

    function view()
    {
        $admin_id = $this->getId();
        $this->admin = get_first("SELECT * FROM admins WHERE admin_id = '{$admin_id}'");
    }

}