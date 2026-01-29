<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;

it('affiche la liste des tâches', function () {
    Task::factory(3)->create();

    $response = $this->get(route('tasks.index'));

    $response->assertOk();
    $response->assertViewHas('tasks');
});

it('redirige la racine vers la liste des tâches', function () {
    $this->get('/')->assertRedirect('/tasks');
});

it('affiche le formulaire de création', function () {
    $this->get(route('tasks.create'))->assertOk();
});

it('crée une nouvelle tâche', function () {
    $response = $this->post(route('tasks.store'), [
        'title' => 'Ma nouvelle tâche',
        'description' => 'Description de test',
        'status' => 'todo',
        'priority' => 'medium',
        'due_date' => '2026-02-15',
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', ['title' => 'Ma nouvelle tâche']);
});

it('valide le titre obligatoire à la création', function () {
    $response = $this->post(route('tasks.store'), [
        'title' => '',
        'status' => 'todo',
        'priority' => 'medium',
    ]);

    $response->assertSessionHasErrors('title');
});

it('affiche le détail d\'une tâche', function () {
    $task = Task::factory()->create(['title' => 'Tâche de test']);

    $response = $this->get(route('tasks.show', $task));

    $response->assertOk();
    $response->assertSee('Tâche de test');
});

it('affiche le formulaire d\'édition', function () {
    $task = Task::factory()->create();

    $this->get(route('tasks.edit', $task))->assertOk();
});

it('met à jour une tâche existante', function () {
    $task = Task::factory()->create();

    $response = $this->put(route('tasks.update', $task), [
        'title' => 'Titre modifié',
        'status' => 'done',
        'priority' => 'high',
    ]);

    $response->assertRedirect(route('tasks.index'));
    expect($task->fresh()->title)->toBe('Titre modifié');
    expect($task->fresh()->status)->toBe(TaskStatus::Done);
});

it('supprime une tâche', function () {
    $task = Task::factory()->create();

    $response = $this->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

it('filtre les tâches par statut', function () {
    Task::factory()->todo()->create(['title' => 'Tâche à faire']);
    Task::factory()->done()->create(['title' => 'Tâche terminée']);

    $response = $this->get(route('tasks.index', ['status' => 'todo']));

    $response->assertOk();
    $response->assertSee('Tâche à faire');
    $response->assertDontSee('Tâche terminée');
});

it('filtre les tâches par priorité', function () {
    Task::factory()->create(['title' => 'Tâche haute', 'priority' => TaskPriority::High]);
    Task::factory()->create(['title' => 'Tâche basse', 'priority' => TaskPriority::Low]);

    $response = $this->get(route('tasks.index', ['priority' => 'high']));

    $response->assertOk();
    $response->assertSee('Tâche haute');
    $response->assertDontSee('Tâche basse');
});

it('recherche les tâches par titre', function () {
    Task::factory()->create(['title' => 'Configurer le serveur']);
    Task::factory()->create(['title' => 'Écrire les tests']);

    $response = $this->get(route('tasks.index', ['search' => 'serveur']));

    $response->assertOk();
    $response->assertSee('Configurer le serveur');
    $response->assertDontSee('Écrire les tests');
});

it('valide le statut invalide', function () {
    $response = $this->post(route('tasks.store'), [
        'title' => 'Test',
        'status' => 'invalide',
        'priority' => 'medium',
    ]);

    $response->assertSessionHasErrors('status');
});
