<?php
require_once('profilePage.php');
// Check if the message session variable is set
if (isset($_SESSION['message'])) {
    // Get the message and clear the session variable
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
  }

  // Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file is uploaded and no errors occurred
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
      $file = $_FILES['profile_photo'];
  
      // Get the file details
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];
  
      // Get the file extension
      $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
  
      // Allowed file extensions
      $allowedExtensions = ['jpg', 'jpeg', 'png'];
  
      // Check if the file extension is allowed
      if (in_array($fileExt, $allowedExtensions)) {
        // Define the directory to upload the file
        $uploadDir = 'pic_forApp/profile_img/';
  
        // Generate a unique file name
        $newFileName = uniqid('profile_', true) . '.' . $fileExt;
  
        // Define the file path
        $filePath = $uploadDir . $newFileName;
        // Move the uploaded file to the desired location
        if (move_uploaded_file($fileTmpName, $filePath)) {
          // Update the user's profile photo in the database
          $query = "UPDATE registration SET profile_photo = '$newFileName' WHERE id = '$id'";
  
          if (mysqli_query($conn, $query)) {
            $_SESSION['message'] = "Profile photo updated successfully!";
            header("Location:update_profile.php?id=".$id);
            exit();
          } else {
            echo "Error updating profile photo: " . mysqli_error($conn);
          }
        } else {
          echo "Error uploading file.";
        }
      } else {
        echo "Invalid file extension. Allowed file types: jpg, jpeg, png.";
      }
    }
  }

if(isset($_POST['update'])){
    $newphone = $_POST['phone'];
    //$newphoto = $_POST['profile_photo'];
    $newlocation = $_POST['location'];
    
    //Update the address and phone of Profile page
    $query = "UPDATE registration SET  address = '$newlocation', phone = '$newphone' WHERE id = '$id'";
    $result = mysqli_query($conn,$query);
    if ($result){
      
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location:" . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']);
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .form-container {
      max-width: 500px;
      margin: 20px auto;
      padding: 20px;
      background-color: #f2f2f2;
      flex: 1;
      padding-bottom: 60px;
    }
    
    .form-container h2 {
      font-size: 24px;
      margin-bottom: 20px;
      text-align: center;
    }
    
    .form-container label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }
    
    .form-container input[type="file"],
    .form-container input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    
    .form-container input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border-radius: 5px;
      cursor: pointer;
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

  <div class="form-container">
    <?php $userinfo = getAll('registration');
$loggedInUserId = $_SESSION['id'];
// Check if there are any menus
if (mysqli_num_rows($userinfo) > 0){
      foreach($userinfo as $row){
        if ($row['id'] == $loggedInUserId) {
        $profilePhoto = $row['profile_photo'];
        ?>
    <form action="" method="POST" enctype="multipart/form-data">
        
      <h2>Update Profile</h2>
      
      <label for="profile-photo">Profile Photo:</label>
      <input type="file" id="profile-photo" name="profile_photo" accept="image/*" value="<?php echo $profilePhoto; ?>" required>
      
      
      <label for="location">Location:</label>
      <input type="text" id="location" name="location" value="<?php echo $row['address']; ?>">
      
      <label for="phone">Phone Number:</label>
      <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
      
      <input type="submit" name="update" value="Update">
    </form>
    <?php  
              }
             }
            }
  ?>
  </div>
</body>
</html>
