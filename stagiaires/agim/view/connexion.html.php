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
