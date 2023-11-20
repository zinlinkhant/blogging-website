<?php
require "./partials/header.php";
require "./db/db.php";
session_start();
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_BCRYPT);
    $address = $_POST['address'];
    $pname = $_FILES['photo']['name'];
    $tmpname = $_FILES['photo']['tmp_name'];
    move_uploaded_file($tmpname, "images/$pname");
    $email_c_qry = "SELECT * FROM users WHERE email=:email";
    $s = $pdo->prepare($email_c_qry);
    $s->bindParam(":email", $email, PDO::PARAM_STR);
    $s->execute();
    $res = $s->rowCount();
    if ($res < 1) {
        $qry = "INSERT INTO users(name,email,phone,address,password,img) VALUES (:name,:email,:phone,:address,:password,:img)";
        $s = $pdo->prepare($qry);
        $s->bindParam(":name", $name, PDO::PARAM_STR);
        $s->bindParam(":email", $email, PDO::PARAM_STR);
        $s->bindParam(":phone", $phone, PDO::PARAM_STR);
        $s->bindParam(":password", $password, PDO::PARAM_STR);
        $s->bindParam(":address", $address, PDO::PARAM_STR);
        $s->bindParam(":img", $pname, PDO::PARAM_STR);
        $s->execute();
        header("location:index.php?name=$name");
    } else { ?>
<script>
alert('email already exist')
</script>
<?php }
} ?>

<div class="container w-full h-screen pt-10 px-6 bg-slate-100">
    <div class="w-[700px] mx-auto px-6 border border-slate-300 shadow-lg rounded-xl p-10 bg-white h-fit">
        <div class="relative flex flex-wrap">
            <div class="w-full relative">
                <div class="">
                    <div class="text-center text-4xl font-semibold text-black">
                        Register form
                    </div>
                    <form class="mt-8" action="register.php" method="post" enctype="multipart/form-data">
                        <div class="mx-auto max-w-lg ">
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Username</span>
                                <input type="text" name="name"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Email</span>
                                <input type="email" name="email"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">phpne</span>
                                <input type="text" name="phone"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">address</span>
                                <input type="text" name="address"
                                    class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Upolad profile picture</span>
                                <input type="file" name="photo" class="text-md block px-3 border">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Password</span>
                                <input type="password" name="password" class="text-md block px-3 rounded-lg w-full">
                            </div>
                            <input type="submit" name="register" class="mt-3 text-lg font-semibold
            bg-gray-800 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                        </div>
                    </form>

                    <div class="text-sm font-semibold block sm:hidden py-6 flex justify-center">
                        <a href="#"
                            class="text-black font-normal border-b-2 border-gray-200 hover:border-teal-500">You're
                            already member?
                            <span class="text-black font-semibold">
                                Login
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>