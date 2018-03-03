<?php namespace App;

class admins extends Controller
{

    function index()
    {
        $this->admins = get_all("SELECT * FROM admins");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
    }

    function view()
    {
        $admin_id = $this->getId();
        $this->admin = get_first("SELECT * FROM admins WHERE admin_id = '{$admin_id}'");
    }

}