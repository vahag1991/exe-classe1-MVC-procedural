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


    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show mt-3 text-center" role="alert">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3 text-center" role="alert">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</body>

</html>