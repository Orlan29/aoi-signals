<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Public/Css/reset.css?">
    <link id="theme-link" rel="stylesheet" href="../Public/Css/light-dashboard-admin.style.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../Public/Js/dashboard-admin.js" defer></script>
</head>

<body>
    <div class="aoi-dashboard">
        <header class="aoi-header">
            <div class="aoi-logo-container">
                <img class="aoi-logo" src="../Public/Img/logo.jpg" alt="aoi signals logo">
            </div>
            <nav class="aoi-navbar">
                <ul class="aoi-navbar-nav">
                    <div class="aoi-nav-item-content">
                        <li class="aoi-nav-item aoi-home aoi-active">
                            <i class="fa-solid fa-house aoi-nav-icon"></i>
                        </li>
                        <span id="aoi-home" class="aoi-nav-label">Accueil</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <li class="aoi-nav-item aoi-add-event">
                            <i class="fa-solid fa-plus aoi-nav-icon"></i>
                        </li>
                        <span id="aoi-add-event" class="aoi-nav-label">Plus d'évenements</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <a href="/signals/conf/index">
                            <li class="aoi-nav-item aoi-conference">
                                <i class="fa-solid fa-video aoi-nav-icon"></i>
                            </li>
                        </a>
                        <span id="aoi-conference" class="aoi-nav-label">Conférence</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <li class="aoi-nav-item aoi-setting">
                            <i class="fa-solid fa-gear aoi-nav-icon"></i>
                        </li>
                        <span id="aoi-setting" class="aoi-nav-label">Paramètres</span>
                    </div>
                </ul>
            </nav>
            <div class="aoi-nav-item-content">
                <div class="aoi-nav-item">
                    <i class="fa-solid fa-circle-user aoi-nav-icon"></i>
                </div>
                <div class="aoi-admin-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket aoi-logout-icon"></i>
                    <span>Déconnexion</span>
                </div>
            </div>
        </header>

        <main class="aoi-main">
            <section id="aoi-home" class="aoi-section aoi-section-active">
                <div class="aoi-home-container">
                    <div class="aoi-home-main">
                        <h1 class="aoi-section-title">Tableau de bors</h1>
                        <div class="aoi-overview">
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-users aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'utilisateurs
                                </span>
                                <span class="aoi-overview-value">
                                    0
                                </span>
                            </div>
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-user-tag aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'utilisateurs prémium
                                </span>
                                <span class="aoi-overview-value">
                                    0
                                </span>
                            </div>
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-dice aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'évènements
                                </span>
                                <span class="aoi-overview-value">
                                    0
                                </span>
                            </div>
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-user-lock aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'administrateurs
                                </span>
                                <span class="aoi-overview-value">
                                    0
                                </span>
                            </div>
                        </div>
                        <div class="aoi-home-content">
                            <div class="aoi-chart-container">
                                <canvas id="chart" class="aoi-chart"></canvas>
                            </div>
                            <div class="aoi-see-more">
                                <button class="aoi-button aoi-see-all">Voir plus</button>
                                <table class="aoi-table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nom</th>
                                            <th>E-mail</th>
                                            <th>Premium</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="aoi-home-events">
                        <h2 class="aoi-section-title">Evènements en cours</h2>
                        <div class="aoi-home-events-content">
                            <div class="aoi-home-events-item">
                                <div class="aoi-events-header">
                                    <span class="aoi-events-owner"></span>
                                    <span class="aoi-events-owner-name">Nom de l'auteur</span>
                                </div>
                                <div class="aoi-events-body">
                                    <span class="aoi-events-title">Lorem ipsum dolor sit amet.</span>
                                    <span class="aoi-events-date">dd/mm/YYYY</span>
                                </div>
                            </div>
                            <div class="aoi-home-events-item">
                                <div class="aoi-events-header">
                                    <span class="aoi-events-owner"></span>
                                    <span class="aoi-events-owner-name">Nom de l'auteur</span>
                                </div>
                                <div class="aoi-events-body">
                                    <span class="aoi-events-title">Lorem ipsum dolor sit amet.</span>
                                    <span class="aoi-events-date">dd/mm/YYYY</span>
                                </div>
                            </div>
                            <div class="aoi-home-events-item">
                                <div class="aoi-events-header">
                                    <span class="aoi-events-owner"></span>
                                    <span class="aoi-events-owner-name">Nom de l'auteur</span>
                                </div>
                                <div class="aoi-events-body">
                                    <span class="aoi-events-title">Lorem ipsum dolor sit amet.</span>
                                    <span class="aoi-events-date">dd/mm/YYYY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="aoi-add-event" class="aoi-section">
                <div class="aoi-event-container">
                    <h1 class="aoi-section-title">Ajouter un évènement</h1>
                    <div class="">
                        <form class="aoi-form" action="#">
                            <div class="aoi-form-group">
                                <label for="author-name" class="aoi-setting-label">Nom de l'auteur</label>
                                <input type="text" id="author-name" name="author-name" class="aoi-form-control">
                            </div>
                            <div>
                                <div class="aoi-form-group">
                                    <label for="author-name" class="aoi-setting-label">Date de début</label>
                                    <input type="date" id="author-name" name="" class="aoi-form-control">
                                </div>
                                <div class="aoi-form-group">
                                    <label for="author-name" class="aoi-setting-label">Heure de début</label>
                                    <input type="time" id="author-name" name="" class="aoi-form-control">
                                </div>
                            </div>
                            <div>
                                <div class="aoi-form-group">
                                    <label for="author-name" class="aoi-setting-label">Date de fin</label>
                                    <input type="date" id="author-name" name="" class="aoi-form-control">
                                </div>
                                <div class="aoi-form-group">
                                    <label for="author-name" class="aoi-setting-label">Heure de fin</label>
                                    <input placeholder="Ex. 03:50 PM" type="time" id="author-name" name="" class="aoi-form-control">
                                </div>
                            </div>
                            <div class="aoi-form-group">
                                <label for="author-name" class="aoi-setting-label">Contenu de l'évènement</label>
                                <textarea id="" class="aoi-form-control aoi-event-msg" name=""></textarea>
                            </div>
                            <div class="aoi-form-group">
                                <button id="apply-change" class="aoi-button">Publier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            <section id="aoi-setting" class="aoi-section">
                <div class="aoi-setting-container">
                    <h1 class="aoi-section-title aoi-setting-title">Paramètres</h1>
                    <div class="">
                        <form class="aoi-form" action="#">
                            <div class="aoi-form-group aoi-dark-mode">
                                <label for="dark-mode" class="aoi-setting-label">Mode sombre</label>
                                <input type="checkbox" id="dark-mode" class="aoi-checkbox">
                            </div>
                            <div class="aoi-form-group">
                                <label for="typography" class="aoi-setting-label">Typography</label>
                                <select id="typography" class="aoi-form-control">
                                    <option value="none">Défaut</option>
                                    <option value="Roboto">Roboto</option>
                                    <option value="Architects Daughter">Architects Daughter</option>
                                    <option value="Cookie">Cookie</option>
                                    <option value="Amiri">Amiri</option>
                                </select>
                            </div>
                            <div class="aoi-form-group">
                                <label for="font-size" class="aoi-setting-label">Taille de la police</label>
                                <select id="font-size" class="aoi-form-control">
                                    <option value="0.85rem">Petite</option>
                                    <option value="1rem" selected>Normal</option>
                                    <option value="1.3rem">Grande</option>
                                    <option value="1.5rem">Très grande</option>
                                </select>
                            </div>
                            <div class="aoi-form-group">
                                <button id="apply-change" class="aoi-button">Appliquer les changements</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>

</html>