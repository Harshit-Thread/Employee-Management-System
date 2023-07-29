<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
//error_reporting(0);
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{


if(isset($_POST['submit']))
  {
    $eid=$_SESSION['uid'];
    $holdername=$_POST['holdername'];
  $bankname=$_POST['bankname'];
  $ifsc=$_POST['ifsccode'];
  $branchname=$_POST['branchname'];
  $accno=$_POST['accnumber'];
  
  
   $query=mysqli_query($con, "UPDATE empbankdetails SET `Holder Name`='$holdername',`Account Number`='$accno',`Bank Name`='$bankname',`IFSC`='$ifsc',`Branch Name`='$branchname' WHERE `EmpID`=$eid;");
  if ($query) {
  $msg="Your Bank Details data has been submitted successfully.";
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

  <title>Edit My Expirence</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
          <h1 class="h3 mb-4 text-gray-800">Edit My Bank Details</h1>

<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>

<form class="user" method="post" action="">
  <?php
 $empid=$_SESSION['uid'];
$ret=mysqli_query($con,"select * from empbankdetails where EmpID='$empid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
                <div class="row">
                <div class="col-4 mb-3">Account Holder name</div>
                   <div class="col-8 mb-3">   <input type="text" class="form-control form-control-user" id="emp1name" name="holdername" aria-describedby="emailHelp" value="<?php  echo $row['Holder Name'];?>"></div>
                    </div>  

                    <div class="row">
                      <div class="col-4 mb-3">Account Number</div>
                     <div class="col-8 mb-3">  <input type="text" class="form-control form-control-user" id="emp1des" name="accnumber" aria-describedby="emailHelp" value="<?php  echo $row['Account Number'];?>"></div>  
                     </div>


                    <div class="row">
                      <div class="col-4 mb-3">Bank Name </div>
                     <div class="col-8 mb-3">  <input type="text" class="form-control form-control-user" id="emp1des" name="bankname" aria-describedby="emailHelp" value="<?php  echo $row['Bank Name'];?>"></div>  
                     </div>



                    <div class="row">
                    <div class="col-4 mb-3">IFSC Code</div>
                    <div class="col-8 mb-3">
                      <input type="text" class="form-control form-control-user" id="emp1ctc" name="ifsccode" aria-describedby="emailHelp" value="<?php  echo $row['IFSC'];?>"></div>
                    </div>

                    <div class="row">
                      <div class="col-4 mb-3">Branch Name</div>
                     <div class="col-8 mb-3">
                      <input type="text" class="form-control form-control-user" id="emp1workduration" name="branchname" aria-describedby="emailHelp" value="<?php  echo $row['Branch Name'];?>">
                    </div></div>

                    <div class="row" style="margin-top:4%">
                      <div class="col-4"></div>
                      <div class="col-4">
                      <input type="submit" name="submit"  value="submit" class="btn btn-primary btn-user btn-block">
                    </div>
                    </div>
                   
                    
                  
                  </form>





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
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  <script type="text/javascript">
    $(".jDate").datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
}).datepicker("update", "10/10/2016"); 
  </script>

</body>

</html>
<?php } 
} ?>
