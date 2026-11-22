<main class="workspace-main workspace-main--narrow">
    <a class="workspace-back" href="/projects"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Wróć do projektów</a>

    <?php if ($projectId === 1): ?>
        <header class="workspace-heading">
            <div>
                <h1>Nowa strona WWW</h1>
                <p class="workspace-description">Przebudowa serwisu firmowego, odświeżenie identyfikacji i uporządkowanie treści.</p>
            </div>
            <span class="workspace-badge workspace-badge--active">W realizacji</span>
        </header>

        <section class="workspace-card workspace-project-progress" aria-labelledby="project-progress">
            <div class="workspace-heading workspace-heading--compact">
                <h2 id="project-progress">Postęp ogólny</h2>
                <strong>60%</strong>
            </div>
            <progress aria-labelledby="project-progress" value="60" max="100"></progress>
            <div class="workspace-progress-note">
                <span>2 z 3 etapów zakończone lub w trakcie</span>
                <span>Szacowany koniec: 24 maja</span>
            </div>
        </section>

        <section class="workspace-section" aria-labelledby="project-team">
            <h2 id="project-team">Zespół</h2>
            <p class="workspace-card">Brak przypisanych osób.</p>
        </section>

        <section class="workspace-section" aria-labelledby="project-tasks">
            <h2 id="project-tasks">Zadania w projekcie</h2>
            <ul class="workspace-list workspace-list--cards">
                <li class="workspace-card workspace-row">
                    <span class="workspace-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                    <div><strong>Projekt graficzny</strong><small>Makiety i prototyp</small></div>
                    <span class="workspace-badge workspace-badge--done">Zakończone</span>
                </li>
                <li class="workspace-card workspace-row">
                    <span class="workspace-icon"><i class="fa-solid fa-ellipsis" aria-hidden="true"></i></span>
                    <div><strong>Wdrożenie szablonu</strong><small>Integracja widoków</small></div>
                    <span class="workspace-badge workspace-badge--active">W toku</span>
                </li>
                <li class="workspace-card workspace-row">
                    <span class="workspace-icon"><i class="fa-regular fa-circle" aria-hidden="true"></i></span>
                    <div><strong>Optymalizacja</strong><small>Wydajność, SEO i dostępność</small></div>
                    <span class="workspace-badge">Do zrobienia</span>
                </li>
            </ul>
        </section>
    <?php else: ?>
        <h1>Projekt #<?= $projectId ?></h1>
    <?php endif; ?>
</main>
