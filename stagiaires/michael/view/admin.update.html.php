<!DOCTYPE html>
<!--
Template name: Nova
Template author: FreeBootstrap.net
Author website: https://freebootstrap.net/
License: https://freebootstrap.net/license
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercice MVC 2025 | Modification d'un article</title>

    <!-- ======= Google Font =======-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&amp;display=swap" rel="stylesheet">
    <!-- End Google Font-->

    <!-- ======= Styles =======-->
    <link href="assets/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendors/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="assets/vendors/glightbox/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendors/aos/aos.css" rel="stylesheet">
    <!-- End Styles-->

    <!-- ======= Theme Style =======-->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- End Theme Style-->

    <!-- ======= Apply theme =======-->
    <script>
        // Apply the theme as early as possible to avoid flicker
        (function() {
            const storedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', storedTheme);
        })();
    </script>
</head>
<body>


<!-- ======= Site Wrap =======-->
<div class="site-wrap">


    <!-- ======= Header =======-->
    <header class="fbs__net-navbar navbar navbar-expand-lg dark" aria-label="freebootstrap.net navbar">
        <div class="container d-flex align-items-center justify-content-between">


            <!-- Start Logo-->
            <a class="navbar-brand w-auto" href="./">
                <!-- If you use a text logo, uncomment this if it is commented-->
                <!-- Vertex-->

                <!-- If you plan to use an image logo, uncomment this if it is commented-->

                <!-- logo dark--><img class="logo dark img-fluid" src="assets/images/logo-dark.svg" alt="FreeBootstrap.net image placeholder">

                <!-- logo light--><img class="logo light img-fluid" src="assets/images/logo-light.svg" alt="FreeBootstrap.net image placeholder">

            </a>
            <!-- End Logo-->

            <!-- Start offcanvas-->
            <div class="offcanvas offcanvas-start w-75" id="fbs__net-navbars" tabindex="-1" aria-labelledby="fbs__net-navbarsLabel">


                <div class="offcanvas-header">
                    <div class="offcanvas-header-logo">
                        <!-- If you use a text logo, uncomment this if it is commented-->

                        <!-- h5#fbs__net-navbarsLabel.offcanvas-title Vertex-->

                        <!-- If you plan to use an image logo, uncomment this if it is commented-->
                        <a class="logo-link" id="fbs__net-navbarsLabel" href="./">


                            <!-- logo dark--><img class="logo dark img-fluid" src="assets/images/logo-dark.svg" alt="FreeBootstrap.net image placeholder">

                            <!-- logo light--><img class="logo light img-fluid" src="assets/images/logo-light.svg" alt="FreeBootstrap.net image placeholder"></a>

                    </div>
                    <button class="btn-close btn-close-black" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body align-items-lg-center">


                    <?php
                    include "_menu.html.php";
                    ?>


                    </ul>

                </div>
            </div>
            <!-- End offcanvas-->

            <div class="ms-auto w-auto">


                    <button class="fbs__net-navbar-toggler justify-content-center align-items-center ms-auto" data-bs-toggle="offcanvas" data-bs-target="#fbs__net-navbars" aria-controls="fbs__net-navbars" aria-label="Toggle navigation" aria-expanded="false">
                        <svg class="fbs__net-icon-menu" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="21" x2="3" y1="6" y2="6"></line>
                            <line x1="15" x2="3" y1="12" y2="12"></line>
                            <line x1="17" x2="3" y1="18" y2="18"></line>
                        </svg>
                        <svg class="fbs__net-icon-close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>

                </div>

            </div>
        </div>
    </header>
    <!-- End Header-->

    <!-- ======= Main =======-->
    <main>


        <!-- ======= Hero =======-->
        <section class="hero__v6 section" id="home">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-2 mb-lg-0">
                        <div class="row">
                            <div class="col-lg-11"><span class="hero-subtitle text-uppercase" data-aos="fade-up" data-aos-delay="0">webdev la classe one</span>
                                <h1 class="hero-title mb-3" data-aos="fade-up" data-aos-delay="100">Modification d'un article</h1>
                                <h4 class="mb-3" data-aos="fade-up" data-aos-delay="100"><a href="./?pg=admin">Retour à l'administration</a> CR(U)D</h4>
                            </div>
                            </div>
                        </div>

                </div>
            </div>
            <!-- End Hero-->
        </section>
        <!-- End Hero-->


        <!-- ======= FAQ =======-->
        <section class="section faq__v2" id="faq">
            <div class="container">
                <div class="mt-3 <?=$displaySucces?>  alert alert-success" id="successMessage">Merci pour votre article</div>
                <div class="mt-3 <?=$displayError?> alert alert-danger" id="errorMessage">Article non valide !</div>
                <?php
                // si c'est un succès, on crée la redirection en js
                if(isset($jsRedirect)) echo $jsRedirect;
                ?>
                <span class="subtitle text-uppercase mb-3" data-aos="fade-up" data-aos-delay="0">Formulaire</span>
                <form class="<?=$displayForm?>" action="" method="post" name="insertion">
                    <input type="hidden" name="idarticle" value="<?=$article['idarticle']?>"/>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Votre titre</label>
                        <input type="text" name="title"  class="form-control" id="exampleFormControlInput1" placeholder="titre" value="<?=$article['title']?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlslug" class="form-label">Votre slug</label>
                        <input type="text" name="slug"  class="form-control" id="exampleFormControlslug" placeholder="slug" value="<?=$article['slug']?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlText" class="form-label">Notre article</label>
                        <textarea name="articletext" class="form-control" id="exampleFormControlText" rows="5"><?=$article['articletext']?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlText" class="form-label">Auteur (origine : <?=$article['login']?>)</label>
                        <select name="user_iduser" class="form-select" aria-label="Default select example">
                            <?php
                            // tant qu'on a des utilisateurs
                            foreach($users as $user):
                                // on vérifie l'actuel
                                $checked = $user['iduser'] == $article['iduser']? "selected" : "";
                            ?>
                            <option value="<?=$user['iduser']?>" <?=$checked?>><?=$user['login']?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>

                    </div>
                    <div class="form-check">
                        <?php $check = ($article['articlepublished']===1)? "checked" : ""; ?>
                        <input class="form-check-input" name="articlepublished" type="checkbox" value="1" id="publish" <?=$check?>>
                        <label class="form-check-label" for="checkDefault">
                            Publié ?
                        </label>
                    </div>
                    <div id="dateContainer" class="mb-3">
                        <label class="form-label fw-semibold">Date et heure de publication :</label>
                        <input type="datetime-local" name="articledatepublished" class="form-control" value="<?=$article['articledatepublished']?>">
                    </div>
                    <input type="submit" value="Mettre à jour">
                </form>
                    </div>


            <!-- End FAQ-->
        </section>
        <!-- End FAQ-->


        <!-- ======= Footer =======-->
        <footer class="footer pt-5 pb-5">
            <div class="container">
                <div class="row credits pt-3">
                    <div class="col-xl-8 text-center text-xl-start mb-3 mb-xl-0">
                        <!--
                        Note:
                        =>>> Please keep all the footer links intact. <<<=
                        =>>> You can only remove the links if you buy the pro version. <<<=
                        =>>> Buy the pro version, which includes a functional PHP/AJAX contact form and many additional features.: https://freebootstrap.net/template/vertex-pro-bootstrap-website-template-for-portfolio/ <<<=
                        -->
                        &copy;
                        <script>document.write(new Date().getFullYear());</script> Nova.
                        All rights reserved. Designed with <i class="bi bi-heart-fill text-danger"></i> by <a href="https://freebootstrap.net">FreeBootstrap.net</a>
                    </div>
                    <div class="col-xl-4 justify-content-start justify-content-xl-end quick-links d-flex flex-column flex-xl-row text-center text-xl-start gap-1">Distributed by<a href="https://themewagon.com" target="_blank">ThemeWagon</a></div>
                </div>
            </div>
        </footer>
        <!-- End Footer-->

    </main>


<!-- ======= Back to Top =======-->
<button id="back-to-top"><i class="bi bi-arrow-up-short"></i></button>
<!-- End Back to top-->

<!-- ======= Javascripts =======-->
<script>
    // affichage du formulaire si on choisit publier.
    document.getElementById('publish').addEventListener('change', function () {
        const dateContainer = document.getElementById('dateContainer');
        dateContainer.classList.toggle('d-none', !this.checked);
    });
</script>
<script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="assets/vendors/gsap/gsap.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendors/isotope/isotope.pkgd.min.js"></script>
<script src="assets/vendors/glightbox/glightbox.min.js"></script>
<script src="assets/vendors/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendors/aos/aos.js"></script>
<script src="assets/vendors/purecounter/purecounter.js"></script>
<script src="assets/js/custom.js"></script>
<script src="assets/js/send_email.js"></script>
<!-- End JavaScripts-->
</body>
</html>