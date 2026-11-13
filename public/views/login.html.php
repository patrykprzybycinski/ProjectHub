<main class="home-card auth-card">
    <h1>Logowanie</h1>

    <form class="auth-form" method="post" action="/login">
        <div class="auth-field">
            <label for="email">Adres e-mail</label>
            <input id="email" name="email" type="email" autocomplete="username" required>
        </div>

        <div class="auth-field">
            <label for="password">Hasło</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
        </div>

        <button type="submit">Zaloguj się</button>
    </form>

    <p class="auth-footer">Nie masz konta? <a href="/register">Załóż konto</a></p>
</main>
