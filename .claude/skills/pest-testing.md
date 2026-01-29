---
description: Écrire des tests Pest pour ce projet Laravel. Activé automatiquement quand l'agent touche aux tests.
globs: tests/**/*.php
---

# Skill : Tests Pest pour Task Manager

## Contexte
Ce projet utilise **Pest** (pas PHPUnit classique) avec le plugin Laravel.

## Configuration Pest
Le fichier `tests/Pest.php` applique automatiquement `RefreshDatabase` à tous les tests Feature :
```php
uses(Tests\TestCase::class, Illuminate\Foundation\Testing\RefreshDatabase::class)->in('Feature');
```

## Conventions strictes

### Nommage
- Utiliser `it('description en français', function () { ... })`
- La description doit être comportementale : "affiche", "crée", "valide", "filtre", "supprime"
- Un fichier par domaine : `TaskTest.php`, `CategoryTest.php`

### Structure d'un test
```php
it('crée une nouvelle tâche', function () {
    // Arrange : préparer les données avec les factories
    $data = ['title' => 'Ma tâche', 'status' => 'todo', 'priority' => 'medium'];

    // Act : exécuter l'action
    $response = $this->post(route('tasks.store'), $data);

    // Assert : vérifier le résultat
    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', ['title' => 'Ma tâche']);
});
```

### Factories obligatoires
- Toujours utiliser les factories pour créer des données : `Task::factory()->create()`
- Utiliser les states pour les variantes : `->todo()`, `->done()`, `->highPriority()`
- Jamais de `Task::create()` directement dans les tests

### Tests à couvrir pour chaque CRUD
1. Affiche la liste (index)
2. Affiche le formulaire de création (create)
3. Crée un enregistrement valide (store)
4. Valide les champs obligatoires (store avec erreurs)
5. Affiche le détail (show)
6. Affiche le formulaire d'édition (edit)
7. Met à jour un enregistrement (update)
8. Supprime un enregistrement (destroy)
9. Tests spécifiques : filtres, recherche, relations

### Assertions fréquentes
```php
$response->assertOk();                              // HTTP 200
$response->assertRedirect(route('xxx.index'));       // Redirection
$response->assertSee('Texte visible');               // Contenu HTML
$response->assertDontSee('Texte absent');            // Absence
$response->assertSessionHasErrors('champ');          // Erreur validation
$this->assertDatabaseHas('table', ['col' => 'val']); // En base
$this->assertDatabaseMissing('table', ['id' => 1]); // Supprimé
expect($model->field)->toBe('valeur');               // Pest expect
```

### Commande
```bash
php artisan test                    # Tous les tests
php artisan test --filter=TaskTest  # Un fichier
```
