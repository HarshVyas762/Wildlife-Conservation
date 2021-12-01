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
  
  // $file = addslashes(file_get_contents($_FILES["images"]["tmp_name"]));
   $title = $_POST['title'];
   $shortdesc = $_POST['shortdesc'];
   $description = addslashes($_POST['description']);
   $target = $_POST['target'];
   $fulldate = date('Y-m-d H:i:s');
   $signature = "null";
   
       $tmpFilePath = $_FILES['images']['tmp_name'];    
    //save the filename
    $shortname = $_FILES['images']['name'];

    //save the url and the file

    $filePath = "images/uploads" . date('d-m-Y-H-i-s').'-'.$_FILES['images']['name'];
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $filePath)) {
        $files = $filePath;
   $query="insert into petetion (username,image,title,shortdesc,description,date_time,Target,signature) values('{$_SESSION['fname']}','$files','$title','$shortdesc','$description','$fulldate','$target','$signature')";
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

// Delete Query
if(isset($_POST['Delete']))
{
    $id = $_POST['Delete'];
    $query="delete from petetion where Id='$id'";
    
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
                    <h1>Create Petition</h1>
                </div><!-- .col -->
            </div>
             <span style="color:red">
                       
                            
                          </span>
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
                          <input type="text" class="form-control" placeholder="Short Description" name="shortdesc">
                          <br>
                          <textarea class="form-control" name="description" placeholder="petetion in description"></textarea>
                          <br>
                          <input type="text" class="form-control" placeholder="Target" name="target"> 
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
                        <h2 class="entry-title">Ongoing Petitions</h2>
                    </div><!-- .section-heading -->
                </div><!-- .col -->
            </div><!-- .row -->

            <div class="row">
                 <?php  
                          $query = "SELECT * FROM petetion ORDER BY id DESC";  
                          $result = mysqli_query($conn, $query);  
                          while($row = mysqli_fetch_array($result))  
                          { 
                          ?> 
                <div class="col-12 col-lg-4">
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
                                <p class="m-0"><?php echo $row['shortdesc']?></p>
                            </div><!-- .entry-content -->

                            <div class="entry-footer mt-5">
                            
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
                              
                                <a href="Single-Petetions.php?show=<?php echo $row['Id'];?>" class="btn gradient-bg">Sign Now!!</a>
                               <br>
                                <br>
                                <a  href="Single-Petetions.php?show=<?php echo $row['Id']; ?>" name="readmore" class="btn gradient-bg">Read More</a>
                         
                            </div><!-- .entry-footer -->
                        </div><!-- .cause-content-wrap -->

                        <div class="fund-raised w-100">
                            <div class="featured-fund-raised-bar barfiller">
                                <div class="tipWrap">
                                    <span class="tip"></span>
                                </div><!-- .tipWrap -->
                                <span class="fill" data-percentage="25"></span>
                            </div><!-- .fund-raised-bar -->

                            <div class="fund-raised-details d-flex flex-wrap justify-content-between align-items-center">
                                <div class="fund-raised-total mt-4">
                                    Raised: <?php echo $row['Target']-'50'?>
                                </div><!-- .fund-raised-total -->

                                <div class="fund-raised-goal mt-4">
                                    <?php echo $row['Target']?>
                                </div><!-- .fund-raised-goal -->
                            </div><!-- .fund-raised-details -->
                        </div><!-- .fund-raised -->
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
<script>

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>
   <!-- footlinks -->
</body>
</html>