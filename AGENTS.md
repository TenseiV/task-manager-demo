# Agents spécialisés du projet

Ce projet utilise des sous-agents pour déléguer des missions ciblées sans polluer le contexte principal.

## Agents disponibles

### @test-writer
- **Rôle** : Rédige les tests Pest pour une feature donnée
- **Quand** : Après l'implémentation d'une feature, lancer un sous-agent pour écrire les tests
- **Prompt** : `.claude/agents/test-writer.md`
- **Skill chargé** : `pest-testing.md`

### @security-auditor
- **Rôle** : Revue de sécurité du code (injections SQL, XSS, CSRF, mass assignment)
- **Quand** : Avant de créer une PR, lancer un audit de sécurité
- **Prompt** : `.claude/agents/security-auditor.md`

### @doc-writer
- **Rôle** : Met à jour la documentation technique après des changements
- **Quand** : Après ajout d'un modèle, d'une route, ou d'un changement d'architecture
- **Prompt** : `.claude/agents/doc-writer.md`

## Utilisation depuis le workflow /dev
Le workflow `/dev` peut déléguer automatiquement aux sous-agents :
1. Agent principal implémente la feature
2. `@test-writer` rédige les tests correspondants
3. `@security-auditor` audite le diff avant la PR
4. `@doc-writer` met à jour `docs/architecture.md` si nécessaire
