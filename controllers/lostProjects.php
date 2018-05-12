<?php namespace App;

class lostprojects extends Controller
{
    function index()
    {

        if(isset($_COOKIE["dateStartLostProjects"]) && isset($_COOKIE["dateEndLostProjects"])) {
            $dateStart = $_COOKIE["dateStartLostProjects"];
            $dateEnd = $_COOKIE["dateEndLostProjects"];
            $this->unknownprojects = get_all("SELECT * FROM unknownprojects");
            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE >= '{$dateStart}' AND DEADLINE_DATE <= '{$dateEnd}' AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");

        } else {
            $this->wonproject = get_all("SELECT * FROM wonproject");
            $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE >= NOW() - INTERVAL 46 DAY AND DEADLINE_DATE <= NOW() + INTERVAL 46 DAY");
            $this->wonProjects = get_all("SELECT COUNT(*) as wonProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 0 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->lostProjects = get_all("SELECT COUNT(*) as lostProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_LOST' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->completedProjects = get_all("SELECT COUNT(*) as completedProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_WON' AND COMPLETED = 1 AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
            $this->unknownProjects = get_all("SELECT COUNT(*) as unknownProjectsNumber FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND STATUS = 'STATUS_UNKNOWN' AND DEADLINE_DATE > NOW() - INTERVAL 46 DAY AND DEADLINE_DATE < NOW() + INTERVAL 46 DAY AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL");
        }
    }

    function view()
    {
        $lostproject_id = $this->getId();
        $this->lostproject = get_first("SELECT * FROM lostprojects WHERE lostproject_id = '{$lostproject_id}'");
    }

    function AJAX_changeTable(){

        if (isset($_POST["dateStart"]) && isset($_POST["dateEnd"])) {
            $dateStart = $_POST["dateStart"];
            $dateEnd = $_POST["dateEnd"];

            setcookie("dateStartLostProjects", $dateStart);
            setcookie("dateEndLostProjects", $dateEnd);

            exit("success");

        }
    }
}