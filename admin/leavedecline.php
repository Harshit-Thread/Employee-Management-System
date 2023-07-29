<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$lc = $_POST['LC'];

$qry = "UPDATE `employee`.`empleave` SET `action`='Declined' WHERE `Leave Code`=$lc;";

if($con->query($qry)){
    echo json_encode("Success");
}
else{
    echo json_encode("Failed");
}



?>