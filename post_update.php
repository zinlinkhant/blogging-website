<?php
require "./db/db.php";
if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $oldphoto = $_POST['oldphoto'];
    if (isset($_POST['photo'])) {
        $pname = $_FILES['photo']['name'];
        $tmpname = $_FILES['photo']['tmp_name'];
        move_uploaded_file($tmpname, "images/$pname");
    } else {
        $pname = $oldphoto;
    }
    $qry = "UPDATE posts SET category=:category,title=:title , content=:content, image=:image WHERE post_id=:post_id";
    // add require db.php which contains $pdo
    $statement = $pdo->prepare($qry);
    // bind
    $statement->bindParam(":post_id", $pid, PDO::PARAM_STR);
    $statement->bindParam(":title", $title, PDO::PARAM_STR);
    $statement->bindParam(":content", $content, PDO::PARAM_STR);
    $statement->bindParam(":category", $category, PDO::PARAM_STR);
    $statement->bindParam(":image", $pname, PDO::PARAM_STR);
    $statement->execute();
    header("location:admin.php");
}
