<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reinitialiser mot de passe</title>
    <link rel="icon" type="image/png" sizes="16x16" href="Public/Img/logo.jpg">
    <link rel="stylesheet" href="Public/Css/reset.css">
    <link rel="stylesheet" href="Public/Css/user.login.css">
    <script type="text/javascript" src="Public/Js/user.login.js" defer></script>
</head>

<body>
    <main class="aoi-login">
        <section class="aoi-login-form-section">
            <div class="aoi-logo-container">
                <img class="aoi-logo" src="Public/Img/logo.png" alt="aoi-signals logo">
            </div>
            <div class="aoi-form-content">
                <div class="aoi-form-title-container">
                    <h1 class="aoi-form-title">Reinitialiser mot de passe</h1>
                    <div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, quos nihil? Sapiente perferendis quis vel.</p>
                    </div>
                </div>
                <form class="aoi-form" action="/signals/u/verify" method="post">
                    <?php if (isset($_SESSION['login_error'])) : ?>
                        <div class="aoi-error-container">
                            <span class="aoi-error"><?= $_SESSION['login_error'] ?></span>
                        </div>
                    <?php endif ?>
                    <div class="aoi-form-group">
                        <div class="aoi-form-control-container">
                            <input type="email" class="aoi-form-control" name="email" id="email" aria-valuetext="false">
                            <label for="email" class="aoi-form-label">Adresse e-mail</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-email-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <button class="aoi-button" type="submit">Continuer</button>
                </form>
            </div>
        </section>
        <section class="aoi-login-image-section">
            <div class="aoi-login-image-containe">
                <img src="Public/Img/key.png" alt="key" class="aoi-login-image aoi-key-image">
                <p class="aoi-messages">&laquo;Lorem, ipsum dolor sit amet consectetur adipisicing elit.&raquo;</p>
            </div>
        </section>
    </main>
</body>

</html>