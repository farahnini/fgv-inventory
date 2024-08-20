<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $task = Task::create($request->only('name'));
        $task->users()->attach($request->users);

        return redirect()->route('tasks.index');
    }
}
