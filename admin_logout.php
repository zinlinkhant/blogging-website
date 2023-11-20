<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['admin_id']);
header("location:admin.php");
