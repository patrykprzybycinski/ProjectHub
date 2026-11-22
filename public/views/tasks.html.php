<main class="workspace-main workspace-main--narrow">
    <header class="workspace-heading">
        <div>
            <h1>Moje zadania</h1>
            <p class="workspace-description">Priorytety i terminy na bieżący sprint.</p>
        </div>
        <a class="workspace-action" href="/tasks/new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nowe zadanie</a>
    </header>

    <section aria-labelledby="sprint">
        <div class="workspace-heading workspace-heading--compact">
            <h2 id="sprint">Bieżący sprint</h2>
            <span class="workspace-badge workspace-badge--active">1 z 4 ukończone</span>
        </div>
        <ul class="workspace-list workspace-list--cards">
            <?php foreach ($tasks as ['title' => $title, 'status' => $status, 'date' => $date, 'state' => $state]): ?>
                <li class="workspace-card workspace-row workspace-task<?= $state === 'done' ? ' workspace-task--done' : '' ?>">
                    <span class="workspace-task-mark" aria-hidden="true"><?= $state === 'done' ? '✓' : '' ?></span>
                    <strong><?= $title ?></strong>
                    <span class="workspace-badge workspace-badge--<?= $state ?>"><?= $status ?></span>
                    <span class="workspace-task-date"><i class="fa-regular fa-calendar" aria-hidden="true"></i> <?= $date ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <dl class="workspace-stats workspace-section">
        <div class="workspace-card workspace-stat"><dt>Otwarte zadania</dt><dd><strong>3</strong> <span>z 4 zadań</span></dd></div>
        <div class="workspace-card workspace-stat"><dt>Najbliższy termin</dt><dd><strong>Jutro</strong> <span>Makiety</span></dd></div>
        <div class="workspace-card workspace-stat"><dt>Ukończone zadania</dt><dd><strong>25%</strong> <span>sprintu</span></dd></div>
    </dl>
</main>
