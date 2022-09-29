<?php
ob_start();
if(!isset($_SESSION)){
    session_start();

}
if (!isset($_SESSION['name']) && !isset($_SESSION['account_type']) && $_SESSION['account_type'] != 'ADMIN') {
    header('location:login.php');
}
const BATCH = [
    '0' => 'Select Option', '2000-01' => '2000-01', '2001-02' => '2001-02', '2002-03' => '2002-03', '2003-04' => '2003-04', '2004-05' => '2004-05', '2005-06' => '2005-06', '2006-07' => '2006-07', '2007-08' => '2007-08', '2008-09' => '2008-09', '2009-10' => '2009-10', '2010-11' => '2010-11', '2011-12' => '2011-12', '2012-13' => '2012-13', '2013-14' => '2013-14', '2014-15' => '2014-15', '2015-16' => '2015-16', '2016-17' => '2016-17', '2017-18' => '2017-18', '2018-19' => '2018-19', '2019-20' => '2019-20', '2020-21' => '2020-21', '2021-22' => '2021-22'
];
?>

<html lang="en">
<head>
    <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <script src="../dist/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/jquery.min.js"></script>
    <title>SMS</title>
    <style>
        .navbar-brand{
            color: white;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-inverse bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="student.php"><h1><strong>SCHOOL MANAGEMENT SYSTEM</strong></h1></a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php" style="color: white"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
    </div>
</nav><br>
</body>
</html>