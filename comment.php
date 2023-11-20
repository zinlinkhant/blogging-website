<?php
require "./db/db.php";
$user_name = $_POST['user_name'];
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$admin_id = $_POST['admin_id'];
$comment = $_POST['comment'];
$s = $pdo->prepare("INSERT INTO comments (user_name,post_id,admin_id,comment,user_id) VALUES (:user_name,:post_id,:admin_id,:comment,:user_id)");
$s->bindParam(":user_name", $user_name, PDO::PARAM_STR);
$s->bindParam(":post_id", $post_id, PDO::PARAM_STR);
$s->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
$s->bindParam(":comment", $comment, PDO::PARAM_STR);
$s->bindParam(":user_id", $user_id, PDO::PARAM_STR);
$s->execute();
header("location:post_detail.php?post_id=$post_id");
