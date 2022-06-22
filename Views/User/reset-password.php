<body>
    <main class="aoi-login">
        <section class="aoi-login-form-section">
            <div class="aoi-form-content">
                <div class="aoi-form-title-container">
                    <h1 class="aoi-form-title">Reinitialiser mot de passe</h1>
                    <div>
                        <p>Entrez l'adresse e-mail utilisée lors de la création <br> de votre compte ci-dessous, afin de réinitialiser votre mot de passe.</p>
                    </div>
                </div>
                <form id="forgot-password-form" class="aoi-form">
                    <div class="aoi-error-container aoi-hidden">
                        <span class="aoi-error"></span>
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
                        <div class="aoi-form-control-container confirm_password aoi-hidden">
                            <input type="password" class="aoi-form-control" name="confirm_password" id="confirm_password">
                            <label for="confirm_password" class="aoi-form-label">Confirmer mot de passe</label>
                        </div>
                        <div class="aoi-label-error-container">
                            <span class="aoi-email-error aoi-label-error aoi-error-desable">Cet champs ne doit pas être vide.</span>
                        </div>
                    </div>

                    <div class="fa-2x">
                        <button class="aoi-button" type="submit">Continuer</button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>