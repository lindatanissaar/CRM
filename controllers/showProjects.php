<?php namespace App;

class showprojects extends Controller
{


    function index()
    {
        $this->transactions = get_all("SELECT * FROM organisation, contact_person, transaction WHERE transaction.ORGANISATION_ID = organisation.ID AND TRANSACTION.CONTACT_PERSON_ID = CONTACT_PERSON.ID");

    }

    function view()
    {
        $showproject_id = $this->getId();
        $this->showproject = get_first("SELECT * FROM showprojects WHERE showproject_id = '{$showproject_id}'");
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

    function AJAX_updateTransactionTable(){

        if(isset($_POST['data']['transactionName'])) {
            $transactionName = $_POST['data']['transactionName'];
            $transactionName = json_decode($transactionName);
            foreach ($transactionName as $key => $value) {
                $value = ucfirst($value);
                if($value== ""){
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

        exit("success");

    }

    function AJAX_markTransactionCompleted(){
        if(isset($_POST["completedTransactionId"])){
            $completedTransactionId = $_POST["completedTransactionId"];
            $status = get_all("SELECT STATUS FROM  transaction WHERE ID='{$completedTransactionId}'");
            $isDeleted = get_all("SELECT DEL_DATETIME_TRANSACTION FROM transaction WHERE ID='{$completedTransactionId}'");
            $activityTransactionId = get_all("SELECT * FROM activity WHERE TRANSACTION_ID = '{$completedTransactionId}'");
            $isCompleted = get_all("SELECT COMPLETED FROM  transaction WHERE ID='{$completedTransactionId}'");

            if(!empty($activityTransactionId)){
                exit("notEmpty");
            }

            error_log($isDeleted[0]["DEL_DATETIME_TRANSACTION"]);

            if($isDeleted[0]["DEL_DATETIME_TRANSACTION"] !=""){
                exit("deleted");
            }

            if($isCompleted[0]["COMPLETED"] == 1){
                exit("isCompleted");
            }

            if($status[0]["STATUS"] == "STATUS_WON"){
                q("UPDATE transaction SET COMPLETED = 1 WHERE ID = '{$completedTransactionId}'");
                exit("success");
            }else{
                exit("notWonTransaction");
            }
        }
    }

    function AJAX_restoreTransaction(){
        if(isset($_POST["restoreTransactionId"])){
            $restoreTransactionId = $_POST["restoreTransactionId"];

            $isDeleted = get_all("SELECT DEL_DATETIME_TRANSACTION FROM TRANSACTION WHERE ID = '{$restoreTransactionId}'");


            if($isDeleted[0]["DEL_DATETIME_TRANSACTION"] ==""){
                exit("isNull");
            }

            q("UPDATE transaction SET DEL_DATETIME_TRANSACTION = null WHERE ID = '{$restoreTransactionId}'");
            exit("success");

        }
    }

    function AJAX_markTransactionNotCompleted(){
        if(isset($_POST["transactionId"])){
            $transactionId = $_POST["transactionId"];
            $status = get_all("SELECT STATUS FROM  transaction WHERE ID='{$transactionId}'");
            $isDeleted = get_all("SELECT DEL_DATETIME_TRANSACTION FROM transaction WHERE ID='{$transactionId}'");
            $activityTransactionId = get_all("SELECT * FROM activity WHERE TRANSACTION_ID = '{$transactionId}'");
            $isCompleted = get_all("SELECT COMPLETED FROM  transaction WHERE ID='{$transactionId}'");


            if($isDeleted[0]["DEL_DATETIME_TRANSACTION"] !=""){
                exit("deleted");
            }

            if($status[0]["STATUS"] == "STATUS_WON"){
                q("UPDATE transaction SET COMPLETED = 0 WHERE ID = '{$transactionId}'");
                exit("success");
            }else{
                exit("notWonTransaction");
            }
        }
    }

}