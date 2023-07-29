<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{


if(isset($_POST['submit']))
  {
    $eid=$_SESSION['uid'];
      $emp1name=$_POST['emp1name'];
    $emp1des=$_POST['emp1des'];
    $emp1ctc=$_POST['emp1ctc'];
    $emp1wd=$_POST['emp1workduration'];
    $emp2name=$_POST['emp2name'];
    $emp2des=$_POST['emp2des'];
    $emp2ctc=$_POST['emp2ctc'];
    $emp2wd=$_POST['emp2workduration'];
    $emp3name=$_POST['emp3name'];
    $emp3des=$_POST['emp3des'];
    $emp3ctc=$_POST['emp3ctc'];
    $emp3wd=$_POST['emp3workduration'];
    
     $query=mysqli_query($con, "insert into empexpireince ( EmpID,Employer1Name, Employer1Designation, Employer1CTC,  Employer1WorkDuration, Employer2Name,  Employer2Designation, Employer2CTC, Employer2WorkDuration, Employer3Name, Employer3Designation, Employer3CTC, Employer3WorkDuration) value('$eid','$emp1name', '$emp1des', '$emp1ctc', '$emp1wd', '$emp2name', '$emp2des', '$emp2ctc', '$emp2wd', '$emp3name', '$emp3des', '$emp3ctc', '$emp3wd' )");
    if ($query) {
    $msg="Your Expirence data has been submitted succeesfully.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
    }
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
          <h1 class="h2 mb-4 text-gray-800">Employees Task Details</h1>
          <hr>

<p style="font-size:16px; color:red" align="center"> <?php 
$msg = $_GET['msg'];
if($msg){
    echo $msg;
  }  ?> </p>

<form action="assigntasksuccessfull.php" method="post">
<h3 class="h4 mb-4 text-gray-800">Assign task to employee</h3>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Employee ID</label>
    <input type="text" class="form-control" name="employeeid" required="required">
  </div>

  <div class="mb-3">
  <label for="exampleInputEmail1" class="form-label">Choose Task </label>
  <select class="form-select form-select-md" aria-label=".form-select-md example" name="task" required="required">
  <option selected>Choose Task</option>
  <option value="Create a website">Create a website</option>
  <option value="Create a div">Create a div</option>
  <option value="Call client">Call client</option>
  <option value="Update Database">Update Database</option>
</select>
  </div>

 

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Deadline</label>
    <input type="date" class="form-control" name="deadline" aria-describedby="emailHelp" required="required">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<hr>
<h3 class="h4 mb-4 text-gray-800">Task Assigned Information</h3>

 <div class="table-responsive mt-3">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

<tr>
  <th>S no.</th>
  <th>Employee Id</th>
  <th>Employee Name </th>
  <th>Task Information</th>
  <th>Deadline</th>
  <th>Status</th>
  <th>Resolved Date</th>

</tr>

<?php
$ret=mysqli_query($con,"select * from emptask;");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
$emplyid = $row['EmpID'];
$qry = "select EmpFname,EmpLName from employeedetail where `ID`=$emplyid;";
$res = $con->query($qry);
while($name = mysqli_fetch_assoc($res)){
    $empname = $name['EmpFname']." ".$name['EmpLName'];
}
?>

<tr>
  <td><?php echo $cnt;?></td>
  <td><?php  echo $row['EmpID'];?></td>
  <td><?php  echo $empname?></td>
   <td><?php echo $row['Task'];?></td>
    <td><?php echo $row['Deadline'];?></td>
  <td><?php echo $row['Action'];?></td>
  <td><?php echo $row['Resolved'];?></td>


</tr>

<?php 
$cnt=$cnt+1;
}?>

</table>

</div>






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
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</html>
<?php }  ?>

