<?php
require_once 'Models/businessDataSet.php';


$view = new stdClass();
$businessDataSet = new BusinessDataSet();
$view->businessDataSet = $businessDataSet->fetchBusinessFromMonth(12);
require_once('Views/business.phtml');