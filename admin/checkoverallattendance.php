<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Employees Details</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
  <?php include_once('includes/sidebar.php')?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
         <?php include_once('includes/header.php')?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->


<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>


<form action="" method="post">

<h1 class="h3 mb-3">Select Employee ID</h1>
<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="empid" required="required">
  <option selected>Open this select menu</option>
 <?php
 $qry = "SELECT `ID` FROM `employee`.`employeedetail`;";
 $res = $con->query($qry);

 while($data = mysqli_fetch_assoc($res)){
    $qry = "select EmpFname,EmpLName from employeedetail where `ID`=".$data['ID'].";";
  $res1 = $con->query($qry);
  while($name = mysqli_fetch_assoc($res1)){
      $empname = $name['EmpFname']." ".$name['EmpLName'];
  }
    echo"
    <option value=".$data['ID'].">".$data['ID']." $empname</option>";
 }
 ?>
</select>

<button type="submit" class="btn btn-primary mt-3 mb-3" name="checkatt">Check Attendance</button></a>

</form>



<?php


if(isset($_POST['checkatt']))
  {

    echo "<table class='table table-striped table-hover'>
<thead>
  <tr>
    <th scope='col'>S No.</th>
    <th scope='col'>Employee ID</th>
    <th scope='col'>Employee Name</th>
    <th scope='col'>Date</th>
  </tr>
</thead>
<tbody>";

$id = $_POST['empid'];
$qry = "SELECT * FROM `employee`.`empattendace` WHERE `EmpID`=$id;";
$res = $con->query($qry);
$k=1;
while($data = mysqli_fetch_assoc($res)){
    $qry = "select EmpFname,EmpLName from employeedetail where `ID`=$id;";
    $res1 = $con->query($qry);
    while($name = mysqli_fetch_assoc($res1)){
        $empname = $name['EmpFname']." ".$name['EmpLName'];
    }
    echo"
    <tr>
      <td>$k</th>
      <td>$id</td>
      <td>$empname</td>
      <td>".$data['Date']."</td>
    </tr>";
  $k=$k+1;  
}
echo "</tbody>
</table>";

  }

  ?>




        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
   <?php include_once('includes/footer.php');?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  
  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
<script>
    function accept(lc){
        $.ajax({
          url: 'leaveaccept.php',
          type: 'post',
          data: {LC:lc},
          success: function(response){
            //alert(response);
                    location.reload();
          },
          dataType:"json"
        });
    }

    function decline(lc){

        $.ajax({
          url: 'leavedecline.php',
          type: 'post',
          data: {LC:lc},
          success: function(response){
            //alert(response);
                    location.reload();
          },
          dataType:"json"
        });
    }
</script>

</html>
<?php  ?>



