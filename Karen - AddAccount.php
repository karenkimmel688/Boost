<?php
//Author Karen Kimmel "User Creates Account" 
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

//Start the session
//Checks to see if a session already exists by looking for the presence of a session ID
session_start();
//Connect to the database
$db = new PDO("sqlite:/www/boost/Boost/BOOST.DB");
/* try {
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
} */

if (isset($_POST['registration'])) {
    //Define variables
    $UserName = $_POST["UserName"];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST["Email"];
    $Password = $_POST['Password'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];

	//Check if email already exist. *HTML verifies that account info is answered so no if statement needed
        $query = "SELECT UserName FROM USERACCOUNT WHERE UserName ='$UserName'";
        $cresult = $db->prepare($query);
        $cresult->execute();
        $result = $cresult->fetch();
        $UserNameFound = $result["UserName"];
        if (!empty($UserNameFound)) {
            echo "<td colspan = 4 style = 'padding-top: 1%; padding-bottom: 1%; color: red; font-size:130%; text-align: center'><b>An account already exists for that Username!";
			/* header("Location: CreateAccount.html");  */
			exit();
        } 
		
		$query = "SELECT Email FROM USERACCOUNT WHERE Email ='$Email'";
        $cresult = $db->prepare($query);
        $cresult->execute();
        $result = $cresult->fetch();
        $EmailFound = $result["Email"];
		if (!empty($EmailFound)) {
            echo "<td colspan = 4 style = 'padding-top: 1%; padding-bottom: 1%; color: red; font-size:130%; text-align: center'><b>An account already exists for that Email address!";
			/* header("Location: CreateAccount.html");  */
			exit();
			
		   //Else create new account for user.
		} else {

    $query = "INSERT INTO USERACCOUNT (UserName, FirstName, LastName, Email, Pass, State, ZipCode) VALUES (:UserName, :FirstName, :LastName, :Email, :Pass, :State, :ZipCode)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(":UserName", $UserName); //Parameter for the specified variable.
    $stmt->bindParam(":FirstName", $FirstName); //Parameter for the specified variable.
    $stmt->bindParam(":LastName", $LastName); //Parameter for the specified variable.
    $stmt->bindParam(":Email", $Email); //Parameter for the specified variable.
    $stmt->bindParam(":Pass", $Password); //Parameter for the specified variable.
    $stmt->bindParam(":State", $State); //Parameter for the specified variable.
    $stmt->bindParam(":ZipCode", $ZipCode); //Parameter for the specified variable.

    $stmt->execute();
	header("Location: PracMainPage.html"); 
		}
}
?> 
