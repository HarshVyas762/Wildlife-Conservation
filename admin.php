<?php
$session_lifetime = 3600 * 24 * 2; // 2 days
session_set_cookie_params ($session_lifetime);
session_start();
include('connection.php');

if(isset($_POST['login']))
{   

    $Email=$_POST['emailid'];
    $Password=$_POST['pass']; 
      $sql = "select id, fname, role from user where Email = '$Email' and Password = '$Password'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC); //syntax to fetch things
      // $count = mysqli_num_rows($result); 
      // If result matched $myusername and $mypassword, table row must be 1 row   
      if($row) { 

//defined variable
         $role=$row['role'];
         $fname= $row['fname'];
//session created
         $_SESSION['fname']=$fname;   
         $_SESSION['role']=$role;   
         header("location: home.php");       
      }
      else
      {
         $error = "Your Login Name or Password is invalid";
         $_SESSION["error"] = $error;
      }
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hello World</title>

    <!-- headlinks -->
<?php include('global/headlink.php'); ?>
    <!-- Required meta tags -->
    
</head>
<body class="single-page contact-page">
  <!-- header nav bar -->
   <?php include('global/header.php'); ?>
   <!-- header nav bar -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Login & Registration</h1>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header -->

    <div class="contact-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-5"> 
                    
                   <form action="#" method="POST" class="contact-form">
                       <h1>Login</h1>
                       <span style="color:red">
                       <?php
                     if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo "<span>$error</span>";
                        }
                        ?> 
                            
                          </span>
                       <input type="email" placeholder="Email" name="emailid">
                       <input type="text" placeholder="password" name="pass">


                        <span>
                            <input class="btn gradient-bg" type="submit"name="login" value="Login">
                        </span>
                    </form>
                </div><!-- .col -->

                <div class="col-12 col-lg-7"> 
                    
                    <form action="#" method="POST" class="contact-form">
                       <h1>Registration</h1>
                        <input type="text" placeholder="First Name" name="fname">
                         <input type="text" placeholder="Last Name" name="lname">
                         <input type="text" placeholder="Number"    name="number">
                          <input type="email" placeholder="Email"   name="email">
                          <input type="text" placeholder="address"  name="Add">
                         <input type="text" placeholder="password"  name="password">

                        <span>
                            <input class="btn gradient-bg" type="submit" name="register" value="Registration">
                        </span>
                    </form><!-- .contact-form -->

                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div>
<!-- footer -->
   <?php include('global/footer.php'); ?>
   <!-- footer -->

   <!-- footlinks -->
   <?php include('global/footlink.php'); ?>
   <!-- footlinks -->
</body>
</html>

<?php
 //registration 

include('connection.php');

if(isset($_POST['register']))
{
    $name  =$_POST['fname'];
    $lname =$_POST['lname'];
    $number=$_POST['number'];
    $address=$_POST['Add'];
    $Email=$_POST['email'];
    $password=$_POST['password'];
    $role = 'admin';

    $sql="insert into user (Fname,Lname,Phone,Address,Email,Password,role)  
          values('$name', '$lname', '$number','$address','$Email','$password', '$role')"; 

 if (mysqli_query($conn, $sql)) 
{ 
    echo '<script language="javascript">';
    echo 'alert("Admin Registered, Try to login")';
    echo '</script>';
} 

else
{ 
    echo "ERROR: Could not able to execute $sql. "
        .mysqli_error($conn); 
} 
  
mysqli_close($conn);
}

//login  
?>