<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($pageTitle) ?></h1>
        <nav>
            <a href="/">Strona główna</a>
            <a href="/projects">Projekty</a>
        </nav>
    </header>

    <main>
        <section>
            <h2>Twoje projekty</h2>
            <p>Tutaj pojawi się lista projektów.</p>
        </section>
    </main>
</body>
</html>