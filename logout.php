<?php
session_start();
// Destroy the session and redirect to the login page
    $_SESSION = array();

    session_destroy();
    
    unset($_SESSION['id']);
    header("location: sign_page.html");
    exit();


?>