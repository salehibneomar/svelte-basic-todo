<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Todo;

class TodoService
{
    /**
     * Get all todos with pagination.
     * @param Request
     * @return LengthAwarePaginator
     */
    public function getAllTodos(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        return Todo::paginate($params['per_page'] ?? 10);
    }

    /**
     * Get a specific todo by ID.
     * @param int
     * @return Todo
     */
    public function getTodoById(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    /**
     * Delete a specific todo by ID.
     * @param int
     * @return Todo
     */
    public function deleteTodoById(int $id): Todo
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return $todo;
    }

    /**
     * Create a new todo.
     * @param array
     * @return Todo
     */
    public function createTodo(array $data): Todo
    {
        $todo = new Todo();
        $todo->fill([
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'is_completed' => $data['is_completed'] ?? false,
        ]);
        $todo->save();
        return $todo;
    }

}
