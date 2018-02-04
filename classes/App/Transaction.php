<?php
/**
 * Created by PhpStorm.
 * User: Linnu
 * Date: 25.01.2018
 * Time: 22:09
 */

namespace App;


class Transaction
{
    static function addTransaction($name, $price, $organisation_name, $contact_person_name, $email, $deadline_date, $telephone, $status, $note)
    {
        $email = htmlspecialchars($email);
        $price = htmlspecialchars($price);
        $name = htmlspecialchars($name);
        $organisation_name = htmlspecialchars($organisation_name);
        $contact_person_name = htmlspecialchars($contact_person_name);
        $deadline_date = htmlspecialchars($deadline_date);
        $status = htmlspecialchars($status);
        $note = htmlspecialchars($note);
        $telephone = htmlspecialchars($telephone);

        insert('organisation', [
            'ORGANISATION_NAME' => $organisation_name
        ]);

        $organisation_id = get_first("SELECT ID FROM organisation WHERE ORGANISATION_NAME = '{$organisation_name}'");

        $organisation_id  = json_encode($organisation_id);
        $json = json_decode($organisation_id, true);
        $organisation_id = $json['ID'];

        insert('contact_person', [
            'ORGANISATION_ID' => $organisation_id,
            'CONTACT_PERSON_NAME' => $contact_person_name,
            'EMAIL' => $email,
            'PHONE' => $telephone
        ]);

        $contact_person_id = get_first("SELECT ID FROM contact_person WHERE CONTACT_PERSON_NAME = '{$contact_person_name}'");

        $contact_person_id  = json_encode($contact_person_id);

        $json = json_decode($contact_person_id, true);

        $contact_person_id = $json['ID'];

        $date = str_replace('/', '-', $deadline_date);
        $date =  date('Y-m-d', strtotime($date));

        insert('transaction', [
            'ORGANISATION_ID' => $organisation_id,
            'CONTACT_PERSON_ID' => $contact_person_id,
            'PRICE' => $price,
            'NAME' => $name,
            'DEADLINE_DATE' => $date,
            'STATUS' => $status,
            'NOTE' => $note
        ]);
    }

    static function getContactPersonName($organisation_name) {

        $organisation_name = htmlspecialchars($organisation_name);
        $organisation_id = get_first("SELECT ID FROM organisation WHERE ORGANISATION_NAME = '{$organisation_name}'");
        $organisation_id  = json_encode($organisation_id);
        $json = json_decode($organisation_id, true);
        $organisation_id = $json['ID'];

        if($organisation_id != null){
            $contact_person = get_all("SELECT CONTACT_PERSON_NAME, EMAIL, PHONE FROM contact_person WHERE ORGANISATION_ID = '{$organisation_id}'");
           return $contact_person;
        }else {
           return "error";
       }
    }
}



