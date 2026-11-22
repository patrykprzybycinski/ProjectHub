<main class="workspace-main">
    <header class="workspace-heading">
        <h1>Projekty</h1>
        <a class="workspace-action" href="/projects/new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nowy projekt</a>
    </header>

    <?php if ($projects === []): ?>
        <p class="workspace-card">Brak projektów. Dodaj pierwszy projekt, aby rozpocząć.</p>
    <?php else: ?>
        <div class="workspace-card workspace-table-card" role="region" aria-label="Lista projektów" tabindex="0">
            <table class="workspace-table">
                <thead>
                    <tr>
                        <th scope="col">Nazwa projektu</th>
                        <th scope="col">Status</th>
                        <th scope="col">Data utworzenia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <th scope="row"><a href="/projects/<?= $project->getId() ?>"><?= htmlspecialchars($project->getTitle(), ENT_QUOTES, 'UTF-8') ?></a></th>
                            <td><span class="workspace-badge workspace-badge--<?= $project->getState() ?>"><?= $project->getStatusLabel() ?></span></td>
                            <td><time datetime="<?= $project->getCreatedAt()->format(DATE_ATOM) ?>"><?= $project->getCreatedAt()->format('d.m.Y H:i') ?></time></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</main>
