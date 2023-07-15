<?php
include 'myfunctions.php';

require 'config.php';
$id = $_GET['id'];
// Destroy the session and redirect to the login page
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['email']);
  header("location: sign_page.html");
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <style>
    /* Add your CSS styles here */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      height: 100%;
    }
    
    .profile-container {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f2f2f2;
      text-align: center;
    }
    
    .sign-out-button {
      position: absolute;
      top: 10px;
      left: 10px;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }

    .home-button {
      position: absolute;
      top: 10px;
      right: 10px;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
    }
    
    .profile-image {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      margin-bottom: 30px;
    }
    
    .profile-name {
      font-size: 24px;
      margin-bottom: 10px;
    }
    
    .profile-email {
      font-size: 16px;
      color: #666;
      margin-bottom: 10px;
    }
    
    .profile-info {
      font-size: 18px;
      margin-bottom: 20px;
    }
    
    .profile-button {
      display: inline-block;
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
    }
  </style>
</head>
<body>

  
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container --bs-info-bg-subtle">
  <h1>Profile Page </h1>
  <i class="fa-solid fa-id-badge fa-2xl"></i>
  <a class="navbar-brand" href="#">
      <img src="pic_forApp/logo.png" width="80" height="64"class="d-inline-block align-text-top"> Healthy Food
    </a>
    
</nav>
  
<?php
$userinfo = getAll('registration');
$loggedInUserId = $_SESSION['id'];
// Check if there are any menus
if (mysqli_num_rows($userinfo) > 0){
      foreach($userinfo as $row){
        if ($row['id'] == $loggedInUserId) {
        $profilePhoto = $row['profile_photo'];
        ?>

  <div class="profile-container">
    <?php if (!empty($profilePhoto)) : ?>
    <img src="pic_forApp/profile_img/<?php echo $profilePhoto; ?>" alt="Profile Image" class="profile-image">
    <?php else : ?>
    <p>No profile photo available.</p>
    <?php endif; ?>
    <h2 class="profile-name"><?php echo $row['Firstname']; ?></h2>
    <p class="profile-email">Email: <?php echo $row['email']; ?></p>
    <p class="profile-info">Phone: <?php echo $row['phone']; ?></p>
    <p class="profile-info">Location: <?php echo $row['address']; ?></p>
    <a href="update_profile.php?id=<?php echo $id; ?>" class="profile-button">Edit Profile</a>
  </div>
  <?php  
              }
             }
            }
  ?>
  <?php include 'footer.php';?> 
</body>
</html>

