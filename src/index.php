<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'Models/viewRotator.php';

$viewRotator = new ViewRotator();
$currentView = $viewRotator->getCurrentView();

$view = new stdClass();
$view->departmentDataSet = $viewRotator->getViewData($currentView);

require_once 'Views/' . $currentView;

$viewRotator->getNextView();