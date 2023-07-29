<?php
error_reporting(0);
include('includes/dbconnection.php');
$id = $_POST['id'];
$tc = $_POST['tc'];
date_default_timezone_set('Asia/Kolkata');
$date = date("Y/m/d");
$qry = "UPDATE `employee`.`emptask` SET `Action`='Completed',`Resolved`='$date' WHERE `EmpID`=$id and `taskcode`=$tc;";

if($con->query($qry)){
    echo json_encode("Success");
}
else{
    echo json_encode("Failed");

}



?>