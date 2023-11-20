<?php
require "./db/db.php";
require "./partials/header.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $qry = "INSERT INTO post_categories (name) VALUES (:name)";
    $s = $pdo->prepare($qry);
    $s->bindParam(":name", $name, PDO::PARAM_STR);
    $s->execute();
    header("location:index.php");
}
?>
<form action="create_categories.php" method="post" class="p-5 border border-2 border-slate-600 w-fit mx-auto mt-20 rounded-2xl shadow-xl">
    <label for="name">Insert New Name</label>
    <input type="text" name="name" class="p-3 rounded-xl">
    <input type="submit" name="submit" value="submit" class="px-4 py-2 border-none bg-blue-400 rounded-xl text-white">
</form>