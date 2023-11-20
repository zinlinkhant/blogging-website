<?php
require "./db/db.php";
if (isset($_POST['update'])) {
    $aid = $_POST['id'];
    $name = $_POST['name'];
    $updateqry = "UPDATE admins SET name=:name WHERE id=:id";
    $statement = $pdo->prepare($updateqry);
    $statement->bindParam(":id", $aid, PDO::PARAM_STR);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $res = $statement->execute();
    header("location:admin_dashboard.php");
}
