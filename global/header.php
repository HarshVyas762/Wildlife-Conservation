<?php
// Turn off all error reporting
error_reporting(0);

?>
 <header class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                    <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="header-bar-email">
                         <?php 
                        
                         session_start();
                         
                         if(isset($_SESSION['fname']) && !empty($_SESSION['fname']) )
                         {
                         echo 'Welcome, '. $_SESSION['fname'];
                         ?>
                         <form action="index.php" method="POST">
                          <input class="btn gradient-bg text-right" type="submit" name="logout" value="logout">
                          </form>
                          <?php
                         }
                          else 
                         {
                             echo 'You have to login. &nbsp <a href="index.php" class="btn gradient-bg text-right">login</a>';
                         }
                          ?>
                        </div> 
                    </div><!-- .col -->
                </div><!-- .row -->
               
            </div><!-- .container -->
        </div><!-- .top-header-bar -->

        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="index.php" rel="home"><img class="d-block" src="images/logo.png" alt="logo"></a>
                        </div><!-- .site-branding -->

                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li class="current-menu-item"><a href="home.php">Home</a></li>
                                <li><a href="about.php">About us</a></li>
                                <li><a href="petitions.php">Petitions</a></li>
                                <li><a href="videos.php">Gallery</a></li>
                                <li><a href="blog.php">Blogs</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="Organisation.php">Organisations</a></li>
                                <li><a href="events.php">Events</a></li>
                                <li><a href="donation.php">Donations</a></li>
                                 <?php 
                                $role=$_SESSION['role'];
                                 if($role =='admin')
                                  {
                                     ?>
                                     <li><a href="user.php">Users</a></li>
                                  
                                  <?php
                                   }
                                   ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                <!-- helpfull code -->
                               <!--  <?php //if(isset($_SESSION['fname']) && !empty($_SESSION['fname']) )
                                {
                                ?>
                                      <a href="index.php">Logout</a>
                                <?php
                                 }
                                // else
                                 { 
                                    ?>
                                     <a href="login.php">Login</a>
                                     <a href="register.php">Register</a>
                                <?php } 
                                ?> -->
                                <!-- <li><a href="registration.php">Register</a></li> -->
                            </ul>
                        </nav><!-- .site-navigation -->

                        
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
    </header><!-- .site-header -->
   