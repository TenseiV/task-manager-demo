<?php

namespace Database\Seeders;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $tasks = [
            ['title' => 'Configurer le serveur de production', 'description' => 'Installer et configurer Nginx, PHP-FPM et les certificats SSL.', 'status' => TaskStatus::Done, 'priority' => TaskPriority::High, 'due_date' => now()->subDays(5)],
            ['title' => 'Rédiger la documentation API', 'description' => 'Documenter tous les endpoints REST avec exemples de requêtes et réponses.', 'status' => TaskStatus::InProgress, 'priority' => TaskPriority::High, 'due_date' => now()->addDays(3)],
            ['title' => 'Corriger le bug d\'affichage mobile', 'description' => 'Le menu hamburger ne se ferme pas correctement sur iOS Safari.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::High, 'due_date' => now()->addDay()],
            ['title' => 'Ajouter les tests d\'intégration', 'description' => 'Écrire les tests pour le module de paiement.', 'status' => TaskStatus::InProgress, 'priority' => TaskPriority::Medium, 'due_date' => now()->addDays(7)],
            ['title' => 'Mettre à jour les dépendances', 'description' => 'Passer à Laravel 12 et mettre à jour les packages NPM.', 'status' => TaskStatus::Done, 'priority' => TaskPriority::Medium, 'due_date' => now()->subDays(2)],
            ['title' => 'Optimiser les requêtes SQL', 'description' => 'Identifier et corriger les requêtes N+1 sur la page tableau de bord.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Medium, 'due_date' => now()->addDays(5)],
            ['title' => 'Créer la page de profil utilisateur', 'description' => 'Permettre la modification de l\'avatar, du nom et de l\'email.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Low, 'due_date' => now()->addDays(14)],
            ['title' => 'Configurer le CI/CD', 'description' => 'Mettre en place GitHub Actions pour les tests et le déploiement automatique.', 'status' => TaskStatus::Done, 'priority' => TaskPriority::High, 'due_date' => now()->subDays(10)],
            ['title' => 'Ajouter le mode sombre', 'description' => 'Implémenter le toggle dark mode avec préférence système.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Low, 'due_date' => null],
            ['title' => 'Réviser le code du module auth', 'description' => 'Code review du middleware d\'authentification et des guards.', 'status' => TaskStatus::InProgress, 'priority' => TaskPriority::Medium, 'due_date' => now()->addDays(2)],
            ['title' => 'Préparer la démo client', 'description' => 'Créer le jeu de données et préparer le scénario de démonstration.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::High, 'due_date' => now()->addDays(1)],
            ['title' => 'Migrer la base de données', 'description' => 'Migrer les données de MySQL vers PostgreSQL.', 'status' => TaskStatus::Done, 'priority' => TaskPriority::High, 'due_date' => now()->subDays(7)],
            ['title' => 'Implémenter la recherche full-text', 'description' => 'Ajouter la recherche avec Scout et Meilisearch.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Low, 'due_date' => now()->addDays(21)],
            ['title' => 'Configurer les notifications email', 'description' => 'Mettre en place les templates d\'email avec Mailgun.', 'status' => TaskStatus::InProgress, 'priority' => TaskPriority::Medium, 'due_date' => now()->addDays(4)],
            ['title' => 'Écrire le guide de contribution', 'description' => 'Rédiger le CONTRIBUTING.md avec les conventions du projet.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Low, 'due_date' => null],
            ['title' => 'Refactorer le service de facturation', 'description' => 'Extraire la logique Stripe dans un service dédié.', 'status' => TaskStatus::Todo, 'priority' => TaskPriority::Medium, 'due_date' => now()->addDays(10)],
            ['title' => 'Ajouter le cache Redis', 'description' => 'Cacher les requêtes fréquentes avec un TTL de 15 minutes.', 'status' => TaskStatus::Done, 'priority' => TaskPriority::Medium, 'due_date' => now()->subDays(3)],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
