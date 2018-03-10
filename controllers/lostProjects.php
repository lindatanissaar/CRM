<?php namespace App;

class lostprojects extends Controller
{

    function index()
    {
        $this->lostprojects = get_all("SELECT * FROM lostprojects");
        $this->transactions_lost = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON'");

    }

    function view()
    {
        $lostproject_id = $this->getId();
        $this->lostproject = get_first("SELECT * FROM lostprojects WHERE lostproject_id = '{$lostproject_id}'");
    }
}