<?php
include "./Partials/dbcon.php";
include "./Partials/navbar.php";
if (isset($_GET['logout'])) {
    logout();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $ph = $_POST['ph'];
    $role = $_POST['role'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $existSql = "SELECT * FROM `mgmnt` WHERE username = '$username'";
    $result = mysqli_query($conn, $existSql);
    $numExist_row = mysqli_num_rows($result);
    if ($numExist_row > 0) {
        $showerror = "User Name already Exists";
    } else {
        $exists = false;
    }
    if (($pass == $cpass)) {
        $sql = "INSERT INTO `mgmnt` (`firstname`, `lastname`, `username`,`email`, `ph`,`role`, `pass`,`datetime`) VALUES ('$firstname', '$lastname', '$username','$email', '$ph','$role', '$pass', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $insert = true;
        }
    } else {
        $showerror = "Passwords not matched";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container-flex {
            display: block;
            margin-right: 200px;
            margin-left: 300px;
            margin-top: 30px;
            width: 650px;
            padding-bottom: 20px;
            margin-bottom: 20px;

        }
    </style>
</head>

<body>
    <div class="container-flex">
        <div class="card">
            <div class="card-header">
                Signup
            </div>
            <div class="card-body">
                <h1 class="card-title" style="text-align:center;">
                    Please Register to login
                </h1>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text">First Name</span>
                        <div class="form-floating">
                            <input name="fname" type="text" class="form-control" id="floatingInputGroup1"
                                placeholder="firstname">
                            <label for="floatingInputGroup1">First Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Last Name</span>
                        <div class="form-floating">
                            <input name="lname" type="text" class="form-control" id="floatingInputGroup1"
                                placeholder="lastname">
                            <label for="floatingInputGroup1">Last Name</label>
                        </div>
                    </div>
                    <div class="input-group mb-3 ">
                        <span class="input-group-text">@</span>
                        <div class="form-floating">
                            <input name="uname" type="text" class="form-control" id="floatingInputGroup1"
                                placeholder="username">
                            <label for="floatingInputGroup1">Username</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="form-floating">
                            <input name="email" type="email" class="form-control" placeholder="Email Address"
                                aria-label="Email Address" aria-describedby="basic-addon2" required>
                            <label for="floatingInputGroup1">Email</label>
                        </div>
                        <span class="input-group-text" id="basic-addon2">example@mail.com</span>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Ph #</span>
                        <div class="form-floating">
                            <input name="ph" type="text" class="form-control" id="floatingInputGroup1"
                                placeholder="Username">
                            <label for="floatingInputGroup1">Phone</label>
                        </div>
                    </div>
                    <div class='input-group mb-3'>
                        <select name='role' class='form-select' id='inputGroupSelect02' readonly>
                            <option value='client' selected>Client</option>
                        </select>
                        <label class='input-group-text' for='inputGroupSelect02'>Role</label>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password</span>
                        <div class="form-floating">
                            <input name="pass" type="password" class="form-control" id="floatingInputGroup1"
                                placeholder="pass">
                            <label for="floatingInputGroup1">Password</label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Confirm Password</span>
                        <div class="form-floating">
                            <input name="cpass" type="password" class="form-control" id="floatingInputGroup1"
                                placeholder="pass">
                            <label for="floatingInputGroup1">Confirm Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register </button>
                    <span style="float:right">Already member? <a href="?logout=1">Login here</a></span>
                </form>
            </div>
        </div>
    </div>
</body>
</html>