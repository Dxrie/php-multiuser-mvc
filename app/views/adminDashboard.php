<?php
if (isset($data)) {
    extract($data);
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= BASE_URL ?>/public/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    <title>Home Page - Scribble</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Scribble</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="..">Home</a>
                    </li>
                    <li class="nav-item">
                        <?php if ($data["user"]["role"] === "penjual"): ?>
                            <a class="nav-link active" aria-current="page" href="seller/dashboard">Seller Dashboard</a>
                        <?php elseif ($data["user"]["role"] === "admin"): ?>
                            <a class="nav-link active" aria-current="page" href="admin/dashboard">Admin Dashboard</a>
                        <?php else: ?>
                            <a class="nav-link active" aria-current="page" href="seller/register">Become a Seller</a>
                        <?php endif; ?>
                    </li>
                </ul>
                <div class="d-flex">
                    <form method="post" action="">
                        <button type="submit" class="nav-link text-white border-0 bg-transparent" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <h1>Welcome to Scribble, <?= $data["user"]["username"] ?>!</h1>
    <h2>This is the <b>Admin Dashboard</b></h2>
    <h2>You're a <?= $data["user"]["role"] ?></h2>
</body>
</html>
