<?php
include "header.php";
include 'config.php';

$nameErr = $dobErr = $cityErr = $stateErr = $genderErr = $mobileNumErr = $centerCodeErr = $registrationDateErr = $courseErr = $admissionNumberErr = $batchSelectionErr = "";
$msg = $edit_name = $edit_dob = $edit_mobile_num = $edit_city = $edit_state = $edit_gender = $edit_center_code = $edit_registration_date = $edit_course = $edit_admission_number = $edit_batch_selection = $edit_path = "";
$name = $gender = $dob = $mobile_num = $state = $city = $file = $center_code = $registration_date = $course = $admission_number = $batch_selection = $id = "";
$edit = false;
$sql_true = false;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $edit = true;
    $id = $_GET['id'];
    $get_sql = "SELECT * FROM `students` WHERE `id` = $id";
    $result = mysqli_query($conn, $get_sql) or die(mysqli_error());
    if (mysqli_num_rows($result) > 0) {
        $edit_row = mysqli_fetch_assoc($result);
        $edit_name = $edit_row['name'];
        $edit_dob = $edit_row['dob'];
        $edit_mobile_num = $edit_row['mobile_number'];
        $edit_city = $edit_row['city'];
        $edit_gender = $edit_row['gender'];
        $edit_state = $edit_row['state'];
        $edit_center_code = $edit_row['center_code'];
        $edit_registration_date = $edit_row['registration_date'];
        $edit_course = $edit_row['course'];
        $edit_admission_number = $edit_row['admission_number'];
        $edit_batch_selection = $edit_row['batch'];
        $edit_path = $edit_row['img'];
    }
}
function error_check($nameErr, $dobErr, $cityErr, $stateErr, $genderErr, $mobileNumErr, $centerCodeErr, $registrationDateErr, $courseErr, $admissionNumberErr, $batchSelectionErr)
{
    if (empty($nameErr) && empty($dobErr) && empty($cityErr) && empty($stateErr) && empty($genderErr) && empty($mobileNumErr) && empty($centerCodeErr) && empty($registrationDateErr) && empty($courseErr) && empty($admissionNumberErr) && empty($batchSelectionErr)) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    if (empty($_POST["student_name"])) {
        $nameErr = "Name is required";
    } else {
        $name = ($_POST["student_name"]);
    }

    if (empty($_POST["dob"])) {
        $dobErr = "DOB is required";
    } else {
        $dob = ($_POST["dob"]);
    }

    if (empty($_POST["mobile_number"])) {
        $mobileNumErr = "mobile number is required";
    } else {
        $mobile_num = ($_POST["mobile_number"]);
    }

    if (empty($_POST["city"])) {
        $cityErr = "city is required";
    } else {
        $city = ($_POST["city"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender = ($_POST["gender"]);
    }
    if (empty($_POST["state"])) {
        $stateErr = "State is required";
    } else {
        $state = ($_POST["state"]);
    }
    if (empty($_POST["center_code"])) {
        $centerCodeErr = "Center code is required";
    } else {
        $center_code = ($_POST["center_code"]);
    }
    if (empty($_POST["registration_date"])) {
        $registrationDateErr = "Registration date is required";
    } else {
        $registration_date = ($_POST["registration_date"]);
    }
    if (empty($_POST["course"])) {
        $courseErr = "Course is required";
    } else {
        $course = ($_POST["course"]);
    }
    if (empty($_POST["admission_number"])) {
        $admissionNumberErr = "Admission number is required";
    } else {
        $admission_number = ($_POST["admission_number"]);
    }
    if (empty($_POST["batch_selection"]) && $_POST["batch_selection"] == 0) {
        $batchSelectionErr = "Batch is required";
    } else {
        $batch_selection = ($_POST["batch_selection"]);
    }
    if ($_FILES['photo']['tmp_name']) {
        $rand_name = rand(1000, 100000);
        $file = $rand_name . "-" . $_FILES['photo']['name'];
        $file_loc = $_FILES['photo']['tmp_name'];
        $file_size = $_FILES['photo']['size'];
        $file_type = $_FILES['photo']['type'];
        $folder = "../upload/";
        move_uploaded_file($file_loc, $folder . $file);
    } else {
        $file = $_POST['path'];
    }
    if (error_check($nameErr, $dobErr, $cityErr, $stateErr, $genderErr, $mobileNumErr, $centerCodeErr, $registrationDateErr, $courseErr, $admissionNumberErr, $batchSelectionErr)) {
        if ($edit) {
            $sql = "UPDATE `students` SET `name`='$name',`gender`='$gender',`dob`='$dob',`mobile_number`='$mobile_num',`state`='$state',`city`='$city',`img`='$file',`center_code`='$center_code',
                      `registration_date`='$registration_date',`course`='$course',`admission_number`='$admission_number',`batch`='$batch_selection',`updated_at` = now() WHERE `id` = $id";
        } else {
            $sql = "INSERT INTO `students`(`name`, `gender`, `dob`, `mobile_number`, `state`, `city`, `img`, `center_code`, `registration_date`, `course`, `admission_number`, `batch`) 
    VALUES ('$name','$gender','$dob','$mobile_num','$state','$city','$file','$center_code','$registration_date','$course','$admission_number','$batch_selection')";
        }
        if (mysqli_query($conn, $sql)) {
            header('location: student.php');
        } else {
            $msg = 'Unable to insert data ';
        }
    }
}
?>
<div class="container d-flex justify-content-around" style="margin-top:50px;">
    <form method="post" action="" class="" enctype="multipart/form-data">
        <div class="container">
            <div class="h3"><?php echo $edit ? "Edit" : "Add"; ?> Student info</div>
            <span class="text-danger"><?= $msg ?></span>
            <div class="row">
                <div class="col-md-12 mb-2 mt-12">
                    <label for="student_name">Student Name</label>
                    <input type="text" name="student_name" class="form-control"
                           value="<?php echo $edit_name ? $edit_name : ''; ?>">
                </div>
                <span class="text-danger"><?= $nameErr ?></span>
            </div>
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-6 mb-2">
                    <label>Gender</label>
                    <div class="d-flex align-items-center mt-2">
                        <label class="option">
                            <input type="radio" name="gender" value="MALE">Male
                            <span class="checkmark"></span>
                        </label>
                        <label class="option ms-4">
                            <input type="radio" name="gender" value="FEMALE">Female
                            <span class="checkmark"></span>
                        </label><label class="option ms-4">
                            <input type="radio" name="gender" value="OTHER">Other
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <span class="text-danger"><?= $genderErr ?></span>
                </div>
                <div class="col-md-6 mt-md-0 mt-6 mb-2">
                    <label>DOB</label>
                    <input type="date" name="dob" class="form-control"
                           value="<?php echo $edit_dob ? $edit_dob : ''; ?>">
                    <span class="text-danger"><?= $dobErr ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-md-0 mt-12">
                    <label>Mobile Number</label>
                    <input type="tel" name="mobile_number" class="form-control"
                           value="<?php echo $edit_mobile_num ? $edit_mobile_num : ''; ?>">
                    <span class="text-danger"><?= $mobileNumErr ?></span>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>City</label>
                    <input type="text" name="city" class="form-control"
                           value="<?php echo $edit_city ? $edit_city : ''; ?>">
                    <span class="text-danger"><?= $cityErr ?></span>
                </div>
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>State</label>
                    <input type="text" name="state" class="form-control"
                           value="<?php echo $edit_state ? $edit_state : ''; ?>">
                    <span class="text-danger"><?= $stateErr ?></span>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 mt-md-0 mt-12">
                    <label>Photo</label>
                    <span class="text-danger"><b>Image should not Exceed 300px 300px</b></span>
                    <input type="file" name="photo" class="form-control">
                    <input type="hidden" name="path" class="form-control"
                           value="<?php echo $edit_path ? $edit_path : ''; ?> ">
                </div>
            </div>

            <br><br>
            <div class="h3">Center Details</div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>Center Code</label>
                    <input type="text" name="center_code" class="form-control"
                           value="<?php echo $edit_center_code ? $edit_center_code : ''; ?>">
                    <span class="text-danger"><?= $centerCodeErr ?></span>
                </div>
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>Registration Date</label>
                    <input type="date" name="registration_date" class="form-control"
                           value="<?php echo $edit_registration_date ? $edit_registration_date : ''; ?>">
                    <span class="text-danger"><?= $registrationDateErr ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>Course</label>
                    <input type="text" name="course" class="form-control"
                           value="<?php echo $edit_course ? $edit_course : ''; ?>">
                    <span class="text-danger"><?= $courseErr ?></span>
                </div>
                <div class="col-md-6 mt-md-0 mt-6">
                    <label>Admission Number</label>
                    <input type="text" name="admission_number" class="form-control"
                           value="<?php echo $edit_admission_number ? $edit_admission_number : ''; ?>">
                    <span class="text-danger"><?= $admissionNumberErr ?></span>
                </div>
            </div>

            <div class="row">
                <div class=" my-md-4 my-3">
                    <label for="batch_selection">Sesion</label>
                    <select class="p-1 mt-6 text-center" id="batch_selection" name="batch_selection">
                        <?php
                            foreach (BATCH as $key => $batch) {
                                if($key == 0 && $edit){
                                    ?>
                                    <option value="<?=  $edit_batch_selection ?>"><?= $edit_batch_selection ?></option>
                               <?php
                                }else{
                                ?>
                                <option value="<?=  $key ?>"><?= $batch ?></option>
                                <?php
                            }
                            }
                        ?>
                    </select>
                    <span class="text-danger"><?= $batchSelectionErr ?></span>
                </div>

            </div>

            <div class="row justify-content-between">
                <div class="col-md-3 col-md-offset-3">
                    <input class="btn btn-danger mt-3 float-end" type="reset">
                </div>
                <div class="col-md-3 col-md-offset-3">
                    <input class="btn btn-primary mt-3 float-start" type="submit">
                </div>
            </div>
        </div>
    </form>
</div>
