<?php
require_once 'Models/businessDataSet.php';

$views = [
    1 => 'Views/business.phtml',
    2 => 'Views/commercialAndAccounts.phtml',
    3 => 'Views/healthAndSafety.phtml',
    4 => 'Views/hr.phtml',
    5 => 'Views/itAndSystems.phtml'
];

$currentViewKey = isset($_GET['view']) ? (int)$_GET['view'] : 1;

if (!array_key_exists($currentViewKey, $views))
{
    $currentViewKey = 1;
}

include $views[$currentViewKey];
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        setInterval(changeView, 3000); // Change view every 30 seconds
    });

    function changeView() {
        var currentView = <?php echo $currentViewKey; ?>;
        var nextView = (currentView % 5) + 1;
        window.location.href = '?view=' + nextView;
    }
</script>

