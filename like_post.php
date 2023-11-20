<?php
require "./db/db.php";
$user_id = $_GET['user_id'];
if ($user_id != '') {
    $post_id = $_GET['post_id'];
    $admin = $_GET['admin'];
    $qry = $pdo->prepare("SELECT * FROM admins WHERE name=:name");
    $qry->bindParam(":name", $admin, PDO::PARAM_STR);
    $qry->execute();
    $adminid = $qry->fetch();
    $user_id = $_GET['user_id'];
    $admin_id = $adminid['id'];
    echo $post_id;
    echo "<br>";
    print_r($user_id);
    echo "<br>";
    print_r($admin_id);
    echo "<br>";
    $select_post_like = $pdo->prepare("SELECT * FROM likes WHERE post_id=:post_id AND user_id=:user_id");
    $select_post_like->bindParam(':post_id', $post_id, PDO::PARAM_STR);
    $select_post_like->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $select_post_like->execute();
    if ($select_post_like->rowCount() > 0) {
        $remove_like = $pdo->prepare("DELETE FROM likes WHERE post_id =:post_id");
        $remove_like->bindParam(":post_id", $post_id, PDO::PARAM_STR);
        $remove_like->execute();
    } else {
        $add_like = $pdo->prepare("INSERT INTO `likes`(user_id, post_id, admin_id) VALUES(:user_id,:post_id,:admin_id)");
        $add_like->bindParam(":post_id", $post_id, PDO::PARAM_STR);
        $add_like->bindParam(":user_id", $user_id, PDO::PARAM_STR);
        $add_like->bindParam(":admin_id", $admin_id, PDO::PARAM_STR);
        $add_like->execute();
    }
    header("location:index.php");
}
