<?php namespace App;

class wonproject extends Controller
{

    function index()
    {

        if(isset($_COOKIE["dateStartWonProjects"]) && isset($_COOKIE["dateEndWonProjects"])) {
            $dateStart = $_COOKIE["dateStartWonProjects"];
            $dateEnd = $_COOKIE["dateEndWonProjects"];

            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
        } else {
            $this->wonproject = get_all("SELECT * FROM wonproject");
            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
        }

    }

    function view()
    {
        $wonprojects_id = $this->getId();
        $this->wonprojects = get_first("SELECT * FROM wonproject WHERE wonprojects_id = '{$wonprojects_id}'");
    }


    function AJAX_changeTable(){

        if (isset($_POST["dateStart"]) && isset($_POST["dateEnd"])) {
            $dateStart = $_POST["dateStart"];
            $dateEnd = $_POST["dateEnd"];

            setcookie("dateStartWonProjects", $dateStart);
            setcookie("dateEndWonProjects", $dateEnd);

            exit("success");

        }
    }
}