<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class TaskController extends Controller
{
    public function listAllTasks(Request $request)
{
    $user = $request->user();

    if ($user->role === 'admin') {
        // Récupérer toutes les tâches avec les infos des utilisateurs (join)
        $tasks = Task::with('user')->get();
    } else {
        // Récupérer seulement les tâches liées à l'utilisateur connecté
        $tasks = Task::where('user_id', $user->id)->get();
    }

    return response()->json($tasks);
}

##########################################

public function createTask(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => ['nullable', Rule::in(['à faire', 'en cours', 'terminée'])],
        'user_id' => 'nullable|exists:users,id',
    ]);

    // Logique d'attribution : admin peut attribuer à un autre user
    $assignedUserId = ($user->role === 'admin' && isset($validated['user_id']))
        ? $validated['user_id']
        : $user->id;

    $task = Task::create([
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        'status' => $validated['status'] ?? 'à faire',
        'user_id' => $assignedUserId,
    ]);

    return response()->json([
        'message' => 'Tâche créée avec succès',
        'task' => $task,
    ], 201);
}
#############################################################
public function updateTask(Request $request, $id)
{
    $user = $request->user(); // Récupère l'utilisateur connecté

    // Valider les données reçues (facultatif mais recommandé)
    $validated = $request->validate([
        'title' => 'sometimes|required|string',
        'description' => 'sometimes|nullable|string',
        'status' => 'required|string|in:à faire,en cours,terminée',

    ]);

    // Trouver la tâche
    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Tâche non trouvée'], 404);
    }

    // Vérifier les droits d'accès
    if ($user->role !== 'admin' && $task->user_id !== $user->id) {
        return response()->json(['message' => 'Accès non autorisé'], 403);
    }

    // Mettre à jour la tâche avec les champs envoyés
    $task->update($validated);

    return response()->json([
        'message' => 'Tâche mise à jour avec succès',
        'task' => $task
    ]);
}

public function deleteTask(Request $request, $id)
{
    $user = $request->user();

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Tâche non trouvée'], 404);
    }

    // Vérification des droits d'accès
    if ($user->role !== 'admin' && $task->user_id !== $user->id) {
        return response()->json(['message' => 'Accès non autorisé'], 403);
    }

    // Suppression de la tâche
    $task->delete();

    return response()->json(['message' => 'Tâche supprimée avec succès']);
}

###############################################################################

public function changeTaskStatus(Request $request, $id)
{
    $user = $request->user();

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Tâche non trouvée'], 404);
    }

    if ($user->role !== 'admin' && $task->user_id !== $user->id) {
        return response()->json(['message' => 'Accès non autorisé'], 403);
    }

    $validated = $request->validate([
        'status' => 'required|string|in:en cours,terminée,en attente'
    ]);

    $task->status = $validated['status'];
    $task->save();

    return response()->json([
        'message' => 'Statut de la tâche mis à jour avec succès',
        'task' => $task
    ]);
}



}
