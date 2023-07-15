<?php
include('config.php');
session_start();
// Connect to MySQL database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve user input
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate user input (e.g., check if username and password match records in the database)
  // Prepare a SQL query to check if the username and password match in the database
$query = "SELECT id FROM registration WHERE email = ? AND password = ?";
$stmt = $conn->prepare("SELECT id FROM registration WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);

// Execute the query
$stmt->execute();

// Bind the result variables
$stmt->bind_result($id);

// Fetch the result
$stmt->fetch();

// Close the statement and the database connection
$stmt->close();
$conn->close();

// Check if a user with the provided credentials exists
if ($id) {
    // Store the user ID in the session
    $_SESSION['id'] = $id;

    // Redirect to the dashboard or any other page
    header("Location: index1.php?id=$id");
    exit;
} else {
    // Display an error message for invalid credentials
    echo "Invalid username or password.";
}
}
?>








