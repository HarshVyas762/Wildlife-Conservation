<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hello World</title>

      <!-- headlinks -->
<?php include('global/headlink.php'); ?>
    <!-- Required meta tags -->
 
</head>
<body class="single-page single-cause">
     <?php include('global/header.php'); ?>
    <?php

include('connection.php');
$id=$_GET['show'];

$query2=mysqli_query($conn,"select * from petetion where id='$id' ");
    if($row=mysqli_fetch_array($query2,MYSQLI_ASSOC))
    {
        $image=$row['image'];
        $title=$row['title'];
        $content= $row['description'];
        $date=$row['date_time'];
    }
?>
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?php echo $row['title']?></h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="highlighted-cause">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 order-2 order-lg-1">
                    <div class="section-heading">
                        <h2 class="entry-title"><?php echo $row['title']?></h2>
                    </div><!-- .section-heading -->

                    <div class="entry-content mt-5">
                        <p><?php echo $row['description']?></p>
                    </div><!-- .entry-content -->

                    <div class="entry-footer mt-5">
                        <a href="donation.php?show=<?php echo $row['Id']; ?>" class="btn gradient-bg">Donate Now</a>
                        <br>
                        <br><input type="submit" onclick="change()" id="btn" class="btn gradient-bg mr-2" value="Signature"> Signature Needed : <?php echo $row['Target']?>
                        
                    </div><!-- .entry-footer -->
                </div><!-- .col -->

                <div class="col-12 col-lg-4 order-1 order-lg-2">
                     <img class="img-fluid" src="<?php  echo $row['image'] ?>" alt="<?php  echo $title ?>">
                </div><!-- .col -->
            </div>
            
            
            <hr>
            <!-- <form action="#" method="POST" enctype="multipart/form-data">-->
            <!--   <input type="text" class="form-control" placeholder="Comments" name="title">-->
            <!--    <br>-->
            <!--    <input class="btn gradient-bg text-right" type="submit" name="Comment" value="Comment">-->
            <!--</form><!-- .row -->
        </div><!-- .container -->
    </div><!-- .highlighted-cause -->
    
    
 <script>  
    function change() // no ';' here
{
    var elem = document.getElementById("btn");
    if (elem.value=="Signature") elem.value = "Signed +1";
    else elem.value = "Signature";
}
</script>
<!-- footer -->
   <?php include('global/footer.php'); ?>
   <!-- footer -->

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>

</body>
</html>