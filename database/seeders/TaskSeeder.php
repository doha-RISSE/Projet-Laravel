<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'title' => 'Tâche admin 1',
            'description' => 'Superviser les utilisateurs',
            'status' => 'à faire',
            'user_id' => 1,
        ]);

        Task::create([
            'title' => 'Tâche Alice',
            'description' => 'Rédiger un rapport',
            'status' => 'en cours',
            'user_id' => 2,
        ]);

        Task::create([
            'title' => 'Tâche Bob',
            'description' => 'Réviser le code',
            'status' => 'terminée',
            'user_id' => 3,
        ]);
    }
}
