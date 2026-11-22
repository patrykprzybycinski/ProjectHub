<main class="workspace-main">
    <h1>Nowe zadanie</h1>

    <form class="workspace-card" method="post" action="/tasks">
        <p>
            <label for="title">Tytuł zadania</label>
            <input id="title" name="title" type="text" required>
        </p>
        <button type="submit">Dodaj zadanie</button>
    </form>

    <a href="/tasks">Wróć do zadań</a>
</main>
