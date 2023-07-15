<?php
	
$showAlert = false;
$showError = false;
$exists=false;
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Include file which makes the
	// Database Connection.
	include 'config.php';
	
	$restaurant_name = $_POST["restuarentname"];
	$email    = $_POST["email"];
	$password = $_POST["password"];
	$Details = $_POST["details"];	
	$phone = $_POST["phone"];
	$Location = $_POST["address"];
	
	$sql = "Select * from restuarent_tb where Restuarent_name='$restaurant_name'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	// This sql query is use to check if
	// the username is already present
	// or not in our Database
	if($num == 0) {
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `restuarent_tb` (`Restuarent_name`,`email`, `pass`, `details`, `phone`, `loc`) VALUES ('$restaurant_name', '$email','$password', '$Details', '$phone', '$Location')";
	
	
			if (mysqli_query($conn, $sql)) {
				$showAlert = true;
			}
		}
	
if($num>0)
{
	$exists="Username not available";
}
	
}//end if
	
?>
	
<!doctype html>
	
<html lang="en">

<head>
	
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content=
		"width=device-width, initial-scale=1,
		shrink-to-fit=no">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href=
"https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		integrity=
"sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
		crossorigin="anonymous">

</head>
	
<body>
	
<?php
	
	if ($showAlert) {
		echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Success!</strong> Your account is now created and you can login.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<a href="admin_login.php">Back to Login</a>
			</div>';
	}
	
	
	if($showError) {
	
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
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

    .container {
      max-width: 400px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
	</style>
<div class="container">
	<a href="admin_login.php"> <span class="fa-solid fa-arrow-left"> Back</span></a>
	<h1>Register</h1>
	<form action="adm_sign.php" method="post">
	
		<div class="form-group">
			<label for="username">Restaurant name:</label>
		<input type="text" class="form-control" id="username"
			name="restuarentname" aria-describedby="emailHelp">	
		</div>
	
		<div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control"
			id="password" name="password">
		</div>
	
		<div class="form-group">
        <label for="details">Restuarent Details:</label>
        <textarea type="text" class="form-control" name="details" required></textarea>
      </div>

      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="tel" class="form-control" name="phone" required>
      </div>

      <div class="form-group">
        <label for="address">Address:</label>
        <textarea type="text" class="form-control" name="address" required></textarea>
      </div>
	
		<button type="submit" class="btn btn-success">
		Register
		</button>
	</form>
</div>
	
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	
<script src="
https://code.jquery.com/jquery-3.5.1.slim.min.js"
	integrity="
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
	crossorigin="anonymous">
</script>
	
<script src="
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
	integrity=
"sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
	crossorigin="anonymous">
</script>
	
<script src="
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
	integrity=
"sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
	crossorigin="anonymous">

</script>
<script src="https://kit.fontawesome.com/42bdcf7111.js" crossorigin="anonymous"></script>
</body>
</html>
