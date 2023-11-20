<?php
session_start();
if (isset($_GET['admin'])) {
    header("location:adminlogout.php");
}
unset($_SESSION['name']);
unset($_SESSION['photo']);
unset($_SESSION['user_id']);
header("location:index.php");
