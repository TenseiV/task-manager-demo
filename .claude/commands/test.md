## Lancer les tests et corriger les échecs

### Workflow
1. Lance `php artisan test`
2. Si tous les tests passent : affiche un résumé et termine
3. Si des tests échouent :
   - Analyse chaque erreur
   - Identifie la cause racine (code applicatif ou test)
   - Corrige le problème
   - Relance les tests
4. Répète l'étape 3 jusqu'à 3 fois maximum
5. Si après 3 itérations il reste des échecs : liste les problèmes non résolus et demande de l'aide
