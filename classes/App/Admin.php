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

}