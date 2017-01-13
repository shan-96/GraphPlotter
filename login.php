<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
  </head>

  <body>

    <!-- Off Canvas Navigation
    ================================================== -->
    <?php 
	require_once("header.php");
	//check if already logged in
	if( $user2->is_logged_in() ){ header('Location: index.php'); }
	?>

    <!-- Customise Form Section
    ================================================== -->
		<div class="container"> <!-- Start Container -->
		<h2>Login to your account</h2>
            <div class="row"> <!-- Start Row -->
                <div style="width: 30%;">
                
                    <form name="sentMessage" action="" method="post">
                        
							                           
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" autocomplete="off" class="form-control" name="username" required data-validation-required-message="Please enter your name.">
                                </div>
				<div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" autocomplete="off" class="form-control" name="password" required data-validation-required-message="Please enter the number of people.">
                                </div>
								<?php
									//process login form if submitted
									if(isset($_POST['submit'])){

										$username = trim($_POST['username']);
										$password = trim($_POST['password']);
										$username = sanitize($username);
										$password = sanitize($password);
										
										if($user2->login($username,$password)){ 

											//logged in return to index page
											header('Location: index.php');
											exit;
										

										} else {
											$message = '<p>Wrong username or password</p>';
										}

									}//end if submit

									if(isset($message)){ echo $message; }
								?>
						
                       
                          
                            <button class="btn btn-default" type="submit" name="submit" value="Login">Login</button> <!-- Send button -->
                  
                    </form>
					
                </div>
            </div> <!-- End Row -->
                                    <center><h3>Not a user yet? <a href="signup.php">Sign Up</b></a></h3></center>
        </div><!-- End Container -->
		

  </body>
</html>	