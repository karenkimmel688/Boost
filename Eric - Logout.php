<?php
// Session Initialized.
session_start();
$db = new PDO("sqlite:/www/boost/Boost/BOOST.DB");

// Unset session variables
unset($_SESSION['ActiveUser']);
// Session destroyed.
session_destroy();

// After logging out you're redirected to
// the Home page.
header("location: LandingP.html");
?>
