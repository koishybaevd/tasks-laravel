<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'desc')->paginate(4);

        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|min:1|max:255'
        ]);

        Task::create([
            'text' => request('text')
        ]);

        return Redirect::to('/tasks');
    }

    public function destroy(Task $task)
    {
        Task::destroy($task->id);

        return Redirect::to('/tasks');
    }

    public function toggle(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();

        return Redirect::to('/tasks');
    }

    public function completeAll()
    {
        $tasks = Task::all();

        foreach($tasks as $task) {
            $task->completed = true;
            $task->save();
        }

        return Redirect::to('/tasks');
    }
}
