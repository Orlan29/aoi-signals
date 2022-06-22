<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="icon" type="image/png" sizes="25x25" href="./Public/Img/logo.png">
    <link rel="stylesheet" href="Public/Css/reset.css">
    <link rel="stylesheet" href="Public/Css/user.login.css">
    <link rel="stylesheet" href="./Public/Css/responsive.css">
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
                    <h1 class="aoi-form-title">Connexion</h1>
                </div>
                <form class="aoi-form" action="/signals/u/verify" method="post">
                    <?php if (isset($_SESSION['login_error'])) : ?>
                        <div class="aoi-error-container">
                            <span class="aoi-error"><?= $_SESSION['login_error'] ?></span>
                        </div>
                    <?php endif ?>
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
                        <div class="aoi-form-control-container">
                            <input type="password" class="aoi-form-control" name="password" id="password">
                            <label for="password" class="aoi-form-label">Mot de Passe</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-password-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                        <div class="aoi-forgot-password">
                            <span><a href="/signals/reset-password">Mot de passe oublié ?</a></span>
                        </div>
                    </div>

                    <button class="aoi-button" type="submit">Se connecter</button>
                    <div class="aoi-form-group aoi-sigin-link">
                        <span>Vous ne disposez pas encore de compte ? <a href="/signals/register">Inscrivez-vous</a></span>
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