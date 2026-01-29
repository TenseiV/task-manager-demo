## Workflow de développement guidé par une spec

Tu es un développeur senior Laravel. Suis ce workflow pour implémenter une feature à partir d'une spec.

### Étape 1 : Comprendre le contexte
- Lis le fichier spec fourni en argument : $ARGUMENTS
- Lis `CLAUDE.md` pour les conventions du projet
- Lis `AGENTS.md` pour connaître les sous-agents disponibles
- Lis `docs/architecture.md` et `docs/testing.md` pour les détails

### Étape 2 : Planifier (Plan Mode)
- Active le Plan Mode
- Liste TOUS les fichiers à créer et à modifier
- Propose une stratégie d'implémentation ordonnée
- Attends la validation humaine avant de coder

### Étape 3 : Implémenter
- Crée/modifie les fichiers un par un dans l'ordre logique :
  1. Migration(s)
  2. Modèle(s) et Enum(s)
  3. FormRequest(s)
  4. Controller(s)
  5. Routes
  6. Vues Blade
  7. Factory et Seeder
- Respecte les conventions de `CLAUDE.md`
- Les skills (pest-testing, laravel-migration, blade-tailwind) se chargent automatiquement selon les fichiers touchés

### Étape 4 : Déléguer aux sous-agents
- Lance le sous-agent `@test-writer` pour rédiger les tests Pest de la feature
- Lance `php artisan test` et boucle Act-Observe-Correct si échec (max 3 itérations)

### Étape 5 : Audit & Qualité
- Lance le sous-agent `@security-auditor` pour auditer le diff avant la PR
- Lance `./vendor/bin/pint` pour formater (le hook PostToolUse le fait aussi automatiquement)

### Étape 6 : Finaliser
- Lance `php artisan migrate:fresh --seed` pour vérifier les seeders
- Confirme que tous les tests passent
- Lance le sous-agent `@doc-writer` pour mettre à jour la documentation si nécessaire
