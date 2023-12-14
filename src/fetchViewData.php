<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'Models/viewRotator.php';
require_once 'Models/DepartmentDataset.php';

$viewRotator = new ViewRotator();
$currentView = $viewRotator->getCurrentView();

// Depending on your implementation, adjust the below line
$viewData = $viewRotator->getViewData($currentView);

// Assuming each view needs its complete dataset
echo json_encode(["departmentDataSet" => $viewData]);
?>
