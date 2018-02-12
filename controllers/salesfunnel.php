<?php namespace App;

class salesfunnel extends Controller
{

    function index()
    {
        $this->salesfunnel = get_all("SELECT * FROM salesfunnel");
        $this->transactions = get_all("SELECT * FROM transaction");
    }

    function view()
    {
        $salesfunnel_id = $this->getId();
        $this->salesfunnel = get_first("SELECT * FROM salesfunnel WHERE salesfunnel_id = '{$salesfunnel_id}'");
    }

}