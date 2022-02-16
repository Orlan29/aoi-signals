<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/Public/Css/reset.css?">
    <link rel="stylesheet" href="/Public/Css/dashboard-admin.style.css">
    <script type="text/javascript" src="/Public/Js/dashboard-admin.js" defer></script>
</head>

<body>
    <div class="aoi-dashboard">
        <header class="aoi-header">
            <div class="aoi-logo-container">
                <img class="aoi-logo" src="/Public/Img/logo.jpg" alt="aoi signals logo">
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
                        <li class="aoi-nav-item aoi-stats">
                            <i class="fa-solid fa-chart-simple aoi-nav-icon"></i>
                        </li>
                        <span id="aoi-stats" class="aoi-nav-label">Statistiques</span>
                    </div>
                </ul>
                <div class="aoi-nav-item">
                    <i class="fa-solid fa-circle-user aoi-nav-icon"></i>
                </div>
            </nav>
        </header>

        <main class="aoi-main">
            <section id="aoi-home" class="aoi-section aoi-section-active">
                <div class="aoi-home-container">
                    <h1>Home</h1>
                </div>
            </section>
            <section id="aoi-add-event" class="aoi-section">
                <div class="aoi-event-container">
                    <h1>Events</h1>
                </div>
            </section>
            <section id="aoi-stats" class="aoi-section">
                <div class="aoi-stats-container">
                    <h1>Stats</h1>
                </div>
            </section>
        </main>
    </div>
</body>

</html>