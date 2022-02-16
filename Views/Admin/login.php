<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signals - Admin login</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/sketchy/bootstrap.min.css">
    <link rel="stylesheet" href="./Public/Css/form-admin.style.css">
    <link rel="stylesheet" href="/Public/Css/reset.css">
    <script type="text/javascript" defer src="./Public/Js/form-admin.js"></script>
</head>

<body>
    <header class="aoi-header">
        <div class="aoi-logo-container">
            <img class="aoi-logo" src="./Public/Img/logo.jpg" alt="aoi signals logo">
        </div>
    </header>

    <section class="aoi-form-section container">
        <main class="row d-flex justify-content-center align-items-center p-2">
            <form class="aoi-form m-auto col-md-6 col-sm-12" action="/admin/verify" method="post">
                <h1 class="aoi-form-head text-center">Admin login</h1>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                    <span class="aoi-email-error aoi-form-label-error">Ce champs ne peut-être vide</span>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <span class="aoi-password-error aoi-form-label-error">Ce champs ne peut-être vide</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100">Administrer</button>
                </div>
            </form>
        </main>
    </section>

    <footer class="aoi-footer">
        <div class="aoi-footer-container d-flex justify-content-center align-items-center">
            <img class="aoi-footer-logo" src="./Public/Img/logo.jpg" alt="aoi signals logo">
            <p class="aoi-footer-mensions">AOI Signals 2022 - All rights reserved</p>
        </div>
    </footer>
</body>

</html>