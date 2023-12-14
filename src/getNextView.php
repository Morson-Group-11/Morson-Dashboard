<?php
session_start();
require_once 'Models/viewRotator.php';

$viewRotator = new ViewRotator();
$currentView = $viewRotator->getNextView();
$currentViewName = basename($currentView, '.phtml'); // Get the view name without the .phtml extension

// Fetch the HTML content of the view
ob_start();
include 'Views/' . $currentView;
$htmlContent = ob_get_clean();

// Return JSON with HTML content and view name
echo json_encode([
    'html' => $htmlContent,
    'viewName' => $currentViewName
]);
