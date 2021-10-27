<!------ Author Karen Kimmel "My Listings" ------>
<!DOCTYPE html>
<html>
    <head>
	<html lang="en" dir="ltr">
	<meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200&display=swap" rel="stylesheet"/>
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="MyListing.css" />
		<!-- This specifies tab title of the page. -->
        <title>Boost | My Listings</title>	
    </head>
<body>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a>BOOST</a></div>
      <div class="nav-links">
        <ul class="links">
          <li><a href="PracMainPage.html">Home</a></li>
          <li>
            <a href="#">Account</a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="ManageAccount.html">Manage Account</a></li>
			  <li><a href="MyListing.php">My Listings</a></li>
              <li><a href="AddListing.html">Add Listings</a></li>
              <li><a href="Notification.html">Notifications</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
          <li><a href="#">Messages</a></li>
        </ul>
      </div>
      </div>
  </nav>
       <table>
            <tr>
                <th>Listing ID</th>
                <th>Vehicle Price</th>
                <th>Vehicle Model</th>
                <th>Vehicle Make</th>
		        <th>Action</th>
            </tr> 
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start the session
//Checks to see if a session already exists by looking for the presence of a session ID
session_start();
//Connect to the database
$pdo = new PDO("sqlite:/www/boost/Boost/BOOST.DB");
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

//Active Session when user logs in
$UserName = $_SESSION["ActiveUser"];

//SELECT for LISTINGS table
$query = "SELECT ListingID, VehiclePrice, VehicleModel, VehicleMake FROM LISTINGS WHERE UserName= '$UserName'";
$result = $pdo->query($query);

//Fetch info from the DB
while ($row = $result->fetch()) {
    echo "
	<tr>
	<td>" . $row["ListingID"] . "</td>
	<td>" . $row["VehiclePrice"] . "</td>
	<td>" . $row["VehicleModel"] . "</td>
	<td>" . $row["VehicleMake"] . "</td>
	<td><a href = 'DeleteListing.php?ID=$row[ListingID]'>Delete</td>
	</tr>
	"; // end echo	
} //end while
echo "</table>";
?>
	</body>
</html>
