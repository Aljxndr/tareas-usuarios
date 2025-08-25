<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:5',
            'description' => 'nullable|max:500',
            'status' => 'required|in:pending,in_progress,completed',
            'user_id' => 'required|exists:users,id',
        ]);

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        $data = $request->validate([
            'title' => 'sometimes|required|min:5',
            'description' => 'nullable|max:500',
            'status' => 'sometimes|required|in:pending,in_progress,completed',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(['message' => 'Task deleted']);
    }
}
