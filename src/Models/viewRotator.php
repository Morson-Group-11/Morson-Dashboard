<?php
require_once 'departmentDataset.php';

class ViewRotator
{
    private $views = ['business.phtml', 'commercialAndAccounts.phtml', 'healthAndSafety.phtml', 'hr.phtml', 'itAndSystems.phtml'];

    public function getCurrentView()
    {
        if (!isset($_SESSION['current_view_index'])) {
            $_SESSION['current_view_index'] = 0;
        }

        return $this->views[$_SESSION['current_view_index']];
    }

    public function getNextView()
    {
        $_SESSION['current_view_index']++;
        if ($_SESSION['current_view_index'] >= count($this->views)) {
            $_SESSION['current_view_index'] = 0;
        }

        return $this->views[$_SESSION['current_view_index']];
    }

    public function getViewData($view)
    {
        $dataSet = new DepartmentDataset();

        if ($view === 'itAndSystems.phtml') {
            $data = $dataSet->fetchAllBusinesses();
            $monthlyData = $dataSet->fetchBusinessFromMonth(12);
            if (isset($monthlyData['it_and_systems']['scheduled_outages'])) {
                $data['it_and_systems']['scheduled_outages'] = $monthlyData['it_and_systems']['scheduled_outages'];
            }
        } else {
            $data = $dataSet->fetchBusinessFromMonth(12);
        }

        // Ensure 'it_and_systems' data is an array
        if (!is_array($data['it_and_systems'])) {
            $data['it_and_systems'] = [];
        }

        return $data;
    }
}