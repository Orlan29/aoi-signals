<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conférence</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../Public/Css/meet.index.css">
    <link rel="stylesheet" href="../Public/Css/reset.css?">
    <script type="text/javascript" src="../Public/Js/meet.index.js" defer></script>
</head>

<body>
    <main class="aoi-meet">
        <section class="aoi-meet-section">
            <div class="aoi-meet-video-container">
                <video class="aoi-meet-video" id="aoi-video" autoplay="true"></video>
            </div>
            <div class="aoi-meet-video-controls">
                <div class="aoi-meet-controls-item">
                    <button class="aoi-meet-controls-button video">
                        <i class="fa-solid fa-video"></i>
                        <span class="aoi-meet-controls-label">Activer la caméra</span>
                    </button>
                </div>
                <div class="aoi-meet-controls-item">
                    <button class="aoi-meet-controls-button microphone">
                        <i class="fa-solid fa-microphone"></i>
                        <span class="aoi-meet-controls-label">Activer le micro</span>
                    </button>
                </div>
            </div>
        </section>
        <button class="aoi-meet-submit aoi-meet-controls-button">Participer au cours</button>
    </main>
</body>

</html>