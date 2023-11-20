<?php
require "./partials/header.php";
require "./db/db.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $s = $pdo->prepare("INSERT INTO admins (name,password) VALUES (:name,:password)");
    $s->bindParam(":name", $name, PDO::PARAM_STR);
    $s->bindParam(":password", $password, PDO::PARAM_STR);
    $s->execute();
}
?>
<div class="grid grid-cols-4">
    <div class="p-5 relative bg-blue-200">
        <?php require "./partials/admin_sidebar.php" ?>
    </div>
    <div class="col-span-3">
        <div class="container max-w-full mx-auto md:py-24 px-6 bg-blue-100 h-screen">
            <div class="max-w-sm mx-auto px-6 border border-slate-300 rounded-3xl p-10 bg-white shadow-lg">
                <div class="relative flex flex-wrap">
                    <div class="w-full relative">
                        <div class="md:mt-6">
                            <div class="text-center text-3xl font-semibold text-black">
                                Register admin
                            </div>
                            <form class="mt-8" action="admin_register.php" method="post">
                                <div class="mx-auto max-w-lg ">
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Name</span>
                                        <input type="text" name="name"
                                            class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <div class="py-1">
                                        <span class="px-1 text-sm text-gray-600">Password</span>
                                        <input type="password" name="password"
                                            class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    </div>
                                    <input type="submit" name="submit" class="mt-3 text-lg font-semibold
            bg-black w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black-400">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>