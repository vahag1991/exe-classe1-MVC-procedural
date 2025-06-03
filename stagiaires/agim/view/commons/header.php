<header>
    <nav>
        <ul class="d-flex justify-center gap-[20px] text-3xl p-4 bg-gray-300 border-1">
            <li><a class="text-black" href="./">Accueil</a></li>
            <li><a class="text-black" href="?page=about">About</a></li>
            <?php
            if (isset($_SESSION['login'])) {
            ?>
                <li><a class="text-black" href="?page=deconn">Administration</a></li>
                <li class="text-black">Bienvenue sur la session de <?= $_SESSION['login']; ?> </li>
                <li><a class="text-black" href="?page=deconn">Deconnexion</a></li>
            <?php
            } else {
            ?>
                <li><a class="text-black" href="?page=conn">Connexion</a></li>
            <?php
            }
            ?>
        </ul>
    </nav>
</header>