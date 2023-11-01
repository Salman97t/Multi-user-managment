<?php
$update = false;
$delete = false;
include "./Partials/dbcon.php";
include "./Partials/navbar.php";
if (!isset($_SESSION['username'])) {
  header("location: login.php");
  exit;
}
$role = $_SESSION['role'];
// udate record
if (isset($_POST['edid'])) {
  $id = $_POST['edid'];
  $Firstname = $_POST['edfname'];
  $Lastname = $_POST['edlname'];
  $Email = $_POST['edemail'];
  $Ph = $_POST['ednumber'];
  $sql = "UPDATE `mgmnt` SET `firstname` = '$Firstname', `lastname` = '$Lastname', `email` = '$Email', `ph` = '$Ph' WHERE `mgmnt`.`id` = $id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $update = true;
  }
}
//delete record
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM `mgmnt` WHERE `mgmnt`.`id` = $id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $delete = true;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous">
    </script>
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">
  </script>
  <script type="text/javascript">
    // Disable the back button
    history.pushState(null, null, document.URL);
    window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
    });
    // Add an event listener to the Logout button
    document.getElementById('logoutButton').addEventListener('click', function () {
      // Redirect to the logout page or perform logout actions
      window.location.href = './login.php'; // Replace with your logout URL
    });
  </script>
  <style>
    .container-flex {
      margin-right: 3px;
      margin-left: 10px;
      padding-right: 10px;
      margin-top: 20px;
      width: 1275px;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
  </style>
  <title>Document</title>
</head>

<body>
  <?php
  if ($update) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Record has been updated.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }
  if ($delete) {
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success!</strong> Record has been deleted.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
  }
  echo "
    <center>
        <h1>
            Welcome $_SESSION[username]
        </h1>
    </center>";
  ?>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="./Welcom.php" method="post">
            <input type="hidden" name="edid" id="edid">
            <div class="row g-2">
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="edfname" name="edfname" placeholder="Your Name" required>
                  <label for="fname">First Name</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="edlname" name="edlname" placeholder="Father Name">
                  <label for="lname">Last Name</label>
                </div>
              </div>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="edemail" name="edemail" placeholder="name@example.com"
                required>
              <label for="email">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="edusername" name="edusername" placeholder="name@example.com"
                required readonly>
              <label for="edusername">User Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="edrole" name="edrole" placeholder="name@example.com" required
                readonly>

              <label for="edrole">Role</label>
            </div>
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="ednumber" name="ednumber" placeholder="Number" required>
              <label for="number">Phone No.</label>
            </div>
            <!-- <div class="form-floating mb-3">
                <input type="password" class="form-control" id="edpass" name="edpass" placeholder="Password" required>
                <label for="pass">Password</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="edCpass" name="edCpass" placeholder="Password" required>
                <label for="edCpass">Password</label>
              </div> -->
        </div>
        <div class="modal-footer d-block mr-4">
          <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->

  <!-- Table -->
  <div class="container-flex">
    <div class="table-responsive">
      <table class="table table-hover table-dark pt-3 pb-3" id="myTable">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">User Name</th>
            <th scope="col">Email</th>
            <th scope="col">Phone No.</th>
            <th scope="col">Role</th>
            <th scope="col">Date/Time</th>
            <?php

            if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'employee'|| $_SESSION['role'] == 'client') {
              echo "   <th scope='col'>Action</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin') {
            $sql = "SELECT * FROM  `mgmnt`";
          } elseif (isset($_SESSION['username']) && $_SESSION['role'] == 'client') {  
            $sql = "SELECT * FROM  `mgmnt` Where username = '$_SESSION[username]'";
          } elseif (isset($_SESSION['username']) && $_SESSION['role'] == 'employee') {
            $sql = "SELECT * FROM  `mgmnt` Where role = 'client' AND addby='$_SESSION[id]'";
          }
          $result = mysqli_query($conn, $sql);
          $id = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            // Into table
            $id = $id + 1;
            echo "<tr>
        <th scope='row'>" . $id . "</th>
        <td>" . $row['firstname'] . "</td>
        <td>" . $row['lastname'] . "</td>
        <td>" . $row['username'] . "</td>
        <td>" . $row['email'] . "</td>
        <td>" . $row['ph'] . "</td>
        <td>" . $row['role'] . "</td>
        <td>" . $row['datetime'] . "</td>
        <td>";
            if (isset($_SESSION['username']) && $_SESSION['role'] == 'admin' || $_SESSION['role'] == 'employee') {
              echo "
        <button type='button' class='edit btn btn-primary btn-sm' id=" . $row['id'] . " data-bs-toggle='modal' data-bs-target='#exampleModal'>Edit</button>
        <button type='button' class='delete btn btn-danger btn-sm' id=" . $row['id'] . " >Del</button>
        </td>";
            }
            elseif(isset($_SESSION['username']) && $_SESSION['role'] == 'client'){
              echo "<button type='button' class='edit btn btn-primary btn-sm'>Add Img</button> </td>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- Table -->
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script>
    let table = new DataTable('#myTable');
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>

  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        // console.log("edit",);
        tr = e.target.parentNode.parentNode;
        Firstname = tr.getElementsByTagName("td")[0].innerText;
        Lastname = tr.getElementsByTagName("td")[1].innerText;
        Username = tr.getElementsByTagName("td")[2].innerText;
        Email = tr.getElementsByTagName("td")[3].innerText;
        Ph = tr.getElementsByTagName("td")[4].innerText;
        role = tr.getElementsByTagName("td")[5].innerText;
        //   Pass = tr.getElementsByTagName("td")[5].innerText;
        console.log(Firstname, Lastname, Username, Email, Ph);
        edfname.value = Firstname;
        edlname.value = Lastname;
        edusername.value = Username;
        edemail.value = Email;
        ednumber.value = Ph;
        edrole.value = role;
        //   edpass.value = Pass;
        edid.value = e.target.id;
        console.log(e.target.id);
        //$('#myModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("delete",);
        id = e.target.id.substr(1,);
        if (confirm("Are u sure?")) {
          console.log("yes");
          window.location = `./Welcom.php?delete=${id}`;
        }
        else {
          console.log("no");

        }
      })
    })
  </script>
</body>

</html>