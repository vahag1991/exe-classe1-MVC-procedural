<div class="d-flex justify-content-center mt-5 p-4">
    <form method="POST" action="" class="bg-white p-4 rounded shadow-sm w-100" style="max-width: 700px;">
        <div class="mb-3">
            <label class="form-label fw-semibold">Titre :</label>
            <input type="text" name="title" required class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Contenu de l'article :</label>
            <textarea name="articletext" rows="6" required class="form-control"></textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" id="publish" name="publish" value="1" class="form-check-input">
            <label for="publish" class="form-check-label">Publier l'article</label>
        </div>

        <div id="dateContainer" class="mb-3 d-none">
            <label class="form-label fw-semibold">Date et heure de publication :</label>
            <input type="datetime-local" name="articledatepublished" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary w-100">Ajouter l'article</button>

        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </form>
</div>

<script>
    document.getElementById('publish').addEventListener('change', function () {
        const dateContainer = document.getElementById('dateContainer');
        dateContainer.classList.toggle('d-none', !this.checked);
    });
</script>
