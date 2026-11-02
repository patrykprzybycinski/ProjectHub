# ProjectHub

ProjectHub pomaga zespołom organizować wspólną pracę, łącząc projekty, zadania i rejestrowanie czasu w jednej aplikacji webowej.

## Funkcje

Projekt jest w trakcie rozwoju. Docelowy zakres obejmuje:

| Obszar | Co robi |
|---|---|
| Panel główny | Prezentuje podsumowanie projektów, zadań i czasu pracy. |
| Projekty | Umożliwia organizację projektów i monitorowanie postępów. |
| Zadania | Pomaga zarządzać obowiązkami, statusami i terminami. |
| Czas pracy | Pozwala rejestrować czas poświęcony na realizację projektów. |

## Tech stack

| Warstwa | Technologie |
|---|---|
| Backend | PHP 8.3, architektura MVC |
| Widoki | HTML, szablony PHP |
| Baza danych | PostgreSQL 17 |
| Serwer HTTP | Nginx |
| Konteneryzacja | Docker Compose |

## Szybki start

Wymagany jest Git, Docker z Docker Compose oraz lokalny plik `.env` z konfiguracją usług.

```bash
git clone https://github.com/patrykprzybycinski/ProjectHub.git
cd ProjectHub
docker compose up --build -d
```

Przed uruchomieniem kontenerów przygotuj lokalny plik `.env` zgodnie ze zmiennymi używanymi w `docker-compose.yaml`.

Aplikacja: [http://localhost:8080](http://localhost:8080)

## Struktura projektu

- `docker/` — konfiguracja obrazów i serwera WWW.
- `public/` — punkt wejścia aplikacji i widoki HTML/PHP.
- `src/controllers/` — kontrolery obsługujące żądania.
- `Routing.php` — mechanizm routingu.
- `docker-compose.yaml` — konfiguracja usług środowiska.

## Zasady developmentu

- Osobny branch dla każdej funkcji lub zmiany.
- Małe, logiczne commity.
- Prefiksy commitów: `feat`, `fix`, `docs`, `refactor`, `test`, `chore`.
- Sekrety wyłącznie w lokalnym pliku `.env`, poza repozytorium.

## Autorzy

- **Patryk Przybyciński** — autor projektu, rozwój i utrzymanie repozytorium.
