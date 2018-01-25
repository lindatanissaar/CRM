<?php namespace App;

class projects extends Controller
{

    function index()
    {
        $this->projects = get_all("SELECT * FROM projects");
        $this->organisations = get_all("SELECT * FROM organisation");

        $this->transactions = get_all("SELECT * FROM transaction, organisation, contact_person WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID");

    }

    function view()
    {
        $project_id = $this->getId();
        $this->project = get_first("SELECT * FROM projects WHERE project_id = '{$project_id}'");
    }

}