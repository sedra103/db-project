<?php
session_start();
include 'config.php';
if(!empty($_SESSION["id"])){
  header("Location: index.html");
}
if (isset($_POST['submit'])){

    $Firstname = $_POST['Firstname'];
    $Lastname = $_POST['Lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];  
    $phone = $_POST['phone'];
    $address = $_POST['address'];

  // Validate and sanitize user input
    $Firstname = mysqli_real_escape_string($conn, $Firstname);
    $Lastname = mysqli_real_escape_string($conn, $Lastname);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $phone = mysqli_real_escape_string($conn, $phone);
    $address = mysqli_real_escape_string($conn, $address);


  // Check if the email is in the correct format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format. Please enter a valid email address.";
    exit();
  }

  // Check if the username and email already exist in the database
  $query = "SELECT * FROM registration WHERE email = '$email'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    echo " email already exists. Please choose different credentials.";
    exit();
  }
  if (strlen($phone) !== 10 || !ctype_digit($phone)) {
    die("Invalid phone number. Please enter a 10-digit number.");
}
        // Insert the user data into the database
 $insertQuery = "INSERT INTO registration (Firstname,Lastname,email,password,phone,address) VALUES ('$Firstname','$Lastname','$email','$password','$phone','$address')";
 
 if (mysqli_query($conn,$insertQuery)) {
    $_SESSION['email'] = $email;
    $_SESSION['message']= "Registration successful. You can now log in";
    header("Location:sign_page.html");
 } else {
   echo "Error: " . mysqli_error($conn);
 }
 

 // Close the database connection
 mysqli_close($conn);
 }


?>