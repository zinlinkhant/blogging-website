<?php
require "./db/db.php";
require "./partials/header.php";
$uqry = "SELECT * FROM users";
$us = $pdo->prepare($uqry);
$us->execute();
$user = $us->fetchAll();
$totalUsers = $us->rowCount(); ?>

<div class="grid grid-cols-4">
    <div class="p-5 relative bg-blue-200">
        <?php require "./partials/admin_sidebar.php" ?>
    </div>
    <div class="col-span-3">
        <div class="grid grid-cols-3 bg-slate-100">
            <?php foreach ($user as $key => $u) : ?>
            <div class="rounded-3xl p-6 bg-white m-5 shadow">
                <img class="mb-2 w-44 m-auto h-44 rounded-full object-cover" src="./images/<?= $u['img'] ?>"></img>
                <p class="text-xl text-center mb-2"><?= $u['name'] ?></p>
                <p class="text-xl text-center mb-2"><?= $u['email'] ?></p>
                <p class="text-xl text-center mb-2"><?= $u['phone'] ?></p>
                <p class="text-xl text-center mb-2"><?= $u['address'] ?></p>
                <div class="flex justify-center font-semibold my-3">
                    <a class="px-7 text-white py-3 rounded-2xl bg-yellow-400 hover:bg-yellow-300 mr-5"
                        href="./user_edit.php?id=<?= $u['user_id'] ?>">Update</a>
                    <a class="px-7 text-white py-3 rounded-2xl bg-red-400 hover:bg-red-300 "
                        href="./delete.php?tbname=users&tbid=user_id&id=<?= $u['user_id'] ?>">Delete</a>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>

</div>