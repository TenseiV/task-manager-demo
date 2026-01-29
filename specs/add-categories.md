# Feature : Système de Catégories pour les Tâches

## Objectif
Permettre de classer les tâches par catégorie avec un code couleur visuel.

---

## Nouveau modèle : Category

### Migration `create_categories_table`
| Colonne | Type | Contraintes |
|---------|------|-------------|
| id | bigint | auto-increment |
| name | string | required, unique, max:255 |
| color | string | required (classe Tailwind, ex: "blue", "green") |
| timestamps | | |

### Modèle `Category`
- `$fillable` : name, color
- Relation : `hasMany(Task::class)`
- Méthode `colorClasses()` : retourne les classes Tailwind (`bg-{color}-100 text-{color}-800`)

---

## Modification du modèle Task

### Migration `add_category_id_to_tasks_table`
- Ajout de `category_id` : foreignId, nullable, constrained, nullOnDelete

### Modèle Task
- Ajouter `category_id` aux `$fillable`
- Relation : `belongsTo(Category::class)`
- Nouveau scope : `scopeCategory($query, ?string $categoryId)`

---

## CRUD Categories

### Routes
```php
Route::resource('categories', CategoryController::class);
```

### CategoryRequest
- `name` : required, string, max:255, unique (ignorer l'ID courant en édition)
- `color` : required, string, in:blue,green,red,purple,orange,yellow,pink,gray

### CategoryController (Resource)
- `index` : liste toutes les catégories avec le nombre de tâches associées
- `create` : formulaire de création
- `store` : création
- `edit` : formulaire d'édition
- `update` : mise à jour
- `destroy` : suppression (les tâches gardent `category_id = null`)

### Vues Blade
- `categories/index.blade.php` : table avec nom, badge couleur, nombre de tâches, actions
- `categories/create.blade.php` : formulaire avec sélecteur de couleur visuel
- `categories/edit.blade.php` : formulaire d'édition

---

## Intégration dans les Tâches

### Formulaires Task (create/edit)
- Ajouter un `<select>` pour la catégorie (optionnel)
- Option vide "Sans catégorie"
- Lister toutes les catégories

### Liste des tâches (index)
- Afficher le badge catégorie coloré dans la table (après la colonne priorité)
- Ajouter un filtre par catégorie dans le formulaire de filtres

### Vue détail Task (show)
- Afficher le badge catégorie dans les badges en haut

### TaskRequest
- Ajouter la règle : `'category_id' => ['nullable', 'exists:categories,id']`

### TaskController
- Passer les catégories aux vues `create` et `edit`
- Ajouter le filtre par catégorie dans `index`

---

## Navigation

### Layout (app.blade.php)
- Ajouter un lien "Catégories" dans la navbar à côté de "Nouvelle tâche"

---

## Seeder : CategorySeeder

Créer 5 catégories :
| Nom | Couleur |
|-----|---------|
| Travail | blue |
| Personnel | green |
| Urgent | red |
| Idées | purple |
| Courses | orange |

Mettre à jour `DatabaseSeeder` pour appeler `CategorySeeder` avant `TaskSeeder`.

Mettre à jour `TaskSeeder` pour assigner aléatoirement des catégories aux tâches existantes.

---

## Tests Pest : `tests/Feature/CategoryTest.php`

Tests à écrire :
1. `it('affiche la liste des catégories')`
2. `it('crée une nouvelle catégorie')`
3. `it('valide le nom obligatoire')`
4. `it('valide le nom unique')`
5. `it('affiche le formulaire d\'édition')`
6. `it('met à jour une catégorie')`
7. `it('supprime une catégorie sans supprimer les tâches')`
8. `it('filtre les tâches par catégorie')`
9. `it('affiche le badge catégorie dans la liste des tâches')`
10. `it('associe une catégorie à une tâche')`

---

## Factory : CategoryFactory

```php
'name' => fake()->unique()->word(),
'color' => fake()->randomElement(['blue', 'green', 'red', 'purple', 'orange']),
```
