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
    var currentViewName = '<?php echo $currentViewName; ?>'; // Set the initial view name
    var abortController = new AbortController(); // Controller to abort fetch requests

    function loadNextView() {
        console.log('Loading next view');
        abortController.abort();
        abortController = new AbortController();

        fetch('getNextView.php')
            console.log('Fetching next view');
            .then(response => response.json())
            .then(data => {
                console.log('Received data');
                currentViewName = data.viewName; // Update the current view name
                const mainContent = document.getElementById('mainContent');
                mainContent.innerHTML = data.html;

                const scriptUrl = '/Views/js/' + data.viewName + '.js';
                const script = document.createElement('script');
                console.log('Loading script: ' + scriptUrl);
                script.src = scriptUrl;

                script.onload = () => {
                    if (typeof updateView === 'function') {
                        console.log('Calling updateView');
                        updateView(abortController.signal); // Pass the signal to the updateView function
                    }
                };

                document.body.appendChild(script);
            })
            .catch(error => console.error('Error:', error));
    }

    setInterval(loadNextView, 30000);
    loadNextView(); // Load the initial view
</script>


</body>
</html>
