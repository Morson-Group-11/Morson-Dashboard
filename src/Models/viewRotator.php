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

        // Fetch common data for all views
        $data = $dataSet->fetchAllBusinesses();
        $monthlyData = $dataSet->fetchBusinessFromMonth(12);

        // Handling for IT and Systems data
        $data['it_and_systems_status'] = $dataSet->fetchItAndSystemsStatus();
        $data['it_and_systems_software'] = $dataSet->fetchItAndSystemsSoftware();

        // Handling for 'scheduled_outages' for IT and Systems
        if (isset($monthlyData['it_and_systems']['scheduled_outages'])) {
            $data['it_and_systems']['scheduled_outages'] = $monthlyData['it_and_systems']['scheduled_outages'];
        }

        // Additional handling for other views (if any specific logic is required)

        return $data;
    }


}
