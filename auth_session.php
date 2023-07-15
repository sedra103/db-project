<?php
    session_start();
    if(isset($_POST["restaurant_name"])) {
        
        header("Location: admin_login.php");
        exit();
    }
?>