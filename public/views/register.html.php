<main class="home-card auth-card">
    <h1>Rejestracja</h1>

    <?php if ($error !== null): ?>
        <p role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form class="auth-form" method="post" action="/register">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="auth-field">
            <label for="email">Adres e-mail</label>
            <input id="email" name="email" type="email" autocomplete="username" maxlength="254" value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="auth-field">
            <label for="password">Hasło</label>
            <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" aria-describedby="password-hint" required>
            <small id="password-hint">Co najmniej 8 znaków.</small>
        </div>

        <button type="submit">Załóż konto</button>
    </form>

    <p class="auth-footer">Masz już konto? <a href="/login">Zaloguj się</a></p>
</main>
