<?php
$entries = [
    ['fa-globe', 'Nowa strona WWW', 'Dzisiaj', '2 h 30 min'],
    ['fa-mobile-screen', 'Aplikacja mobilna', 'Wczoraj', '1 h 15 min'],
    ['fa-file-lines', 'System raportów', '20 maja', '3 h 45 min'],
];
?>
<main class="workspace-main workspace-main--narrow">
    <header class="workspace-heading">
        <h1>Mój czas</h1>
        <span class="workspace-badge workspace-badge--active">Przykładowa sesja</span>
    </header>

    <section class="workspace-card workspace-session" aria-labelledby="active-session">
        <h2 id="active-session">Aktywna sesja</h2>
        <time class="workspace-timer" datetime="PT2H5M18S">02:05:18</time>
        <p>Projekt: <strong>Design System &amp; Audyt UI</strong></p>
    </section>

    <section class="workspace-section" aria-labelledby="time-entries">
        <h2 id="time-entries">Ostatnie wpisy</h2>
        <ul class="workspace-list workspace-list--cards">
            <?php foreach ($entries as [$icon, $name, $date, $duration]): ?>
                <li class="workspace-card workspace-row">
                    <span class="workspace-icon"><i class="fa-solid <?= $icon ?>" aria-hidden="true"></i></span>
                    <div><strong><?= $name ?></strong><small><?= $date ?></small></div>
                    <strong class="workspace-duration"><?= $duration ?></strong>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>
