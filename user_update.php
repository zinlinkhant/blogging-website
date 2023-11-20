<?php
require "./db/db.php";
if (isset($_POST['update'])) {
    $uid = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $updateqry = "UPDATE users SET name=:name,email=:email,address=:address, phone=:phone WHERE user_id=:user_id";
    $statement = $pdo->prepare($updateqry);
    $statement->bindParam(":user_id", $uid, PDO::PARAM_STR);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":email", $email, PDO::PARAM_STR);
    $statement->bindParam(":phone", $phone, PDO::PARAM_STR);
    $statement->bindParam(":address", $address, PDO::PARAM_STR);
    $res = $statement->execute();
    header("location:index.php");
}
