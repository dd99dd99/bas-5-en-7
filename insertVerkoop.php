<?php

include "classes/InkooporderForm.php";
include 'classes/inkoop.php';

$db = new Database();
$form = new InkooporderForm($db);
$form->generateForm();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $levId = $_POST["leverancier"];
    $artId = $_POST["artikel"];
    $aantal = $_POST["aantal"];

    $inkoop = new Inkoop();
    $inkoop->insertInkoop($conn, $levId, $artId, $aantal);

}

	//if(isset($_POST['submit'])){
	//	include "conn.php";
	//	include 'classes/verkoop.php';
	//	$conn = dbConnect();




		//$klantId = $_POST['$klant[klantId]'];
		//$artId = $_POST['artId'];
		//$aantal = $_POST['Aantal'];

		//$verkoop = new Verkoop();
		//$verkoop->insertVerkoop($conn, $klantId, $artId, $aantal);
	//}

	if(isset($inkoop) && $inkoop == true){
		echo '<script>alert("InkoopOrder toegevoegd")</script>';
        echo "<script> location.replace('index.php'); </script>";
	}

?>