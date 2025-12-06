# Nora API

## Prérequis
- PHP 8.2+
- Composer
- Node.js + npm
- Base de données (MySQL/MariaDB, PostgreSQL, SQLite, etc.)

## Installation rapide (script)
Le projet inclut un script d’installation dans [`composer.json`](composer.json) via `scripts.setup`.

```sh
composer run setup
```

Ce script effectue:
- Installation des dépendances PHP
- Copie de `.env.example` vers `.env`
- Génération de la clé `APP_KEY`
- Exécution des migrations
- Installation des dépendances npm
- Build front avec Vite
- Publication éventuelle des assets nécessaires (Telescope / Scramble si requis)

## Installation manuelle
1) Cloner le projet
```sh
git clone <repo> && cd base-laravel-api
```

2) Dépendances PHP
```sh
composer install
```

3) Environnement
```sh
cp .env.example .env
php artisan key:generate
```
Configurer la DB dans [`config/database.php`](config/database.php) et `.env`:
- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
Voir l’exemple dans [`.env.example`](.env.example).

4) Migrations et seed
```sh
php artisan migrate --force
php artisan db:seed
```

5) Dépendances front et build
```sh
npm install
npm run build
```

6) Lier le stockage public (optionnel si vous servez des fichiers)
```sh
php artisan storage:link
```

## Outils & Observabilité

### Laravel Telescope
- Accès: `/telescope` (en environnement local / selon config).
- Utile pour: requêtes, jobs, exceptions, logs, événements, cache.
- Restreindre l’accès via `TelescopeServiceProvider` ou middleware (ex: uniquement local).

### Documentation API (Scramble)
- Accès: `/docs/api`
- Génération automatique à partir des routes, FormRequests, resources.
- Pour regénérer manuellement si la documentation API semble avoir un problème:
```sh
php artisan scramble:analyze
```
- Sortie interactive (OpenAPI) disponible à l’URL; exporter le schéma JSON si besoin.

## Démarrage en développement
Le projet fournit un script `dev` dans [`composer.json`](composer.json) qui lance:
- Serveur PHP
- Écouteur de queue
- Vite en mode dev

```sh
composer run dev
```

Sinon, manuellement:
```sh
php artisan serve
php artisan queue:listen --tries=1
npm run dev
```

## Tests
Les tests utilisent Pest et PHPUnit. Config de test dans [`phpunit.xml`](phpunit.xml).
```sh
php artisan test
```
