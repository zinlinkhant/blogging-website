<?php
require "./partials/header.php";
require "./db/db.php";
$postId = $_GET['id'];
$qry = $pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id");
$qry->bindParam(":post_id", $postId, PDO::PARAM_STR);
$qry->execute();
$post = $qry->fetch();
session_start();
?>
<div class="grid grid-cols-4">
    <div class="p-5 relative bg-blue-200">
        <?php require "./partials/admin_sidebar.php" ?>
    </div>
    <?php if ($post['name'] === $_SESSION['admin']) { ?>
    <div class="col-span-3">
        <div class="bg-blue-100 w-full h-fit pt-20">
            <form action="postupdate.php" method="post" class="mx-auto border p-10 w-fit bg-white shadow-lg"
                enctype="multipart/form-data">
                <input class="block mb-5 rounded-lg w-full px-5 py-2" type="hidden" name="pid"
                    value="<?= $post['post_id'] ?>">
                <input class="block mb-5 rounded-lg w-full px-5 py-2" type="hidden" name="admin"
                    value="<?= $_SESSION['admin'] ?>">
                <input class="block mb-5 rounded-lg w-full px-5 py-2" type="hidden" name="admin_id"
                    value="<?= $_SESSION['admin_id'] ?>">
                <input class="block  mb-5 rounded-lg w-full px-5 py-2 " type="text" name="title"
                    value="<?= $post['title'] ?>">
                <textarea class="block  mb-5 rounded-lg w-full px-5 py-2" name="content" cols="30"
                    rows="3"><?= $post['content'] ?></textarea>
                <select class="block  mb-5 rounded-lg w-full px-5 py-2" name="category">
                    <option selected><?= $post['category'] ?></option>
                    <?php
                        $qry = $pdo->prepare("SELECT * FROM post_categories");
                        $qry->execute();
                        $category = $qry->fetchAll();
                        foreach ($category as $key => $c) : ?>
                    <option value=""><?= $c['name'] ?></option>
                    <?php endforeach ?>
                </select>
                <input type="hidden" name="oldphoto" value="<?= $post['image'] ?>">
                <div class="p-5">
                    <img name="photo" src="./images/<?= $post['image'] ?>" class="w-fit h-[500px]" alt="">
                </div>
                <input type="file" name="photo" class="block  mb-5 rounded-lg w-full border border-black"
                    placeholder="choose photo">
                <input type="submit" value="update" name="update"
                    class="mx-auto bg-blue-500 rounded-l text-white hover:bg-blue-700 px-3 py-1 text-lg  transition">
            </form>
        </div>
    </div>
</div>
<?php } else { ?>
<h1 class="text-3xl text-center my-10 font-bold">You don't post this</h1>
<?php } ?>