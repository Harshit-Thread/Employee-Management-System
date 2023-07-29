<?php
session_start();
// error_reporting(0);
include('includes/dbconnection.php');
$id = $_POST['employeeid'];
$date = $_POST['date'];
$cnt=0;
$qry = "INSERT INTO `employee`.`empattendace` VALUES($id,'$date');";
$checkqry = "SELECT `Date` FROM `employee`.`empattendace` WHERE `EmpID`=$id;";
$res = $con->query($checkqry);
$rows = mysqli_num_rows($res);

if($rows>0){
while($data = mysqli_fetch_assoc($res)){
    if($date == $data['Date']){
        $cnt = 1;
    }
}
}

if($cnt==0){
if($con->query($qry)){
    $msg="Attendace Marked Successfully";
    header("location:markattendance.php?msg=".$msg);
}
else{
    $msg="Attendace Marked Failed";
    header("location:markattendance.php?msg=".$msg);
}

}
else{
    $msg="Attendace Already Marked For Today";
    header("location:markattendance.php?msg=".$msg);
}

?>