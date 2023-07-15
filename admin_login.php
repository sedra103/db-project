<?php
include('config.php');
// Connect to MySQL database
include 'message.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve user input
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Validate user input (e.g., check if username and password match records in the database)
  // Prepare a SQL query to check if the username and password match in the database
$query = "SELECT id FROM restuarent_tb WHERE email = '$email' AND pass = '$password'";

$result = mysqli_query($conn, $query);
$rows = mysqli_fetch_array($result);

// Check if there is a matching record
if (isset($rows['id']) && $rows['id'] > 0) {
  // Set session variables
  $adminid = $rows['id'];
  $_SESSION['id'] = $rows['id'];
  $_SESSION['message'] = 'You have logged in';
  // Redirect to the logged-in page
  header('Location: admin.php?id='. $rows['id']);
}
else{
  echo "<script>alert('Incorrect user id and password')</script>";
      }

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login and Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }


    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea {
      width: 90%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error-message {
      color: #ff0000;
      margin-bottom: 10px;
    }
    .success-message {
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      color: #155724;
      padding: 10px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
    
  <?php if (isset($message)) : ?>
    <div class="success-message">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <h1>Admin Page</h1>

  <div class="container">

    <div id="login" class="tab-content">
      <h2>Login <span class="fa-solid fa-right-to-bracket"></span></h2>

      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" required>
        </div>

        <div class="form-group">
          <input type="submit" value="Login">
        </div>
      </form>
      <div>
        <a href="adm_sign.php">Register</a>
      </div>
    </div>
</body>
</html>


