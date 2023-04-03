<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\View\Components\Task as ComponentsTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->user()->id)->get();
        return view('user.tasks_list.index', compact('tasks'));
    }

    /**
     * Crear tareas
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string'
        ]);

        $task = new Task();
        $task->description = $request->description;
        $task->user_id = Auth::user()->id;
        $task->save();

        return redirect()->route('task.list');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit(int $id)
    {
        $task = Task::find($id);
        if ($task->user_id == auth()->user()->id) {
            return view('user.tasks_list.edit', compact('task'));
        }
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'description' => 'required|string'
        ]);

        $task = Task::find($id);

        if (is_null($task)) {
            return redirect()->route('task.list')->with('error', 'Tarea no econtrada.');
        }

        $task->update($request->all());
        return redirect()->route('task.list')->with('success', "Tarea {$request->description} fue actualizada! .");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        if ($task->user_id === auth()->user()->id) {
            $task->delete();
            return redirect()->route('task.list')->with('success', 'Tarea eliminada exitosamente');
        }
    }

    public function updateState(int $id)
    {
        $task = Task::findOrFail($id);
        $task->state_id = State::whereNotIn('id', [$task->state_id])->first()->id;
        $task->update();

        return redirect()->route('task.list')->with('success', 'Estado de la tarea actualizado');
    }
}
