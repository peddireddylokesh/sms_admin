<?php
ob_start();
session_start();
include 'config.php';
include 'header.php';
?>

<div class="container">
    <div class="float-end mb-2"> <a class="btn btn-primary " href="create_student.php">Add</a></div>
    <table class=" table table-striped table-bordered table-responsive table-hover ">
    <thead>
    <th style="text-align: center">s.no</th>
    <th style="text-align: center">Name</th>
    <th style="text-align: center">Admission Number</th>
    <th style="text-align: center">DOB</th>
    <th style="text-align: center">Action</th>
    </thead>
        <tbody>
    <?php

    $sql = "SELECT `id`, `name`,`admission_number`,`dob` FROM `students` ";
    $result = mysqli_query($conn,$sql) or die(mysqli_error());
    if (mysqli_num_rows($result) > 0) {
        $cnt = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr style="text-align: center">
                <td><?php echo $cnt; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['admission_number']; ?></td>
                <td><?php echo $row['dob']; ?></td>
                <td><a href="create_student.php?id=<?=$row['id']?>">Edit</a> <a href="delete.php?id=<?=$row['id']?>">Delete</a></td>
            </tr>
            <?php
            $cnt++;
        }
        ?>
        <?php
    }
    ?>
    </tbody>
</table>
</div>
