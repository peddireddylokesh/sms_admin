<?php
require 'admin/config.php';
$admission_number_err = $admission_number = $dob = $dob_err = '';
$search = $search_err = false;
$row = array();
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (isset($_POST['admission_number']) && !empty($_POST['admission_number'])) {
        $admission_number = trim($_POST['admission_number']);
    } else {
        $admission_number_err = 'Admission number is required';
    }
    if (isset($_POST['dob']) && !empty($_POST['dob'])) {
        $dob = trim($_POST['dob']);
    } else {
        $dob_err = 'DOB is required';
    }
    if (empty($admission_number_err) && empty($dob_err)) {
        $query = "SELECT * FROM `students` WHERE `admission_number` = '$admission_number ' AND `dob` = '$dob'";
        $query_run = mysqli_query($conn, $query);
        if (mysqli_num_rows($query_run) > 0) {
            $search = true;
            $row = mysqli_fetch_array($query_run);
        } else {
            $search_err = true;
            $row = ['error' => 'No Data Found'];
        }
    }

}

?>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    <script src="dist/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/jquery.min.js"></script>
    <style>
        .container {
            margin-top: 2em !important;
        }

        .btn-primary {
            border-radius: 20px;
        }
        .gradient-custom {
            background: #f6d365;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
        }
        img
        {
            border-radius: 10px;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-sm gradient-custom navbar-dark " >
    <div class="container-fluid">
        <a  class="navbar-brand" href="index.php">
            <strong  class="text-dark">Student Management System</strong>
        </a>
    </div>
<!--    <div class="me-lg-3"><a class="navbar-brand" href="#">Welcome Back</a></div>-->
</nav>


<div class="container">
    <form action="" method="post" name="info">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <label for="admission number"><strong>Enter Admission Number</strong></label>
                <input type="text" class="form-control" placeholder="Enter admission number" name="admission_number">
                <span class="text-danger"><?= $admission_number_err ?></span>
            </div>
            <div class="col-sm-3">
                <label for="admission number"><strong>Select Date Of Birth Here</strong> </label>

                <input type="date" class="form-control" placeholder="select date" name="dob">
                <span class="text-danger"><?= $dob_err ?></span>
            </div>
            <div class="col-lg-2 mt-4">
                <input type="submit" name="submit" value="submit" class="btn btn-primary ">
            </div>
    </form>
</div>
<div class="col-lg-2 mt-2 <?php echo $search_err ? 'show' : 'toast hide'; ?>">
    <?=$row['error']?>
</div>
<section style="background-color: #f4f5f7;" class="<?php echo $search ? 'show' : 'toast hide'; ?>">
    <div class="row d-flex justify-content-center align-items-center pt-3 ">
        <div class="col col-lg-10 mb-4 mb-lg-0">
            <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center text-white " style="border-radius: 0.5rem">
                        <img src="upload/<?= $row['img'] ?>"
                             alt="Avatar" class="img-fluid my-5" style="max-height:300px"  />
                        <h3 class="text-dark"><?= strtoupper($row['name']) ?></h3>

                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <h6><strong>Information</strong></h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-2">
                                    <h6>Gender</h6>
                                    <p class="text-muted"><?= $row['gender'] ?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Phone</h6>
                                    <p class="text-muted"><?= $row['mobile_number'] ?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Date Of Birth</h6>
                                    <p class="text-muted"><?= $row['dob'] ?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>City</h6>
                                    <p class="text-muted"><?= $row['city'] ?></p>
                                </div>

                            </div>
                            <div class="col-6 mb-2">
                                <h6>State</h6>
                                <p class="text-muted"><?= $row['state'] ?></p>
                            </div>
                            <h6><strong> Center Details </strong></h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-2">
                                    <h6>Center Code</h6>
                                    <p class="text-muted"><?=$row['center_code']?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Registration Date</h6>
                                    <p class="text-muted"><?=$row['registration_date']?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Course</h6>
                                    <p class="text-muted"><?=$row['course']?></p>
                                </div>
                                <div class="col-6 mb-2">
                                    <h6>Batch</h6>
                                    <p class="text-muted"><?=$row['batch']?></p>
                                </div>

                                <div class="col-6 mb-2">
                                    <h6>Admission Number</h6>
                                    <p class="text-muted"><?=$row['admission_number']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<?php //include "../admin/student.php"; ?>
</body>
</html>