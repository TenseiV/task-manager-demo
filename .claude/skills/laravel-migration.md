---
description: Créer et gérer les migrations Laravel et les modèles Eloquent. Activé quand l'agent travaille sur le schéma de base de données.
globs: database/migrations/**/*.php, app/Models/**/*.php
---

# Skill : Migrations & Modèles Laravel

## Créer une migration
```bash
php artisan make:migration create_categories_table
php artisan make:migration add_category_id_to_tasks_table
```

## Conventions de ce projet

### Colonnes standards
- Toujours `$table->id()` et `$table->timestamps()`
- Foreign keys : `$table->foreignId('x_id')->nullable()->constrained()->nullOnDelete()`
- Enums stockés en `string` (pas de type enum SQL) : `$table->string('status')->default('todo')`

### Modèle Eloquent
```php
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date'];

    protected function casts(): array
    {
        return [
            'status' => TaskStatus::class,    // Enum PHP
            'priority' => TaskPriority::class, // Enum PHP
            'due_date' => 'date',
        ];
    }

    // Scopes pour filtres
    public function scopeStatus($query, ?string $status) { ... }

    // Relations
    public function category(): BelongsTo { ... }
}
```

### Règles
- `$fillable` explicite (pas `$guarded`)
- Casts via la **méthode** `casts()` (pas la propriété `$casts`)
- Relations typées avec return type
- Scopes pour tous les filtres récurrents

### Commandes utiles
```bash
php artisan migrate                    # Appliquer les migrations
php artisan migrate:fresh --seed       # Reset complet + seed
php artisan migrate:status             # Voir l'état
```
