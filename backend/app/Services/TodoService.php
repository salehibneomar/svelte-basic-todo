<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Models\Todo;


class TodoService
{

    public function getAllTodos(Request $request): LengthAwarePaginator
    {
        $params = $request->all();
        return Todo::paginate($params['per_page'] ?? 10);
    }

    public function getTodoById (int $id) : Todo {
        return Todo::findOrFail($id);
    }

}
