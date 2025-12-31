<div class="auth-container">
    <div class="auth-wrapper">
                <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form id="login-form" class="auth-form" method="POST" action="/mini_mvc/public/login">
            <h2>Connexion</h2>
            
            <div class="form-group">
                <label for="login-email">Email</label>
                <input type="email" id="login-email" name="login-email" required>
            </div>
            
            <div class="form-group">
                <label for="login-password">Mot de passe</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            
            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="auth-divider">
            <span>OU</span>
        </div>

        <!-- Formulaire d'inscription -->
        <form id="register-form" class="auth-form" method="POST" action="/mini_mvc/public/register">
            <h2>Inscription</h2>
            
            <div class="form-group">
                <label for="register-username">Nom d'utilisateur</label>
                <input type="text" id="register-username" name="register-username" required>
            </div>
            
            <div class="form-group">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="register-email" required>
            </div>
            
            <div class="form-group">
                <label for="register-password">Mot de passe</label>
                <input type="password" id="register-password" name="register-password" required>
            </div>
            
            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>
    </div>
</div>