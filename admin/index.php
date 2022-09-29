<?php
session_start();
if (isset($_SESSION["name"]) && isset($_SESSION["account_type"]) && $_SESSION["account_type"] == 'ADMIN' ) {
    header('location:student.php');
}else {
    header("location: login.php");

}