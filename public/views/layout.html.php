<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= htmlspecialchars($pageTitle ?? 'Aplikacja', ENT_QUOTES, 'UTF-8') ?>
    </title>

    <script>
        (() => {
            const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
            let theme = systemTheme.matches ? 'dark' : 'light';

            try {
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'light' || savedTheme === 'dark') {
                    theme = savedTheme;
                }
            } catch {
                // The system preference still works when storage is unavailable.
            }

            document.documentElement.dataset.theme = theme;
        })();
    </script>
    <link rel="stylesheet" href="/css/style.css">
    <?php foreach ($stylesheets ?? [] as $stylesheet): ?>
        <link rel="stylesheet" href="<?= htmlspecialchars($stylesheet, ENT_QUOTES, 'UTF-8') ?>">
    <?php endforeach; ?>
    <script src="/js/theme.js" defer></script>
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>
</head>
<body<?= isset($workspaceSection) ? ' class="workspace"' : '' ?>>
    <button class="theme-toggle" type="button" aria-label="Ciemny motyw" aria-pressed="false" title="Zmień motyw" hidden>
        <svg class="theme-icon--moon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20.9 13.4A9 9 0 0 1 10.6 3.1a9 9 0 1 0 10.3 10.3Z"/>
        </svg>
        <svg class="theme-icon--sun" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2m0 16v2M2 12h2m16 0h2M4.9 4.9l1.4 1.4m11.4 11.4 1.4 1.4m0-14.2-1.4 1.4M6.3 17.7l-1.4 1.4"/>
        </svg>
    </button>
    <?php if (isset($workspaceSection)): ?>
        <?php
        $navigation = [
            '/dashboard' => 'Panel główny',
            '/projects' => 'Projekty',
            '/time' => 'Mój czas',
            '/tasks' => 'Moje zadania',
        ];
        ?>
        <aside class="workspace-sidebar">
            <a class="workspace-brand" href="/dashboard">ProjectHub</a>
            <nav aria-label="Obszar roboczy">
                <?php foreach ($navigation as $path => $label): ?>
                    <a href="<?= $path ?>"<?= $workspaceSection === $path ? ' aria-current="page"' : '' ?>>
                        <?= $label ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </aside>
    <?php endif; ?>
    <?= $content ?>
</body>
</html>
