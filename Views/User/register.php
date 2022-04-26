<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="icon" type="image/png" sizes="16x16" href="Public/Img/logo.jpg">
    <link rel="stylesheet" href="Public/Css/reset.css">
    <link rel="stylesheet" href="Public/Css/user.login.css">
    <script type="text/javascript" src="Public/Js/user.form.js" defer></script>
    <script type="text/javascript" src="Public/Js/form.control.js" defer></script>
</head>

<body>
    <main class="aoi-login">
        <section class="aoi-login-form-section">
            <div class="aoi-logo-container">
                <img class="aoi-logo" src="Public/Img/logo.png" alt="aoi-signals logo">
            </div>
            <div class="aoi-form-content">
                <div class="aoi-form-title-container">
                    <h1 class="aoi-form-title aoi-register-title">Inscription</h1>
                </div>
                <form class="aoi-form" action="/signals/u/verify" method="post">

                    <?php if (isset($_SESSION['register_error'])) : ?>
                        <div class="aoi-error-container">
                            <span class="aoi-error"><?= $_SESSION['register_error'] ?></span>
                        </div>
                    <?php elseif (isset($_SESSION['ref_error'])) : ?>
                        <div class="aoi-error-container">
                            <span class="aoi-error"><?= $_SESSION['ref_error'] ?></span>
                        </div>
                    <?php endif ?>

                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="text" class="aoi-form-control" name="firstName" id="firstName">
                            <label for="firstName" class="aoi-form-label">Prénom</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-firstName-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="text" class="aoi-form-control" name="lastName" id="lastName">
                            <label for="lastName" class="aoi-form-label">Nom</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-lastName-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="email" class="aoi-form-control" name="email" id="email">
                            <label for="email" class="aoi-form-label">Adresse e-mail</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-email-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <label for="dateOfBorn" class="aoi-select-label">Date de naissance</label>

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

                                    foreach ($months as $month) :
                                    ?>
                                        <option value="<?= $month ?>"><?= $month ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="aoi-select-control-container">
                                <select class="aoi-select-control" name="years" id="yearOfBorn">
                                    <option selected value="years">Années</option>
                                    <?php for ($i = 2007; $i >= 1927; $i--) : ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="text" class="aoi-form-control" name="phone" id="phone">
                            <label for="phone" class="aoi-form-label">Contact</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-phone-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="aoi-form-group aoi-group-field">
                        <div class="aoi-town-field">
                            <div class="aoi-form-control-container">
                                <input type="text" class="aoi-form-control" name="town" id="town">
                                <label for="town" class="aoi-form-label">Ville de résidence</label>
                            </div>
                            <div class="aoi-label-error-container">
                                <span class="aoi-town-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                            </div>
                        </div>


                        <div class="aoi-country-field">
                            <div class="aoi-form-control-container">
                                <input type="text" class="aoi-form-control" name="country" id="country">
                                <label for="country" class="aoi-form-label">Pays de résidence</label>
                            </div>
                            <div class="aoi-label-error-container">
                                <span class="aoi-country-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                            </div>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="password" class="aoi-form-control" name="password" id="password">
                            <label for="password" class="aoi-form-label">Mot de Passe</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-password-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="aoi-form-group">
                        <p class="aoi-select-label">Code promo (facultatif)</p>
                        <div class="aoi-form-control-container">
                            <input type="text" class="aoi-form-control" name="userRef" id="userRef">
                            <label for="userRef" class="aoi-form-label">Numéro de référence</label>
                        </div>
                    </div>

                    <div class="aoi-form-group aoi-sigin-link">
                        <input class="aoi-checkbox" type="checkbox" id="terms-and-conditions">
                        <label for="terms-and-conditions">J'ai lu et j'accepte les <a href="#">conditions générales d'utilisation</a></label>
                    </div>

                    <button class="aoi-button aoi-button-submit" type="submit">S'inscrire</button>

                    <div class="aoi-form-group aoi-sigin-link">
                        <span>Vous disposez déjà d'un compte ? <a href="/signals/login">Connectez-vous</a></span>
                    </div>
                </form>
            </div>
        </section>
        <section class="aoi-login-image-section">
            <div class="aoi-login-image-container">
                <img src="Public/Img/bank.png" alt="" class="aoi-login-image">
                <p class="aoi-message">&laquo;Lorem, ipsum dolor sit amet consectetur adipisicing elit.&raquo;</p>
            </div>
        </section>
    </main>
</body>

</html>