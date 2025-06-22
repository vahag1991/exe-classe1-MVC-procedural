<div class="d-flex justify-content-center mt-5">
    <form action="" method="post" class="bg-white p-4 rounded shadow-sm text-center" style="width: 400px;">
        <div class="mb-3">
            <label for="login_inscription" class="form-label fw-semibold">Login</label>
            <input type="text" name="login_inscription" id="login_inscription" class="form-control">
        </div>

        <div class="mb-3">
            <label for="full_name" class="form-label fw-semibold">Nom complet</label>
            <input type="text" name="full_name" id="full_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="mail_inscription" class="form-label fw-semibold">Email</label>
            <input type="email" name="mail_inscription" id="mail_inscription" class="form-control">
        </div>

        <div class="mb-4">
            <label for="pwd_inscription" class="form-label fw-semibold">Mot de passe</label>
            <input type="password" name="pwd_inscription" id="pwd_inscription" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">
            Inscription
        </button>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </form>
</div>
