<?php
/**
 * Created by PhpStorm.
 * User: Linnu
 * Date: 03.03.2018
 * Time: 20:54
 */

namespace App;


class Admin
{
    static function addTaskName($activityDescription)
    {
        $activityDescription = htmlspecialchars($activityDescription);

        insert('activity_description', [
            'DESCRIPTION' => $activityDescription
        ]);
    }

    static function addNewEmployee($firstName, $lastName){
        $firstName = htmlspecialchars($firstName);
        $lastName = htmlspecialchars($lastName);

        insert('employee', [
            'FIRST_NAME' => $firstName,
            'LAST_NAME' => $lastName
        ]);

    }

}