<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');

$empid =intval($_POST['employeeid']);
$deadline = $_POST['deadline'];
$task = $_POST['task'];
echo $empid;
$qry = "INSERT INTO `employee`.`emptask`(`EmpID`,`Deadline`,`Task`) VALUES($empid,'$deadline','$task');";
if($con->query($qry)){
    $msg = "Task Assigned Successfully";
    header("location:assigntask.php?msg=".$msg);
}
else{
    $msg = "Task Assigned Failed";
    header("location:assigntask.php?msg=".$msg);
}



?>