<?php
require "./partials/header.php";
require "./db/db.php";
$id = $_GET['id'];
$likePostqry = $pdo->prepare("SELECT DISTINCT post_id FROM likes WHERE admin_id=:admin_id");
$likePostqry->bindParam(":admin_id", $id, PDO::PARAM_STR);
$likePostqry->execute();
$likePosts = $likePostqry->fetchAll();
print_r($likePosts);
?>
<div class="grid grid-cols-3">
    <?php
    foreach ($likePosts as $key => $post) {
        # code..
        $posts = $pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id");
        $posts->bindParam(":post_id", $post['post_id'], PDO::PARAM_STR);
        $posts->execute();
        $showPosts = $posts->fetch();
        // print_r($showPosts)
    ?>
        <div class="bg-white p-5 h-fit mr-4 mb-4 shadow-lg hover:bg-blue-1 00 transition-all ">
            <div class="flex justify-between">
                <div>
                    <p class="text-blue-500">From</p>
                    <p class="text-slate-500"><?= $showPosts['name'] ?></p>
                    <p class="text-right text-blue-500"><?= $showPosts['date'] ?></p>

                </div>
                <div>
                    <p class="text-right text-blue-500">Category</p>
                    <p class="text-right text-slate-500"><?= $showPosts['category'] ?></p>
                </div>
            </div>
            <img src="./images/<?= $showPosts['image'] ?>" class="w-full h-[300px] object-cover center my-2">
            <p class="text-2xl font-bold m-4"><?= $showPosts['title'] ?></p>
            <p class="paraTop"></p>
            <div class="m-4">
                <p class="para"><?= $showPosts['content'] ?></p>
            </div>
            <div class="flex justify-center my-3">
                <a class="px-7 text-white py-3 rounded-2xl bg-yellow-400 hover:bg-yellow-300 mr-5" href="./postedit.php?id=<?= $showPosts['post_id'] ?>">Update</a>
                <a class="px-7 text-white py-3 rounded-2xl bg-red-400 hover:bg-red-300 " href="./delete.php?tbname=posts&tbid=post_id&id=<?= $showPosts['post_id'] ?>">Delete</a>
            </div>
        </div>
    <?php
    } ?>
</div>