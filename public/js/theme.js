(() => {
    const root = document.documentElement;
    const toggle = document.querySelector('.theme-toggle');
    const systemTheme = window.matchMedia('(prefers-color-scheme: dark)');
    const storageKey = 'theme';

    let savedTheme;
    try {
        savedTheme = localStorage.getItem(storageKey);
    } catch {
    }

    let hasManualChoice = savedTheme === 'light' || savedTheme === 'dark';

    function applyTheme(theme) {
        root.dataset.theme = theme;
        toggle?.setAttribute('aria-pressed', String(theme === 'dark'));
    }

    if (toggle) {
        toggle.addEventListener('click', () => {
            const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
            hasManualChoice = true;
            applyTheme(nextTheme);

            try {
                localStorage.setItem(storageKey, nextTheme);
            } catch {
            }
        });
    }

    systemTheme.addEventListener('change', (event) => {
        if (!hasManualChoice) {
            applyTheme(event.matches ? 'dark' : 'light');
        }
    });

    applyTheme(hasManualChoice ? savedTheme : (systemTheme.matches ? 'dark' : 'light'));
    if (toggle) {
        toggle.hidden = false;
    }
})();
