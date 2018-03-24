<?php namespace App;
use App\Transaction as Transaction_Model;

class projects extends Controller
{

    function index()
    {
        $this->projects = get_all("SELECT * FROM projects");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID");
    }

    function view()
    {
        $project_id = $this->getId();
        $this->project = get_first("SELECT * FROM projects WHERE project_id = '{$project_id}'");
    }


    function AJAX_addTransaction()
    {
        // controls transaction parameters
        if (isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["organisation_name"])&& isset($_POST["contact_person_name"])&& isset($_POST["email"])&& isset($_POST["deadline_date"])&& isset($_POST["telephone"]) && isset($_POST["status"]) && isset($_POST["note"])) {
            // uses Transaction class
            Transaction_Model::addTransaction($_POST["name"], $_POST["price"], $_POST["organisation_name"], $_POST["contact_person_name"], $_POST["email"], $_POST["deadline_date"], $_POST["telephone"], $_POST["status"], $_POST["note"]);
            exit("success");
        }
    }

    function AJAX_getOrganisation()
    {
        if(isset($_POST["organisation_name"])){
            $contact_person = Transaction_Model::getContactPersonName($_POST["organisation_name"]);

            $contact_person = json_encode($contact_person);

            exit($contact_person);
        }
    }

    function AJAX_deleteTableRow(){
        if(isset($_POST["transaction_id"])){
            q("DELETE FROM transaction WHERE ID = '" . $_POST["transaction_id"] . "'");

            exit("success");
        }
    }

    function AJAX_editTableRow(){
        if(isset($_POST["transaction_id"])){
            $transaction_id = $_POST["transaction_id"];

            $transactions2 = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ID = '{$transaction_id}' AND transaction.ORGANISATION_ID = organisation.ID AND transaction.CONTACT_PERSON_ID = contact_person.ID");
            exit(json_encode($transactions2));
        }
    }
}

