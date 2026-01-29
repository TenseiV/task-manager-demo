# Architecture du projet

## Controllers
- Toujours des **Resource controllers** (`php artisan make:controller XxxController --resource`)
- Le controller ne contient que de l'orchestration : pas de logique métier complexe
- Injection des FormRequest pour la validation
- Retour de vues Blade avec `compact()` ou tableaux associatifs

## Validation
- **Toujours** via FormRequest (`app/Http/Requests/`)
- Jamais de `$request->validate()` inline dans le controller
- Messages d'erreur en français dans `messages()`
- Règles typées avec `Rule::enum()` pour les enums

## Enums PHP
- Dossier `app/Enums/`
- Backed enums (`string`)
- Méthode `label()` : retourne le libellé français
- Méthode `color()` : retourne les classes Tailwind CSS pour le badge

## Modèles
- `$fillable` explicite (pas de `$guarded`)
- Casts via la méthode `casts()` (pas la propriété)
- Scopes pour les filtres récurrents (`scopeStatus`, `scopeSearch`, etc.)
- Relations typées

## Vues Blade
- Layout principal : `resources/views/layouts/app.blade.php`
- Partiels préfixés par `_` : `_form.blade.php`
- Tailwind CSS utilitaire uniquement
- Flash messages dans le layout
- Formulaires avec `@csrf` et `@method` si nécessaire

## Routes
- `Route::resource()` pour le CRUD
- Routes nommées automatiquement (`tasks.index`, `tasks.store`, etc.)
