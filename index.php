<?php
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: ./src/pages/log.php');
}
include_once './config.php';
include_once './src/actions/Class.php';
include_once './src/actions/Post.php';
$user = new User($connection, $_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="./src/assets/logo/black.svg" />
    <script src="./src/assets/js/script.js" defer></script>
    <script>
        localStorage.setItem("accountId", "<?php echo $_SESSION["accountId"]; ?>");
    </script>
    <title>Document</title>
</head>

<body>
    <div class="flex flex-nowrap">
        <div class="flex flex-col items-center w-20 h-screen gap-5 px-2 pt-4 bg-gris">
            <img src="./src/assets/logo/bg-black.png" alt="logo">
            <!-- page list -->
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <!-- page list -->

            <img src="./src/assets/icons/Plus circle.svg" alt="plus">
        </div>
        <div class="w-full">

            <nav class="flex justify-end gap-4 p-3 bg-post">
                <div class="h-10 w-44 rounded-2xl bg-casse"></div>
                <img src="./src/assets/icons/Icon.svg" alt="" class="w-9 ">
            </nav>
            <div class="flex flex-col gap-3 p-2">
                <?php
                $user->publishComponent(); // Appel de la méthode pour afficher le formulaire de publication
                ?>
                <div id="postContainer" class="flex flex-col gap-3">
                    <!-- all publications -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>