<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Document</title>
</head>

<body>
    <?php require_once('commons/header.php'); ?>
    <div class="d-flex justify-content-center mt-5">
        <form action="" method="post" class="bg-white p-4 rounded shadow-sm text-center" style="width: 400px;">
            <div class="mb-3">
                <label for="login" class="form-label fw-semibold">Login</label>
                <input type="text" name="login" id="login" class="form-control">
            </div>

            <div class="mb-3">
                <label for="pwd" class="form-label fw-semibold">Mot de passe</label>
                <input type="password" name="pwd" id="pwd" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Connexion
            </button>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
        </form>
    </div>


</body>

</html>