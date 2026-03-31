<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'priority'    => 'required|in:low,medium,high',
            'due_date'    => 'nullable|date',
        ]);

        auth()->user()->tasks()->create($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea creada correctamente');
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
            'title'       => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'priority'    => 'required|in:low,medium,high',
            'status'      => 'required|in:pending,in_progress,completed',
            'due_date'    => 'nullable|date',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea actualizada correctamente');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Tarea eliminada correctamente');
    }
}