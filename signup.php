<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
  </head>

  <body>

    <!-- Off Canvas Navigation
    ================================================== -->
    <?php require_once("header.php");?>


	
        <div class="container"> <!-- Start Container -->
            <h2>Create Your Account</h2>
	    <div class="row"> <!-- Start Row -->
                <div style="width: 30%">
                    <form name="sentMessage" action="" method="post">                   
                                <div class="form-group">
                                    <label  for="username">Username:</label>
                                    <input type="text" autocomplete="off" class="form-control" name="username" required data-validation-required-message="Please enter your name." />
                                </div>
				<div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" autocomplete="off" class="form-control" name="password" required data-validation-required-message="Please enter the password." />
                                </div>
		                <div class="form-group">
                                    <label  for="confirmPassword">Confirm Password:</label>
                                    <input type="password" autocomplete="off" class="form-control" name="passwordConfirm" required data-validation-required-message="Please enter the number of password." />
                                </div>
				<div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" autocomplete="off" class="form-control" name="email" required data-validation-required-message="Please enter the email" />
                                </div>
									<?php

											//if form has been submitted process it
											if(isset($_POST['submit'])){

												//collect form data
												extract($_POST);

												//very basic validation
												if($username ==''){
													$error[] = 'Please enter the username.';
												}

												if($password ==''){
													$error[] = 'Please enter the password.';
												}

												if($passwordConfirm ==''){
													$error[] = 'Please confirm the password.';
												}

												if($password != $passwordConfirm){
													$error[] = 'Passwords do not match.';
												}

												if($email ==''){
													$error[] = 'Please enter the email address.';
												}

												if(!isset($error)){

													$hashedpassword = $user2->password_hash($password, PASSWORD_BCRYPT);

													try {

														//insert into database
														$stmt = $db->prepare('INSERT INTO users (username,password,email) VALUES (:username, :password, :email)') ;
														$stmt->execute(array(
															':username' => sanitize($username),
															':password' => $hashedpassword,
															':email' => sanitize($email)
														));
														if($user2->login($username,$password)){ 

													//logged in return to index page
													header('Location: index.php');
													exit;
												

												
												}
														
														//redirect to index page
														//header('Location:login.php');
														exit;

													} catch(PDOException $e) {
														echo $e->getMessage();
													}

												}

											}

											//check for any errors
											if(isset($error)){
												foreach($error as $error){
													echo '<p class="error">'.$error.'</p>';
												}
											}
											?>
						
		
                        <div>
                            <button class="btn btn-default" type="submit" name="submit" value="Sign Up">Sign Up</button> <!-- Send button -->
                        </div>
                    </form>
                </div>
            </div> <!-- End Row -->
                                <center><h3>Already a User? <a href="login.php"><b>Login</b></a></h3></center>
        </div><!-- End Container -->


  </body>
</html>