<?php
require "./db/db.php";
require "./partials/header.php";
session_start();
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_user = "SELECT * FROM users WHERE email=:email";
    $s = $pdo->prepare($login_user);
    $s->bindParam(":email", $email, PDO::PARAM_STR);
    $s->execute();
    $user = $s->fetch();
    $check = password_verify($password, $user['password']);
    if ($check) {
        $_SESSION['name'] = $user['name'];
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['photo'] = $user['img'];
        header("location:index.php");
    }else{?>
<script>
alert("You have entered wrong email or password")
</script>
<?php
    }
}
?>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>

<div class="container max-w-full mx-auto md:py-24 px-6 bg-slate-100 h-screen">
    <div class="max-w-sm mx-auto px-6 border border-slate-300 rounded-xl p-10 bg-white shadow-lg">
        <div class="relative flex flex-wrap">
            <div class="w-full relative">
                <div class="md:mt-6">
                    <div class="text-center text-2xl font-semibold text-black">
                        You haven't login yet
                    </div>
                    <div class="text-center text-2xl font-base text-black">
                        Please Login
                    </div>
                    <form class="mt-8" action="user_login.php" method="post">
                        <div class="mx-auto max-w-lg ">
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Email</span>
                                <input type="email" require name="email"
                                    class="text-md block px-3 py-2 rounded-lg w-full 
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <div class="py-1">
                                <span class="px-1 text-sm text-gray-600">Password</span>
                                <input type="password" require name="password"
                                    class="text-md block px-3 py-2 rounded-lg  w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                            </div>
                            <input type="submit" name="submit" class="mt-3 text-lg font-semibold
            bg-black w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black-400">
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
                    <a href="./register.php" class="block text-center text-blue-500 hover:underline">Don't have account?
                        register</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>