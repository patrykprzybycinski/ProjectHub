<main class="workspace-main workspace-main--narrow">
    <a class="workspace-back" href="/projects"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Wróć do projektów</a>

    <header class="workspace-heading">
        <div>
            <h1><?= htmlspecialchars($project->getTitle(), ENT_QUOTES, 'UTF-8') ?></h1>
            <p class="workspace-description"><?= nl2br(htmlspecialchars($project->getDescription() ?? 'Brak opisu.', ENT_QUOTES, 'UTF-8')) ?></p>
        </div>
        <span class="workspace-badge workspace-badge--<?= $project->getState() ?>"><?= $project->getStatusLabel() ?></span>
    </header>

    <dl class="workspace-card project-metadata">
        <div>
            <dt>Utworzono</dt>
            <dd><time datetime="<?= $project->getCreatedAt()->format(DATE_ATOM) ?>"><?= $project->getCreatedAt()->format('d.m.Y H:i') ?></time></dd>
        </div>
        <div>
            <dt>Ostatnia zmiana</dt>
            <dd><time datetime="<?= $project->getUpdatedAt()->format(DATE_ATOM) ?>"><?= $project->getUpdatedAt()->format('d.m.Y H:i') ?></time></dd>
        </div>
    </dl>

    <div class="workspace-heading workspace-section">
        <a class="workspace-action" href="/projects/<?= $project->getId() ?>/edit">Edytuj projekt</a>
        <form method="post" action="/projects/<?= $project->getId() ?>/delete">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
            <button class="workspace-action" type="submit">Usuń projekt</button>
        </form>
    </div>

    <section class="workspace-section" aria-labelledby="project-team">
        <h2 id="project-team">Zespół</h2>
        <p class="workspace-card">Brak przypisanych osób.</p>
    </section>
    <section class="workspace-section" aria-labelledby="project-tasks">
        <h2 id="project-tasks">Zadania w projekcie</h2>
        <p class="workspace-card">Brak przypisanych zadań.</p>
    </section>
</main>
