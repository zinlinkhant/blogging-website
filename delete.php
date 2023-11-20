<?php
require "./partials/header.php";
require "./db/db.php";
$tbname = $_GET['tbname'];
$tbid = $_GET['tbid'];
$id = $_GET['id'];
function delete($tbname, $tbid, $id)
{
    global $pdo;
    $s = $pdo->prepare("DELETE FROM  $tbname WHERE $tbid = $id");
    $s->execute();
    header("location:admin.php");
}
delete($tbname, $tbid, $id);
