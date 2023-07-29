<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');

$id = $_POST['employeeid'];
$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
$reason = $_POST['reason'];

$qry = "select EmpFname,EmpLName from employeedetail where `ID`=$id;";
$res = $con->query($qry);
while($name = mysqli_fetch_assoc($res)){
    $empname = $name['EmpFname']." ".$name['EmpLName'];
}

$qry = "INSERT INTO `employee`.`empleave` (`EmpID`,`Name`,`start date`,`end date`,`Reason`)values($id,'$empname','$sdate','$edate','$reason');";

if($con->query($qry)){
    $msg = "Leave Applied Successfully";
    header("location:applyleave.php?msg=".$msg);
}
else{
    $msg = "Leave Applied Failed";
    header("location:applyleave.php?msg=".$msg);
}



?>