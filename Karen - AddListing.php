<?php
//Author Karen Kimmel "Seller Adds Listing"
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start the session
//Checks to see if a session already exists by looking for the presence of a session ID
session_start();
//Connect to the database
$pdo = new PDO("sqlite:/www/boost/Boost/BOOST.DB");

try
{
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}

if (isset($_POST['registration']))
{
    //Define variables
    $VehiclePrice = $_POST['VehiclePrice'];
    $VehicleModel = $_POST['VehicleModel'];
    $VehicleVIN = $_POST["VehicleVIN"];
    $VehicleMake = $_POST['VehicleMake'];
    $VehicleYear = $_POST['VehicleYear'];
    $VehicleExteriorColor = $_POST['VehicleExteriorColor'];
    $VehicleInteriorColor = $_POST['VehicleInteriorColor'];
    $VehicleBodyStyle = $_POST['VehicleBodyStyle'];
    $VehicleNumberofSeats = $_POST['VehicleNumberofSeats'];
    $VehicleSeatMaterial = $_POST['VehicleSeatMaterial'];
    $VehicleSeatType = $_POST['VehicleSeatType'];
    $VehicleNumberofDoors = $_POST['VehicleNumberofDoors'];
    $VehicleEngineType = $_POST['VehicleEngineType'];
    $VehicleDriveType = $_POST['VehicleDriveType'];
    $VehicleTransmission = $_POST['VehicleTransmission'];
    $VehicleSteering = $_POST['VehicleSteering'];
    $VehicleFuelType = $_POST['VehicleFuelType'];
    $VehicleMileage = $_POST['VehicleMileage'];
    $VehicleDesc = $_POST['VehicleDesc'];
    /* $VehiclePicPath1 = $_POST['VehiclePicPath1'];
    $VehiclePicPath2 = $_POST['VehiclePicPath2'];
    $VehiclePicPath3 = $_POST['VehiclePicPath3'];
    $VehiclePicPath4 = $_POST['VehiclePicPath4'];
    $VehiclePicPath5 = $_POST['VehiclePicPath5']; */

    //Creates unique id for database *NOTE: DATABASE ONLY ACCEPTS UNIQUE IDs AS IT IS A PRIMARY KEY
    $query = "SELECT MAX(ListingID) AS MaxListingID From LISTINGS";
    $cresult = $pdo->prepare($query);
    $cresult->execute();
    $result = $cresult->fetch();
    $lastListID = $result["MaxListingID"];
    $listID = 1 + $lastListID;

    //Active Session when user logs in
    $UserName = $_SESSION["ActiveUser"];

    //Adds Listing to the DATABASE
    $query = "INSERT INTO LISTINGS (ListingID, UserName, VehicleModel, VehicleVIN, VehicleMake, VehicleYear, VehicleDesc, VehicleExteriorColor, VehicleInteriorColor, VehicleBodyStyle, VehicleNumberofSeats, VehicleSeatMaterial, VehicleSeatType, VehicleNumberofDoors, VehicleEngineType, VehicleDriveType, VehicleTransmission, VehicleSteering, VehicleFuelType, VehicleMileage, VehiclePrice) 
	VALUES (:ListingID, :UserName, :VehicleModel, :VehicleVIN, :VehicleMake, :VehicleYear, :VehicleDesc, :VehicleExteriorColor, :VehicleInteriorColor, :VehicleBodyStyle, :VehicleNumberofSeats, :VehicleSeatMaterial, :VehicleSeatType, :VehicleNumberofDoors, :VehicleEngineType, :VehicleDriveType, :VehicleTransmission, :VehicleSteering, :VehicleFuelType, :VehicleMileage, :VehiclePrice)";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":ListingID", $listID); //Parameter for the specified variable.
    $stmt->bindParam(":UserName", $UserName); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleModel", $VehicleModel); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleVIN", $VehicleVIN); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleMake", $VehicleMake); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleYear", $VehicleYear); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleDesc", $VehicleDesc); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleExteriorColor", $VehicleExteriorColor); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleInteriorColor", $VehicleInteriorColor); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleBodyStyle", $VehicleBodyStyle); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleNumberofSeats", $VehicleNumberofSeats); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleSeatMaterial", $VehicleSeatMaterial); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleSeatType", $VehicleSeatType); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleNumberofDoors", $VehicleNumberofDoors); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleEngineType", $VehicleEngineType); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleDriveType", $VehicleDriveType); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleTransmission", $VehicleTransmission); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleSteering", $VehicleSteering); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleFuelType", $VehicleFuelType); //Parameter for the specified variable.
    $stmt->bindParam(":VehicleMileage", $VehicleMileage); //Parameter for the specified variable.
    $stmt->bindParam(":VehiclePrice", $VehiclePrice); //Parameter for the specified variable.
    $stmt->execute();
}
?> 

<?php
// If upload button is clicked ...
if (isset($_POST['registration']))
{

    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "/www/boost/Boost/Image" . $filename;

    //Get all the submitted data from the form (THIS IS NOT DOING ANYTHING)
    $query = "INSERT INTO LISTINGS (Images) VALUES (:filename)";
  
    $stmt = $pdo->prepare($query);

    //Uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder))
    {
        echo "Image uploaded successfully";
    }
    else
    {
        echo "Failed to upload image";
    }
}
header("Location: MyListing.php");
?>
