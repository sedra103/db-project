<?php
include 'config.php';
include 'myfunctions.php';
// Path to the folder containing the restaurant photos
$folderPath = 'pic_forApp/restuarents/';

// Get the list of files in the folder
$files = glob($folderPath . '*');

// Get a random index from the files array
$randomIndex = array_rand($files);

// Get the randomly selected file
$randomFile = $files[$randomIndex];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants Nearby</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 20px;
        }
        
        h1 {
          text-align: center;
        }
        
        ul {
          list-style: none;
          padding: 0;
        }
        
        li {
          display: flex;
          align-items: center;
          margin-bottom: 20px;
          border: 1px solid #ccc;
          padding: 20px;
          border-radius: 4px;
        }
        
        
        a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: #000;
    transition: color 0.3s ease;
}

a:hover {
    color: #ff0000; /* Change the color on hover */
}

/* Styles for the restaurant card */
.restaurant-card {
    display: flex;
    align-items: center;
    margin-bottom: 20px; /* Add a margin at the bottom for spacing */
}

/* Styles for the restaurant info */
.restaurant-info {
    flex: 1;
    padding-right: 10px; /* Add some spacing between the info and image */
}

.restaurant-name {
    font-size: 20px;
    font-weight: bold;
}

.restaurant-rating {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.restaurant-rating-icon {
    color: gold; /* Change the color of the rating icon */
    margin-right: 5px; /* Add some spacing between the icon and text */
}

.restaurant-details,
.restaurant-phone,
.restaurant-location {
    margin-bottom: 5px;
}

/* Styles for the restaurant image */
.restaurant-image {
    width: 100px; /* Adjust the width as needed */
    height: 100px; /* Adjust the height as needed */
    flex: 0 0 100px; /* Set a fixed width for the image container */
    margin-left: 10px; /* Add some spacing between the info and image */
}


    </style>
</head>
<body>
    <h1>Restaurants Nearby</h1>

    

<?php

$restuarent_tb = getAll('restuarent_tb');
            // Check if there are any menus
            if (mysqli_num_rows($restuarent_tb) > 0){
                  foreach($restuarent_tb as $item){
                    // Generate the image URL with a random image from the "restaurants" folder
                    ?>
    <ul>
        <li>
        <a href="products.php?user_id=<?php echo $_GET['id']; ?>&restaurant_id=<?php echo $item['id']; ?>">
                    <div class="restaurant-info">
                        <h2 class="restaurant-name"><?php echo $item['Restuarent_name']; ?></h2>
                        <div class="restaurant-rating">
                            <i class="restaurant-rating-icon fa fa-star"></i>
                            <span>4.3</span>
                        </div>
                        <p class="restaurant-details"><?php echo $item['details']; ?></p>
                        <p class="restaurant-phone">Phone: <?php echo $item['phone']; ?></p>
                        <p class="restaurant-location">Location: <?php echo $item['loc']; ?></p>
                    </div>
                    <div class="product-list" >
                    <?php
                    $folderPath = 'pic_forApp/restuarents/';
                    $photos = glob($folderPath . '*.jpg'); // Retrieve all JPEG images from the folder

                    // Get a random index from the array of photos
                    $randomIndex = array_rand($photos);

                    // Get the randomly selected photo from the array
                    $randomPhoto = $photos[$randomIndex];

                    // Generate the HTML code for the random photo
                    echo '<img src="' . $randomPhoto . '" width="120" height="120" alt="Restaurant Photo">';
                    ?>
                    </div>
                    
                </li>
        <?php  
              }
             }
           ?>
        
    </ul>

</body>
</html>
