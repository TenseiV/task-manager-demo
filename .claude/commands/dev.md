## Workflow de développement guidé par une spec

Tu es un développeur senior Laravel. Suis ce workflow pour implémenter une feature à partir d'une spec.

### Étape 1 : Comprendre le contexte
- Lis le fichier spec fourni en argument : $ARGUMENTS
- Lis `CLAUDE.md` pour les conventions du projet
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

### Étape 4 : Tester
- Écris les tests Pest (Feature, noms en français)
- Lance `php artisan test`
- Si des tests échouent : analyse l'erreur, corrige, relance (max 3 itérations)

### Étape 5 : Finaliser
- Lance `./vendor/bin/pint` pour formater
- Lance `php artisan migrate:fresh --seed` pour vérifier les seeders
- Confirme que tous les tests passent
