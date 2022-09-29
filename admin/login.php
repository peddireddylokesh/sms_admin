<?php
include 'config.php';

$msg = '';
session_start();
if (isset($_SESSION['name']) && isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'ADMIN') {
    header('location: student.php');
}
if (isset($_POST['submit'])) {
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = md5($_POST['password']);


        $sql = "SELECT * FROM `admin` WHERE `email`='$name' AND `password` ='$password'";
        $result = mysqli_query($conn, $sql) or die(mysqli_error());
        if ( mysqli_num_rows($result) > 0) {
            $response = mysqli_fetch_array($result);

            $_SESSION['name'] = $response['name'];
            $_SESSION['email'] = $response['email'];
            $_SESSION['account_type'] = $response['account_type'];
            if ($_SESSION['account_type'] == 'ADMIN') {
                header('location:student.php');
            }else{
                $msg = '<span class="text-danger">Your are not admin</span>';
            }
        } else {
            $msg = '<span class="text-danger">Invalid credentials</span>';
        }
    }
}

?>
<html lang="en">
<head><title>STUDENT MANAGEMENT SYSTEM</title>

    <!------ Including CSS and SCRIPT  In HEAD tag ---------->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/custom.css" rel="stylesheet">
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/jquery.min.js"></script>
    <style>
        .container {
            position: absolute;
            margin-top: 100px;
        }
        h1
        {
            color: black;
        }
    </style>

</head>
<body class="gradient-custom-background">

<div class="container">
    <div class="wrapper"><h1><strong>SCHOOL MANAGEMENT SYSTEM</strong></h1></div>
</div>

<div class="gradient-custom form-login" >
    <form action="" method="post" name="login">
        <h4>ADMIN LOGIN</h4>

        <div class="form-outline ">
            <input type="text" id="name" name="name" class="form-control" placeholder="username">
            </br></div>
        <div class="form-outline ">
            <input type="password" id="Password" name="password" class="form-control" placeholder="password">
            </br></div>
        <div class="wrapper">
            <span class="group-btn">
      <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </span>
        </div>
    </form><span style="color: #ff0814"><?php echo $msg; ?></span>
</div>
</body>
</html>