<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../output.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../assets/logo/black.svg" />
    <title>Login</title>
</head>

<body>
    <div class="flex flex-col items-center w-screen h-screen py-20 gap-14 md:justify-between md:flex-row md:px-10 bg-gris lg:px-60">
        <img src="../assets/logo/white.png" alt="logo" class="w-40 md:w-64">
        <form action="../actions/session/creatAccount.php" method="post" class="flex flex-col gap-5 p-5 lg:gap-7 rounded-xl">
            <label for="firstName" class="text-3xl lg:text-4xl text-casse">First Name:</label>
            <input type="text" name="firstName" placeholder="" class=" w-[90vw] md:w-[50vw] lg:w-[40vw] h-12 lg:h-14 rounded-2xl p-4">
            <label for="lastName" class="text-3xl lg:text-4xl text-casse">Last Name:</label>
            <input type="text" name="lastName" placeholder="" class=" w-[90vw] md:w-[50vw] lg:w-[40vw] h-12 lg:h-14 rounded-2xl p-4">
            <label for="email" class="text-3xl lg:text-4xl text-casse">Mail:</label>
            <input type="email" name="email" placeholder="" class=" w-[90vw] md:w-[50vw] lg:w-[40vw] h-12 lg:h-14 rounded-2xl p-4">
            <label for="password" class="text-3xl lg:text-4xl text-casse">Password:</label>
            <input type="password" name="password" placeholder="" class=" w-[90vw] md:w-[50vw] lg:w-[40vw] h-12 lg:h-14 rounded-2xl p-4">
            <label for="profilePicture" class="text-3xl lg:text-4xl text-casse">Profile Picture:</label>
            <input type="file" name="profilePicture" class="w-[90vw] md:w-[50vw] lg:w-[40vw] h-12 lg:h-14 rounded-2xl p-4">
            <a href="./log.php"
                class="py-1 pr-3 text-casse text-end">
                <p class="text-xl lg:text-2xl">
                    Already have an account?
                    <span class="underline">
                        Login
                    </span>
                </p>
            </a>
            <button type="submit" class="h-12 p-2 text-2xl transition-all lg:text-4xl rounded-2xl bg-noire text-casse lg:h-14 hover:bg-beige hover:text-noire">
                SignUp
            </button>
            <div class="flex gap-2 text-casse">
                <?php
                $error = $_GET['error'];
                if (isset($error)) {
                    echo '<img src="../assets/icons/Cirecle-exclamation.svg" alt="Cirecle-exclamation.svg" class="w-5">';
                    echo "$error";
                }
                ?>
            </div>
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