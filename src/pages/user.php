<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../assets/js/user.js"></script>
    <link rel="stylesheet" href="../output.css">
    <title>User</title>
</head>

<body>
    <div class="flexflex-nowrap">
        <!-- Sidebar -->
        <aside class="fixed flex flex-col items-center w-20 h-screen gap-5 px-2 pt-4 bg-gris">
            <img src="../assets/logo/bg-black.png" alt="logo">
            <!-- page list -->
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <div class="w-10 h-10 rounded-full bg-post"></div>
            <!-- page list -->

            <img src="../assets/icons/Plus circle.svg" alt="plus">
        </aside>

        <!-- Main Content -->
        <div class="w-full pl-20">
            <!-- Navigation -->
            <nav class="flex justify-end gap-4 p-3 bg-post">
                <div class="h-10 w-44 rounded-2xl bg-casse"></div>
                <img src="" alt="profilpucture" class="rounded-full w-9 profile-picture">
            </nav>
            <div class="p-5">
                <h1 class="text-4xl profile-name"></h1>
                <button onclick="handleLogout()">
                    Log out
                </button>
            </div>
        </div>
    </div>
</body>

</html>