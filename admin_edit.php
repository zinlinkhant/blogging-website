<?php
require "./db/db.php";
require "./partials/header.php";
$aid = $_GET['id'];
$qry = "SELECT id,name FROM admins WHERE id=:id";
$s = $pdo->prepare($qry);
$s->bindParam(":id", $aid, PDO::PARAM_STR);
$s->execute();
$admin = $s->fetch();
// echo $now, "<br>", $name, "<br>", $email, "<br>", $phone, "<br>", $password, "<br>", $address;

?>
<div class="container w-full h-screen pt-10 px-6 bg-slate-100">
    <div class="w-[700px] mx-auto px-6 border border-slate-300 shadow-lg rounded-xl p-10 bg-white h-fit">
        <div class="relative flex flex-wrap">
            <div class="w-full relative">
                <div class="">
                    <div class="text-center text-4xl font-semibold text-black">
                        Update admin
                    </div>
                    <form class="mt-8" action="admin_update.php" method="post" enctype="multipart/form-data">
                        <div class="mx-auto max-w-lg ">
                            <input type="hidden" name="id" value="<?= $admin['id'] ?>">
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Admin name</span>
                                <input type="text" name="name" class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none" value="<?= $admin['name'] ?>">
                            </div>
                            <input type="submit" name="update" class="mt-3 text-lg font-semibold
            bg-gray-800 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black" value="update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>