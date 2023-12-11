<?php
session_start();
require_once 'Models/ViewRotator.php';

$viewRotator = new ViewRotator();
$currentView = $viewRotator->getCurrentView();

$view = new stdClass();
$view->departmentDataSet = $viewRotator->getViewData($currentView);

require_once 'Views/' . $currentView;

$viewRotator->getNextView();