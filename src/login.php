<?php

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($password == "testing") {
        header('Location: adminpage.php');
    }
}

require_once('Views/login.phtml');