<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../assets/logo/black.svg" />
    <title>Document</title>
</head>

<body>
    <div class="flex items-center justify-center w-screen h-screen bg-beige">
        <form action="../actions/session/login.php" method="post" class="flex flex-col gap-5 p-5 bg-gris rounded-xl">
            <h1 class="text-5xl text-maron">Login</h1>
            <input type="email" name="email" placeholder="Email" class=" w-[90vw] h-12 rounded-2xl p-4">
            <input type="password" name="password" placeholder="Password" class=" w-[90vw] h-12 rounded-2xl p-4">
            <a href="./session/forgotPassword.php" class=" text-casse"> Forgot Password </a>
            <button type="submit" class="h-12 p-2 text-2xl rounded-2xl bg-noire text-casse">Login</button>
            <?php
            $error = $_GET['error'];
            if (isset($error)) {
                echo "$error";
            }
            ?>
        </form>
    </div>
</body>

</html>

<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: ../../index.php');
}

?>