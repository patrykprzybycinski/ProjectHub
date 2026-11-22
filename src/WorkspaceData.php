<?php

declare(strict_types=1);

final class WorkspaceData
{
    public const PROJECTS = [
        ['name' => 'Nowa strona WWW', 'status' => 'W realizacji', 'progress' => 60, 'state' => 'active', 'url' => '/projects/1'],
        ['name' => 'Aplikacja mobilna', 'status' => 'Planowane', 'progress' => 25, 'state' => 'pending', 'url' => null],
        ['name' => 'System raportów', 'status' => 'Ukończono', 'progress' => 100, 'state' => 'done', 'url' => null],
    ];

    public const TASKS = [
        ['title' => 'Przygotowanie makiet', 'status' => 'W toku', 'date' => 'Jutro', 'state' => 'active'],
        ['title' => 'Przegląd kodu', 'status' => 'Do zrobienia', 'date' => '25 maja', 'state' => 'pending'],
        ['title' => 'Aktualizacja treści', 'status' => 'Do zrobienia', 'date' => '28 maja', 'state' => 'pending'],
        ['title' => 'Testy końcowe', 'status' => 'Zakończone', 'date' => 'Wczoraj', 'state' => 'done'],
    ];
}
