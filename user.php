<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wildlife</title>

    <!-- headlinks -->
<?php include('global/headlink.php'); ?>
    <!-- Required meta tags -->
    
</head>
<body class="single-page causes-page">
      <!-- header nav bar -->
   <?php include('global/header.php'); ?>
   <!-- header nav bar -->
<?php
include('connection.php');

if(isset($_POST['upload']))
{
  
   $file = addslashes(file_get_contents($_FILES["images"]["tmp_name"]));
   $title = $_POST['title'];
   $shortdesc = $_POST['shortdesc'];
   $description = $_POST['description'];
   $target = $_POST['target'];
   $date = date('d-m-Y-H-i-s');
   $query="insert into petetion (username, image, title, shortdesc, description, Target, date_time) values('{$_SESSION['fname']}','$file','$title', '$shortdesc', '$description', '$target',  '$date')";

if (mysqli_query($conn, $query))
{
    $error = "Your petetions is Created";
    $_SESSION["error"] = $error;
}
else
{   
   
    echo("Error description: " . mysqli_error($conn));
}
}

// Delete Query
if(isset($_POST['Delete']))
{
    $id = $_POST['Delete'];
    $query="delete from user where Id='$id'";
    
if(mysqli_query($conn, $query))
{
  
}
else
{
    echo("Error description: " . mysqli_error($conn));
}
}
?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                </div><!-- .col -->
            </div>
             <span style="color:red">
                       
                          </span>
            <?php 
                         session_start();
                         

                        
                         ?><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                 <?php  
                          $query = "SELECT * FROM user ORDER BY id ASC";  
                          $result = mysqli_query($conn, $query);  
                          while($row = mysqli_fetch_array($result))  
                          { 
                          ?> 
                <div class="col-12 col-lg-4">
                    <div class="cause-wrap d-flex flex-wrap justify-content-between">
                        

                        <div class="cause-content-wrap">
                         
                            <header class="entry-header d-flex flex-wrap align-items-center">
                               

                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Id']?> </a>
                                </div>
                                <br>
                                </br>
                                <p>
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Fname']?></a>
                                </div>
                                </p>
                                <p>
                                
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Lname']?></a>
                                </div>
                                </p>
                                <br>
                                </br>
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Phone']?></a>
                                </div>
                                <br>
                                </br>
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Address']?></a>
                                </div>
                                <br>
                                </br>
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Email']?></a>
                                </div>
                                <br>
                                </br>
                                <div class="posted-date">
                                    <a href="#"><?php echo $row['Password']?></a>
                                </div>
                            </header>

                            <div class="entry-content">
                                <b><p class="m-0"><?php echo $row['Role']?></p></b>
                            </div><!-- .entry-content -->

                            <div class="entry-footer mt-5">
                            
                                
                          <form action="#" method="POST" class="form-disable">
                             <button class="btn gradient-bg mr-2" value="<?php echo $row['Id']?>" name="Delete">Delete</button>
                          </form>
                           <br>
                          
                                
                         
                            </div><!-- .entry-footer -->
                        </div><!-- .cause-content-wrap -->

                        
                    </div><!-- .cause-wrap -->
                </div><!-- .col -->
                 <?php
                  }
                 ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .featured-cause -->
    <!-- footer -->
   <?php include('global/footer.php'); ?>
   <!-- footer -->

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>
   <!-- footlinks -->
</body>
</html>