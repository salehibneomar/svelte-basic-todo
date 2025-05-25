<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Todo;
use Illuminate\Support\Arr;

class TodoService
{
    public function getAllTodos(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        return Todo::orderBy('id', 'desc')
                    ->paginate($params['per_page'] ?? 10);
    }

    public function getTodoById(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function createTodo(array $data): Todo
    {
        $todo = new Todo();
        $todo->fill([
            'title' => trim($data['title']),
            'description' => $data['description'] ?? null,
            'is_completed' => $data['is_completed'] ?? 0,
        ])->save();
        return $todo;
    }

    public function updateTodoById(int $id, array $data) : Todo {
        $todo = Todo::findOrFail($id);
        $filteredData = Arr::only($data, $todo->getFillable());
        $todo->fill($filteredData)->save();
        return $todo;
    }

    public function deleteTodoById(int $id): Todo
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return $todo;
    }
}
