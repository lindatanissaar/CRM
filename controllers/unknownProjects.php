<?php namespace App;

class unknownprojects extends Controller
{

    function index()
    {

        if(isset($_COOKIE["dateStartUnknownProjects"]) && isset($_COOKIE["dateEndUnknownProjects"])) {
            $dateStart = $_COOKIE["dateStartUnknownProjects"];
            $dateEnd = $_COOKIE["dateEndUnknownProjects"];
            $this->unknownprojects = get_all("SELECT * FROM unknownprojects");
            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}'");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}'");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}'");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}'");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}'");

        } else {
            $this->wonproject = get_all("SELECT * FROM wonproject");
            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE >= NOW() - INTERVAL 46 DAY AND DEADLINE_DATE <= NOW() + INTERVAL 46 DAY");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY");
        }

    }

    function view()
    {
        $unknownproject_id = $this->getId();
        $this->unknownproject = get_first("SELECT * FROM unknownprojects WHERE unknownproject_id = '{$unknownproject_id}'");
    }

    function AJAX_changeTable(){

        if (isset($_POST["dateStart"]) && isset($_POST["dateEnd"])) {
            $dateStart = $_POST["dateStart"];
            $dateEnd = $_POST["dateEnd"];

            setcookie("dateStartUnknownProjects", $dateStart);
            setcookie("dateEndUnknownProjects", $dateEnd);

            exit("success");

        }
    }

}