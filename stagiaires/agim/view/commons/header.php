<style>
    a.nav-link {
        position: relative;
        color: black;
        text-decoration: none;
    }

    a.nav-link::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        height: 2px;
        background-color: black;
        width: 0;
        transition: width 0.3s ease;
    }

    a.nav-link:hover::after {
        width: 100%;
    }
</style>

<header>
    <nav class="bg-light border-bottom py-3">
        <ul class="nav justify-content-center fs-4">
            <li class="nav-item">
                <a class="nav-link" href="./">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?page=about">A propos</a>
            </li>
            <?php if (isset($_SESSION['login'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=admin">Administration</a>
                </li>
                <li class="nav-item d-flex align-items-center px-2 text-dark">
                    Bienvenue sur la session de <?= htmlspecialchars($_SESSION['login']) ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?page=deconn">Déconnexion</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="?page=conn">Connexion</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
