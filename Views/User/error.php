<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur - <?= $parameters['code'] ?></title>
    <link rel="icon" type="image/png" sizes="25x25" href="Public/Img/logo.png">
    <link rel="stylesheet" href="./Public/Css/reset.css">
    <link rel="stylesheet" href="./Public/Css/error.style.css">
</head>

<body>
    <main class="aoi-page-error">
        <div class="aoi-page-error-container">
            <p class="aoi-page-error-title"><?= $parameters['code'] ?></p>
            <p class="aoi-page-error-subtitle"><?= $parameters['content'] ?></p>
        </div>
    </main>
</body>

</html>