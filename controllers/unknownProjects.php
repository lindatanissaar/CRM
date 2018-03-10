<?php namespace App;

class unknownprojects extends Controller
{

    function index()
    {
        $this->unknownprojects = get_all("SELECT * FROM unknownprojects");
        $this->transactions_unknown = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN'");

    }

    function view()
    {
        $unknownproject_id = $this->getId();
        $this->unknownproject = get_first("SELECT * FROM unknownprojects WHERE unknownproject_id = '{$unknownproject_id}'");
    }

}