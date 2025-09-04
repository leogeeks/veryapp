<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::with('user')->orderByDesc('id');
        if ($q = $request->get('q')) {
            $query->where('title', 'like', "%$q%");
        }
        $tasks = $query->paginate(20)->withQueryString();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Work,Family,Personal,Other'],
            'priority' => ['required', 'in:High,Medium,Low'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ]);
        Task::create($data);
        return redirect('/admin/tasks')->with('status', 'Task created');
    }

    public function edit(Task $task)
    {
        $users = User::orderBy('name')->get(['id','name']);
        return view('admin.tasks.edit', compact('task','users'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:Work,Family,Personal,Other'],
            'priority' => ['required', 'in:High,Medium,Low'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'is_completed' => ['sometimes', 'boolean'],
        ]);
        $task->update($data);
        return redirect('/admin/tasks/'.$task->id.'/edit')->with('status', 'Updated');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect('/admin/tasks')->with('status', 'Deleted');
    }

    public function complete(Task $task)
    {
        $task->update(['is_completed' => true]);
        return redirect('/admin/tasks')->with('status', 'Task marked complete');
    }
}
