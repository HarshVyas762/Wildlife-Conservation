<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wildlife</title>
<!-- headlinks -->
<?php include('global/headlink.php'); ?>
    <!-- Required meta tags -->
    
</head>
<body class="single-page about-page">
    <!-- header nav bar -->
   <?php include('global/header.php'); ?>
   <!-- header nav bar -->
<?php
include('connection.php');

if(isset($_POST['upload']))
{
  
   //$file = addslashes(file_get_contents($_FILES["images"]["tmp_name"]));
   $title = $_POST['title'];
    $description = addslashes($_POST['description']);
    $tmpFilePath = $_FILES['images']['tmp_name'];    
    //save the filename
    $shortname = $_FILES['images']['name'];

    //save the url and the file

    $filePath = "images/uploads" . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $filePath)) {
        $files = $filePath;
   $query="insert into organisations (image, name, description) values('$files','$title', '$description')";
$sql = mysqli_query($conn, $query);
if ($sql)
{
    
}
else
{
    echo("Error description: " . mysqli_error($conn));
}
}

}

?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Insert Organisation</h1>
                </div><!-- .col -->
                <?php 
                         $session_lifetime = 3600 * 24 * 2; // 2 days
                         session_set_cookie_params ($session_lifetime);
                         session_start();
                         if(isset($_SESSION['fname']) && !empty($_SESSION['fname']) )
                         {
                         ?>

                         <form action="#" method="POST"  enctype="multipart/form-data" >
                          <input type="file" class="form-control" name="images">
                          <br> 
                          <input type="text" class="form-control" placeholder="Name of Organization" name="title">
                          <br>
                         <textarea class="form-control" placeholder="Other Informations" name="description" ></textarea>
                          <br>
                          <input class="btn gradient-bg text-right" type="submit" name="upload" value="Upload">
                          </form>

                          <?php
                         }
                         ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->
         
    <div class="welcome-wrap">
        <div class="container">
            
                <?php  
                $query = "SELECT * FROM organisations ORDER BY id DESC";  
                $result = mysqli_query($conn, $query);  
                while($row = mysqli_fetch_array($result))  
                { 
                ?> 
                <div class="row">  
                <div class="col-12 col-lg-6 order-2 order-lg-1">
                    <div class="welcome-content">
                        <header class="entry-header">
                            <h2 class="entry-title"><?php echo $row['name']?></h2>
                        </header><!-- .entry-header -->

                        <div class="entry-content mt-5">
                            <p><?php echo $row['description']?></p>
                        </div><!-- .entry-content -->
                    </div><!-- .welcome-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 order-1 order-lg-2">
                 <img class="img-fluid" src="<?php  echo $row['image'] ?>" alt="<?php  echo $title ?>">
                </div><!-- .col -->
                </div><!-- .row -->
                <br>
                <hr>

                <?php

                 }  

                ?> 
            
        </div><!-- .container -->
    </div><!-- .home-page-icon-boxes -->

    


    <div class="help-us">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                    <h2>Help us so we can help others</h2>

                    <a class="btn orange-border" href="donation.php">Donate now</a>
                </div>
            </div>
        </div>
    </div>

<!-- footer -->
   <?php include('global/footer.php'); ?>
   <!-- footer -->

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>
   <!-- footlinks -->
</body>
</html>