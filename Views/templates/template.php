<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> </title>
    <link rel="icon" type="image/png" sizes="25x25" href="./Public/Img/logo.png">
    <link rel="stylesheet" href="./Public/Css/reset.css">
    <link rel="stylesheet" href="./Public/Css/user.dashboard.css">
    <link rel="stylesheet" href="./Public/Css/user.login.css">
    <link rel="stylesheet" href="./Public/Css/footer.css">
    <link rel="stylesheet" href="./Public/Css/home.css">
    <link rel="stylesheet" href="./Public/Css/responsive.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" defer integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" defer src="./Public/Js/user.dashboard.js"></script>
    <script type="text/javascript" defer src="./Public/Js/settings.js"></script>
    <script type="text/javascript" src="Public/Js/user.form.js" defer></script>
    <script type="text/javascript" src="Public/Js/reset-password.js" defer></script>
</head>

<body>

    <header class="aoi-header">
        <div class="aoi-header-content">
            <div class="aoi-header-img-container">
                <a href="/signals/" title="Page d'accueil">
                    <img class="aoi-img" src="Public/Img/logo.png" alt="logo aoi_signals">
                </a>
            </div>

            <div class="aoi-header-search-btn">
                <?php if (isset($sess['user_status']) && $sess['user_status'] == 'disconected') : ?>
                    <button class="aoi-home-nav-btn aoi-menu-btn">
                        <span class="aoi-nav-item-icon">
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>
                <?php else : ?>
                    <!-- <div class="aoi-search-content">
                        <div class="aoi-search-container aoi-search-hidden">
                            <input class="aoi-search" type="text" name="search" id="search" placeholder="Rechercher">
                        </div>
                        <div class="aoi-search-icon-content">
                            <span class="aoi-search-icon">
                                <i class="fa-solid fa-search"></i>
                            </span>
                        </div>
                    </div> -->

                    <button class="aoi-user-profile-btn aoi-menu-btn" title="Profil d'utilisatur">
                        <?php if ($user->getProfile_image() !== Null) : ?>
                            <img class="aoi-user-profile-image" src="./Images/Users/<?= $user->getProfile_image() ?>" alt="user image">
                        <?php else : ?>
                            <span><?= substr($user->getFirst_name(), 0, 1) . substr($user->getLast_name(), 0, 1) ?></span>
                        <?php endif; ?>
                    </button>
                <?php endif ?>
            </div>

            <?php if (isset($sess['user_status']) && $sess['user_status'] == 'disconected') : ?>

                <div class="aoi-nav-mask">
                    <nav class="aoi-home-nav">
                        <div class="aoi-home-nav-header">
                            <div class="aoi-back-btn">
                                <span class="aoi-back-btn-icon">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </span>
                            </div>

                            <h3 class="aoi-home-nav-title">Aoi Signals</h3>

                            <div class="aoi-home-nav-image-content">
                                <img class="aoi-home-nav-image" src="Public/Img/logo.png" alt="aoi signals logo">
                            </div>
                        </div>
                        <div class="aoi-home-nav-content">
                            <ul>
                                <a class="aoi-home-nav-link" href="/signals/">
                                    <li class="aoi-home-nav-item">Accueil</li>
                                </a>
                                <a class="aoi-home-nav-link" href="/signals/login">
                                    <li class="aoi-home-nav-item">Se connecter</li>
                                </a>
                                <a class="aoi-home-nav-link" href="/signals/register">
                                    <li class="aoi-home-nav-item">S'inscrire</li>
                                </a>
                                <a class="aoi-home-nav-link" href="/signals/faq">
                                    <li class="aoi-home-nav-item">FAQ</li>
                                </a>
                            </ul>
                            <p class="aoi-home-nav-copy">&copy; copyrights Aoi-Signals 2022</p>
                        </div>
                    </nav>
                </div>

            <?php else : ?>
                <nav class="aoi-nav aoi-nav-hidden">
                    <ul>
                        <div class="aoi-nav-item aoi-nav-item-link">
                            <span class="aoi-nav-item-icon aoi-user-icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <span class="aoi-user-name"><?= "{$user->getFirst_name()} {$user->getLast_name()}" ?></span>
                        </div>
                        <li class="aoi-nav-item">
                            <a class="aoi-nav-item-link" href="/signals/dashboard">
                                <span class="aoi-nav-item-icon">
                                    <i class="fa-solid fa-clipboard-user aoi-nav-icon"></i>
                                </span>
                                <span>Tableau de bord</span>
                            </a>
                        </li>
                        <li class="aoi-nav-item">
                            <a class="aoi-nav-item-link" href="/signals/settings">
                                <span class="aoi-nav-item-icon">
                                    <i class="fa-solid fa-gear"></i>
                                </span>
                                <span>Paramètre</span>
                            </a>
                        </li>
                        <li class="aoi-nav-item">
                            <a class="aoi-nav-item-link" href="/signals/settings#premium">
                                <span class="aoi-nav-item-icon">
                                    <i class="fa-solid fa-user-tag aoi-nav-icon"></i>
                                </span>
                                <span>Premium</span>
                            </a>
                        </li>
                        <li class="aoi-nav-item">
                            <a class="aoi-nav-item-link" href="/signals/logout">
                                <span class="aoi-nav-item-icon aoi-logout-icon">
                                    <i class="fa-solid fa-arrow-right-from-bracket aoi-nav-icon"></i>
                                </span>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif ?>
        </div>
    </header>

    <?= $content ?>

    <footer class="aoi-footer">
        <div class="aoi-footer-container">
            <div class="aoi-footer-items">
                <h5 class="aoi-footer-title">À propos de nous</h5>
                <p class="aoi-footer-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                <p class="aoi-footer-text">&copy; Copyrights. All rights reserved.</p>
            </div>
            <div class="aoi-footer-items">
                <h5 class="aoi-footer-title">Liens rapides</h5>
                <nav class="aoi-footer-nav">
                    <ul class="">
                        <li class="aoi-footer-nav-items"><a class="aoi-footer-nav-items-link" href="/signals/">Accueil</a></li>
                        <li class="aoi-footer-nav-items"><a class="aoi-footer-nav-items-link" href="#">Get started</a></li>
                        <li class="aoi-footer-nav-items"><a class="aoi-footer-nav-items-link" href="/signals/faq">FAQ</a></li>
                    </ul>
                </nav>
            </div>
            <div class="aoi-footer-items">
                <h5 class="aoi-footer-title">Retrouver nous sur</h5>
                <nav class="aoi-footer-nav aoi-footer-social-nav">
                    <ul class="">
                        <li class="aoi-footer-nav-items">
                            <a class="aoi-footer-nav-items-link" href="#">
                                <i class="fa-brands fa-facebook-square aoi-footer-nav-items-icon"></i>
                                <span>Facebook</span>
                            </a>
                        </li>
                        <li class="aoi-footer-nav-items">
                            <a class="aoi-footer-nav-items-link" href="#">
                                <i class="fa-brands fa-twitter-square aoi-footer-nav-items-icon"></i>
                                <span>Twitter</span>
                            </a>
                        </li>
                        <li class="aoi-footer-nav-items">
                            <a class="aoi-footer-nav-items-link" href="#">
                                <i class="fa-brands fa-instagram-square aoi-footer-nav-items-icon"></i>
                                <span>Instagram</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </footer>
</body>

</html>