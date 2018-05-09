<?php namespace App;
use App\Transaction as Transaction_Model;

class projects extends Controller
{

    function index()
    {
        $this->projects = get_all("SELECT * FROM projects");
        $this->organisations = get_all("SELECT * FROM organisation");
        $this->contact_persons = get_all("SELECT * FROM contact_person");
        $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID AND transaction.COMPLETED = 0 AND TRANSACTION.STATUS != 'STATUS_LOST'");
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
            $transaction_id = $_POST["transaction_id"];

           $activityTransactionId = get_all("SELECT * FROM activity WHERE TRANSACTION_ID = '{$transaction_id}'");


            if(empty($activityTransactionId)){
                q("DELETE FROM transaction WHERE ID = '" . $_POST["transaction_id"] . "'");
                exit("success");
            }


            exit("notEmpty");
        }
    }

    function AJAX_editTableRow(){
        if(isset($_POST["transaction_id"])){
            $transaction_id = $_POST["transaction_id"];
            $transactions2 = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ID = '{$transaction_id}' AND transaction.ORGANISATION_ID = organisation.ID AND transaction.CONTACT_PERSON_ID = contact_person.ID");
            exit(json_encode($transactions2));
        }
    }

    function AJAX_markTransactionCompleted(){
        if(isset($_POST["completedTransactionId"])){
            $completedTransactionId = $_POST["completedTransactionId"];
            $status = get_all("SELECT STATUS FROM  transaction WHERE ID='{$completedTransactionId}'");
            $activityTransactionId = get_all("SELECT * FROM activity WHERE TRANSACTION_ID = '{$completedTransactionId}'");

            if(!empty($activityTransactionId)){
                exit("notEmpty");
            }

            if($status[0]["STATUS"] == "STATUS_WON"){
                q("UPDATE transaction SET COMPLETED = 1 WHERE ID = '{$completedTransactionId}'");

                exit("success");
            }else{
                exit("notWonTransaction");
            }
        }
    }

    function AJAX_updateTransactionTable(){

        if(isset($_POST['data']['transactionName'])) {
            $transactionName = $_POST['data']['transactionName'];
            $transactionName = json_decode($transactionName);
            foreach ($transactionName as $key => $value) {
                $value = ucfirst($value);
                $transactionName = get_first("SELECT ID FROM transaction WHERE NAME = '{$value}'");
                if(empty($transactionName)){
                    exit("empty");
                }

                q("UPDATE transaction SET NAME = '{$value}' WHERE ID = '{$key}'");
            }

        }

        if(isset($_POST['data']['price'])) {
            $price = $_POST['data']['price'];
            $price = json_decode($price);

            foreach ($price as $key => $value) {
                if($value == ""){
                    exit("empty");
                }
                $value = str_replace("€","",$value);
                q("UPDATE transaction SET PRICE = '{$value}' WHERE ID = '{$key}'");
            }
        }

        if(isset($_POST['data']['note'])) {
            $note = $_POST['data']['note'];
            $note = json_decode($note);

            foreach ($note as $key => $value) {
                q("UPDATE transaction SET NOTE = '{$value}' WHERE ID = '{$key}'");
            }

        }

        if(isset($_POST['data']['date'])) {
            $date = $_POST['data']['date'];
            $date = json_decode($date);
            foreach ($date as $key => $value) {
                if($value == ""){
                    exit("empty");
                }
                $date = str_replace('/', '-', $value);
                $date =  date('Y-m-d', strtotime($date));
                q("UPDATE transaction SET DEADLINE_DATE = '{$date}' WHERE ID = '{$key}'");
            }
        }

        if(isset($_POST['data']['organisationName'])) {
            $organisationName = $_POST['data']['organisationName'];
            $organisationName = json_decode($organisationName);
            foreach ($organisationName as $key => $value) {

                $organisationName = ucfirst($value);
                $organisationId = get_first("SELECT ID FROM organisation WHERE ORGANISATION_NAME = '{$organisationName}'");
                if(empty($organisationId)){
                    exit("empty");
                }
                $organisationId  = json_encode($organisationId);
                $json = json_decode($organisationId, true);
                $organisationId = $json['ID'];

                q("UPDATE transaction SET ORGANISATION_ID = '{$organisationId}' WHERE ID = '{$key}'");
            }
        }

        if(isset($_POST['data']['contactPersonName'])) {
            $contactPersonName = $_POST['data']['contactPersonName'];
            $contactPersonName = json_decode($contactPersonName);
            foreach ($contactPersonName as $key => $value) {

                $value = ucfirst($value);
                $organisationId = get_first("SELECT ORGANISATION_ID FROM transaction WHERE ID = '{$key}'");
                $contactPerson = get_first("SELECT CONTACT_PERSON_NAME FROM contact_person WHERE ORGANISATION_ID = '{$organisationId}' AND CONTACT_PERSON_NAME = '{$value}'");

                if(empty($contactPerson)){
                    exit("empty");
                }
               /* $employee_id  = json_encode($employee_id);
                $json = json_decode($employee_id, true);
                $employee_id = $json['ID'];*/

                q("UPDATE contact_person SET CONTACT_PERSON_NAME = '{$contactPerson}' WHERE ORGANISATION_ID = '{$key}'");
            }

            exit("success");
        }
    }
}


