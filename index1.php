<?php 
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <title>Food Delivery System</title>
  <style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-image: linear-gradient(45deg, #7c9885, #b5b682);
  }

  header {
    background-color: #f2f2f2;
    padding: 20px;
    text-align: center;
  }

  .logo {
    width: 180px; /* Adjust the desired width */
    height: 100px; /* Adjust the desired height */
    margin: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .logo img {
    width: 90px;
    height: auto;
  }

  h1 {
    font-size: 24px;
    color: #28666e;
  }

  .article {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .article-wrapper {
    text-align: center;
    padding: 20px;
  }

  .articles {
    display: grid;
    margin-inline: auto;
    padding-inline: 24px;
    width: fit-content;
    height: fit-content;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .cta-button {
    display: block;
    width: 200px;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin: 0 auto;
  }

  .featured-section {
    background-color: #f9f9f9;
    padding: 20px;
    text-align: center;
  }

  .featured-section h2 {
    font-size: 20px;
    margin-bottom: 10px;
  }

  .featured-section p {
    font-size: 14px;
    margin-bottom: 20px;
  }

  .featured-section .cta-button {
    width: 160px;
  }
  .signout{
    max-height: 20px;
    display: inline-flex;
    justify-content: space-around;
  }
  @media (max-width: 767px) {
    /* Styles for mobile view */
    .logo {
      width: 120px;
      height: 70px;
    }

    h1 {
      font-size: 20px;
    }

    .cta-button {
      width: 160px;
    }
    figure img{
      width: 200px;
    }
    figure{
      width : 140px;
    }
  }
</style>

</head>
<body>
  <header>

  <div class="container">
    <div class="row">
      <div class="col-sm-6 logo">
        <img src="pic_forApp/logo.png" alt="Logo">
      </div>
      <div class="col-sm-6 text-right">
        <a href="logout.php" class="btn btn-outline-secondary signout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
      </div>
    </div>
  </div>

    <h1>Welcome to our Food Delivery System</h1>
    <p>Order delicious food from your favorite restaurants!</p>
  </header>
  
  <section class="featured-section">
    
    <div class="card">
    <section class="articles">
  <article>
    <div class="article-wrapper">
      <figure>
        <img src="https://www.citysignal.com/wp-content/uploads/2022/06/breakfast-near-me.jpg" alt="" width="280px" />
      </figure>
      <div class="article-body">
        <h2>Best Foods and Restaurants to Enjoy</h2>
        <p>
        Explore some of the best restaurants in your area
        </p>
      </div>
    </div>
  </article>
</div>    <?php require_once 'restuarents.php';?>
  </section>
  
  <?php include 'footer.php';?>
</body>
</html>


