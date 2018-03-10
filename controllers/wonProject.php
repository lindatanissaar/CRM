<?php namespace App;

class wonproject extends Controller
{

    function index()
    {
        $this->wonproject = get_all("SELECT * FROM wonproject");
        $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON'");
    }

    function view()
    {
        $wonprojects_id = $this->getId();
        $this->wonprojects = get_first("SELECT * FROM wonproject WHERE wonprojects_id = '{$wonprojects_id}'");
    }

}