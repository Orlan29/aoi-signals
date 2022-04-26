<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Aoi-signals'; ?> </title>
    <link rel="icon" type="image/png" sizes="25x25" href="Public/Img/logo.png">
    <link rel="stylesheet" href="./Public/Css/reset.css">
    <link rel="stylesheet" href="./Public/Css/user.dashboard.css">
    <link rel="stylesheet" href="./Public/Css/footer.css">
    <link rel="stylesheet" href="./Public/Css/home.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" defer integrity="sha512-6PM0qYu5KExuNcKt5bURAoT6KCThUmHRewN3zUFNaoI6Di7XJPTMoT6K0nsagZKk2OB4L7E3q1uQKHNHd4stIQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" defer src="Public/Js/user.dashboard.js"></script>
    <script type="text/javascript" defer src="<?= isset($link) ? $link : Null; ?>"></script>
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
                <div class="aoi-search-content">
                    <div class="aoi-search-container aoi-search-hidden">
                        <input class="aoi-search" type="text" name="search" id="search" placeholder="Rechercher">
                    </div>
                    <div class="aoi-search-icon-content">
                        <span class="aoi-search-icon">
                            <i class="fa-solid fa-search"></i>
                        </span>
                    </div>
                </div>

                <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'disconected') : ?>
                    <button class="aoi-home-nav-btn aoi-menu-btn">
                        <span class="aoi-nav-item-icon">
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>
                <?php else : ?>
                    <button class="aoi-user-profile-btn aoi-menu-btn" title="Profil d'utilisatur">
                        <span><?= isset($uc) ? 'BB' : 'OK' ?></span>
                    </button>
                <?php endif ?>
            </div>

            <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] == 'disconected') : ?>

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
                            <span class="aoi-user-name"><?= "{$uc->getFirst_name()} {$uc->getLast_name()}" ?></span>
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