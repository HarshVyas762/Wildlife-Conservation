<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hello World</title>

    <!-- headlinks -->
<?php include('global/headlink.php'); ?>
    <!-- Required meta tags -->
    
    
</head>
<body class="single-page news-page">
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
   $query="insert into blogs(username, image, title, shortdesc, description, date_time) values('{$_SESSION['fname']}', '$files', '$title', '$shortdesc', '$description', '$fulldate')";
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
    $query="delete from blogs where Id='$id'";
    
if(mysqli_query($conn, $query))
{
    echo "<script>alert('Blog Deleted Successfully')</script>";
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
                    <h1>Recent Blogs</h1>
                </div><!-- .col -->
            </div>
            
             <?php 
                         $session_lifetime = 3600 * 24 * 2; // 2 days
                         session_set_cookie_params ($session_lifetime);
                         session_start();
                         if(isset($_SESSION['fname']) && !empty($_SESSION['fname']) )
                         {
                         ?>
                            
                         <form action="#" method="POST" enctype="multipart/form-data">

                          <input type="file" class="form-control" name="images">
                          <br> 
                          <input type="text" class="form-control" placeholder="title" name="title">
                          <br>
                          <input type="text" class="form-control" placeholder="Short Description" name="shortdesc">
                          <br>
                          <textarea class="form-control" name="description" placeholder="insert Blog"></textarea>
                          <br>
                          <input class="btn gradient-bg text-right" type="submit" name="upload" value="submit">
                          </form>
                          <?php
                         }
                         ?><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="news-wrap">
        <div class="container">
            <div class="row">
                        <?php 
                         $query = "SELECT * FROM blogs ORDER BY id DESC";  
                          $result = mysqli_query($conn, $query);  
                          while($row = mysqli_fetch_array($result))  
                          { 
                          ?> 
                <div class="col-12 col-lg-10">
                    <div class="news-content">
                        <img class="img-fluid" src="<?php  echo $row['image'] ?>" alt="<?php  echo $title ?>">

                        <header class="entry-header d-flex flex-wrap justify-content-between align-items-center">
                            <div class="header-elements">
                                <div class="posted-date"><?php echo $row['date_time']?></div>

                                <h2 class="entry-title"><a href="#"><?php echo $row['title']?></a></h2>

                                <div class="post-metas d-flex flex-wrap align-items-center">
                                    <span class="cat-links">in <a href="#">Causes</a></span>
                                    <span class="post-author">by <a href="#"> <?php echo $row['username']?></a></span>
                                </div>
                            </div>
                          
                            <div class="donate-icon">
                                <a  href="donation.php?show=<?php echo $row['Id']; ?>"><img src="images/donate-icon.png" alt=""></a>
                            </div>
                        </header>

                        <div class="entry-content">
                            <p><?php echo $row['shortdesc']?></p>
                        </div>

                        <footer class="entry-footer">
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
                            <a  href="blog-details.php?show=<?php echo $row['Id']; ?>" name="readmore" class="btn gradient-bg">Read More</a>
                        </footer>
                    </div>
                     <hr>
                </div>
                
                 <?php
                  }
                 ?>
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