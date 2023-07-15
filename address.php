<?php
require_once 'my.php';

if(!empty($_SESSION["id"])){
  header("Location: index1.html");
}
if (isset($_POST['submit'])){
// Retrieve form data
$address = $_POST['address'];

$address = mysqli_real_escape_string($conn, $address);
if (isset($_GET['email'])){
  
// Check if the user already exists
$email = $_GET['email'];

$sql = "SELECT * FROM registration WHERE email = '$email'";

$result = $conn->query($sql);



if ($result->num_rows > 0) {
  // User exists, update the address information
  $updateSql = "UPDATE registration SET address = '$address' WHERE email = '$email'";
  
  if ($conn->query($updateSql) === TRUE) {
    $_SESSION['message']= "Address information updated successfully";
    header("Location:index1.html");
    exit(0);
  } else {
    echo "Error updating address information: " . $conn->error;
  }
} else {
  // User doesn't exist, show an error message or handle it as per your requirements
  echo "User not found";
}
}

 // Close the database connection
 mysqli_close($conn);
}


?>

