<?php

?>
<head>
    <title>Healthy Food</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<style >
    ul {
  list-style-type: none;
}
</style>
</head>
<body >

        <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Dashboard</a>
    
    <span class="navbar-text">
    <?php if(isset($_GET['id'])){
                    $idd = $_GET['id'];
                    $rstname = getByIdname('restuarent_tb',$idd,'Restuarent_name');
      
                   // Check if there are any menus
                 if (mysqli_num_rows($rstname) > 0){
                    $row = $rstname->fetch_assoc();
                    $value = $row['Restuarent_name'];
                ?>
            <?php echo 'Restuarent : '.$value; ?>
                <?php }else{
                    echo 'Id missing from url';} }?>    </span> 
    <a class="nav-link active" aria-current="page" href="profilePage.php?logout='1'">
    <button class="btn btn-outline-success me-2" type="button">SIGN OUT</button></a>
    </div>
</nav>
</body>