<?php
$title = 'Paramètre';
$link = 'Public/Js/settings.js';

require_once './Views/templates/header.php';
?>

<main>
    <section class="aoi-banner-section">
        <div class="aoi-banner-container">
            <div class="aoi-banner-title-container">
                <h1 class="aoi-banner-title">Paramètres</h1>
            </div>
            <nav class="aoi-banner-nav">
                <ul class="aoi-banner-nav-content">
                    <a class="aoi-banner-nav-items" href="#profil">
                        <li class="aoi-profil">Profil</li>
                    </a>
                    <a class="aoi-banner-nav-items" href="#params">
                        <li class="yaoi-params">Paramètres</li>
                    </a>
                    <a class="aoi-banner-nav-items" href="#premium">
                        <li class="aoi-premium">Premium</li>
                    </a>
                </ul>
            </nav>
        </div>
    </section>

    <section id="profil" class="aoi-settings-section aoi-section-hidden">
        <div class="aoi-profil-container">
            <div class="aoi-profil-header aoi-profil-content">
                <div class="aoi-profil-picture-content"></div>
                <div class="aoi-profil-name">
                    <h2><?= "{$uc->getFirst_name()} {$uc->getLast_name()}" ?></h2>
                </div>
            </div>
            <div class="aoi-profil-content">
                <h3 class="aoi-section-title">À propos de moi</h3>
                <div>
                    <p class="aoi-section-items"><?= "{$uc->getFirst_name()} {$uc->getLast_name()}" ?></p>
                    <p class="aoi-section-items">Date de naissance : <?= $uc->getBirthday() ?></p>
                    <p class="aoi-section-items">Pays : <?= ucfirst($uc->getCountry()) ?></p>
                    <p class="aoi-section-items">Contact : <?= $uc->getPhone() ?></p>
                </div>
            </div>
            <div class="aoi-profil-content">
                <h3 class="aoi-section-title">Information sur le compte</h3>
                <div>
                    <p class="aoi-section-items">Cet compte est premium ? : </p>
                    <p class="aoi-section-items">Numéro de référence : </p>
                    <p class="aoi-section-items">Date d'inscrition : <?= $uc->getRegistered_date() ?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="params" class="aoi-settings-section">
        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Changer votre e-mail</h3>

            <form class="aoi-settings-form" action="/signals/u/new-email/<?= $uc->getId() ?>/" method="post">
                <?php if (isset($_SESSION['login_validate'])) : ?>
                    <div class="aoi-validate-container">
                        <span class="aoi-error"><?= $_SESSION['login_validate'] ?></span>
                    </div>
                <?php endif ?>

                <div class="aoi-form-group">
                    <label class="aoi-form-label" for="old-email">Votre e-mail actuel</label>
                    <input class="aoi-form-control" type="email" name="old-email" id="old-email" value="<?= $uc->getEmail() ?>" disabled>
                </div>
                <div class="aoi-form-group">
                    <label class="aoi-form-label" for="new-email">Nouvel e-mail</label>
                    <input class="aoi-form-control" type="email" name="new-email" id="new-email">
                </div>

                <button class="aoi-button" type="submit">Modifier</button>
            </form>
        </div>

        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Changer votre mot de passe</h3>
            <form class="aoi-settings-form" action="/signals/u/new-password/<?= $uc->getId() ?>/" method="post">
                <?php if (isset($_SESSION['login_error'])) : ?>
                    <div class="aoi-error-container">
                        <span class="aoi-error"><?= $_SESSION['login_error'] ?></span>
                    </div>
                <?php endif ?>

                <div class="aoi-form-group">
                    <label class="aoi-form-label" for="old-password">Votre ancien mot de passe</label>
                    <input class="aoi-form-control" type="password" name="old-password" id="old-password">
                </div>
                <div class="aoi-form-group">
                    <label class="aoi-form-label" for="new-password">Nouveau mot de passe</label>
                    <input class="aoi-form-control" type="password" name="new-password" id="new-password">
                </div>
                <div class="aoi-form-group">
                    <label class="aoi-form-label" for="confirm-password">Confirmer mot de passe</label>
                    <input class="aoi-form-control" type="password" name="confirm-password" id="confirm-password">
                </div>

                <button class="aoi-button" type="submit">Modifier</button>
            </form>
        </div>

        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title aoi-text-danger">Supprimer votre compte</h3>
            <div class="aoi-form-group">
                <p class="aoi-form-group-text"><a href="/signals/u/delete/<?= $uc->getId() ?>/">Je souhaite supprimer mon compte</a></p>
            </div>
        </div>
    </section>

    <section id="premium" class="aoi-settings-section aoi-section-hidden">
        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Adhésion aux membres Premium</h3>
            <p>Vous n'êtes actuellement pas membre Premium.</p>
            <button class="aoi-button" type="submit">Devenir premium</button>
        </div>

        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Vos factures</h3>
            <table class="aoi-table">
                <thead class="aoi-table-head">
                    <tr>
                        <th>N° facture</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Facture</th>
                    </tr>
                </thead>
                <tbody class="aoi-table-body">
                    <tr>
                        <td colspan="7">Vous n'avez aucune facture.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require_once './Views/templates/footer.php'; ?>