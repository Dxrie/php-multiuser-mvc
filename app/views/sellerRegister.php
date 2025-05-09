<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= BASE_URL ?>/public/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
    <title>Register</title>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-4">Register as Seller</h3>
                        <?php App\Core\Flasher::flash(); ?>
                        <form action="register" method="POST">
                            <div class="mb-3">
                                <label for="seller_name" class="form-label">Store Name</label>
                                <input type="text" class="form-control" id="seller_name" name="seller_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Store Description</label>
                                <input type="text" class="form-control" id="description" name="description" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register as a Seller</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
