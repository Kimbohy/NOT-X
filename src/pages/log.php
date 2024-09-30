<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./output.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="../assets/logo/black.svg" />
    <title>Document</title>
</head>

<body>
    <div>
        <form action="../actions/session/login.php" method="post">
            <h1>Login</h1>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <a href="./session/forgotPassword.php"> Forgot Password </a>
            <button type="submit">Login</button>
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