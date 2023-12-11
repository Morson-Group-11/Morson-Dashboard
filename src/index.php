<?php
require_once 'Models/departmentDataset.php';

$view = new stdClass();
$businessDataSet = new DepartmentDataset();
$view->departmentDataSet = $businessDataSet->fetchBusinessFromMonth(12);
//$view->businessDataSet = $businessDataSet->fetchBusinessFromMonth(12);
require_once('Views/business.phtml');