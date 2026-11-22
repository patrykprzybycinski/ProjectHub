<main class="workspace-main workspace-main--narrow">
    <h1><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>

    <?php if ($error !== null): ?>
        <p class="workspace-card" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form class="workspace-card project-form" method="post" action="<?= $projectId === null ? '/projects' : '/projects/' . $projectId . '/update' ?>">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <div class="project-field">
            <label for="title">Nazwa projektu</label>
            <input id="title" name="title" type="text" maxlength="150" required value="<?= htmlspecialchars($values['title'], ENT_QUOTES, 'UTF-8') ?>">
        </div>
        <div class="project-field">
            <label for="description">Opis</label>
            <textarea id="description" name="description" rows="5"><?= htmlspecialchars($values['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <div class="project-field">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <?php foreach (Project::STATUSES as $value => $label): ?>
                    <option value="<?= $value ?>"<?= $values['status'] === $value ? ' selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="workspace-heading workspace-heading--compact">
            <button class="workspace-action" type="submit"><?= $projectId === null ? 'Dodaj projekt' : 'Zapisz zmiany' ?></button>
            <a href="/projects">Wróć do projektów</a>
        </div>
    </form>
</main>
