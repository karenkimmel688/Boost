<?php
//Author Karen Kimmel "User Login PHP" 
//Start the session
//Checks to see if a session already exists by looking for the presence of a session ID
session_start();
/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

//Variable to store incorrect details when trying to login.
$message="";
//Connect to the database
$db = new PDO("sqlite:/www/boost/Boost/BOOST.DB");
//isset function checks if the argument variable exists or "is set"
if (isset($_POST['Email']) && isset($_POST['Password'])) {
    
    //Define variables
    $Email  = $_POST['Email'];
    $Password= $_POST['Password'];
    
    $query = "SELECT * FROM USERACCOUNT WHERE Email='$Email' AND Pass='$Password'";
	$cresult = $db->prepare($query);
	$cresult->execute();
	$result = $cresult->fetch(); //Fetche the next row from a result set.
	$UserNamephp = $result["UserName"];

   if (!empty($result)) {
        $_SESSION['ActiveUser'] = $UserNamephp;
		header("Location: PracMainPage.html"); 
    } else {
		$message = "Incorrect Email or Password Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
   <meta charset="utf-8"/>
   <meta name="viewport" content="width-device-width, initial-scale=1.0"/>
   <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200&display=swap" rel="stylesheet"/>
   <link rel="stylesheet" href="LoginPage.css">
   <head>
      <title>Boost | Login</title>
      <!-- This specifies tab title of the page. -->
      <!-- Menu Bar. -->
      <nav class="navbar">
         <a class="nav-logo">Boost</a>
         <ul>
            <li><a href="LandingP.html">Home</a></li>
            <li><a href="About.html">About</a></li>
            <li><a href="Contact.html">Contact</a></li>
         </ul>
      </nav>
   </head>
   <body>
      <div class="container">
         <div class="title">Login</div>
         <!------ Login Form ------>
         <form method="post" action="Login.php" enctype="multipart/form-data">
            <div class="user-details">
               <!------ Email Here ------>
               <div class="input-box">
                  <span class="details">Email</span>
                  <input type="text" name="Email" placeholder="Enter Email" id="Email" required />
               </div>
               <!------ Password Here ------>
               <div class="input-box">
                  <span class="details">Password</span>
                  <input type="text" name="Password" placeholder="Enter Password" id="Password" required />
               </div>
            </div>
            <!------ Incorrect message Details Here ------>
			<div class="message-details"><?php if($message!="") {echo $message;}?></div>
			<!------ Forgot Password Here ------>
            <div class="forgot-password"><a href="ResetPassword.html"> Forgot Password?</a></div>
            <!------ SignUp-Link Here ------>
            <div class="SignUp-Link">Not a member? <a href="CreateAccount.html">Signup</a></div>
            <!------ Login Button Here ------>
            <div class="button">
               <input type="submit" name="registration" id="register" value="Login">
            </div>
         </form>
      </div>
   </body>
</html>
