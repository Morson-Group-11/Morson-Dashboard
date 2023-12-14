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
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    require_once './Models/viewRotator.php';

    $viewRotator = new ViewRotator();
    $currentView = $viewRotator->getCurrentView();
    $currentViewName = basename($currentView, '.phtml'); // Strip the .phtml extension
    require_once 'Views/' . $currentView; // Load initial content
    ?>
</div>

<footer>
    <p>sample news ticker</p>
</footer>

<script>
    var currentViewName = '<?php echo $currentViewName; ?>';
    var isLoadingView = false; // Flag to indicate a view is being loaded
    var abortController = new AbortController(); // Controller to abort fetch requests

    function loadNextView() {
        console.log('Starting to load next view.');
        isLoadingView = true;
        abortController.abort();
        abortController = new AbortController();

        fetch('getNextView.php')
            .then(response => {
                console.log('Received response from getNextView.php');
                return response.json();
            })
            .then(data => {
                console.log('Received data:', data);
                currentViewName = data.viewName; // Update the current view name
                const mainContent = document.getElementById('mainContent');
                mainContent.innerHTML = data.html;
                isLoadingView = false;

                const scriptUrl = '/Views/js/' + data.viewName + '.js';
                const script = document.createElement('script');
                console.log('Loading script for view:', scriptUrl);
                script.src = scriptUrl;

                script.onload = () => {
                    console.log('Script loaded:', scriptUrl);
                    if (typeof updateView === 'function') {
                        // Delay the execution of updateView
                        setTimeout(() => {
                            console.log('Calling updateView function for:', data.viewName);
                            updateView(abortController.signal);
                        }, 400); // 100 ms delay
                    }
                };

                document.body.appendChild(script);
            })
            .catch(error => {
                console.error('Error loading view:', error);
            });
    }

    setInterval(loadNextView, 30000);
    console.log('Initial view load.');
    loadNextView();
</script>

</body>
</html>
