## Créer une Pull Request

Analyse les changements de la branche courante et crée une PR GitHub formatée.

### Workflow
1. Lance `git diff main...HEAD --stat` pour voir les fichiers modifiés
2. Lance `git log main..HEAD --oneline` pour voir les commits
3. Crée la PR avec `gh pr create` en utilisant ce template :

```
--title "feat: [titre court et descriptif]"
--body "## Résumé
[2-3 bullets décrivant les changements]

## Fichiers modifiés
[Liste des fichiers clés modifiés]

## Plan de test
- [ ] Tests unitaires passent (`php artisan test`)
- [ ] Migration fonctionne (`php artisan migrate:fresh --seed`)
- [ ] Vérification visuelle sur localhost:8000"
```

4. Affiche le lien de la PR créée
