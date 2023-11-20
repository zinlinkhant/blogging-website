<?php
require "./partials/header.php";
require "./db/db.php";
$s = $pdo->prepare("SELECT * FROM post_categories");
$s->execute();
$category = $s->fetchAll();
session_start();
if (isset($_POST['submit'])) {
    $name = $_POST['admin'];
    $id = $_POST['admin_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $status = "active";
    $photo = $_FILES['photo']['name'];
    $tmpphoto = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmpphoto, "images/$photo");
    $s = $pdo->prepare("INSERT INTO posts(admin_id,name,title,content,category,image,status) VALUES (:admin_id,:name,:title,:content,:category,:image,:status)");
    $s->bindParam(":name", $name, PDO::PARAM_STR);
    $s->bindParam(":admin_id", $id, PDO::PARAM_STR);
    $s->bindParam(":title", $title, PDO::PARAM_STR);
    $s->bindParam(":content", $content, PDO::PARAM_STR);
    $s->bindParam(":category", $category, PDO::PARAM_STR);
    $s->bindParam(":image", $photo, PDO::PARAM_STR);
    $s->bindParam(":status", $status, PDO::PARAM_STR);
    $s->execute();
}
?>
<?php

if (isset($_SESSION['admin'])) : ?>
<div class="grid grid-cols-4">
    <div class="p-5 relative bg-blue-200">
        <?php require "./partials/admin_sidebar.php" ?>
    </div>
    <div class="col-span-3">
        <div class="bg-blue-100 w-full h-screen pt-20">
            <form action="add_post.php" method="post" class="mx-auto border p-10 w-fit bg-white shadow-lg"
                enctype="multipart/form-data">
                <input class="block mb-5 rounded-lg w-full px-5 py-2" type="hidden" name="admin"
                    value="<?= $_SESSION['admin'] ?>">
                <input class="block mb-5 rounded-lg w-full px-5 py-2" type="hidden" name="admin_id"
                    value="<?= $_SESSION['admin_id'] ?>">
                <input class="block  mb-5 rounded-lg w-full px-5 py-2 " type="text" name="title"
                    placeholder="Post Title">
                <textarea class="block  mb-5 rounded-lg w-full px-5 py-2" name="content" cols="30" rows="3"
                    placeholder="post-content"></textarea>
                <select class="block  mb-5 rounded-lg w-full px-5 py-2" name="category">
                    <option value="" selected>Select Categories</option>
                    <?php
                        foreach ($category as $key => $c) : ?>
                    <option value="<?= $c['name'] ?>"><?= $c['name'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="file" name="photo" class="block  mb-5 rounded-lg w-full border border-black"
                    placeholder="choose photo">
                <input type="submit" value="submit" name="submit"
                    class="mx-auto bg-blue-500 rounded-l text-white hover:bg-blue-700 px-3 py-1 text-lg  transition">
            </form>
        </div>
    </div>
</div>
<?php else : ?>
<h1 class="text-3xl text-center font-semibold">You can only create post if you are admin</h1>
<div class="flex justify-center">
    <a href="./index.php" class="px-5 py-2 rounded-lg bg-blue-500 text-white">Go back to home page</a>
</div>
<?php endif;