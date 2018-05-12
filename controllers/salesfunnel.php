<?php namespace App;

class salesfunnel extends Controller
{

    function index()
    {
        $this->salesfunnel = get_all("SELECT * FROM salesfunnel");
        $this->transactions1 = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' OR STATUS = 'STATUS_UNKNOWN' AND COMPLETED = 0 AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL ORDER BY DEADLINE_DATE ASC");
        $this->transactions2 = get_all("SELECT * FROM transaction WHERE STATUS = 'STATUS_WON' OR STATUS = 'STATUS_UNKNOWN' AND COMPLETED = 0 AND TRANSACTION.DEL_DATETIME_TRANSACTION IS NULL ORDER BY DEADLINE_DATE DESC");
    }

    function view()
    {
        $salesfunnel_id = $this->getId();
        $this->salesfunnel = get_first("SELECT * FROM salesfunnel WHERE salesfunnel_id = '{$salesfunnel_id}'");
    }

}