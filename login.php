<!-- Form fields
User Name/Email address
Password
  -->
<?php
include "./Partials/dbcon.php";
$login = false;
$logerror = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["uname"];
    $pass = $_POST["pass"];
    $sql = "SELECT role , id FROM mgmnt WHERE username = '$username' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    $num = $result->num_rows;
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            // if (password_verify($pass, $row['pass'])){
            $login = true;
            // $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $row['role'];
            $_SESSION['id'] = $row['id'];

            header("Location: Welcom.php");
            exit;
        }
    } else {
        $logerror = "Invalid Credentials";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .container-flex {
            display: block;
            margin-right: 200px;
            margin-left: 320px;
            margin-top: 120px;
            width: 650px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mgmnt</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./user_reg.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-flex">
        <div class="card">
            <div class="card-header">
                Login
            </div>
            <div class="card-body">
                <h1 class="card-title" style="text-align:center;">
                    Please Login to Continue
                </h1>
                <form action="" method="post">
                    <div class="form-floating mb-3">
                        <input name="uname" type="text" class="form-control" id="floatingInput"
                            placeholder="name@example.com" required>
                        <label for="floatingInput">User Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="pass" type="password" class="form-control" id="floatingPassword"
                            placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">Login</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    -->
</body>

</html>