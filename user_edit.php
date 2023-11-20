<?php
require "./db/db.php";
require "./partials/header.php";
$uid = $_GET['id'];
$qry = "SELECT user_id,name,email,phone,address,img FROM users WHERE user_id=:user_id";
$s = $pdo->prepare($qry);
$s->bindParam(":user_id", $uid, PDO::PARAM_STR);
$s->execute();
$user = $s->fetch();
// echo $now, "<br>", $name, "<br>", $email, "<br>", $phone, "<br>", $password, "<br>", $address;

?>
<div class="container w-full h-screen pt-10 px-6 bg-slate-100">
    <div class="w-[700px] mx-auto px-6 border border-slate-300 shadow-lg rounded-3xl p-10 bg-white h-fit">
        <div class="relative flex flex-wrap">
            <div class="w-full relative">
                <div class="">
                    <div class="text-center text-4xl font-semibold text-black">
                        Register form
                    </div>
                    <form class="mt-8" action="userupdate.php" method="post" enctype="multipart/form-data">
                        <div class="mx-auto max-w-lg ">
                            <input type="hidden" name="id" value="<?= $user['user_id'] ?>">
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Username</span>
                                <input type="text" name="name"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                    value="<?= $user['name'] ?>">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Email</span>
                                <input type="email" name="email"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                    value="<?= $user['email'] ?>">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">phone</span>
                                <input type="text" name="phone"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                    value="<?= $user['phone'] ?>">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">address</span>
                                <input type="text" name="address"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none"
                                    value="<?= $user['address'] ?>">
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