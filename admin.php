<?php
require "./partials/header.php";
require "./db/db.php";
session_start();
$admin = $_SESSION['admin'];
$postqry = $pdo->prepare("SELECT * FROM posts WHERE name=:name");
$postqry->bindParam(":name", $admin, PDO::PARAM_STR);
$postqry->execute();
$posts = $postqry->fetchAll();
$totalPosts = $postqry->rowCount();
if (!isset($_SESSION['admin'])) {
    header("location:admin_login.php");
} else { ?>
<div class="grid grid-cols-4">
    <div class="p-5 relative bg-blue-200">
        <?php
            require "./partials/admin_sidebar.php";
            ?>
    </div>
    <div class="col-span-3">
        <div class="p-5">
            <h1 class="text-center text-3xl font-semibold">You have <?= $totalPosts ?> posts </h1>
        </div>
        <div class="grid grid-cols-3 gap-3 bg-slate-100 p-5">
            <?php
                foreach ($posts as $key => $p) : ?>
            <div class="bg-white p-5 h-fit mr-4 mb-4 shadow-lg hover:bg-blue-1 00 transition-all ">
                <div class="flex justify-between">
                    <div>
                        <p class="text-blue-500">From</p>
                        <p class="text-slate-500"><?= $p['name'] ?></p>
                        <p class="text-right text-blue-500"><?= $p['date'] ?></p>

                    </div>
                    <div>
                        <p class="text-right text-blue-500">Category</p>
                        <p class="text-right text-slate-500"><?= $p['category'] ?></p>
                    </div>
                </div>
                <img src="./images/<?= $p['image'] ?>" class="w-full h-[300px] object-cover center my-2">
                <p class="text-2xl font-bold m-4"><?= $p['title'] ?></p>
                <p class="paraTop"></p>
                <div class="m-4">
                    <p class="para"><?= $p['content'] ?></p>
                </div>
                <div class="flex justify-center my-3">
                    <a class="px-7 text-white py-3 rounded-2xl bg-yellow-400 hover:bg-yellow-300 mr-5"
                        href="./postedit.php?id=<?= $p['post_id'] ?>">Update</a>
                    <a class="px-7 text-white py-3 rounded-2xl bg-red-400 hover:bg-red-300 "
                        href="./delete.php?tbname=posts&tbid=post_id&id=<?= $p['post_id'] ?>">Delete</a>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

</div>
<?php } ?>