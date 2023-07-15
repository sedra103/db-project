<?php

$showAlert = false;
$showError = false;
$exists=false;


// Check if the 'id' parameter is set in the URL
$id = $_GET['id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
	// Include file which makes the
	// Database Connection.
	include 'config.php';
    // Retrieve the form data
    $menuName = $_POST['menu_name'];
    $menuCategory = $_POST['menu_category'];
    $menuPrice = $_POST['menu_price'];
    
    // Sanitize the ID value before using it in the query
    $rst_id = mysqli_real_escape_string($conn, $id);

    // Handle the uploaded image file
    $imageFile = $_FILES['menu_image'];
    $imageName = $imageFile['name'];
    $imageTmpName = $imageFile['tmp_name'];
    $imageError = $imageFile['error'];
    $imageSize = $imageFile['size'];

    // Perform any necessary validation on image file

    // Validate the image file
    if ($imageError !== UPLOAD_ERR_OK) {
        $errors[] = "Error uploading menu image.";
    } else {
        // Check the file size
        $maxFileSize = 2 * 1024 * 1024; // 2MB
        if ($imageSize > $maxFileSize) {
            $errors[] = "Menu image size exceeds the maximum allowed limit.";
        }
        // Validate file type (optional)
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            $errors[] = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

     // Map category names to IDs
     $categoryMap = array(
        'keto' => 0,
        'gluteen free' => 1,
        'sugar free' => 2,
        'vegan' => 3,
        'low carb' => 4
    );

    // Check if the category exists in the map
    if (!array_key_exists(strtolower($menuCategory), $categoryMap)) {
        $errors[] = "Invalid menu category.";
    } else {
        // Get the category ID
        $categoryId = $categoryMap[strtolower($menuCategory)];
    }
    // Move the uploaded image file to a desired location
    $uploadDir = "pic_forApp/menus/"; // Specify the directory to store the images
    $uploadPath = $uploadDir . $imageName;
    
    if (empty($errors)) {
        $existingMenuQuery = "SELECT COUNT(*) FROM food_item WHERE title = '$menuName' AND rst_id = '$rst_id'";
        
        $result = mysqli_query($conn, $existingMenuQuery);
        $row = mysqli_fetch_row($result);
        $menuCount = $row[0];
    
        // Check if a menu with the same name and category already exists
        if ($menuCount > 0) {
            $exists = "Menu already exists.";
        } else {
            // Move the uploaded image file to a desired location
            $uploadDir = "pic_forApp/menus/"; // Specify the directory to store the images
            $uploadPath = $uploadDir . $imageName;
            if(move_uploaded_file($imageTmpName, $uploadPath)){
                $sql = "INSERT INTO `food_item` (`title`,`category_id`, `price`, `image_name`,`rst_id`) VALUES ('$menuName', $categoryId, $menuPrice, '$imageName','$rst_id')";
                if (mysqli_query($conn, $sql)) {
                    $showAlert = true;
                }
    }
}
}
}
  
// Action when clicking the "Add Menu" button
if (isset($_POST['back'])) {
    // Perform the desired action here
    echo "Add Menu button clicked for ID: " . $id;
    
// Redirect to addMenu.php with the ID parameter
header('Location: admin.php?id=' . $id);
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Menu - Admin Dashboard</title>
    <?php
    if ($showAlert) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Menu added successfully!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>';
	}
	
	
	if($showError) {
	
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error adding menu: </strong> '. $showError.'
	
	<button type="button" class="close" data-dismiss="alert aria-label="Close">
    <span aria-hidden="true">×</span> </button>
	</div> ';
}
		
	if($exists) {
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
	}

?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    

<form method="POST">
        <input type="submit" name="back" value="Back">
    </form>
    <h1>Add Menu</h1>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="menu_name">Menu Name:</label>
        <input type="text" id="menu_name" name="menu_name" required>

        <label for="menu_category">Category:</label>
        <select id="menu_category" name="menu_category" required>
            <option value="keto">Keto</option>
            <option value="gluten_free">Gluten Free</option>
            <option value="sugar_free">Sugar Free</option>
            <option value="vegan">Vegan</option>
            <option value="low_carb">Low Carb</option>
        </select>

        <label for="menu_price">Menu Price:</label>
        <input type="number" id="menu_price" name="menu_price" step="0.01" required>

        <label for="menu_image">Menu Image:</label>
        <input type="file" id="menu_image" name="menu_image" accept="image/*" required>

        <input type="submit" value="Add Menu">
    </form>
    <script src="https://kit.fontawesome.com/42bdcf7111.js" crossorigin="anonymous"></script>

</body>
</html>

