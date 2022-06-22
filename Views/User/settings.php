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
            <form id="user-image-form" class="aoi-profil-header aoi-profil-item">
                <div class="aoi-profil-content">
                    <input id="user-image" name="user-image" class="aoi-profil-picture-content" type="file" accept="image/png, image/jpg, image/jpeg">
                    <div class="aoi-profil-name">
                        <h2><?= "{$user->getFirst_name()} {$user->getLast_name()}" ?></h2>
                    </div>
                </div>
                <button disabled class="aoi-button user-image-submit" type="submit">
                    <span class="aoi-button-text">Modifier</span>
                    <i class="fa-solid fa-pen"></i>
                </button>
            </form>
            <div class="aoi-profil-item">
                <h3 class="aoi-section-title">À propos de moi</h3>
                <div>
                    <p class="aoi-section-items"><?= "{$user->getFirst_name()} {$user->getLast_name()}" ?></p>
                    <p class="aoi-section-items">Date de naissance : <?= $user->getBirthday() ?></p>
                    <p class="aoi-section-items">Pays : <?= ucfirst($user->getCountry()) ?></p>
                    <p class="aoi-section-items">Contact : <?= $user->getPhone() ?></p>
                </div>
            </div>
            <div class="aoi-profil-item">
                <h3 class="aoi-section-title">Information sur le compte</h3>
                <div>
                    <p class="aoi-section-items">Compte premium ? : </p>
                    <p class="aoi-section-items">Num référence : <?= $user->getUser_ref() ?></p>
                    <p class="aoi-section-items">Date d'inscrition : <?= $user->getRegistered_date() ?></p>
                </div>
            </div>
        </div>
    </section>

    <section id="params" class="aoi-settings-section">
        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Changer votre e-mail</h3>

            <?php if ($user->getId() !== Null) : ?>
                <form class="aoi-settings-form" action="/signals/u/new-email/<?= $user->getId() ?>/" method="post">
                    <?php if (isset($sess['login_validate'])) : ?>
                        <div class="aoi-validate-container">
                            <span class="aoi-error"><?= $sess['login_validate'] ?></span>
                        </div>
                    <?php endif ?>

                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="old-email">Votre e-mail actuel</label>
                        <input class="aoi-form-control setting-form-control" type="email" name="old-email" id="old-email" value="<?= $user->getEmail() ?>" disabled>
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="new-email">Nouvel e-mail</label>
                        <input class="aoi-form-control setting-form-control" type="email" name="new-email" id="new-email">
                    </div>

                    <button class="aoi-button" type="submit">Modifier</button>
                </form>
            <?php else : ?>
                <form class="aoi-settings-form" action="#" method="post">
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="old-email">Votre e-mail actuel</label>
                        <input disabled class="aoi-form-control setting-form-control" type="email" name="old-email" id="old-email" value="<?= $user->getEmail() ?>" disabled>
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="new-email">Nouvel e-mail</label>
                        <input disabled class="aoi-form-control setting-form-control" type="email" name="new-email" id="new-email">
                    </div>

                    <button disabled class="aoi-button" type="submit">Modifier</button>
                </form>
            <?php endif; ?>
        </div>

        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Changer votre mot de passe</h3>

            <?php if ($user->getId() !== Null) : ?>
                <form class="aoi-settings-form" action="/signals/u/new-password/<?= $user->getId() ?>/" method="post">
                    <?php if (isset($sess['login_error'])) : ?>
                        <div class="aoi-error-container">
                            <span class="aoi-error"><?= $sess['login_error'] ?></span>
                        </div>
                    <?php endif ?>

                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="old-password">Votre ancien mot de passe</label>
                        <input class="aoi-form-control setting-form-control" type="password" name="old-password" id="old-password">
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="new-password">Nouveau mot de passe</label>
                        <input class="aoi-form-control setting-form-control" type="password" name="new-password" id="new-password">
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="confirm-password">Confirmer mot de passe</label>
                        <input class="aoi-form-control setting-form-control" type="password" name="confirm-password" id="confirm-password">
                    </div>

                    <button class="aoi-button" type="submit">Modifier</button>
                </form>
            <?php else : ?>
                <form class="aoi-settings-form" action="#" method="post">
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="old-password">Votre ancien mot de passe</label>
                        <input disabled class="aoi-form-control setting-form-control" type="password" name="old-password" id="old-password">
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="new-password">Nouveau mot de passe</label>
                        <input disabled class="aoi-form-control setting-form-control" type="password" name="new-password" id="new-password">
                    </div>
                    <div class="aoi-form-group">
                        <label class="setting-form-label" for="confirm-password">Confirmer mot de passe</label>
                        <input disabled class="aoi-form-control setting-form-control" type="password" name="confirm-password" id="confirm-password">
                    </div>

                    <button disabled class="aoi-button" type="submit">Modifier</button>
                </form>
            <?php endif; ?>
        </div>

        <?php if ($user->getId() !== Null) : ?>
            <div class="aoi-settings-form-content">
                <h3 class="aoi-section-title aoi-text-danger">Supprimer votre compte</h3>
                <div class="aoi-form-group">
                    <p class="aoi-form-group-text"><a class="delete-acount-link" href="#<?= $user->getId() ?>">Je souhaite supprimer mon compte</a></p>
                </div>
                <div class="aoi-nav-mask aoi-hidden">
                    <h3 class="aoi-mask-title">Supprimer le compte?</h3>
                    <div class="aoi-mask-content">
                        <button class="aoi-button mask-item-no">Non</button>
                        <button class="aoi-button mask-item-yes">Oui</button>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </section>

    <section id="premium" class="aoi-settings-section aoi-section-hidden">
        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Adhésion aux membres Premium</h3>
            <p>Vous n'êtes actuellement pas membre Premium.</p>
            <button class="aoi-button" type="submit">Devenir premium</button>
        </div>

        <h3 class="aoi-section-title">Vos factures</h3>

        <div class="aoi-settings-form-content">
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