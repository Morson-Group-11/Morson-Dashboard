<?php

class BusinessData
{
    private $month, $bids, $live_bids, $value_live_bids, $current_leads;

    public function __construct($dbRow)
    {
        $this->month = $dbRow['month'];
        $this->bids = $dbRow['bids'];
        $this->live_bids = $dbRow['live_bids'];
        $this->value_live_bids = $dbRow['value_live_bids'];
        $this->current_leads = $dbRow['current_leads'];
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getBids()
    {
        return $this->bids;
    }

    public function getLiveBids()
    {
        return $this->live_bids;
    }

    public function getValueLiveBids()
    {
        return $this->value_live_bids;
    }

    public function getCurrentLeads()
    {
        return $this->current_leads;
    }
}