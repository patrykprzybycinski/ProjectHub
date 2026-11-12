<main class="workspace-main">
    <p><a href="/projects">Wróć do projektów</a></p>

    <?php if ($projectId === 1): ?>
        <h1>Nowa strona WWW</h1>
        <p>Przebudowa serwisu firmowego i odświeżenie identyfikacji.</p>

        <section class="workspace-card">
            <h2>Postęp ogólny</h2>
            <progress aria-label="Postęp projektu" value="60" max="100">60%</progress> 60%
            <p>Status: w realizacji</p>
        </section>

        <section class="workspace-card">
            <h2>Zespół</h2>
            <p>Anna K., Piotr N., Tomasz W.</p>
        </section>

        <section class="workspace-card">
            <h2>Zadania w projekcie</h2>
            <ul>
                <li>Projekt graficzny — zakończone</li>
                <li>Wdrożenie szablonu — w toku</li>
                <li>Optymalizacja — do zrobienia</li>
            </ul>
        </section>
    <?php else: ?>
        <h1>Projekt #<?= $projectId ?></h1>
    <?php endif; ?>
</main>
