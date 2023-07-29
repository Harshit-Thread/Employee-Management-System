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
        echo " <button type='button' onclick='accept($lc)' class='btn btn-primary'>Completed</button>";
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