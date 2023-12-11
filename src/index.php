<?php
require_once 'Models/departmentDataset.php';

phpinfo();
$view = new stdClass();
$businessDataSet = new DepartmentDataset();
//$view->businessDataSet = $businessDataSet->fetchBusinessFromMonth(12);
require_once('Views/business.phtml');