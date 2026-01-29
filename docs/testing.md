# Conventions de test

## Framework
- **Pest** exclusivement (pas de classes PHPUnit)
- Fichier de config : `tests/Pest.php`

## Structure
- Tests **Feature** dans `tests/Feature/` (avec `RefreshDatabase` automatique via Pest.php)
- Un fichier par domaine : `TaskTest.php`, `CategoryTest.php`, etc.

## Nommage
- Noms de tests en **français**, style comportemental
- Utiliser `it('fait quelque chose', function () { ... })`
- Exemples :
  - `it('affiche la liste des tâches')`
  - `it('crée une nouvelle tâche')`
  - `it('valide le titre obligatoire à la création')`

## Factories
- Dossier `database/factories/`
- Utiliser les **states** pour les variantes : `->todo()`, `->highPriority()`
- Toujours utiliser les factories dans les tests (jamais `Task::create()` directement)

## Assertions courantes
```php
$response->assertOk();
$response->assertRedirect(route('tasks.index'));
$response->assertSee('Texte visible');
$response->assertSessionHasErrors('champ');
$this->assertDatabaseHas('tasks', ['title' => 'Mon titre']);
expect($model->field)->toBe('valeur');
```

## Bonnes pratiques
- Un test = un comportement
- Arrange / Act / Assert
- Tester les cas nominaux ET les erreurs de validation
- Tester les filtres et recherches
