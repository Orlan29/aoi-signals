<?php
$title = 'Dashboard';
require_once './Views/templates/header.php';
$link = 'Public/Js/settings.js';
?>

<main>
    <section id="aoi-premium" class="aoi-settings-section">
        <div class="aoi-settings-form-content aoi-alert">
            <h3 class="aoi-alert-title">Devenir membre Premium</h3>
            <p class="aoi-alert-text">Vous n'êtes actuellement pas un membre Premium.</p>
            <p class="aoi-alert-text">Devenz Premium maintenant et bénéficier de nombreux avantages</p>
            <button class="aoi-button" type="submit">Devenir premium</button>
        </div>

        <div class="aoi-settings-form-content">
            <h3 class="aoi-section-title">Cours disponibles</h3>
            <table class="aoi-table">
                <thead class="aoi-table-head">
                    <tr>
                        <th>Nom du cours</th>
                        <th>Date</th>
                        <th>Présenter par</th>
                        <th>Voir</th>
                    </tr>
                </thead>
                <tbody class="aoi-table-body">
                    <tr>
                        <td colspan="7">Vous n'avez aucun cours de disponible.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php require_once './Views/templates/footer.php'; ?>