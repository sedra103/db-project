<?php
include('config.php');
session_start();
// Check if the user is logged in
if (!isset($_SESSION['email'])) {
  // Redirect to the login page
  header('Location: sign_page.html');
  exit();
}

// Display the logged-in user information
echo "Welcome, " . $_SESSION['FirstName'] . "!";

// Logout functionality
echo "<a href='logout.php'>Logout</a>";
?>