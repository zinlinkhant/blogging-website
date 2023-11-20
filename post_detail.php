<?php
require "./db/db.php";
require "./partials/header.php";
$post_id = $_GET['post_id'];
$s = $pdo->prepare("SELECT * FROM posts WHERE post_id=:post_id");
$s->bindParam(":post_id", $post_id, PDO::PARAM_STR);
$s->execute();
$p = $s->fetch();
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $post_id = $_GET['post_id'];
    $admin = $_GET['admin'];
    $qry = $pdo->prepare("SELECT * FROM admins WHERE name=:name");
    $qry->bindParam(":name", $admin, PDO::PARAM_STR);
    $qry->execute();
    $adminid = $qry->fetch();
    $user_id = $_GET['user_id'];
    $user_name = $_GET['user_name'];
    $admin_id = $adminid['id'];
}
?>
<div class="bg-slate-100 pt-12 pb-32">
    <div class=" w-3/5 m-auto bg-white p-5 h-fit shadow-lg transition-all ">
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
        <img src="./images/<?= $p['image'] ?>" class="w-full h-[600px] object-cover center my-2">
        <p class="text-2xl font-bold m-4"><?= $p['title'] ?></p>
        <p class="para m-4"><?= $p['content'] ?></p>
        <div>
        </div>
        <?php
        if (isset($user_id)) { ?>
        <form action="comment.php" method="post" class="mt-10">
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <input type="hidden" name="user_name" value="<?= $user_name ?>">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
            <input type="text" name="comment" class="px-5 py-2 w-full" placeholder="comment">
            <input type="submit" name="submit" value="comment" class="bg-blue-500 text-white px-5 py-1 mt-3">
        </form>
        <?php }
        ?>
        <div class="py-5">
            <h3 class="text-xl mb-2 font-semibold">Comments</h3>
            <?php
            $qry = $pdo->prepare("SELECT * FROM comments WHERE post_id=:post_id");
            $qry->bindParam(":post_id", $post_id, PDO::PARAM_STR);
            $qry->execute();
            $comments = $qry->fetchAll();
            foreach ($comments as $key => $cmt) : ?>
            <div class="px-5 py-2 border border-black mb-4">
                <div class="flex justify-between">
                    <p class="text-blue-500"><?= $cmt['user_name'] ?></p>
                    <p class="text-blue-500"><?= substr($cmt['date'], 0, 10) ?></p>
                </div>
                <p><?= $cmt['comment'] ?></p>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</div>