<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Exceptions\BusinessException;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tasks = Task::where('user_id', $request->user()->id)
                ->orderByDesc('id')
                ->paginate(20);
            return $this->successResponse($tasks);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to fetch tasks');
        }
    }

    public function store(TaskStoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = $request->user()->id;
            $task = Task::create($data);
            return $this->successResponse($task, 'Created', 201);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to create task');
        }
    }

    public function update(TaskUpdateRequest $request, $id)
    {
        try {
            $task = Task::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
            $task->update($request->validated());
            return $this->successResponse($task);
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to update task');
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $task = Task::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
            $task->delete();
            return $this->successResponse(null, 'Deleted');
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to delete task');
        }
    }

    public function complete(Request $request, $id)
    {
        try {
            $task = Task::where('id', $id)->where('user_id', $request->user()->id)->firstOrFail();
            $task->update(['is_completed' => true]);
            return $this->successResponse(['task' => $task], 'Completed');
        } catch (\Throwable $e) {
            throw new BusinessException('Unable to complete task');
        }
    }
}
