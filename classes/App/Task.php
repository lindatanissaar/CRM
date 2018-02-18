<?php
/**
 * Created by PhpStorm.
 * User: Linnu
 * Date: 18.02.2018
 * Time: 18:28
 */

namespace App;


class Task
{
    static function addTask($activityDescription, $deadlineDate, $transactionName, $employeeName)
    {
        $activityDescription = htmlspecialchars($activityDescription);
        $deadlineDate = htmlspecialchars($deadlineDate);
        $transactionName = htmlspecialchars($transactionName);
        $employeeName = htmlspecialchars($employeeName);

        $date = str_replace('/', '-', $deadlineDate);
        $deadlineDate =  date('Y-m-d', strtotime($date));

        $transaction_id = get_first("SELECT ID FROM transaction WHERE NAME = '{$transactionName}' ");

        $description_id = get_first("SELECT ID FROM activity_description WHERE DESCRIPTION = '{$activityDescription}' ");

        $transaction_id  = json_encode($transaction_id);
        $json = json_decode($transaction_id, true);
        $transaction_id = $json['ID'];

        $description_id  = json_encode($description_id);
        $json = json_decode($description_id, true);
        $description_id = $json['ID'];


        insert('activity', [
            'TRANSACTION_ID' => $transaction_id,
            'DESCRIPTION_ID'=> $description_id,
            'DEADLINE_DATE' => $deadlineDate
        ]);


        $activity_id = get_first("SELECT ID FROM activity WHERE TRANSACTION_ID = '{$transaction_id}' AND DESCRIPTION_ID = '{$description_id}' AND  DEADLINE_DATE = '{$deadlineDate}'");

        $activity_id  = json_encode($activity_id);
        $json = json_decode($activity_id, true);
        $activity_id = $json['ID'];


        $parts = explode(" ", $employeeName);

        $lastname = array_pop($parts);
        $firstname = implode(" ", $parts);

        $employee_id = get_first("SELECT ID FROM employee WHERE LAST_NAME = '{$lastname}' AND FIRST_NAME = '{$firstname}'");

        $employee_id  = json_encode($employee_id);
        $json = json_decode($employee_id, true);
        $employee_id = $json['ID'];

        insert('supervisor', [
            'EMPLOYEE_ID' => $employee_id,
            'ACTIVITY_ID' => $activity_id
        ]);
    }
}