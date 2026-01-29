---
description: Créer des vues Blade avec Tailwind CSS pour ce projet. Activé quand l'agent travaille sur les fichiers de vue.
globs: resources/views/**/*.blade.php
---

# Skill : Vues Blade + Tailwind CSS

## Structure des vues
```
resources/views/
  layouts/app.blade.php     ← Layout principal
  tasks/
    index.blade.php         ← Liste avec filtres
    create.blade.php        ← Formulaire création
    edit.blade.php          ← Formulaire édition
    show.blade.php          ← Vue détail
    _form.blade.php         ← Partiel formulaire (partagé create/edit)
```

## Conventions

### Layout
- Toutes les vues étendent `layouts.app` : `@extends('layouts.app')`
- Sections : `@section('title', 'Mon titre')` et `@section('content')`
- Flash messages gérés dans le layout (session('success'))
- Navbar avec liens de navigation

### Formulaires
- Toujours `@csrf` dans les formulaires POST
- Utiliser `@method('PUT')` pour update, `@method('DELETE')` pour destroy
- Partiels préfixés par `_` : `@include('tasks._form')`
- Affichage des erreurs : `@error('field') <p class="text-red-600">{{ $message }}</p> @enderror`
- Valeurs par défaut : `old('field', $model->field ?? '')`

### Badges colorés (Enums)
Les enums ont une méthode `color()` qui retourne les classes Tailwind :
```blade
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->status->color() }}">
    {{ $task->status->label() }}
</span>
```

### Tailwind CSS
- Design minimaliste et propre
- Utiliser les classes utilitaires (pas de CSS custom)
- Cards : `bg-white rounded-lg shadow-sm border border-gray-200 p-6`
- Boutons primaires : `px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700`
- Boutons secondaires : `px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200`
- Inputs : `w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500`

### Langue
- UI en **français** (labels, boutons, messages)
- Code en **anglais** (variables, classes, routes)
