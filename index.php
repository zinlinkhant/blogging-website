<?php
require "./partials/header.php";
require "./db/db.php";
session_start();
if (!isset($_SESSION['name'])) {
    header("location:user_login.php");
} else { ?>

    <div class="w-screen overflow-hidden relative">
        <nav class="bg-[#525FE1] flex justify-between items-center px-5">
            <ul class="flex">
                <li class="mx-5 text-xl font-semibold my-2 text-white px-3 py-2"><a href="./index.php" class="
                    hover:underline">View
                        posts</a>
                </li>
                <li class="mx-5 text-xl font-semibold my-2 text-white px-3 py-2 userEdit cursor-pointer">updateProfile</li>
                <li class="mx-5 text-md font-semibold my-2 text-white px-3 py-2 "><a href="./admin.php" class="hover:underline">admin panel</a>
                </li>
            </ul>
            <ul class="flex items-center">
                <li>
                    <form action="./search.php" method="post">
                        <input type="text" name="search" placeholder="search" class="rounded-lg border-none">
                    </form>
                </li>
                <li class="ml-5 text-xl font-semibold my-2 text-white px-3 py-2">
                    <!-- Modal toggle -->
                    <button data-modal-target="staticModal" data-modal-toggle="staticModal" class="text-white bg-[#7770ff] px-7 py-2 rounded-3xl border border-blue-200 hover:shadow-md hover:shadow-slate-600 transition" type="button">
                        <?= $_SESSION['name'] ?>
                    </button>
                </li>
                <li>
                    <?php
                    if (!isset($_SESSION['photo'])) { ?>
                        <img class="h-14 w-14 rounded-full object-cover" src="./images/<?= $_SESSION['photo'] ?>" alt="">
                    <?php } else { ?>
                        <div></div>
                    <?php } ?>
                </li>
                <li class="text-s font-thin bg-red-600 px-5 rounded-2xl text-white mr-3">
                    <!-- <a href="./logout.php">logout</a> -->
                    <button onclick="check()">logout</button>
                </li>
            </ul>
        </nav>
        <?php
        require "./db/db.php";
        require "./partials/header.php";
        if (isset($_GET['category'])) {
            $category = $_GET['category'];
            $s = $pdo->prepare("SELECT * FROM posts WHERE category=:category");
            $s->bindParam(":category", $category, PDO::PARAM_STR);
            $s->execute();
            if ($s->rowCount() === 0) {
                $p = 'There are no posts with that category';
            } else {
                $pNum = $s->rowCount();
                $p = "There are $pNum posts with that category";
            }
            $post = $s->fetchAll();
        } elseif (isset($_GET['name'])) {
            $name = $_GET['name'];
            $s = $pdo->prepare("SELECT * FROM posts WHERE name=:name");
            $s->bindParam(":name", $name, PDO::PARAM_STR);
            $s->execute();
            if ($s->rowCount() === 0) {
                $p = 'There are no posts with that aurthor';
            } else {
                $pNum = $s->rowCount();
                $p = "There are $pNum posts with that aurthor";
            }
            $post = $s->fetchAll();
        } elseif (isset($_GET['search'])) {
            $search = $_GET['search'];
            $search = "%$search%";
            $s = $pdo->prepare("SELECT * FROM posts WHERE title LIKE :title");
            $s->bindParam(":title", $search, PDO::PARAM_STR);
            $s->execute();
            if ($s->rowCount() === 0) {
                $p = 'There are no posts with that name';
            } else {
                $pNum = $s->rowCount();
                $p = "There are $pNum posts with that name";
            }
            $post = $s->fetchAll();
        } else {
            $s = $pdo->prepare("SELECT * FROM posts");
            $s->execute();
            $post = $s->fetchAll();
            $p = null;
        }
        ?>
        <div class="p-5">
            <div class="flex justify-center">
                <btn class="text-center text-2xl px-4 py-1 font-semibold text-slate-800 mb-3 cat-btn bg-blue-100 m-auto cursor-pointer">
                    Categories
                </btn>
            </div>
            <div class="flex flex-wrap justify-center categories">
                <a class="px-5 py-2 rounded-md border bg-blue-800 text-white mr-3 mb-3 hover:px-10 hover:tracking-widest transition-all duration-300" href="./index.php">All</a>
                <?php
                $s = $pdo->prepare("SELECT * FROM post_categories");
                $s->execute();
                $category = $s->fetchAll();
                foreach ($category as $key => $c) : ?>
                    <a class="px-5 py-2 rounded-md border bg-blue-800 text-white mr-3 mb-3 hover:px-10 hover:tracking-widest transition-all duration-300" href="./index.php?category=<?= $c['name'] ?>"><?= $c['name'] ?></a>
                <?php endforeach
                ?>
            </div>
            <div class="flex justify-center">
                <btn class="text-center text-2xl px-4 py-1 font-semibold text-slate-800 mb-3 bg-blue-100 m-auto cursor-pointer name-btn">
                    Names
                </btn>
            </div>
            <div class="flex flex-wrap justify-center names">
                <a class="px-5 py-2 rounded-md border bg-blue-800 text-white mr-3 mb-3 hover:px-10 hover:tracking-widest transition-all duration-300" href="./index.php">All</a>
                <?php
                $s = $pdo->prepare("SELECT DISTINCT name FROM posts");
                $s->execute();
                $names = $s->fetchAll();
                foreach ($names as $key => $n) : ?>
                    <a class="px-5 py-2 rounded-md border bg-blue-800 text-white mr-3 mb-3 hover:px-10 hover:tracking-widest transition-all duration-300" href="./index.php?name=<?= $n['name'] ?>"><?= $n['name'] ?></a>
                <?php endforeach
                ?>
            </div>
        </div>
        <h1 class="text-2xl text-center my-5"><?= $p ?></h1>
        <div class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 bg-slate-100 p-5">
            <?php
            foreach ($post as $key => $p) : ?>
                <div class="bg-white p-5 h-fit mr-4 mb-4 shadow-lg hover:bg-blue-100 transition-all ">
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
                    <p class="paraTop m-4 text-slate-500">
                        <?php
                        $para = $p['content'];
                        $paraResult = substr($para, 0, 20);
                        echo $paraResult . ".......";
                        ?>
                    </p>
                    <a href="post_detail.php?post_id=<?= $p['post_id'] ?>" class="btn text-lg px-4 py-1 bg-blue-600 my-1 mx-3 text-white rounded-md">See All</a>
                    <div class="my-5 mx-3 flex justify-between">
                        <?php
                        $s = $pdo->prepare("SELECT * FROM likes WHERE post_id=:post_id");
                        $s->bindParam(":post_id", $p['post_id'], PDO::PARAM_STR);
                        $s->execute();
                        $lCount = $s->rowCount();
                        $ls = $pdo->prepare("SELECT * FROM likes WHERE post_id=:post_id AND user_id=:user_id");
                        $ls->bindParam(":post_id", $p['post_id'], PDO::PARAM_STR);
                        $ls->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_STR);
                        $ls->execute();
                        $ulCount = $ls->rowCount();
                        if ($ulCount > 0) {
                            $likeClass = "text-red-500";
                        } else {
                            $likeClass = "text-slate-500";
                        }
                        $commentS = $pdo->prepare("SELECT * FROM comments WHERE post_id=:post_id");
                        $commentS->bindParam(":post_id", $p['post_id'], PDO::PARAM_STR);
                        $commentS->execute();
                        $uCount = $commentS->rowCount();
                        ?>
                        <a name="like" href="./like_post.php?admin=<?= $p['name'] ?>&user_id=<?= $_SESSION['user_id'] ?>&post_id=<?= $p['post_id'] ?>"><i class="fa-solid fa-heart text-xl mx-2 <?= $likeClass ?>"></i><?= $lCount ?></a>
                        <a href="./post_detail.php?admin=<?= $p['name'] ?>&user_id=<?= $_SESSION['user_id'] ?>&post_id=<?= $p['post_id'] ?>&user_name=<?= $_SESSION['name'] ?>"><i class="mr-3 fa-solid fa-comment text-slate-500 text-xl"></i><?= $uCount ?></a>
                    </div>
                </div>
            <?php endforeach ?>
            <script>
                $(document).ready(function() {
                    $('.likeBtn').click(
                        function() {
                            this.toggleClass('bg-red-400')
                            this.toggleClass('bg-green-400')
                        }
                    )
                    $('.categories').hide();
                    $()
                    $('.cat-btn').click(
                        function() {
                            $('.categories').toggle(500)
                        }
                    )
                    $('.names').hide();
                    $('.name-btn').click(
                        function() {
                            $('.names').toggle(500)
                        }
                    )
                    $(this).parent().css(" background-color", "blue");
                    $(".para").hide();
                    $(".btn").click(function() {
                        $(this).parent().children('div').children('p').toggle(500);
                        if ($(this).html() === "See contents") {
                            $(this).html("Unsee contents")
                        } else {
                            $(this).html("See contents")
                        }
                    })
                });
            </script>
        </div>
    </div>
<?php } ?>
<script>
    function check() {
        alert('are you sure to logout')
        return newDoc();
    }

    function newDoc() {
        window.location.assign("logout.php")
    }
</script>