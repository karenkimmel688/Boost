<!------ Author Carlos Rebollar "Delete Listings" ------>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start the session
//Checks to see if a session already exists by looking for the presence of a session ID
session_start();
//Connect to the database
$pdo = new PDO("sqlite:/www/boost/Boost/BOOST.DB");

$ListingID=$_GET['ID'];
$delete_query = "DELETE FROM LISTINGS WHERE ListingID = '$ListingID'";
$delete_result = $pdo->query($delete_query);

if ($delete_result) {
    echo "Record deleted successfully";
}
 else {
    echo "Error deleting record: ";
} 
header("Location: MyListing.php");
?>
