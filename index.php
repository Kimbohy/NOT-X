<?php
session_start();
// Redirect if the user is not logged in
if (!isset($_SESSION['userId'])) {
    header('Location: ./src/pages/log.php');
    exit(); // Ensure script stops after redirect
}

include_once './config.php';
include_once './src/actions/Class.php';
$user = new User($connection, $_SESSION['userId']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="./src/assets/logo/black.svg" />
    <script src="./src/assets/js/script.js" defer></script>
    <title>Document</title>
</head>

<script>
    // Check if accountId exists in PHP session and set it in localStorage
    <?php if (isset($_SESSION['userId'])): ?>
        localStorage.setItem("accountId", "<?php echo $_SESSION["userId"]; ?>");
        // console.log(localStorage.getItem("accountId"));
    <?php else: ?>
        console.warn("accountId is not set in the session.");
    <?php endif; ?>
</script>

<body>
    <div class="flex flex-nowrap">
        <!-- Sidebar -->
        <aside class="fixed flex flex-col items-center w-20 h-screen gap-5 px-2 pt-4 bg-gris">
            <img src="./src/assets/logo/bg-black.png" alt="logo">
            <!-- page list -->
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <!-- page list -->

            <img src="./src/assets/icons/Plus circle.svg" alt="plus">
        </aside>

        <!-- Main Content -->
        <div class="w-full pl-20">
            <!-- Navigation -->
            <nav class="flex justify-end gap-4 p-3 bg-post">
                <div class="h-10 w-44 rounded-2xl bg-casse"></div>
                <img src="./src/assets/icons/Icon.svg" alt="" class="cursor-pointer w-9" onclick="handleLogout()">
            </nav>
            <div class="flex flex-nowrap">

                <div class="flex flex-col flex-grow gap-3 p-2">
                    <div class="flex flex-col gap-3 p-2">
                        <div class="p-3 bg-post rounded-xl">

                            <form action="" method="post" onsubmit="handleCreatePost(event)">
                                <textarea name="content" id="content" cols="30" rows="5" class="w-full p-2 rounded-xl" placeholder="What's on your mind?"></textarea>
                                <button type="submit" class="w-full p-2 bg-casse rounded-xl">Publish</button>
                            </form>

                        </div>
                    </div>

                    <!-- Container for displaying posts -->
                    <div id="postContainer" class="flex flex-col gap-3">
                        <!-- All publications will be injected here via JavaScript -->
                    </div>
                </div>

                <div id="comment" class="w-[10000px] pt-2 pr-2 overflow-hidden">
                    <div class="flex flex-col gap-3 p-2">
                        <div class="p-3 bg-post rounded-xl">
                            <form action="" method="post" onsubmit="handleCreateComment(event)">
                                <textarea name="content" id="content" cols="30" rows="5" class="w-full p-2 rounded-xl" placeholder="What's on your mind?"></textarea>
                                <button type="submit" class="w-full p-2 bg-casse rounded-xl">Publish</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>