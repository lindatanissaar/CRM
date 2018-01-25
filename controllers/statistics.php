<?php namespace App;

class statistics extends Controller
{

    function index()
    {
        $this->statistics = get_all("SELECT * FROM statistics");
    }

    function view()
    {
        $statistic_id = $this->getId();
        $this->statistic = get_first("SELECT * FROM statistics WHERE statistic_id = '{$statistic_id}'");
    }

}