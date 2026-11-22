<main class="workspace-main">
    <header class="workspace-heading">
        <h1>Projekty</h1>
        <a class="workspace-action" href="/projects/new"><i class="fa-solid fa-plus" aria-hidden="true"></i> Nowy projekt</a>
    </header>

    <div class="workspace-card workspace-table-card" role="region" aria-label="Lista projektów" tabindex="0">
        <table class="workspace-table">
            <thead>
                <tr>
                    <th scope="col">Nazwa projektu</th>
                    <th scope="col">Status</th>
                    <th scope="col">Postęp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as ['name' => $name, 'status' => $status, 'progress' => $progress, 'state' => $state, 'url' => $url]): ?>
                    <tr>
                        <th scope="row">
                            <?php if ($url !== null): ?>
                                <a href="<?= $url ?>"><?= $name ?></a>
                            <?php else: ?>
                                <?= $name ?>
                            <?php endif; ?>
                        </th>
                        <td><span class="workspace-badge workspace-badge--<?= $state ?>"><?= $status ?></span></td>
                        <td>
                            <div class="workspace-progress">
                                <progress aria-label="Postęp projektu <?= $name ?>" value="<?= $progress ?>" max="100"></progress>
                                <span><?= $progress ?>%</span>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
