<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="icon" type="image/png" sizes="25x25" href="../Public/Img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Public/Css/reset.css">
    <link id="theme-link" rel="stylesheet" href="../Public/Css/light-dashboard-admin.style.css">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../Public/Js/dashboard-admin.js" defer></script>
</head>

<body>
    <div class="aoi-dashboard">
        <header class="aoi-header">
            <div class="aoi-logo-container">
                <img class="aoi-logo" src="../Public/Img/logo.png" alt="aoi signals logo">
            </div>
            <nav class="aoi-navbar">
                <ul class="aoi-navbar-nav">
                    <div class="aoi-nav-item-content">
                        <a href="#home" class="aoi-home-item">
                            <li class="aoi-nav-item aoi-home aoi-active">
                                <i class="fa-solid fa-house aoi-nav-icon"></i>
                            </li>
                        </a>
                        <span id="aoi-home-item" class="aoi-nav-label">Accueil</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <a href="#add-event" class="aoi-add-event-item">
                            <li class="aoi-nav-item aoi-add-event">
                                <i class="fa-solid fa-plus aoi-nav-icon"></i>
                            </li>
                        </a>
                        <span id="aoi-add-event-item" class="aoi-nav-label">Plus d'évenements</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <a href="/signals/conf/index" class="aoi-conference-item">
                            <li class="aoi-nav-item aoi-conference">
                                <i class="fa-solid fa-video aoi-nav-icon"></i>
                            </li>
                        </a>
                        <span id="aoi-conference-item" class="aoi-nav-label">Conférence</span>
                    </div>
                    <div class="aoi-nav-item-content">
                        <a href="#setting" class="aoi-setting-item">
                            <li class="aoi-nav-item aoi-setting">
                                <i class="fa-solid fa-gear aoi-nav-icon"></i>
                            </li>
                        </a>
                        <span id="aoi-setting-item" class="aoi-nav-label">Paramètres</span>
                    </div>
                </ul>
            </nav>
            <div class="aoi-nav-item-content">
                <?php if (!empty($admin->getProfile_image())) : ?>
                    <img src="../Images/Admin/<?= $admin->getProfile_image() ?>" alt="admin image" class="aoi-nav-item admin-profile-image">
                <?php else : ?>
                    <div class="aoi-nav-item admin-profile-image">
                        <i class="fa-solid fa-circle-user aoi-nav-icon"></i>
                    </div>
                <?php endif; ?>
                <a href="/signals/a/logout">
                    <div class="aoi-admin-logout">
                        <p class="aoi-admin-logout-item"><?= "{$admin->getLast_name()} {$admin->getFirst_name()}" ?></p>
                        <div class="aoi-admin-logout-content">
                            <i class="fa-solid fa-arrow-right-from-bracket aoi-logout-icon"></i>
                            <span>Déconnexion</span>
                        </div>
                    </div>
                </a>
            </div>
        </header>

        <main class="aoi-main">
            <?php
            $users = $uc->getAllUsers()['users'];
            $user_number = $uc->getAllUsers()['user_number'];
            $amdin_number = $ac->getAllAdmins()['number'];
            ?>

            <section id="home" class="aoi-section aoi-section-active">
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
                                <span id="overview-user" class="aoi-overview-value">
                                    <?= $user_number ?>
                                </span>
                            </div>
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-user-tag aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'utilisateurs prémium
                                </span>
                                <span id="overview-prime" class="aoi-overview-value">
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
                                <span id="overview-event" class="aoi-overview-value">
                                    <?= $events['number'] ?>
                                </span>
                            </div>
                            <div class="aoi-overview-item">
                                <div class="aoi-overview-icon-content">
                                    <i class="fa-solid fa-user-lock aoi-overview-icon"></i>
                                </div>
                                <span class="aoi-overview-name">
                                    Nombre d'administrateurs
                                </span>
                                <span id="overview-admin" class="aoi-overview-value">
                                    <?= $amdin_number ?>
                                </span>
                            </div>
                        </div>
                        <div class="aoi-home-content">
                            <div class="aoi-chart-container">
                                <canvas id="chart" class="aoi-chart"></canvas>
                            </div>
                            <div class="aoi-see-more">
                                <a href="#all-user" class="aoi-nav-item">
                                    <button class="aoi-button aoi-see-all">Voir plus</button>
                                </a>
                                <table class="aoi-table">
                                    <thead class="aoi-table-head">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nom &amp; Prénom</th>
                                            <th>Email</th>
                                            <th>Reférence</th>
                                            <th>Tel</th>
                                            <th>Premium</th>
                                        </tr>
                                    </thead>
                                    <tbody class="aoi-table-body">
                                        <?php
                                        if (!empty($users)) :
                                            $i = 0;
                                            foreach ($users as $user) :
                                                if ($i < 10) :
                                        ?>
                                                    <tr is-active="true" user-id=<?= $user->getId() ?>>
                                                        <td><?= $user->getId() ?></td>
                                                        <td><?= "{$user->getLast_name()} {$user->getFirst_name()}" ?></td>
                                                        <td><?= $user->getEmail() ?></td>
                                                        <td><?= $user->getUser_ref() ?></td>
                                                        <td><?= $user->getPhone() ?></td>
                                                        <td><?= $user_number ?></td>
                                                    </tr>
                                            <?php
                                                    $i += 1;
                                                endif;
                                            endforeach;
                                        else :
                                            ?>
                                            <tr>
                                                <td colspan="7">Aucun utilisateur disponible pour l'intant.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="aoi-home-events">
                        <h2 class="aoi-section-title">Evènements en cours</h2>
                        <?php if (!empty($events['events'])) : ?>
                            <div class="aoi-home-events-content">
                                <?php foreach ($events['events'] as $event) : ?>
                                    <div class="aoi-home-events-item">
                                        <?php foreach ($events['publishers'] as $publisher) :
                                            if ($event->getPublisher() == "{$publisher->getLast_name()} {$publisher->getFirst_name()}") : ?>
                                                <div class="aoi-events-header">
                                                    <img class="aoi-events-owner" src="../Images/Admin/<?= $publisher->getProfile_image() ?>" alt="publisher">
                                                    <span class="aoi-events-title"><?= "{$publisher->getFirst_name()} {$publisher->getLast_name()}" ?></span>
                                                </div>
                                        <?php
                                            endif;
                                            break;
                                        endforeach; ?>
                                        <div class="aoi-events-content">
                                            <p><?= $event->getTitle() ?></p>
                                        </div>
                                        <div class="aoi-events-footer">
                                            <span class="aoi-events-date"><?= $event->getEnd_date() ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div>
                                <p>Aucun évènement en cours</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section id="add-event" class="aoi-section">
                <div class="aoi-form-content aoi-event-container">
                    <h1 class="aoi-section-title aoi-setting-title">Ajouter un évènement</h1>
                    <form class="aoi-form" action="/signals/a/add-event" method="post">
                        <div class="aoi-form-group">
                            <div class="aoi-form-control-container">
                                <input type="text" value="<?= "{$admin->getFirst_name()} {$admin->getLast_name()}" ?>" class="aoi-form-control" name="author" id="author">
                                <label for="author" class="aoi-form-label">Nom de l'auteur</label>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <div class="aoi-form-control-container">
                                <input type="text" class="aoi-form-control" name="title" id="title">
                                <label for="title" class="aoi-form-label">Titre évènement</label>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <label for="dateOfBorn" class="aoi-select-label">Date de l'évènement</label>

                            <div class="aoi-select-group">
                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="day" id="dateOfBorn">
                                        <option selected value="days">Jours</option>
                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="month" id="monthOfBorn">
                                        <option selected value="month">Mois</option>
                                        <?php
                                        $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

                                        foreach ($months as $key => $value) :
                                        ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="year" id="yearOfBorn">
                                        <option selected value="years">Années</option>
                                        <?php for ($i = 2022; $i <= 2050; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <label class="aoi-select-label">Heure de l'évènement</label>

                            <div class="aoi-select-group">
                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="hour" id="hours">
                                        <option selected value="hours">Heures</option>
                                        <?php for ($i = 0; $i <= 23; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="minute" id="minutes">
                                        <option selected value="min">Minutes</option>
                                        <?php for ($i = 0; $i <= 59; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <label class="aoi-select-label">Date de fin</label>

                            <div class="aoi-select-group">
                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="end-day" id="end-day">
                                        <option selected value="days">Jours</option>
                                        <?php for ($i = 1; $i <= 31; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="end-month" id="end-month">
                                        <option selected value="month">Mois</option>
                                        <?php
                                        $months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

                                        foreach ($months as $key => $value) :
                                        ?>
                                            <option value="<?= $key ?>"><?= $value ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="end-year" id="end-years">
                                        <option selected value="years">Années</option>
                                        <?php for ($i = 2022; $i <= 2050; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <label class="aoi-select-label">Heure de fin</label>

                            <div class="aoi-select-group">
                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="end-hour" id="end-hours">
                                        <option selected value="end-hours">Heures</option>
                                        <?php for ($i = 0; $i <= 23; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>

                                <div class="aoi-select-control-container">
                                    <select class="aoi-select-control" name="end-minute" id="endminutes">
                                        <option selected value="min">Minutes</option>
                                        <?php for ($i = 0; $i <= 59; $i++) : ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <div class="aoi-form-control-container">
                                <textarea class="aoi-form-control aoi-textarea-control" name="content" id="content">Contenu de l'évènement</textarea>
                            </div>
                        </div>

                        <button class="aoi-button aoi-button-submit" type="submit">Ajouter l'évènement</button>
                    </form>
                </div>
            </section>

            <section id="setting" class="aoi-section">
                <div class="aoi-setting-container">
                    <h1 class="aoi-section-title aoi-setting-title">Paramètres</h1>

                    <form id="admin-image-form" class="aoi-profil-header aoi-profil-item">
                        <div class="aoi-profil-content">
                            <input id="admin-image" name="user-image" class="aoi-profil-picture-content" type="file" accept="image/png, image/jpg, image/jpeg">
                            <div class="aoi-profil-name">
                                <h2><?= "{$admin->getFirst_name()} {$admin->getLast_name()}" ?></h2>
                            </div>
                        </div>
                        <button disabled class="aoi-button user-image-submit" type="submit">
                            <span class="aoi-button-text">Modifier</span>
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </form>

                    <form class="aoi-form">
                        <div class="aoi-form-group aoi-dark-mode">
                            <label for="dark-mode" class="aoi-setting-label">Mode sombre</label>
                            <input type="checkbox" id="dark-mode" class="aoi-checkbox">
                        </div>

                        <div class="aoi-form-group">
                            <div class="aoi-select-control-container">
                                <select id="typography" class="aoi-select-control">
                                    <option value="none">Défaut</option>
                                    <option value="Roboto">Roboto</option>
                                    <option value="Architects Daughter">Architects Daughter</option>
                                    <option value="Cookie">Cookie</option>
                                    <option value="Amiri">Amiri</option>
                                </select>
                            </div>
                        </div>

                        <div class="aoi-form-group">
                            <div class="aoi-select-control-container">
                                <select id="font-size" class="aoi-select-control">
                                    <option value="0.85rem">Petite</option>
                                    <option value="1rem" selected>Normal</option>
                                    <option value="1.3rem">Grande</option>
                                    <option value="1.5rem">Très grande</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </section>

            <section id="user" class="aoi-section">
                <div class="aoi-user-profile aoi-section-container">
                    <h1 class="aoi-section-title">Information Utilisateur</h1>
                    <div class="aoi-user-profile-header">
                        <div class="aoi-user-profile-info">
                            <div class="aoi-user-profile-img"></div>
                            <div class="aoi-user-profile-name"></div>
                        </div>
                        <button class="aoi-button">Supprimer ce compte</button>

                        <div class="aoi-nav-mask aoi-hidden">
                            <h3 class="aoi-mask-title">Supprimer le compte?</h3>
                            <div class="aoi-mask-content">
                                <button class="aoi-button mask-item-no">Non</button>
                                <button class="aoi-button mask-item-yes">Oui</button>
                            </div>
                        </div>
                    </div>
                    <div class="aoi-user-profile-content">
                        <p class="aoi-user-profile-item email">
                            <span>Email :</span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item country">
                            <span>Pays : </span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item city">
                            <span>Ville : </span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item birthday">
                            <span>Date naissance : </span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item registered_date">
                            <span>Date inscription : </span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item phone">
                            <span>Téléphone : </span>
                            <span></span>
                        </p>
                        <p class="aoi-user-profile-item ref">
                            <span>Reférence : </span>
                            <span></span>
                        </p>
                    </div>
                </div>
            </section>

            <section id="all-user" class="aoi-section">
                <div class="aoi-section-container">
                    <h1 class="aoi-section-title">All User content</h1>
                    <table class="aoi-table">
                        <thead class="aoi-table-head">
                            <tr>
                                <th>ID</th>
                                <th>Nom &amp; Prénom</th>
                                <th>Email</th>
                                <th>Reférence</th>
                                <th>Tel</th>
                                <th>Premium</th>
                            </tr>
                        </thead>
                        <tbody all-user class="aoi-table-body all-users"></tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>

</html>