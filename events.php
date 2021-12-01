<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wildife</title>

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
  
   //$file = addslashes(file_get_contents($_FILES["images"]["tmp_name"]));
   $title = $_POST['title'];
   $shortdesc = $_POST['shortdesc'];
   $description = addslashes($_POST['description']);
    $fulldate = date('Y-m-d H:i:s');
    $tmpFilePath = $_FILES['images']['tmp_name'];    
    //save the filename
    $shortname = $_FILES['images']['name'];

    //save the url and the file

    $filePath = "images/uploads" . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $filePath)) {
        $files = $filePath;
   $query="insert into events (username, image, title, description, date_time) values('{$_SESSION['fname']}','$files','$title', '$description', '$date')";
$sql = mysqli_query($conn, $query);
if ($sql)
{
    $msg1="<script>swal('Your Petetion is Created!')</script>";
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
                    <h1>Events</h1>
                </div><!-- .col -->
            </div>
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
                          <input type="text" class="form-control" placeholder="title" name="title">
                          <br>
                          <textarea class="form-control" name="description">Create Event</textarea>
                          <br>
                          <input class="btn gradient-bg text-right" type="submit" name="upload" value="Upload">
                          </form>

                          <?php
                         }
                         ?><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h2 class="entry-title">Upcoming Events</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                    <?php  
                            $query = "SELECT * FROM events ORDER BY id DESC";  
                            $result = mysqli_query($conn, $query);  
                            while($row = mysqli_fetch_array($result))  
                            { 
                            ?> 
                <div class="col-12 col-lg-6">
                    <div class="cause-wrap d-flex flex-wrap justify-content-between">
                        <figure class="m-0">
                         <img class="img-fluid" src="<?php  echo $row['image'] ?>" alt="<?php  echo $title ?>">
                        </figure>

                        <div class="cause-content-wrap">
                        
                            <header class="entry-header d-flex flex-wrap align-items-center">
                                <h3 class="entry-title w-100 m-0"><a href="#"><?php echo $row['title']?></a></h3>

                                <div class="posted-date">
                                    <a href="#"><?php echo $row['date_time']?> </a>
                                </div><!-- .posted-date -->

                                <div class="cats-links">
                                    <a href="#"><?php echo $row['username']?></a>
                                </div><!-- .cats-links -->
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p class="m-0"><?php echo $row['description']?> </p>
                            </div><!-- .entry-content -->

                            <div class="entry-footer mt-5">
                                <a href="contact.php" class="btn gradient-bg mr-2">Join Event</a>
<!--admin rights to delete it-->
                                 <?php 
                          $role=$_SESSION['role'];
                         if($role =='admin')
                           {
                            ?>
                          <form action="#" method="POST" class="form-disable">
                             <button class="btn gradient-bg mr-2" value="<?php echo $row['Id']?>" name="Delete">Delete</button>
                          </form>
                           <br>
                          <?php
                            }
                          ?>
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
    <div class="highlighted-cause">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-7 order-2 order-lg-1">
                    <div class="section-heading">
                        <h2 class="entry-title">We love to help all the children that have problems in the world. After 15 years we have many goals achieved.</h2>
                    </div><!-- .section-heading -->

                    <div class="entry-content">
                        <p>Dolor sit amet, consectetur adipiscing elit. Mauris tempus vestib ulum mauris quis aliquam. Lorem ipsum dolor sit amet.</p>
                    </div><!-- .entry-content -->

                    

                    <div class="entry-footer mt-5">
                        <a href="#" class="btn gradient-bg">Donate Now</a>
                    </div><!-- .entry-footer -->
                </div><!-- .col -->

                <div class="col-12 col-lg-5 order-1 order-lg-2">
                    <img src="images/oshomah.jpg" alt="">
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .highlighted-cause -->
<!-- footer -->
   <?php include('global/footer.php'); ?>
   <!-- footer -->

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>
   <!-- footlinks -->
</body>
</html>