<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = auth()->user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        auth()->user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès !');
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_completed' => ['nullable', 'boolean'],
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->boolean('is_completed'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès !');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès !');
    }

    public function toggle(Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'is_completed' => !$task->is_completed,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Statut de la tâche mis à jour !');
    }
}
