# Task Manager - Guide Claude Code

## THE WHAT - Stack technique

- **Framework** : Laravel 12, PHP 8.5
- **Base de données** : SQLite
- **Frontend** : Blade + Tailwind CSS 4 (via Vite)
- **Tests** : Pest (Feature tests)
- **Linter** : Laravel Pint (règles par défaut)

## THE WHY - Commandes essentielles

```bash
php artisan serve              # Lancer le serveur local
php artisan test               # Lancer les tests Pest
./vendor/bin/pint              # Formater le code PHP
php artisan migrate:fresh --seed  # Reset DB avec données de test
npm run build                  # Compiler les assets frontend
```

## THE HOW - Conventions du projet

### Architecture
- **Enums PHP** pour status et priority (méthodes `label()` et `color()`)
- **FormRequest** pour toute validation (jamais de validation inline dans les controllers)
- **Resource controllers** pour le CRUD
- **Scopes** sur les modèles pour les filtres (status, priority, search)

### Frontend
- UI en **français**, code en **anglais**
- Tailwind CSS utilitaire, design minimaliste
- Badges colorés via les méthodes `color()` des enums

### Tests
- **Pest** uniquement (pas de PHPUnit classique)
- Tests **Feature** avec `RefreshDatabase`
- Noms de tests en **français** (description comportementale)
- Utiliser les **factories** et leurs states

### Sous-agents disponibles
- `@test-writer` : Rédige les tests Pest pour une feature
- `@security-auditor` : Audit de sécurité pré-PR (injections, XSS, CSRF, mass assignment)
- `@doc-writer` : Met à jour la documentation après des changements
- Voir `AGENTS.md` pour le détail des personas

### Pour aller plus loin
- Architecture détaillée : `docs/architecture.md`
- Conventions de test : `docs/testing.md`
- Agents et délégation : `AGENTS.md`
