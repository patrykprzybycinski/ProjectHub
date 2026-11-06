<?php

declare(strict_types=1);

abstract class AppController
{
    protected function render(string $template, array $variables = []): void
    {
        $templatePath = dirname(__DIR__, 2) . '/public/views/' . $template . '.html.php';

        if (!is_file($templatePath)) {
            throw new \RuntimeException('View not found: ' . $template);
        }

        extract($variables, EXTR_SKIP);

        ob_start();
        try {
            require $templatePath;
            $content = ob_get_contents();
        } finally {
            ob_end_clean();
        }

        require __DIR__ . '/../../public/views/layout.html.php';
    }
}
