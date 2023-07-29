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
          <h1 class="h3 mb-4 text-gray-800">Pending Leave Record</h1>

<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>



 <div class="table-responsive">

 <table class="table table-striped table-hover mt-3">
  <thead>
    <tr>
      <th scope="col">S. No</th>
      <th scope="col">Leave Code</th>
      <th scope="col">Employee Id</th>
      <th scope="col">Employee Name</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col">Reason</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>

  <?php 
  $id = $_SESSION['uid'];
  $k=1;
  $qry = "SELECT * FROM `employee`.`empleave`;";
  $res = $con->query($qry);
  while($data = mysqli_fetch_assoc($res)){
  echo"
    <tr id=$k>
      <td>$k</td>
      <td class='row-data'>".$data['Leave Code']."</td>
      <td class='row-data'>".$data['EmpID']."</td>
      <td class='row-data'>".$data['Name']."</td>
      <td class='row-data'>".$data['start date']."</td>
      <td class='row-data'>".$data['end date']."</td>
      <td class='row-data'>".$data['Reason']."</td>
      <td class='row-data'>"; if($data['action']=="Pending"){
        $lc = $data['Leave Code'];
        echo " <button type='button' onclick='accept($lc)' class='btn btn-primary'>Accepted</button>";
        echo " <button type='button' onclick='decline($lc)' class='btn btn-danger'>Declined</button>";

      }
      else{
        if($data['action']=="Declined"){
            echo "<p class='text-primary'>Declined</p>";
        }
        else{
            echo "<p class='text-primary'>Accepted</p>";
        }
      }
      
      echo "</td>
    </tr>";
$k=$k+1;
  }
    ?>

    
  </tbody>
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
<?php }  ?>



