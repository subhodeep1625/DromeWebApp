<?php  
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "dromedb";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `drome` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
    // Update the record
    $sno = $_POST["snoEdit"];
    $mailid = $_POST["mailidEdit"];
    $phonenumber = $_POST["phonenumberEdit"];

    // Sql query to be executed
    $sql = "UPDATE `drome` SET `mailid` = '$mailid' , `phonenumber` = '$phonenumber' WHERE `drome`.`sno` = $sno";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $cid = $_POST["cid"];
    $cname = $_POST["cname"];
    $mailid = $_POST["mailid"];    
    $phonenumber = $_POST["phonenumber"];
    $bid = $_POST["bid"];
    $lid = $_POST["lid"];
    $dsid = $_POST["dsid"];

  // Sql query to be executed
  $sql = "INSERT INTO `drome` (`cid`, `cname`, `mailid`, `phonenumber`, `bid`, `lid`, `dsid`) VALUES ('$cid', '$cname', '$mailid', '$phonenumber', '$bid', '$lid', '$dsid')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>

<!-- HTML Part -->

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


  <title>Drome Website</title>
  <style>
  @import url(https://fonts.googleapis.com/css?family=Exo:100);
  $bg-width: 5px;
  $bg-height: 5px;

  /* Animations */
  @-webkit-keyframes bg-scrolling-reverse {
    100% { background-position: $bg-width $bg-height; }
  }
  @-moz-keyframes    bg-scrolling-reverse {
    100% { background-position: $bg-width $bg-height; }
  }
  @-o-keyframes      bg-scrolling-reverse {
    100% { background-position: $bg-width $bg-height; }
  }
  @keyframes         bg-scrolling-reverse {
    100% { background-position: $bg-width $bg-height; }
  }

  @-webkit-keyframes bg-scrolling {
    0% { background-position: $bg-width $bg-height; }
  }
  @-moz-keyframes    bg-scrolling {
    0% { background-position: $bg-width $bg-height; }
  }
  @-o-keyframes      bg-scrolling {
    0% { background-position: $bg-width $bg-height; }
  }
  @keyframes         bg-scrolling {
    0% { background-position: $bg-width $bg-height; }
  }

  /* Main styles */
  body {    
    color: black;
    font: 400 16px/1.5 exo, ubuntu, "segoe ui", helvetica, arial, sans-serif;
    text-align: center;
    background: #E0FFFF;
    background-image: url('drone-flying.gif');
    
    -webkit-animation: bg-scrolling-reverse .92s infinite; 
    -moz-animation:    bg-scrolling-reverse .92s infinite; 
    -o-animation:      bg-scrolling-reverse .92s infinite; 
    animation:         bg-scrolling-reverse .92s infinite; 
    -webkit-animation-timing-function: linear;
    -moz-animation-timing-function:    linear;
    -o-animation-timing-function:      linear;
    animation-timing-function:         linear;
    
    &::before {
      content: "INFINITY";
      font-size: 10rem;
      font-weight: 100;
      font-style: normal;
    }
}
  </style>


</head>
<body>
  
  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/My_Workspace/DromeProject/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="mailid">Email ID</label>
              <input type="text" class="form-control" id="mailidEdit" name="mailidEdit" aria-describedby="emailHelp">
            </div>

            <div class="form-group">
              <label for="phonenumber">Phone Number</label>
              <input type="number" class="form-control" id="phonenumberEdit" name="phonenumberEdit">
            </div> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

    <!--Nav bar-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- drome logo -->
    <a class="navbar-brand" href="#"><img src="https://i.gifer.com/KaqG.gif" height="35px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Droame Booking Portal<span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Let's See The Records</button>
      </form>
    </div>
  </nav>

  <?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your record has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your record has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your record has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>

    <!-- Conatiner class -->
    <div class="container my-4">
        <h1><u>Customer Records</u></h1>
        <form action="/My_Workspace/DromeProject/index.php" method="POST">
        <div class="form-group">
            <label for="cid"><h4>Customer ID</h4></label>
            <input type="text" class="form-control" id="cid" name="cid" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="cname"><h4>Customer Name</h4></label>
            <input type="text" class="form-control" id="cname" name="cname" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="mailid"><h4>Email ID</h4></label>
            <input type="text" class="form-control" id="mailid" name="mailid" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="phonenumber"><h4>Phone Number</h4></label>
            <input type="text" class="form-control" id="phonenumber" name="phonenumber" aria-describedby="">
        </div>
        <hr>
        <hr>

        <h1><u>Booking Records</u></h1>
        <div class="form-group">
            <label for="bid"><h4>Booking ID</h4></label>
            <input type="text" class="form-control" id="bid" name="bid" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="lid"><h4>Location ID</h4></label>
            <input type="text" class="form-control" id="lid" name="lid" aria-describedby="">
        </div>
        <div class="form-group">
            <label for="dsid"><h4>Drone Shot ID</h4></label>
            <input type="text" class="form-control" id="dsid" name="dsid" aria-describedby="">
        </div>
        <button type="submit" class="btn btn-primary">Insert</button>
        </form>
    </div>
    <hr>


    <!-- Table container class -->
  <div class="container my-4">
  <h1><u>All Records</u></h1>
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Customer ID</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Email ID</th>
          <th scope="col">Phone Number</th>
          <th scope="col">Booking ID</th>
          <th scope="col">Location ID</th>
          <th scope="col">Drone Shot ID</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `drome`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['cid'] . "</td>
            <td>". $row['cname'] . "</td>
            <td>". $row['mailid'] . "</td>
            <td>". $row['phonenumber'] . "</td>
            <td>". $row['bid'] . "</td>
            <td>". $row['lid'] . "</td>
            <td>". $row['dsid'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button><br> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>
      </tbody>
    </table>
  </div>
  <hr>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

  <!-- JavaScript Part -->
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        mailid = tr.getElementsByTagName("td")[2].innerText;
        phonenumber = tr.getElementsByTagName("td")[3].innerText;
        console.log(mailid, phonenumber);
        mailidEdit.value = mailid;
        phonenumberEdit.value = phonenumber;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete");
        sno = e.target.id.substr(1,);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/My_Workspace/DromeProject/index.php?delete=${sno}`;
        }
        else {
          console.log("no");
        }
      })
    })
  </script>
</body>
</html>
