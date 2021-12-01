<!DOCTYPE html>
<html lang="en">
<head>
    <title>Wildlife</title>

    <!-- headlinks -->
<?php include('global/headlink.php'); 
   include('connection.php');
if(isset($_POST['donate']))
{
   $Cardnumber = $_POST['Cardnumber'];
   $fulldate = $_POST['epiredate'];
   $cvv = $_POST['cvv'];
   $note = $_POST['note'];
   $query="insert into donation (cardnumber,expiredate,cvv,note) values('$Cardnumber','$fulldate','$cvv','$note')";
    $sql = mysqli_query($conn, $query);
if ($sql)
{   
     $url = "successfull.php";    
     echo '<script>window.location = "'.$url.'";</script>';      
}
else
{   
   
    echo("Error description: " . mysqli_error($conn));
}
}

 ?>  
</head>
<body class="single-page causes-page">
      <!-- header nav bar -->
   <?php include('global/header.php'); ?>
   <!-- header nav bar -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Donate as much as you can</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="featured-cause">
        <div class="container">
            <div class="row">
                 <form action="#" method="POST"  enctype="multipart/form-data" >
                     <h2>Enter Credit Card Details</h2>
                    <input type="text" class="form-control" placeholder="Card Number" name="Cardnumber" required maxlength="16">
                    <br> 
                    <input type="date" class="form-control" placeholder="epiredate" name="epiredate" required>
                    <br>
                    <input type="text" class="form-control" placeholder="CVV number" name="cvv" required maxlength="3">
                    <br>
                    <textarea class="form-control" name="note" placeholder="Any Note on donation"></textarea>
                    <br>
                    <input class="btn gradient-bg text-right" type="submit" name="donate" value="donate">
                    
                </form>
            </div>
            <div class="row">
                <h2>Donate from Paytm or Google pay on this Number : </h2>
                </br>
                <h2> &nbsp +91 8422932444</h2>
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