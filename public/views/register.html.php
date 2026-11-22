<main class="home-card auth-card">
    <h1>Rejestracja</h1>

    <form class="auth-form" method="post" action="/register">
        <div class="auth-field">
            <label for="email">Adres e-mail</label>
            <input id="email" name="email" type="email" autocomplete="username" required>
        </div>

        <div class="auth-field">
            <label for="password">Hasło</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required>
        </div>

        <button type="submit">Załóż konto</button>
    </form>

    <p class="auth-footer">Masz już konto? <a href="/login">Zaloguj się</a></p>
</main>
