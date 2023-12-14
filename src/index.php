<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once './Models/viewRotator.php';

$viewRotator = new ViewRotator();
$currentView = $viewRotator->getCurrentView();
$currentViewName = basename($currentView, '.phtml'); // Strip the .phtml extension
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Morson</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="/Views/mystyles.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="mainContent">
    <?php require_once 'Views/' . $currentView; // Load initial content ?>
</div>

<footer>
    <p>sample news ticker</p>
</footer>

<script>
    function loadNextView() {
        console.log("Next View Loaded");
        fetch('getNextView.php')
            .then(response => response.json()) // Assuming the response will be JSON
            .then(data => {
                const mainContent = document.getElementById('mainContent');
                mainContent.innerHTML = data.html; // Assuming 'html' is part of the response

                // Dynamically load the JavaScript file for the view
                const scriptUrl = '/Views/js/' + data.viewName + '.js'; // Construct the script URL
                const script = document.createElement('script');
                script.src = scriptUrl;
                console.log("scriptUrl: " + scriptUrl);
                script.onload = () => {
                    if (typeof updateView === 'function') {
                        updateView();
                        console.log("updateView ran");
                    }
                };
                document.body.appendChild(script);
            })
            .catch(error => console.error('Error:', error));
    }
    setInterval(loadNextView, 30000);
    loadNextView();
</script>

</body>
</html>
