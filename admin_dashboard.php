<?php
require "./partials/header.php";
require "./db/db.php";
session_start();
$adminName = $_SESSION['admin'];
$adminId = $_SESSION['admin_id'];
$s = $pdo->prepare("SELECT * FROM admins WHERE id=:id");
$s->bindParam(":id", $adminId, PDO::PARAM_STR);
$s->execute();
$admin = $s->fetch();
$updatedAdminName = $admin['name'];
$ps = $pdo->prepare("SELECT * FROM posts WHERE admin_id=:admin_id");
$ps->bindParam(":admin_id", $adminId, PDO::PARAM_STR);
$ps->execute();
$posts = $ps->rowCount();
$as = $pdo->prepare("SELECT * FROM admins");
$as->execute();
$adminsNum = $as->rowCount();
$us = $pdo->prepare("SELECT * FROM users");
$us->execute();
$usersNum = $us->rowCount();
$ls = $pdo->prepare("SELECT * FROM likes WHERE admin_id=:admin_id");
$ls->bindParam(":admin_id", $admin['id'], PDO::PARAM_STR);
$ls->execute();
$likesNum = $ls->rowCount();
$cs = $pdo->prepare("SELECT * FROM comments WHERE admin_id=:admin_id");
$cs->bindParam(":admin_id", $admin['id'], PDO::PARAM_STR);
$cs->execute();
$commentsNum = $cs->rowCount();
if (!isset($_SESSION['admin'])) {
    header("location:admin_login.php");
} else { ?>
<div class="grid grid-cols-4 bg-slate-100">
    <div class="p-5 relative bg-blue-200">
        <?php
            require "./partials/admin_sidebar.php";
            ?>
    </div>
    <div class="col-span-3">
        <h1 class="text-center text-2xl py-3 font-semibold tracking-wide">ADMIN DASHBOARD</h1>
        <div class="grid grid-cols-3 gap-3 bg-slate-100 p-5 gap-8">
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-2xl text-blue-500 font-semibold tracking-wide">Your Name</h1>
                    <h1 class="text-center text-2xl font-semibold"><?= $updatedAdminName ?></h1>
                </div>

                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white"
                    href="./admin_edit.php?id=<?= $admin['id'] ?>">Update
                    Profile</a>

            </div>
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-xl text-blue-500 font-semibold tracking-wide">Posts</h1>
                    <h1 class="text-center text-xl font-semibold"><?= $posts ?></h1>
                </div>
                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white"
                    href="./add_post.php">Add New
                    Post</a>

            </div>
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-xl text-blue-500 font-semibold tracking-wide">Admin Accounts</h1>
                    <h1 class="text-center text-xl font-semibold"><?= $adminsNum ?></h1>
                </div>

                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white" href="">See Admins</a>

            </div>
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-xl text-blue-500 font-semibold tracking-wide">Users Accounts</h1>
                    <h1 class="text-center text-xl font-semibold"><?= $usersNum ?></h1>
                </div>

                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white" href="./users.php">See
                    Users</a>

            </div>
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-xl text-blue-500 font-semibold tracking-wide">Likes</h1>
                    <h1 class="text-center text-xl font-semibold"><?= $likesNum  ?></h1>
                </div>

                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white"
                    href="./see_like_post.php?id=<?= $adminId ?>">See posts</a>

            </div>
            <div class="bg-white px-5 py-3 border border-slate-500 rounded-md">
                <div class="">
                    <h1 class="text-center text-xl text-blue-500 font-semibold tracking-wide">Comments</h1>
                    <h1 class="text-center text-xl font-semibold"><?= $commentsNum  ?></h1>
                </div>
                <a class="bg-blue-700 w-full px-4 py-2 w-full mt-1 block text-center text-white" href="">See
                    comments</a>
            </div>
        </div>
    </div>

</div>
<?php } ?>